<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function user_list()
    {
        $user_list = User::select('id','name','email','role')->orderby('name')->paginate(10, ['*']);
        return view('admin_panel', ["user_list"=>$user_list]);
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $found_users_list = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->get();
        
            return view('search_user', ["found_user_list"=>$found_users_list]);
    }
}
