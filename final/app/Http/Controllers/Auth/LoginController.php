<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        // Retrieve the email_verification_token from the database for the authenticated user
        $storedCode = DB::table('users')
            ->where('id', $userId)
            ->value('email_verification_token');
        Mail::raw("Your verification code is: $storedCode", function ($message) {
            $message->to(Auth::user()->email)
                ->subject('Your Verification Code');
        });

        if (Auth::check()) {
            return '/verify';
            // $user = \Illuminate\Support\Facades\Auth::user();
            // $roleId = $user->role->id ?? null;

            // // Log the user login with time and date
            // \Illuminate\Support\Facades\Log::info('User logged in', [
            //     'user_id' => $user->id,
            //     'email' => $user->email, 
            //     'timestamp' => now()->toDateTimeString(),
            // ]);

            // switch ($roleId) {
            //     case 1:
            //         return '/admin/dashboard';
            //     case 2:
            //         return '/chairperson/dashboard';
            //     case 3:
            //         return '/employee/dashboard';
            //     default:
            //         return '/home';
            // }
        }

        return '/home';
    }
    
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
