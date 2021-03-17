<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'name',
        'email',
        'phone',
        'address',
        'logo',
        'description',
        'weekly_working_days',
        'week_start',
        'week_end',
        'daily_working_hour',
        'hour_start',
        'hour_end',
        'yearly_leave',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($company) {
            if (!$company->logo) {
                $company->logo = asset(\App\Enum\Company::DEFAULT_LOGO);
            }
            $company->creator_id = auth()->user()->id;
            $company->username = $company->setUserName();
        });
    }

    public function isUserNameExists($username)
    {
        return static::where('username', $username)->exists();
    }

    public function setUserName()
    {
        $username = Str::slug($this->name, '_');
        while ($this->isUserNameExists($username)) {
            $username = $username . '_' . rand(11111, 99999);
        }

        if (!$username || empty(trim($username))) {
            $username = uniqid('company_');
        }

        return $username;
    }

    public function employee()
    {
        $this->belongsTo(User::class, 'creator_id', 'id');
    }
}