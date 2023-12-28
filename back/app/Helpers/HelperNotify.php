<?php

namespace App\Helpers;

class HelperNotify
{
    // AQUÍ SE ALMACENAN LOS 3 TIPOS DE MENSAJES, ESTO CAE EN EL FRONT EN LA RUTA boot/helpers.js PARA ASÍ MOSTRAR
    // LA NOTIFICACIÓN
    public function getNotify ($key = 'exception', $message = '') {
        $notifications = [
            'success' => [
                'message' => $message,
                'color' => 'positive',
                'position' => 'top',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'error' => [
                'message' => $message,
                'color' => 'warning',
                'position' => 'top',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'exception' => [
                'message' => $message,
                'color' => 'red-6',
                'position' => 'top',
                'icon' => 'close',
                'timeout' => 5000,
            ]
        ];

        // RETORNA SI SE MANDA UN NOMBRE CONOCIDO SI NO, RETORNA LO DE EXCEPTION
        return array_key_exists($key, $notifications) ? $notifications[$key] : $notifications['exception'];
    }
}