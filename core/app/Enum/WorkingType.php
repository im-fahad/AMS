<?php


namespace App\Enum;

interface WorkingType
{
    const FULL_TIME = 1;
    const HALF_DAY = 2;


    const WORKING_TYPES = [
        self::FULL_TIME, self::HALF_DAY
    ];

    const LIST = [
        self::FULL_TIME => 'full time',
        self::HALF_DAY => 'half day',
    ];
}

