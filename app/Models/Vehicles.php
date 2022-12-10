<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    public function models()
    {
        return $this->hasMany('App\Models\VehiclesTypes');
        return $this->hasMany('App\Models\VehiclesBrands');
        return $this->hasMany('App\Models\VehiclesModels');
        return $this->hasMany('App\Models\VehiclesGenerations');
        return $this->hasMany('App\Models\VehiclesSeries');
        return $this->hasMany('App\Models\VehiclesEngines');
    }

    protected $fillable = [
        'vehicle_type',
        'make',
        'model',
        'generation',
        'year_from',
        'year_to',
        'series',
        'trim',
        'body_type',
        'load_height_mm',
        'number_of_seats',
        'length_mm',
        'width_mm',
        'height_mm',
        'wheelbase_mm',
        'front_track_mm',
        'rear_track_mm',
        'curb_weight_kg',
        'wheel_size_r14',
        'ground_clearance_mm',
        'trailer_load_with_brakes_kg',
        'payload_kg',
        'back_track_width_mm',
        'front_track_width_mm',
        'clearance_mm',
        'full_weight_kg',
        'front_rear_axle_load_kg',
        'max_trunk_capacity_l',
        'cargo_compartment_length_width_height_mm',
        'cargo_volume_m3',
        'minimum_trunk_capacity_l',
        'maximum_torque_n_m',
        'injection_type',
        'overhead_camshaft',
        'cylinder_layout',
        'number_of_cylinders',
        'compression_ratio',
        'engine_type',
        'valves_per_cylinder',
        'boost_type',
        'cylinder_bore_mm',
        'stroke_cycle_mm',
        'engine_placement',
        'cylinder_bore_and_stroke_cycle_mm',
        'turnover_of_maximum_torque_rpm',
        'max_power_kw',
        'presence_of_intercooler',
        'capacity_cm3',
        'engine_hp',
        'engine_hp_rpm',
        'drive_wheels',
        'bore_stroke_ratio',
        'number_of_gears',
        'turning_circle_m',
        'transmission',
        'mixed_fuel_consumption_per_100_km_l',
        'range_km',
        'emission_standards',
        'fuel_tank_capacity_l',
        'acceleration_0_100_km/h_s',
        'max_speed_km_per_h',
        'city_fuel_per_100km_l',
        'CO2_emissions_g/km',
        'fuel_grade',
        'highway_fuel_per_100km_l',
        'back_suspension',
        'rear_brakes',
        'front_brakes',
        'front_suspension',
        'steering_type',
        'car_class',
        'country_of_origin',
        'number_of_doors',
        'safety_assessment',
        'rating_name',
        'battery_capacity_KW_per_h',
        'electric_range_km',
        'charging_time_h'               
    ];

    protected $hidden = [
        'vehicle_id',
        'type_id',
        'make_id',
        'model_id',
        'generation_id',
        'series_id',
        'trim_id'
    ];
}
