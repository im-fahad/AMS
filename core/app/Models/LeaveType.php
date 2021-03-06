<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'name'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($type) {
            $type->creator_id = auth()->user()->id;
        });
    }

    public function leaves(){
        return $this->hasMany(Leave::class,'type_id');
    }
}
