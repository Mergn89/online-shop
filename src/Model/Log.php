<?php

namespace Model;

class Log extends Model
{
    public static function createLog(string $message, string $file, string $line, string $time): void
    {
        $stmt = self::connectToDatabase()->prepare("INSERT INTO logs (message, file, line, time) VALUES (:message, :file, :line, :time)");
        $stmt->execute(['message' => $message, 'file' => $file, 'line' => $line, 'time' => $time]);
    }

}