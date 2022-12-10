<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class UserRefuels extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['refueling_date','fuel','price','distance'];

    protected $fillable = [        
        'user_id',
        'fuel' ,
        'price',
        'distance',
        'refueling_date',
        'avg_fuel_consumption' 
    ];

    protected $hidden = [
        'refueling_id'
    ];

    public static function getRefuels(){
        $refuels = DB::table('user_refuels')->select('refueling_date','fuel', 'distance', 'price', DB::raw('round(fuel / distance * 100, 2) as spalanie'))->OrderBy('refueling_date', 'desc')->get()->toArray();
        return $refuels;
    }


}