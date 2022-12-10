<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarEquipments extends Model
{
    use HasFactory;
    protected $table = 'car_equipments';
    protected $primaryKey = 'id_car_equipment';

    protected $fillable = [
        'name',
        'year',
    ];
}
