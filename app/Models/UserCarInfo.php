<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCarInfo extends Model
{
    use HasFactory;
    protected $fillable = [        
        'user_id',
        'make' ,
        'model',
        'production_year',
        'oc_date',
        'tech_rev_date' 
    ];

    protected $hidden = [
    ];

    public function userCar(){
        return $this->belongsTo(User::class, 'id');
    }
}
