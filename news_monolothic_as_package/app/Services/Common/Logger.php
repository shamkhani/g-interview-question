<?php

namespace App\Services\Common;

use Exception;
use Illuminate\Support\Facades\Log;

class Logger
{

    public static function logObject(string $message, $object)
    {
        Log::info(
            'message: ' . $message .
            ', data = ' . $object
        );
    }

    /**
     * log info
     * @param string $message
     * @param array $data
     * @return void
     */
    public static function logMessage(string $message, array $data = null)
    {
        if ($data) {
            Log::info(
                'message: ' . $message .
                ', data = ' . json_encode($data)
            );
        } else {
            Log::info($message);
        }
    }

    /**
     * log info
     * @param $trackingCode
     * @param $action
     * @param $userId
     * @param $data
     * @return void
     */
    public static function logInfo($trackingCode, $action, $userId = '', $data = array())
    {
        Log::info(
            'trackingCode: ' . $trackingCode .
            ', action: ' . $action .
            ', userId: ' . $userId .
            ', data = ' . json_encode($data)
        );
    }

    /**
     * log Error
     * @param Exception $exception
     * @param null $data
     * @param string|null $message
     */
    public static function logError(Exception $exception, $data = null, string $message = null)
    {
        Log::error(
            $exception->getMessage(),
            ['message' => $message, 'data' => json_encode($data), 'trace' => $exception->getTraceAsString()]
        );
    }
}
