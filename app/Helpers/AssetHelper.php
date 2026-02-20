<?php

use App\Models\Order;
use App\Models\Company;
use Illuminate\Support\Str;

/**
 * AssetHelper
 *
 */

/**
 * Return's admin assets directory
 *
 * CALLING PROCEDURE
 *
 * In controller call it like this:
 * $adminAssetsDirectory = adminAssetsDir() . $site_settings->site_logo;
 *
 * In View call it like this:
 * {{ asset(adminAssetsDir() . $site_settings->site_logo) }}
 *
 * @param string $role
 *
 * @return bool
 */
function uploadsDir($path = '')
{
    return $path != '' ? 'uploads/' . $path . '/' : 'uploads/';
}

function uploadsUrl($file = '')
{
    return $file != '' && file_exists(uploadsDir('users') . $file) ? uploadsDir('users') . $file : 'avatar.jpg';
}

function isValidDateTime($dateTimeString) {
    $format = 'Y-m-d h:i A'; // Define the expected format
    $dateTime = DateTime::createFromFormat($format, $dateTimeString);

    // Check if the parsed DateTime object is valid and matches the format
    return $dateTime && $dateTime->format($format) === $dateTimeString;
}

function getGeocodeByAddress($address = '')
{
    if ($address == '') {
        return '';
    }

    $text = urlencode($address);
    $response = file_get_contents("https://geocoder.api.mappable.world/v1/?apikey=pk_IdyZAASOihgTQFedKyNPklJqgzNRdzqsPiqLasTGlvIfzjvoYrHvsBwaiPdiyXHy&geocode=".$text."&kind=metro&lang=en_US&&skip=0&results=1");
    $data = json_decode($response, true);
    $coordinates = '';

    if (isset($data['response']) && isset($data['response']['GeoObjectCollection']) && isset($data['response']['GeoObjectCollection']['featureMember']) && isset($data['response']['GeoObjectCollection']['featureMember'][0]) && isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']) && isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point'])) {
        $coordinates = explode(' ', $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);
    }

    return $coordinates;
}

function createRoute($coordinates = [], $optimize = true)
{
    if (count($coordinates) < 2) {
        return '';
    }

    $coordinates = implode('|', $coordinates);

    $waypoints = urlencode($coordinates);
    $response = file_get_contents("https://router.api.mappable.world/v2/?apikey=pk_jGLPsUVXSzwQimgFDNwlofchPIdEhdsdKaearbKtwUgDiYNsZGGTuVXNCrxSsXmd&waypoints=" . $waypoints . "&optimize=" . $optimize . "&mode=driving");
    $data = json_decode($response, true);

    if (isset($data['route']) && isset($data['route']['legs'])) {
        $totalLength   = 0;
        $totalDuration = 0;
        $coordinates   = [];
        foreach ($data['route']['legs'] as $leg) {
            foreach ($leg['steps'] as $step) {
                $totalLength += $step['length'];
                $totalDuration += $step['duration'];
                foreach ($step['polyline']['points'] as $point) {
                    $coordinates[] = $point;
                }
            }
        }

        $polyline = [
            'id' => 'optimized',
            'draggable' => false,
            'geometry' => [
                'type' => 'LineString',
                'coordinates' => $coordinates,
            ],
            'style' => [
                'stroke' => [
                    [
                        'color' => '#ff2800',
                        'width' => 2.5,
                    ],
                ],
            ],
        ];

        $totalLengthInKm = number_format($totalLength / 1000, 2) . " KM";
        // Convert totalDuration from seconds to hours and minutes
        $hours           = floor($totalDuration / 3600);
        $minutes         = floor(($totalDuration % 3600) / 60);
        $seconds         = number_format($totalDuration % 60, 2);

        if ($hours > 0) {
            $totalDurationFormatted = "{$hours} h {$minutes} m";
        } else {
            $totalDurationFormatted = "{$minutes} minutes";
        }

        return [
            'route' => $polyline,
            'length' => $totalLengthInKm,
            'duration' => $totalDurationFormatted
        ];
    } else {
        return [];
    }
}

function adminHasAssets($image)
{
    if (!empty($image) && file_exists(uploadsDir() . $image)) {
        return true;
    } else {
        return false;
    }
}

function matchChecked($param1, $param2)
{
    return $param1 == $param2 ? ' checked="checked" ' : '';
}

function matchSelected($param1, $param2)
{
    return $param1 == $param2 ? ' selected="selected" ' : '';
}

function generateRandomString($length = 10)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function getGender($id = null)
{
    $values = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function getOrderStatus($id = null)
{
    $values = [
        '1'  => 'Draft',
        '2'  => 'New',
        '3'  => 'Ready',
        '4'  => 'Processing',
        '5'  => 'Shipped',
        '6'  => 'In-transit',
        '7'  => 'Out for Delivery',
        '8'  => 'Delivered',
        '9'  => 'Delivery Attempted',
        '10' => 'Cancelled',
        '11' => 'Closed',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function getReturnOrderStatus($id = null)
{
    $values = [
        '12' => 'Pending Return',
        '13' => 'Dispatched for Return',
        '14' => 'Return in Progress',
        '15' => 'Return Completed',
        '16' => 'Return Attempted',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function getStatus($id = null)
{
    $values = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function filterUrl($key = '', $value = '')
{
    $data = $_SERVER['QUERY_STRING'];

    $data = str_replace(urlencode($key) . '=' . $value, '', $data);
    $data = str_replace('&&', '&', $data);

    return $data;
}

function getTransactionType($id = null)
{
    $values = [
        1 => 'Buy',
        2 => 'Sell',
        3 => 'Lease',
        4 => 'Rent',
    ];

    return isset($id) && $id <= 4 && $id >= 1 ? $values[$id] : $values;
}

function generateOrderNumber()
{
    $lastOrder = Order::orderBy('id', 'desc')->first();

    if ($lastOrder) {
        $orderNo = str_replace('BP-', '', $lastOrder->order_id);
        // If records exist, increment the last incident number
        $nextNumber = str_pad($orderNo + 1, 6, '0', STR_PAD_LEFT);
        $nextNumber = 'BP-' . $nextNumber;
    } else {
        // If no records exist, start with 000001
        $nextNumber = 'BP-000001';
    }

    return $nextNumber;
}