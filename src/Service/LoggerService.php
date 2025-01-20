<?php

namespace Service;


class LoggerService
{
    public function recordError(\Throwable $exception): void
    {
        date_default_timezone_set('Asia/Irkutsk');

        $path = './../Storage/log/error.txt';
        $message = 'error: '.$exception->getMessage();
        $file = 'file: '.$exception->getFile();
        $line = 'line: '.$exception->getLine();
        $date = date('d-m-Y-H-i-s');

        file_put_contents($path, print_r($date.PHP_EOL.$message.PHP_EOL.$file.PHP_EOL.$line, true).PHP_EOL."\n", FILE_APPEND);

    }

}