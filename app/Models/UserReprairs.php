<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class UserReprairs extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['reprair_date','price'];

    protected $fillable = [        
        'user_id',
        'reprair_date' ,
        'car_mileage',
        'reprair_location',
        'reprair_subject',
        'price'
    ];

    protected $hidden = [
        'reprair_id'
    ];

    public static function getReprairs(){
        $reprairs = DB::table('user_reprairs')->select('reprair_date','reprair_subject', 'reprair_location', 'car_mileage', 'price')->OrderBy('reprair_date', 'desc')->get()->toArray();
        return $reprairs;
    }
}
