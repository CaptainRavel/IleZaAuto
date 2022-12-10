<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Models\PremiumAccount;
use Carbon\Carbon;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {

        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Zostałeś poprawnie zalogowany!');
        }


  
        return redirect("login")->with('not_login', 'Nie udało się zalogować! Podałeś niepoprawny email/hasło.');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
  
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
           
        $data = $request->all();
        $createUser = $this->create($data);
  
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $createUser->id, 
              'token' => $token
            ]);
  
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Zweryfikuj swój adres e-mail');
          });
         
          return redirect()->route('login')
          ->with('not verified', 'Aby się zalogować, zweryfikuj zwój adres-email. Wysłaliśmy ci link, jeśli masz kłopot skontaktuj się z administratorem.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('index');
        }
  
        return redirect("login")->withSuccess('Nie jesteś poprawnie zalogowany!');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        $user_id = Auth::id();
        $currentDateTime = Carbon::now();
        $user_role = User::where('id', '=', $user_id)->value('role');
        $end_premium_date = PremiumAccount::where('user_id', '=', $user_id)->value('premium_end');
        
        if($user_role == 'premium_user'){           
            if($currentDateTime >= $end_premium_date)
            {
                PremiumAccount::where('user_id', '=', $user_id)->delete(); 
                User::where('id', '=', $user_id)->update(['role'=>'user']);
            }
        }

        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Przepraszamy, nie możemy znaleźć takiego adresu e-mail.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Twój emai został zweryfikowany, możesz się zlogować.";
            } else {
                $message = "Twój email jest już zweryfikowany, możesz się zalogować.";
            }
        }
  
      return redirect()->route('login')->with('verify', $message);
    }

    //Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        
    }

    //Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        
    }

    //Github
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        
    }
    
}