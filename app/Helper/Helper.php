<?php

namespace App\Helper;

class Helper{
    public function getRemainingTime($finishDate): array{
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

//        $currentTime = Carbon::now()->timestamp;
//        $finishTime = Carbon::parse($finishDate)->timestamp;
//        $remainingTime = $finishTime - $currentTime;
//        return Carbon::createFromTimestamp($remainingTime)->format('H:i:s');
    }

}
