<?php

namespace App\Models;

use App\Enum\Auth;
use App\Enum\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($user) {
            if (!$user->avatar) {
                $user->avatar = asset(Auth::DEFAULT_AVATAR);
            }
            $user->username = $user->setUserName();
        });
    }

//    public function name(){
//        return ($this->first_name . ' ' . $this->last_name);
//    }

    public function isUsernameExists($username)
    {
        return static::where('username', $username)->exists();
    }

    public function setUserName()
    {
        $username = Str::slug($this->name, '_');
        while ($this->isUsernameExists($username)) {
            $username = $username . '-' . rand(11111, 99999);
        }

        if (!$username || empty(trim($username))) {
            $username = uniqid('ams_');
        }

        return $username;
    }

    public function isAdmin()
    {
        return ($this->role == Role::ADMIN || Role::SUPER_ADMIN);
    }
    public function isModerator(){
        return ($this->role == Role::MODERATOR);
    }
    public function isUser(){
        return ($this->role == Role::USER);
    }
    public function isEmployee(){
        return ($this->role == Role::EMPLOYEE);
    }
}
