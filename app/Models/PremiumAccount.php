<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumAccount extends Model
{
    use HasFactory;
    protected $table = 'premium_accounts';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'premium_type',
        'premium_start',
        'premium_end'
    ];
}
