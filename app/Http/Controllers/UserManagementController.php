<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\UserCars;
use App\Models\UserRefuels;
use App\Models\UserReprairs;
use Illuminate\Http\Request;
use App\Models\PremiumAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_edit(Request $request, $id){
        $user_id = $id;
        $user_name = User::select('name')->where('id', '=', $user_id)->get();
        $user_email = User::select('email')->where('id', '=', $user_id)->get();
        $user_role = User::select('role')->where('id', '=', $user_id)->get();
        $user_cars_number = UserCars::where('user_id', '=', $user_id)->count('car_id');
        $user_raports_number = UserRefuels::where('user_id', '=', $user_id)->count('refueling_id') + UserReprairs::where('user_id', '=', $user_id)->count('reprair_id');
        $currentDateTime = Carbon::now();
        $p_end = strtotime(PremiumAccount::where('user_id', '=', $user_id)->value('premium_end'));
        $premium_end = date('d.m.Y H:i', $p_end);
        $days = '(' . (string)$currentDateTime->diffInDays(PremiumAccount::where('user_id', '=', $user_id)->value('premium_end')) . ' dni)';
        $user_verify_status = User::select('is_email_verified')->where('id', '=', $user_id)->get();
        return view('user_management', ["user_id"=>$user_id,"user_name"=>$user_name,
                    "user_email"=>$user_email, "user_role"=>$user_role, "user_verify_status"=>$user_verify_status,
                    "premium_end"=>$premium_end, "days"=>$days, "user_cars_number"=>$user_cars_number, "user_raports_number"=>$user_raports_number]);
    }

    public function update_nick(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required|max:255']);

        $user_id = $id;
        $nick = $request->name;
        User::where('id', '=', $user_id)->update(['name' => $nick]);
    
        return redirect()->route('user_management', $user_id);
    }

    public function verify_user_email($id){

        $user_id = $id;
        $verify_status=User::where('id', '=', $user_id)->value('is_email_verified');
        if ($verify_status == 0){
            $verify_status = 1;
            User::where('id', '=', $user_id)->update(['is_email_verified' => $verify_status]);
        }
        else{
            $verify_status = 0;
            User::where('id', '=', $user_id)->update(['is_email_verified' => $verify_status]);
        }
        return redirect()->route('user_management', $user_id);
    }

    public function update_email(Request $request, $id){

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);

        $user_id = $id;
        $mail = $request->email;
        User::where('id', '=', $user_id)->update(['email' => $mail]);
    
        return redirect()->route('user_management', $user_id);
    }
    public function update_password(Request $request, $id){

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8']]);

        $user_id = $id;
        $pass = Hash::make($request->password);
        User::where('id', '=', $user_id)->update(['password' => $pass]);
    
        return redirect()->route('user_management', $user_id);
    }
    public function destroy_user($id){

        $user_id = $id;
    
        $user_cars = UserCars::where('user_id', '=', $user_id)->get();
        foreach($user_cars as $car){
            $file_path = public_path('img/users_car_images/'.$car->image);
            if (File::exists($file_path)){
                File::delete($file_path);
            }

            $refuels_files = UserRefuels::where('car_id', '=', $car->car_id)->get();        
            foreach($refuels_files as $raport_file){
                $raport_file_path = public_path('users_reports_files/'.$raport_file->file);
                if (File::exists($raport_file_path)){
                    File::delete($raport_file_path);
                    }
                }
            $reprairs_files = UserReprairs::where('car_id', '=', $car->car_id)->get();        
            foreach($reprairs_files as $raport_file){
                $raport_file_path = public_path('users_reports_files/'.$raport_file->file);
                if (File::exists($raport_file_path)){
                    File::delete($raport_file_path);
                    }
                }
        }
        User::where('id', '=', $user_id)->delete();
        UserCars::where('user_id', '=', $user_id)->delete();      
        UserRefuels::where('user_id', '=', $user_id)->delete();
        UserReprairs::where('user_id', '=', $user_id)->delete();

        return redirect()->route('admin_panel');
    }

        public function add_premium_month($id)
        {
            $user_id = $id;
            $currentDateTime = Carbon::now();
            $newDateTime = Carbon::now()->addMonth();
            $premium_user = new PremiumAccount();
            $premium_user->user_id = $user_id;
            $premium_user->premium_type = 'month';
            $premium_user->premium_start = $currentDateTime;
            $premium_user->premium_end = $newDateTime;
            $premium_user->save();
            User::where('id', '=', $user_id)->update(['role'=>'premium_user']);
    
            return redirect()->route('user_management', $user_id);
        }
    
        public function add_premium_year($id)
        {
            $user_id = $id;
            $currentDateTime = Carbon::now();
            $newDateTime = Carbon::now()->addYear();
            $premium_user = new PremiumAccount();
            $premium_user->user_id = $user_id;
            $premium_user->premium_type = 'year';
            $premium_user->premium_start = $currentDateTime;
            $premium_user->premium_end = $newDateTime;
            $premium_user->save();
            User::where('id', '=', $user_id)->update(['role'=>'premium_user']);
    
            return redirect()->route('user_management', $user_id);
        }

        public function add_premium_off($id)
        {
            $user_id = $id;
            User::where('id', '=', $user_id)->update(['role'=>'user']);
            PremiumAccount::where('user_id', '=', $user_id)->delete();
    
            return redirect()->route('user_management', $user_id);
        }

        public function user_auto_management($id)
        {
            $user_id = $id;
            $user_name = User::where('id', '=', $user_id)->value('name');
            $user_number = User::where('id', '=', $user_id)->value('id');
            $exist = UserCars::where('user_id', '=', $user_id)->exists();
            $user_cars = UserCars::where('user_id', '=', $user_id)->get();
            $cars_count = $user_cars->count();
            return view('user_auto_management', ["user_cars"=>$user_cars, "exist"=>$exist, "cars_count"=>$cars_count, "user_name"=>$user_name, "user_number"=>$user_number]);
        }

        public function destroy_user_car_admin($user_id, $car_id){

            $id = $car_id;
            $uid = $user_id;
            $image_path = UserCars::select('image')->where('car_id', '=', $id)->value('image');
            $file_path = public_path('img/users_car_images/'.$image_path);
            if (File::exists($file_path)){
                File::delete($file_path);
            }
            $refuels_files = UserRefuels::where('car_id', '=', $id)->get();        
            foreach($refuels_files as $raport_file){
                $raport_file_path = public_path('users_reports_files/'.$raport_file->file);
                if (File::exists($raport_file_path)){
                    File::delete($raport_file_path);
                    }
                }
            $reprairs_files = UserReprairs::where('car_id', '=', $id)->get();        
            foreach($reprairs_files as $raport_file){
                $raport_file_path = public_path('users_reports_files/'.$raport_file->file);
                if (File::exists($raport_file_path)){
                    File::delete($raport_file_path);
                    }
                }
            UserCars::where('car_id', '=', $id)->delete();
            UserRefuels::where('car_id', '=', $id)->delete();
            UserReprairs::where('car_id', '=', $id)->delete();
    
            return redirect()->route('user_auto_management',$uid);
        }

        public function user_auto_raports_management($user_id, $car_id)
        {
            $uid = $user_id;
            $cid = $car_id;
            $current_car_name= UserCars::select('name')->Where('car_id', '=', $cid)->value('name');
            $user_number = User::where('id', '=', $user_id)->value('id');
            $cars_list = UserCars::where('user_id', '=', $uid)->get();
            $refuel_list = UserRefuels::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sortable(['refueling_date' => 'desc'])->paginate(5, ['*'], 'refuels');
            $reprair_list = UserReprairs::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sortable(['reprair_date' => 'desc'])->paginate(5, ['*'], 'reprairs');
            $refuel_sum = UserRefuels::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sum('fuel');
            $distance_sum = UserRefuels::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sum('distance');
            $price_sum = UserRefuels::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sum('price');
            $reprair_sum = UserReprairs::where('user_id', '=', $uid)->where('car_id', '=', $cid)->sum('price');
            return view('user_car_raports_management', ["refuel_list"=>$refuel_list,
                        "reprair_list"=>$reprair_list, "cars_list"=>$cars_list, "current_car"=>$cid, "user_number"=>$user_number,
                        "current_car_name"=>$current_car_name, 'refuel_sum'=>$refuel_sum, 'distance_sum'=>$distance_sum,
                        'price_sum'=>$price_sum, 'reprair_sum'=>$reprair_sum,"title" => "Moje konto"]);
        }
    
        public function add_user(Request $request){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $pass = Hash::make($request->password);

            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->email;
            $new_user->password = $pass;
            $new_user->role = UserRole::USER;
            $new_user->is_email_verified = 1;
            $new_user->save();

            return redirect()->route('admin_panel');
        }
}
