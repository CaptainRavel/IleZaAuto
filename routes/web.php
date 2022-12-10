<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\IndexPageController::class, 'index']);
Route::get('/oblicz', [App\Http\Controllers\IndexPageController::class, 'oblicz']);
Route::get('/car_base', [App\Http\Controllers\CarBaseController::class, 'index'])->name('car_base');
Route::get('/search',[App\Http\Controllers\SearchUserController::class, 'index']);

Route::middleware(['auth'])->group(function()
{
    Route::get('/user_account', [App\Http\Controllers\UserAccountController::class, 'index'])->name('user_account');
    Route::post('/user_account1', [App\Http\Controllers\UserAccountController::class, 'update_nick'])->name('user_account.update_nick');
    Route::post('/user_account2', [App\Http\Controllers\UserAccountController::class, 'update_email'])->name('user_account.update_email');
    Route::get('/user_account3', [App\Http\Controllers\UserAccountController::class, 'destroy_user'])->name('user_account.destroy_user');
});

Route::middleware(['auth', 'is_verify_email'])->group(function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user_raports', [App\Http\Controllers\UserCarController::class, 'user_raports'])->name('user_raports.reports');
    Route::get('/user_raports/{car}', [App\Http\Controllers\UserCarController::class, 'user_car_raports'])->name('user_raports.car_reports');
    Route::post('/user_raports1', [App\Http\Controllers\UserCarController::class, 'store_refuels'])->name('user_raports.store_refuels');
    Route::post('/edit_raport_refuels', [App\Http\Controllers\UserCarController::class, 'update_refuels'])->name('user_raports.update_refuels');
    Route::post('/edit_raport_reprairs', [App\Http\Controllers\UserCarController::class, 'update_reprairs'])->name('user_raports.update_reprairs');
    Route::post('/user_raports2', [App\Http\Controllers\UserCarController::class, 'store_reprairs'])->name('user_raports.store_reprairs');
    Route::get('/edit_raport1/{refuel_id}/{car_id}', [App\Http\Controllers\UserCarController::class, 'edit_refuel_raport'])->name('edit_raport.refuel');
    Route::get('/edit_raport2/{reprair_id}/{car_id}', [App\Http\Controllers\UserCarController::class, 'edit_reprair_raport'])->name('edit_raport.reprair');
    Route::get('/destroy_user_raport1/{id}/{car_id}', [App\Http\Controllers\UserCarController::class, 'destroy_refuel_raport'])->name('destroy_raport.refuel');
    Route::get('/destroy_user_raport2/{id}/{car_id}', [App\Http\Controllers\UserCarController::class, 'destroy_reprair_raport'])->name('destroy_raport.reprair');
    Route::get('download_raport_file/{filename}', function($filename)
    {
        $file_path = public_path('users_reports_files/'.$filename);
        if (file_exists($file_path))
        {
            return Response::download($file_path, $filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            exit('Żądany plik nie znajduje się na serwerze!');
        }
    })
    ->where('filename', '[A-Za-z0-9\-\_\.]+')->name('download_raport_file');
    Route::get('/export_refuels_excel/{car_id}', [App\Http\Controllers\UserCarController::class, 'exportRefuelsExcel'])->name('export_refuels.excel');
    Route::get('/export_refuels_CSV/{car_id}', [App\Http\Controllers\UserCarController::class, 'exportRefuelsCSV'])->name('export_refuels.csv');
    Route::get('/export_reprairs_excel/{car_id}', [App\Http\Controllers\UserCarController::class, 'exportReprairsExcel'])->name('export_reprairs.excel');
    Route::get('/export_reprairs_CSV/{car_id}', [App\Http\Controllers\UserCarController::class, 'exportReprairsCSV'])->name('export_reprairs.csv');

    Route::get('/user_auto', [App\Http\Controllers\UserCarController::class, 'user_auto'])->name('user_auto');
    Route::get('/add_user_auto', [App\Http\Controllers\UserCarController::class, 'user_add_car'])->name('user_auto.add_car');
    Route::post('/add_user_auto1', [App\Http\Controllers\UserCarController::class, 'user_add_car_save'])->name('user_auto.add_car_save');
    Route::get('/edit_user_auto/{car_id}', [App\Http\Controllers\UserCarController::class, 'edit_user_car'])->name('user_auto.edit_car');
    Route::post('/update_user_auto', [App\Http\Controllers\UserCarController::class, 'update_user_car'])->name('user_auto.update_car');
    Route::get('/destroy_user_auto/{car_id}', [App\Http\Controllers\UserCarController::class, 'destroy_user_car'])->name('user_auto.destroy_car');

    Route::get('/get_premium', [App\Http\Controllers\PremiumController::class, 'get_premium'])->name('get_premium');
});

