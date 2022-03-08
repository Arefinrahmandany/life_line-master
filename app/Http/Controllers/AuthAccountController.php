<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAccountController extends Controller
{
    public function index()
    {
        return view('admin.auth-account.auth-account');
    }

    public function tFAPwdChecking($password): \Illuminate\Http\JsonResponse
    {
        if (!Hash::check('plain-text'/*$password, current_user()->password*/)) {
            return response()->json(404);
        }
        if(current_user()->is_two_factor_auth)
        {
            return response()->json(201);
        }else{
            Helper::send2FACode(current_user()->phone,current_user()->id);
        }
        return response()->json(200);
    }

    public function activeDeactivate(Request $request): \Illuminate\Http\JsonResponse
    {
        $user  = current_user();
        if($request->get('type')=='active')
        {
            if(Hash::check($request->get('verify_code'), @$user->tow_factor_auth->code)) {
                if(@$user->tow_factor_auth->expires_at >= Carbon::parse(Carbon::now())){
                    current_user()->update([
                        'is_two_factor_auth' => true,
                    ]);
                    return response()->json(200);
                }else{
                    return response()->json(401); // code is expired
                }
            }
            return response()->json(404);
        }
        current_user()->update([
           'is_two_factor_auth' => false,
        ]);
        return response()->json(200);
    }

}
