<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\PremiumAccount;

class PremiumController extends Controller
{
    public function get_premium()
    {
        return view('get_premium');
    }

    public function add_premium_month()
    {
        $user_id = Auth::id();
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addMonth();
        $premium_user = new PremiumAccount();
        $premium_user->user_id = $user_id;
        $premium_user->premium_type = 'month';
        $premium_user->premium_start = $currentDateTime;
        $premium_user->premium_end = $newDateTime;
        $premium_user->save();
        User::where('id', '=', $user_id)->update(['role'=>'premium_user']);

        return redirect()->route('user_auto');
    }

    public function add_premium_year()
    {
        $user_id = Auth::id();
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addYear();
        $premium_user = new PremiumAccount();
        $premium_user->user_id = $user_id;
        $premium_user->premium_type = 'year';
        $premium_user->premium_start = $currentDateTime;
        $premium_user->premium_end = $newDateTime;
        $premium_user->save();
        User::where('id', '=', $user_id)->update(['role'=>'premium_user']);

        return redirect()->route('user_auto');
    }
}
