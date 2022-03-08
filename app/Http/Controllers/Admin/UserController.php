<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function changePwd(Request $request,$id): RedirectResponse
    {
        $validated = Validator::make($request->all(),[
            'password' => 'required',
            'confirm-password' => 'required',
        ]);
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect()->back();
        }
        if($request->get('password') !== $request->get('confirm-password'))
        {
            toastr()->error('Password and confirm-password did not match!');
            return redirect()->back();
        }

        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);
        toastr()->success('Password changed successfully.');
        return redirect()->back();
    }

    public function update(Request $request,$id): RedirectResponse
    {
        $validated = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|unique:users,email,'.$id
        ]);
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect()->back();
        }

        $user = User::find($id);
        $user->update([
           'first_name' => $request->get('first_name'),
           'last_name' => $request->get('last_name'),
           'email' => $request->get('email'),
        ]);
        if(!empty($request->file('photo')))
        {
            $request->validate([
                'photo' => 'image',
            ]);
            //delete old
            if(!empty($user->photo_uri))
            {
                try {
                    Storage::disk()->delete($user->photo_uri);
                }catch (\Exception $e) {
                    abort(403);
                }
            }
            $uniqueId = substr(str_shuffle($user->id.$user->first_name), 0, 6);
            $imageContent = $request->file('photo');
            $filename = 'users' . DIRECTORY_SEPARATOR .$uniqueId.'.'.$imageContent->getClientOriginalExtension();
            $content = file_get_contents($imageContent);
            Storage::disk()->put($filename, $content);
            Storage::disk()->setVisibility($filename, 'public');
            $user->update([
                'photo_uri' => $filename
            ]);
        }
        toastr()->success('Customer Profile Updated','Success');
        return redirect()->back();
    }

}
