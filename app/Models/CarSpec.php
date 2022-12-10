<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpec extends Model
{
    use HasFactory;
    protected $table = 'cars_specs';
    protected $primaryKey = 'id_car_specification_value';

    protected $fillable = [
        'value',
        'unit',
        'spec_name',
    ];
}
