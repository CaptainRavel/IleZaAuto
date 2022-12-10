<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRefuels;
use App\Models\UserReprairs;
use App\Models\UserCars;
use App\Models\CarMakes;
use App\Models\CarModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;
use App\Exports\RefuelsExport; 
use App\Exports\ReprairsExport;
use Excel;
use Illuminate\Auth\Access\Gate;

class UserCarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function user_raports()
    {
        $user_id = Auth::id();
        $exist = UserCars::where('user_id', '=', $user_id)->exists();
        $user_role = User::where('id', '=', $user_id)->value('role');
        if ($user_role == 'user' || $user_role == 'test_user'){
            $user_cars = UserCars::where('user_id', '=', $user_id)->orderBy('created_at')->limit(2)->get();  
        }
        else{
            $user_cars = UserCars::where('user_id', '=', $user_id)->get();
        }
        return view('user_raports', ["user_cars"=>$user_cars, "exist"=>$exist]);
    }
    public function user_car_raports($car)
    {
        $user_id = Auth::id();
        $car_id=$car;
        $user_role = User::where('id', '=', $user_id)->value('role');
        $current_car_name= UserCars::select('name')->Where('car_id', '=', $car)->value('name');
        if ($user_role == 'user' || $user_role == 'test_user'){
            $cars_list = UserCars::where('user_id', '=', $user_id)->orderBy('created_at')->limit(2)->get();  
        }
        else{
            $cars_list = UserCars::where('user_id', '=', $user_id)->get();
        }
        $refuel_list = UserRefuels::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sortable(['refueling_date' => 'desc'])->paginate(5, ['*'], 'refuels');
        $reprair_list = UserReprairs::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sortable(['reprair_date' => 'desc'])->paginate(5, ['*'], 'reprairs');
        $refuel_sum = UserRefuels::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sum('fuel');
        $distance_sum = UserRefuels::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sum('distance');
        $price_sum = UserRefuels::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sum('price');
        $reprair_sum = UserReprairs::where('user_id', '=', $user_id)->where('car_id', '=', $car_id)->sum('price');
        if($cars_list->contains('car_id',$car_id)){
        return view('user_car_raports', ["refuel_list"=>$refuel_list,
                    "reprair_list"=>$reprair_list, "cars_list"=>$cars_list, "current_car"=>$car,
                    "current_car_name"=>$current_car_name, 'refuel_sum'=>$refuel_sum, 'distance_sum'=>$distance_sum,
                    'price_sum'=>$price_sum, 'reprair_sum'=>$reprair_sum,"title" => "Moje konto"]);
        }
        else{
            return view('errors.403');
        }
    }
    
    public function store_refuels(Request $request){
    
        if ($request->file != NULL){
            $newFileName = time() . '-' . $request->car_id . '.' . $request->file->extension();
            $request->file->move(public_path('users_reports_files'), $newFileName);
            $file = $newFileName;
            }
        else{
            $file = NULL;
            }

        $refuel_list = new UserRefuels();
        $refuel_list->user_id = Auth::id();
        $refuel_list->fuel = $request->fuel;
        $refuel_list->price = $request->price;
        $refuel_list->refueling_date = $request->refueling_date;
        $refuel_list->distance = $request->distance;
        $refuel_list->car_id = $request->car_id;
        $refuel_list->file = $file;
        $refuel_list->save();
    
        return redirect()->route('user_raports.car_reports', $request->car_id);
    }

    public function store_reprairs(Request $request){
    
        if ($request->file != NULL){
            $newFileName = time() . '-' . $request->car_id . '.' . $request->file->extension();
            $request->file->move(public_path('users_reports_files'), $newFileName);
            $file = $newFileName;
            }
        else{
            $file = NULL;
            }

        $reprair_list = new UserReprairs();
        $reprair_list->user_id = Auth::id();
        $reprair_list->reprair_date = $request->reprair_date;
        $reprair_list->car_mileage = $request->car_mileage;
        $reprair_list->reprair_location = $request->reprair_location;
        $reprair_list->reprair_subject = $request ->reprair_subject;
        $reprair_list->price = $request->price;
        $reprair_list->car_id = $request->car_id;
        $reprair_list->file = $file;
        $reprair_list->save();
    
        return redirect()->route('user_raports.car_reports', $request->car_id);
    }

    public function update_refuels(Request $request){

        $id = $request->refueling_id;
        $fuel = $request->fuel;
        $price = $request->price;
        $refueling_date = $request->refueling_date;
        $distance = $request->distance;
        $car_id = $request->car_id;

        if ($request->file != NULL){
            $file_path = UserRefuels::select('file')->where('refueling_id', '=', $id)->value('file');
            $raport_file_path = public_path('users_reports_files/'.$file_path);
            File::delete($raport_file_path);
            
            $newFileName = time() . '-' . $request->car_id . '.' . $request->file->extension();
            $request->file->move(public_path('users_reports_files/'), $newFileName);
            $file = $newFileName;
        }
        else{
            $file = UserRefuels::select('file')->where('refueling_id', '=', $id)->value('file');
        }
        UserRefuels::where('refueling_id', '=', $id)->update([
            'fuel'=>$fuel,
            'price'=>$price,
            'refueling_date'=>$refueling_date,
            'distance'=>$distance,
            'car_id'=>$car_id,
            'file'=>$file,
        ]);

        return redirect()->route('user_raports.car_reports', $request->car_id);
    }
    public function update_reprairs(Request $request){

        $id = $request->reprair_id;
        $reprair_subject = $request->reprair_subject;
        $reprair_location = $request->reprair_location;
        $reprair_date = $request->reprair_date;
        $car_mileage = $request->car_mileage;
        $price = $request->price;
        $car_id = $request->car_id;

        if ($request->file != NULL){
            $file_path = UserReprairs::select('file')->where('reprair_id', '=', $id)->value('file');
            $raport_file_path = public_path('users_reports_files/'.$file_path);
            File::delete($raport_file_path);
            
            $newFileName = time() . '-' . $request->car_id . '.' . $request->file->extension();
            $request->file->move(public_path('users_reports_files/'), $newFileName);
            $file = $newFileName;
        }
        else{
            $file = UserReprairs::select('file')->where('reprair_id', '=', $id)->value('file');
        }
        UserReprairs::where('reprair_id', '=', $id)->update([
            'reprair_subject'=>$reprair_subject,
            'reprair_location'=>$reprair_location,
            'reprair_date'=>$reprair_date,
            'car_mileage'=>$car_mileage,
            'price'=>$price,
            'car_id'=>$car_id,
            'file'=>$file,
        ]);

        return redirect()->route('user_raports.car_reports', $request->car_id); 
    }

    public function edit_refuel_raport($refuel_id, $car_id){
        $id = $refuel_id;
        $current_car = $car_id;
        $raport_type = 'refuel';
        $refuels = UserRefuels::where('refueling_id', '=', $id)->get();
        return view('edit_raport', ['refuels'=>$refuels, 'raport_type'=>$raport_type, 'current_car'=>$current_car]);
    }

    public function edit_reprair_raport($reprair_id, $car_id){
        $id = $reprair_id;
        $current_car = $car_id;
        $raport_type = 'reprair';
        $reprairs = UserReprairs::where('reprair_id', '=', $id)->get();
        return view('edit_raport', ['reprairs'=>$reprairs, 'raport_type'=>$raport_type, 'current_car'=>$current_car]);
    }

    public function destroy_refuel_raport($id, $car_id){

        $refuel_id = $id;
        $file_path = UserRefuels::select('file')->where('refueling_id', '=', $refuel_id)->value('file');
        $raport_file_path = public_path('users_reports_files/'.$file_path);
        if (File::exists($raport_file_path)){
            File::delete($raport_file_path);
            UserRefuels::where('refueling_id', '=', $refuel_id)->delete();
        }
        else{
            UserRefuels::where('refueling_id', '=', $refuel_id)->delete();
        }
        return redirect()->route('user_raports.car_reports', $car_id);
    }

    public function destroy_reprair_raport($id, $car_id){

        $reprair_id = $id;
        $file_path = UserReprairs::select('file')->where('reprair_id', '=', $reprair_id)->value('file');
        $raport_file_path = public_path('users_reports_files/'.$file_path);
        if (File::exists($raport_file_path)){
            File::delete($raport_file_path);
            UserReprairs::where('reprair_id', '=', $reprair_id)->delete();
        }
        else{
            UserReprairs::where('reprair_id', '=', $reprair_id)->delete();
        }
        return redirect()->route('user_raports.car_reports', $car_id);
    }

    public function user_auto()
    {
        $user_id = Auth::id();
        $exist = UserCars::where('user_id', '=', $user_id)->exists();
        $user_role = User::where('id', '=', $user_id)->value('role');
        if ($user_role == 'user' || $user_role == 'test_user'){
            $user_cars = UserCars::where('user_id', '=', $user_id)->orderBy('created_at')->limit(2)->get();  
        }
        else{
            $user_cars = UserCars::where('user_id', '=', $user_id)->get();
        }
        $cars_count = $user_cars->count();
        return view('user_auto', ["user_cars"=>$user_cars, "exist"=>$exist, "cars_count"=>$cars_count]);
    }

    public function user_add_car()
    {
        $user_id = Auth::id();
        $cars = UserCars::where('user_id', '=', $user_id)->count('car_id');
        if ($cars >= 2 && $cars < 6 ){
        $this->authorize('isPremiumUser');
        }      
        elseif ($cars < 2){
            return view('add_user_auto');
        }
        else{
            return view('errors.403');
        }
        return view('add_user_auto');
        
    }

    public function user_add_car_save(Request $request){

        $request->validate([
            'name' => 'required',
            'car_make' => 'required',
            'car_model' => 'required',
            'registration_number' => 'required',
            'production_year' => 'required|integer|min:1900|max:2099',
            'image' => 'mimes:jpg,png,jpeg|max:5048',

        ]);
        if ($request->image != NULL){
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('img/users_car_images'), $newImageName);
        $image = $newImageName;

        }
        else{
        $image = NULL;
        }

        $user_cars = new UserCars();
        $user_cars->user_id = Auth::id();
        $user_cars->name = $request->name;
        $user_cars->car_make = CarMakes::where('id_car_make', '=', $request->car_make)->value('name');
        $user_cars->car_model = CarModels::where('id_car_model', '=', $request->car_model)->value('name');
        $user_cars->production_year = $request->production_year;
        $user_cars->oc_date = $request->oc_date;
        $user_cars->tech_rev_date = $request->tech_rev_date;
        $user_cars->image = $image;
        $user_cars->make_id = $request->car_make;
        $user_cars->model_id = $request->car_model;
        $user_cars->registration_number = strtoupper($request->registration_number);
        $user_cars->save();
    
        return redirect()->route('user_auto');
    }
    public function edit_user_car($car_id)
    {
        $id = $car_id;
        $user_cars = UserCars::where('car_id', '=', $id)->get();
        $make_id = UserCars::where('car_id', '=', $id)->value('make_id');
        $models = CarModels::where('id_car_make', '=', $make_id)->get();
        return view('edit_user_auto', ['user_cars'=>$user_cars, 'id'=>$id, 'models'=>$models]);
    }

    public function update_user_car(Request $request){
        $request->validate([
            'name' => 'required',
            'car_make' => 'required',
            'car_model' => 'required',
            'production_year' => 'required|integer|min:1900|max:2099',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
        ]);
        
        $make = CarMakes::where('id_car_make', '=', $request->car_make)->value('name');
        $model = CarModels::where('id_car_model', '=', $request->car_model)->value('name');

        $id = $request->car_id;
        $name = $request->name;
        $car_make = $make;
        $car_model = $model;
        $production_year = $request->production_year;
        $oc_date = $request->oc_date;
        $tech_rev_date = $request->tech_rev_date;
        $make_id =$request->car_make;
        $model_id = $request->car_model;
        $registration_number =strtoupper($request->registration_number);

        if ($request->image != NULL){
            $image_path = UserCars::select('image')->where('car_id', '=', $id)->value('image');
            $file_path = public_path('img/users_car_images/'.$image_path);
            File::delete($file_path);
            
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('img/users_car_images'), $newImageName);
            $image = $newImageName;
        }
        else{
            $image = UserCars::select('image')->where('car_id', '=', $id)->value('image');
        }
        if($make_id != 'NULL' and $model_id != 'NULL'){
        UserCars::where('car_id', '=', $id)->update([
            'name'=>$name,
            'production_year'=>$production_year,
            'oc_date'=>$oc_date,
            'tech_rev_date'=>$tech_rev_date,
            'image'=>$image,
            'car_make'=>$car_make,
            'car_model'=>$car_model,
            'make_id'=>$make_id,
            'model_id'=>$model_id,
            'registration_number'=>$registration_number
        ]);
        }
        else{
            UserCars::where('car_id', '=', $id)->update([
                'name'=>$name,
                'production_year'=>$production_year,
                'oc_date'=>$oc_date,
                'tech_rev_date'=>$tech_rev_date,
                'image'=>$image,
                'registration_number'=>$registration_number
            ]);
        }
        return redirect()->route('user_auto');
    }

    public function destroy_user_car($car_id){

        $id = $car_id;
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

        return redirect()->route('user_auto');
    }

    public function exportRefuelsExcel($car_id){
        $car_name= UserCars::select('name')->where('car_id', '=', $car_id)->value('name');
        return Excel::download(new RefuelsExport, $car_name.'_raporty_spalania.xlsx');
    }

    public function exportRefuelsCSV($car_id){
        $car_name= UserCars::select('name')->where('car_id', '=', $car_id)->value('name');
        return Excel::download(new RefuelsExport, $car_name.'_raporty_spalania.csv');
     }

     public function exportReprairsExcel($car_id){
        $car_name= UserCars::select('name')->where('car_id', '=', $car_id)->value('name');
        return Excel::download(new ReprairsExport, $car_name.'_raporty_napraw.xlsx');
    }

    public function exportReprairsCSV($car_id){
        $car_name= UserCars::select('name')->where('car_id', '=', $car_id)->value('name');
        return Excel::download(new ReprairsExport, $car_name.'_raporty_napraw.csv');
     }
}