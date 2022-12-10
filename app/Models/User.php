<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'is_email_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function userRefuels(){
        return $this->hasMany(UserRefuels::class,'user_id');
    }
    public function userReprairs(){
        return $this->hasMany(UserReprairs::class,'user_id');
    }
    public function userCar(){
        return $this->hasMany(UserCar::class,'user_id');
    }
    public function userCarInfo(){
        return $this->hasMany(UserCarInfo::class,'user_id');
    }
}
