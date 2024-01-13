<?php

namespace App\Helpers;

class Helper{

    public function __construct(){

    }

    public static function getRemainingTime($finishDate): array{
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $finishDate);
        $now = new \DateTime();

        if($date > $now){
            // you can still upload task on time
            $remainingTime = $now->diff($date);
            $onTime = true;
        } else {
            // you're too late
            $remainingTime = $date->diff($now);
            $onTime = false;
        }

        return [$remainingTime->format('%Y-%m-%d %H:%I:%S'), $onTime];
    }

    public static function formatSizeUnits($bytes): string{
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, 2) . ' ' . $units[$pow];
    }

}