Route::middleware(['can:isAdmin'])->group(function()
{
    Route::get('/admin_panel', [App\Http\Controllers\AdminPanelController::class, 'user_list'])->name('admin_panel');
    Route::get('/searchuser', [App\Http\Controllers\AdminPanelController::class, 'search'])->name('search');

    Route::get('/user_management/{id}', [App\Http\Controllers\UserManagementController::class, 'user_edit'])->name('user_management');
    Route::post('/user_management_add_user', [App\Http\Controllers\UserManagementController::class, 'add_user'])->name('user_management.add_user');;
    Route::post('/user_management_edit_name/{id}', [App\Http\Controllers\UserManagementController::class, 'update_nick']);
    Route::post('/user_management_edit_password/{id}', [App\Http\Controllers\UserManagementController::class, 'update_password']);
    Route::post('/user_management_edit_email/{id}', [App\Http\Controllers\UserManagementController::class, 'update_email']);
    Route::get('/user_management_edit_email_verify/{id}', [App\Http\Controllers\UserManagementController::class, 'verify_user_email'])->name('user_management.email_verify');
    Route::get('/user_management_delete_user/{id}', [App\Http\Controllers\UserManagementController::class, 'destroy_user']);

    Route::get('/user_auto_management/{id}', [App\Http\Controllers\UserManagementController::class, 'user_auto_management'])->name('user_auto_management');
    Route::get('/user_auto_management_delete/{user_id}/{car_id}', [App\Http\Controllers\UserManagementController::class, 'destroy_user_car_admin'])->name('user_auto_management.delete');
    Route::get('/user_auto_management_raports/{user_id}/{car_id}', [App\Http\Controllers\UserManagementController::class, 'user_auto_raports_management'])->name('user_auto_raports_management');

    Route::get('/add_premium_month/{id}', [App\Http\Controllers\UserManagementController::class, 'add_premium_month'])->name('add_premium.month.admin');
    Route::get('/add_premium_year/{id}', [App\Http\Controllers\UserManagementController::class, 'add_premium_year'])->name('add_premium.year.admin');
    Route::get('/add_premium_off/{id}', [App\Http\Controllers\UserManagementController::class, 'add_premium_off'])->name('add_premium.off.admin');
});


Route::middleware(['can:isTestUser'])->group(function()
{
    Route::get('/add_premium_month', [App\Http\Controllers\PremiumController::class, 'add_premium_month'])->name('add_premium.month');
    Route::get('/add_premium_year', [App\Http\Controllers\PremiumController::class, 'add_premium_year'])->name('add_premium.year');
});

Route::get('dashboard', [App\Http\Controllers\Auth\AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']); 
Route::get('account/verify/{token}', [App\Http\Controllers\Auth\AuthController::class, 'verifyAccount'])->name('user.verify');

Route::get('/login', [App\Http\Controllers\Auth\AuthController::class, 'index'])->name('login');
Route::post('/post-login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('/registration', [App\Http\Controllers\Auth\AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [App\Http\Controllers\Auth\AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

Route::get('/forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//Google login
//Route::get('login/google',[App\Http\Controllers\Auth\AuthController::class, 'redirectToGoogle'])->name('login.google');
//Route::get('login/google/callback',[App\Http\Controllers\Auth\AuthController::class, 'handleGoogleCallback']);
//
//Facebook login
//Route::get('login/facebook',[App\Http\Controllers\Auth\AuthController::class, 'redirectToFacebook'])->name('login.facebook');
//Route::get('login/facebook/callback',[App\Http\Controllers\Auth\AuthController::class, 'handleFacebookCallback']);
//
//Github login
//Route::get('login/github',[App\Http\Controllers\Auth\AuthController::class, 'redirectToGithub'])->name('login.github');
//Route::get('login/github/callback',[App\Http\Controllers\Auth\AuthController::class, 'handleGithubCallback']);