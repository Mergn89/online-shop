<?php

namespace Service\Logger;


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

//        $message = 'error: '.$exception->getMessage();
//        $file = 'file: '.$exception->getFile();
//        $line = 'line: '.$exception->getLine();
//        file_put_contents($path, print_r($date.PHP_EOL.$message.PHP_EOL.$file.PHP_EOL.$line, true).PHP_EOL."\n", FILE_APPEND);

    }

//    public function __construct() {
//        // Устанавливаем обработчик ошибок
//        set_error_handler([$this, 'handleError']);
//    }
//
//    public function handleError(int $errno, string $errstr, string $errfile, int $errline): void
//    {
//        if ($errno === E_WARNING) {
//            $this->warning($errstr, [
//                'file' => $errfile,
//                'line' => $errline
//            ]);
//        }
//    }

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