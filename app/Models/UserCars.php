<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCars extends Model
{
    use HasFactory;
    protected $table = 'user_cars';
    protected $primaryKey = 'car_id';
    protected $fillable = [     
        'user_id',
        'car_make' ,
        'car_model',
        'production_year',
        'oc_date',
        'tech_rev_date',
        'name',
        'image',
    ];

    protected $hidden = [
    ];

    public function userCar(){
        return $this->belongsTo(User::class, 'id');
    }
}
