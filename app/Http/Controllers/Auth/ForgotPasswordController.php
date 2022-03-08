<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showPage()
    {
        return view('auth.admin.forgot-password');
    }

    public function send(Request $request): RedirectResponse
    {
        Helper::inputRequired('phone');
        $user = User::where('phone',$request->get('phone'))->first();
        if ($user === null) {
            toastr()->warning('No account has found!');
            return back();
        }
        try {
            return $user->sendPasswordReset('phone', 'web');
        } catch (\Exception $e) {
            toastr()->warning("Please try again. Can't send code right now!");
            return back();
        }
    }


    public function reset($phone)
    {
        $phone = encryptDecryptMS($phone,'decrypt');
        return view('auth.passwords.reset',compact('phone'));
    }

    public function confirm(Request $request): RedirectResponse
    {
        Helper::inputRequired('phone', 'code',
            ['password' => User::$rules['password']]);
        $user = User::where('phone',$request->phone)->first();
        if ($user === null) {
            toastr()->warning('No account has found!');
            return back();
        }
        $app = 'web';
        return $user->resetPassword($request->code, $request->password, $app);
    }

    public function confirmAdmin(Request $request): RedirectResponse
    {
        Helper::inputRequired('phone', 'verify_code', 'password');
        $user = User::where('type_id', UserType::SUPER_ADMIN)->where('phone',$request->phone)->first();
        if ($user === null) {
            toastr()->warning('No account has found!');
            return back();
        }
        $app = 'web';
        return $user->resetPassword($request->verify_code, $request->password, $app);
    }

}
