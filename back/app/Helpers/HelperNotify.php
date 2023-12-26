<?php

namespace App\Helpers;

class HelperNotify
{
    public function getNotify ($key = 'exception', $message = '') {
        $notifications = [
            'success' => [
                'message' => $message,
                'color' => 'positive',
                'position' => 'top-right',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'error' => [
                'message' => $message,
                'color' => 'warning',
                'position' => 'top-right',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'exception' => [
                'message' => $message,
                'color' => 'red-6',
                'position' => 'top-right',
                'icon' => 'close',
                'timeout' => 5000,
            ]
        ];

        return array_key_exists($key, $notifications) ? $notifications[$key] : $notifications['exception'];
    }
}