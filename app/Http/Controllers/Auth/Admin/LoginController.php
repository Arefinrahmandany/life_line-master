<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Helpers\Helper;
use App\Helpers\UserSystemInfo;
use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Models\Settings;
use App\Models\TwoFactorAuth;
use App\Models\User;
use App\Models\UserType;
use App\Providers\RouteServiceProvider;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function logout(Request $request)
    {
        $getLoginURL = Settings::where('id',Settings::ADMINLOGINURL)->first();
        $getUrl = $getLoginURL->value??'login';
        Auth::logout();
        return redirect(url('/'.'admin-server'.'/'.$getUrl))->with('logout');
    }

    public function redirectToLogin(Request $request)
    {
        //get cookie
        $cookie = Cookie::get('save_this_browser-F-C-T-L-S');
        if($cookie)
        {
            $getLoginURL = Settings::where('id',Settings::ADMINLOGINURL)->first();
            $getUrl = $getLoginURL->value??'login';
            return redirect(url('/'.'admin-server'.'/'.$getUrl));
        }
        return view('auth.admin.redirect-login');
    }

    public function redirectToLoginChecking(Request $request): JsonResponse
    {
        $request->validate([
           'uuid' => 'required',
        ]);
        $getLoginURL = Settings::where('id',Settings::ADMINLOGINURL)->where('value',$request->get('uuid'))->first();
        if($getLoginURL)
        {
            //set cookie
            if($request->get('saveThisBrowser'))
            {
                Cookie::queue('save_this_browser-F-C-T-L-S', 'yes_saved', 45000);
            }
            return response()->json(200);
        }
        return response()->json(404);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'phone';
    }

    public function loginFormShow(Request $request,$getUrl)
    {
        $getLoginURL = Settings::where('id',Settings::ADMINLOGINURL)->where('value',$getUrl)->first();
        if($getLoginURL)
        {
            // Account Verify Form
            if($request->get('account-verify') && $request->get('u'))
            {
                $phone  = $request->get('u');
                $user = User::where('phone',$phone)->whereIn('type_id',[UserType::SUPER_ADMIN,UserType::ADMIN])->first();
                if($user===null||$user->phone_verified_at!==null) {return redirect(route('auth.redirectToLogin'));}
                return view('auth.admin.account-verify',compact('phone'));

                $user = User::where('phone',$request->get('u'))->whereIn('type_id',[UserType::SUPER_ADMIN,UserType::ADMIN])->first();
                if($user===null) {return view('errors.404');}
                return view('auth.admin.account-verify');
            }
            // End
            return view('auth.admin.login');
        }
        return view('errors.404');
    }

    protected function credentials(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);
        $data = $request->all();
        $credentials = [
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),
            'is_active' => true
        ];
        $phone = $data['phone'];
        $current_password = $data['password'];
        $password='';
        $user = User::where('phone',$phone)->whereIn('type_id',[UserType::SUPER_ADMIN,UserType::ADMIN])->first();
        if($user===null) {return response()->json(404);}

        // when phone is right then check password
        $password = $user->password;
        $phoneVerifiedAt = $user->phone_verified_at;
        $accountIsActive = $user->is_active;
        // check hash password
        if(Hash::check($current_password,$password)){
            if ($accountIsActive == false) {
                return response()->json(8604); // account_is_inactive
            }elseif ($phoneVerifiedAt==null) {
                try {
                    $code = Helper::get6DigitCode();
                    $msg = Helper::msgAccountVerifyCode($code);
                    $user->update(['verify_code' => Hash::make($code)]);
                    if (!Helper::sendSMS($user->phone, $msg)) {
                        return Helper::jsonMessage('We can\'t send a SMS right now! Contact us through Help Center.', 500);
                    }
                } catch (\Exception $e) {
                    return Helper::jsonMessage("Please try again. Can't send code right now! Contact us through Help Center.", 500);
                }
                toastr()->success('Verification code has been sent.','Success');
                return response()->json(8605); // phone_verify_required
            }else{
                //Settings For Check Two Factor Auth
               // $settingsTwoFAuth = Settings::where('id',Settings::TwoFactorAuthentication)->where('value',Settings::TwoFactorAuthenticationEnabledValue)->first();
                if($user->is_two_factor_auth==false){
                    // attempt to do the login
                    if (auth()->attempt($credentials)) {
                        // User Login History
                        $userID = auth()->user()->id;
//                        LoginHistory::create([
//                            'user_id' => $userID,
//                            'ip' => UserSystemInfo::get_ip(),
//                            'os' => UserSystemInfo::get_os(),
//                            'device' => UserSystemInfo::get_device(),
//                            'browser' => UserSystemInfo::get_browsers(),
//                            'is_active' => true,
//                        ]);
                        return response()->json(200); // success
                    }
                }else{
                    Helper::send2FACode($phone,$user->id);
                    return response()->json(8606); // required_2fauth
                }
            }
        }else {
            return response()->json(404);
        }
        return response()->json(404);
    }

    protected function credentials2FA(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'verify_code' => 'required'
        ]);
        $data = $request->all();
        $credentials = [
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),
            'is_active' => true
        ];
        $phone = $data['phone'];
        $user = User::where('phone',$phone)->whereIn('type_id',[UserType::SUPER_ADMIN,UserType::ADMIN])->first();
        if($user===null) {return response()->json(404);}
            if(Hash::check($request->get('verify_code'),@$user->tow_factor_auth->code)) {
            if(@$user->tow_factor_auth->expires_at >= Carbon::parse(Carbon::now())){
                if (auth()->attempt($credentials)) {
                    $userID = auth()->user()->id;
                    $log = LoginHistory::create([
                        'user_id' => $userID,
                        'ip' => UserSystemInfo::get_ip(),
                        'os' => UserSystemInfo::get_os(),
                        'device' => UserSystemInfo::get_device(),
                        'browser' => UserSystemInfo::get_browsers(),
                        'is_active' => true,
                    ]);
                    $user->tow_factor_auth->update(['login_history_id' => $log->id]);
                    return response()->json(200); // success
                }
            }else{
                return response()->json(401); // code is expired
            }
        }
        return response()->json(404); // code is wrong
    }

    public function resend2FAuth(Request $request): JsonResponse
    {
        $request->validate(['phone' => 'required']);
        $user = User::where('phone',$request->get('phone'))->first();
        if($user===null) {return response()->json(404);}
        Helper::send2FACode($user->phone,$user->id);
        return response()->json(200);
    }

}
