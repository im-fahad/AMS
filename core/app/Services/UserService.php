<?php


namespace App\Services;


use App\Models\User;

class UserService extends Service
{
    public function storeUserDetails($data)
    {
        User::update($data);
    }
}
