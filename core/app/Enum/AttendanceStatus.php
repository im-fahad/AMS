<?php


namespace App\Enum;


class AttendanceStatus
{
    const SIGN_IN = 1;
    const SIGN_OUT = 2;
    const PENDING = 3;


    const ATTENDANCE_STATUS = [
        self::SIGN_IN, self::SIGN_OUT, self::PENDING
    ];

    const LIST = [
        self::SIGN_IN => 'sign in',
        self::SIGN_OUT => 'sign out',
        self::PENDING => 'pending',
    ];
}
