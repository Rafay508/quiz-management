<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Firebase\JWT\JWT;

class NotificationController extends Controller
{
    public function saveSubscription(Request $request)
    {
        $keys = $request->keys;

        // Insert or update subscription data in the database
        Subscription::updateOrInsert(
            ['endpoint' => $request->endpoint], // Ensure no duplicate subscriptions
            [
                'endpoint' => $request->endpoint,
                'keys' => json_encode($keys), // Store keys as a JSON string
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    }

    public function sendPushNotificationToAll()
    {
        // Get all subscriptions from the database
        $subscriptions = Subscription::all();  // Assuming you have a Subscription model

        $publicKey = env('VAPID_PUBLIC_KEY');
        $privateKey = env('VAPID_PRIVATE_KEY');
        $subject = env('VAPID_SUBJECT');

        // Iterate over each subscription and send notification
        foreach ($subscriptions as $subscription) {
            $jwt = $this->generateVapidAuthorizationHeader($publicKey, $privateKey, $subject, $subscription->endpoint);

            // Setup the push notification payload
            $payload = json_encode([
                'notification' => [
                    'title' => 'New Notification',
                    'body' => 'This is a test message',
                    'icon' => 'path/to/icon.png',
                ]
            ]);

            // Send the notification using cURL
            $ch = curl_init($subscription->endpoint);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: WebPush ' . $jwt,
                'Content-Type: application/json',
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            $response = curl_exec($ch);
            curl_close($ch);

            // Optionally log the response for debugging
            \Log::info('Notification sent to: ' . $subscription->endpoint);
            \Log::info('Response: ' . $response);
        }

        return response()->json(['success' => true, 'message' => 'Notifications sent']);
    }

    private function sendPushNotification($subscription, $vapidPublicKey, $vapidPrivateKey, $vapidSubject)
    {
        // Notification data
        $payload = [
            'notification' => [
                'title' => 'New Notification',
                'body' => 'This is a test push notification.',
                'icon' => '/path/to/icon.png',  // Your icon
                'badge' => '/path/to/badge.png',  // Your badge icon
            ]
        ];

        // Prepare headers
        $headers = [
            'Authorization' => 'vapid ' . $this->generateVapidAuthorizationHeader($vapidPublicKey, $vapidPrivateKey, $vapidSubject, $subscription->endpoint),
            'Content-Type' => 'application/json',
        ];

        // Send the push notification request
        $response = Http::withHeaders($headers)->post($subscription->endpoint, $payload);

        // Check response for success or failure
        if ($response->failed()) {
            \Log::error("Failed to send notification to: " . $subscription->endpoint);
        }
    }

    private function generateVapidAuthorizationHeader($publicKey, $privateKey, $subject, $endpoint)
    {
        $payload = [
            'aud' => $endpoint,
            'sub' => $subject,
        ];

        // The JWT header
        $header = [
            'alg' => 'ES256',  // The algorithm used for signing
            'typ' => 'JWT',    // Type of the token
            'x5c' => [$publicKey], // The public key is added in 'x5c' field
        ];

        // Check if private key is in PEM format
        if (strpos($privateKey, 'BEGIN PRIVATE KEY') === false) {
            $privateKey = "-----BEGIN PRIVATE KEY-----\n" . chunk_split($privateKey, 64, "\n") . "-----END PRIVATE KEY-----";
        }

        // Check if private key is valid
        if (!openssl_pkey_get_private($privateKey)) {
            throw new \Exception("Invalid private key format.");
        }

        // Generate JWT token using the correct header array
        $jwt = JWT::encode($payload, $privateKey, 'ES256', null, $header);

        return $jwt;
    }
}
