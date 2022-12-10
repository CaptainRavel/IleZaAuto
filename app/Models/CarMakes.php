<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMakes extends Model
{
    use HasFactory;
    protected $table = 'car_makes';
    protected $primaryKey = 'id_car_make';

    protected $fillable = [
        'name',
    ];
}
