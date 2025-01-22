<?php

namespace Service\Logger;

use Model\Log;

class LoggerDbService implements LoggerServiceInterface
{
    public function error(string $message, array $data = []): void
    {
        $error = $data['message'];
        $file = $data['file'];
        $line = $data['line'];
        $time = $data['time'];
        Log::createLog($error, $file, $line, $time);

    }

    public function info(string $message, array $data = [])
    {

    }

    public function warning(string $message, array $data = [])
    {

    }



}