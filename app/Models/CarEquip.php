<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarEquip extends Model
{
    use HasFactory;
    protected $table = 'cars_equips';
    protected $primaryKey = 'id_car_option_value';

    protected $fillable = [
        'equip_value_name',
        'is_base',
        'year',
    ];
}
