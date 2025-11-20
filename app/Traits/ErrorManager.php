<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ErrorManager
{
    /**
     * Log error details to the errors channel (static method).
     *
     * @param string $message
     * @param string $invoking_file_path
     * @param int $error_line_number
     * @param string $file_path
     * @return void
     */
    public static function registerError($message, $invoking_file_path, $error_line_number, $file_path)
    {
        $log_message = PHP_EOL;
        $log_message .= '-------------------------------------------------------' . PHP_EOL;
        $log_message .= 'Error Message: ' . $message . PHP_EOL;
        $log_message .= 'Error Invoking File Path: ' . $invoking_file_path . PHP_EOL;
        $log_message .= 'Error File Path: ' . $file_path . PHP_EOL;
        $log_message .= 'Error Line Number: ' . $error_line_number . PHP_EOL;
        $log_message .= '-------------------------------------------------------' . PHP_EOL;
        Log::channel('errors')->error($log_message);
    }
}
