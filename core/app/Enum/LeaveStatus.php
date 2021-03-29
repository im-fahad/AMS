<?php


namespace App\Enum;

interface LeaveStatus
{
    const PENDING = 1;
    const ACCEPTED = 2;
    const ACCEPTED_WITH_MESSAGE = 3;
    const REJECTED = 4;


    const LEAVE_STATUS = [
        self::PENDING, self::ACCEPTED, self::ACCEPTED_WITH_MESSAGE, self::REJECTED
    ];

    const LIST = [
        self::PENDING => 'pending',
        self::ACCEPTED => 'accepted',
        self::ACCEPTED_WITH_MESSAGE => 'accepted with message',
        self::REJECTED => 'rejected',
    ];
}
