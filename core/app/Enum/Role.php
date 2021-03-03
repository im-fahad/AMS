<?php


namespace App\Enum;


interface Role
{
    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const MODERATOR = 3;
    const USER = 4;
    const EMPLOYEE = 5;

    const DEFAULT_ROLE = self::USER;

    const ROLES = [
        self::SUPER_ADMIN, self::ADMIN, self::USER, self::MODERATOR, self::EMPLOYEE
    ];

    const LIST = [
        self::SUPER_ADMIN => 'super admin',
        self::ADMIN => 'admin',
        self::USER => 'user',
        self::MODERATOR => 'moderator',
        self::EMPLOYEE => 'employee',
    ];
}
