<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarGenerations extends Model
{
    use HasFactory;
    protected $table = 'car_generations';
    protected $primaryKey = 'id_car_generation';

    protected $fillable = [
        'name',
        'year_begin',
        'year_end',
    ];
}
