// Handle push notifications
self.addEventListener('push', function(event) {
    console.log('Push event received:', event);

    if (event.data) {
        const data = event.data.json();  // Parse the incoming push notification data
        console.log('Push data:', data);

        // Show the notification
        self.registration.showNotification(data.title, {
            body: data.body,
            icon: data.icon || '/default-icon.png',
            badge: data.badge || '/default-badge.png',
            data: data.url || null,  // Optionally add a URL
        });
    } else {
        console.warn('Push event but no data.');
    }
});

// Handle notification click
self.addEventListener('notificationclick', function(event) {
    console.log('Notification clicked:', event.notification);
    
    event.notification.close();  // Close the notification

    // Open the URL attached to the notification (if available)
    if (event.notification.data) {
        event.waitUntil(
            clients.openWindow(event.notification.data)
        );
    }
});