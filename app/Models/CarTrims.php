<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTrims extends Model
{
    use HasFactory;
    protected $table = 'car_trims';
    protected $primaryKey = 'id_car_trim';

    protected $fillable = [
        'name',
        'star_production_year',
        'end_prduction_year',
    ];
}
