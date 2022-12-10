<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModels extends Model
{
    use HasFactory;
    protected $table = 'car_models';
    protected $primaryKey = 'id_car_model';

    protected $fillable = [
        'name',
    ];
}
