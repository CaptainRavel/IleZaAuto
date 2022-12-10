<?php


namespace App\Enums;


class UserRole
{
    const ADMIN = 'admin';
    const USER = 'user';
    const P_USER = 'premium_user';
    const T_USER = 'test_user';

    const TYPES =[
        self::ADMIN,
        self::USER,
        self::P_USER.
        self::T_USER
    ];
}