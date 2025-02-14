<?php

namespace Service\Logger;

use Mergen\Core\LoggerServiceInterface;


class LoggerFileService implements LoggerServiceInterface
{
    public function error(string $message, array $data = []): void
    {
        $path = './../Storage/log/error.txt';
        $time = date('d-m-Y-H-i-s');

        file_put_contents($path, "\n".$message, FILE_APPEND);
        foreach ($data as $key => $error) {
            file_put_contents($path, "\n$key: $error", FILE_APPEND);
        }

    }


    public function info(string $message, array $data = []): void
    {
        $path = './../Storage/log/info.txt';

    }

    public function warning(string $message, array $data = []): void
    {
        $path = './../Storage/log/warning.txt';

        $time = date('d-m-Y-H-i-s');

        file_put_contents($path, "\n WARNING: ".$message, FILE_APPEND);
        foreach ($data as $key => $warning) {
            file_put_contents($path, "\n$key: $warning", FILE_APPEND);
        }
    }


}