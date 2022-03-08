<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    public function index()
    {
        return view('admin.pages.users-manage.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.pages.users-manage.profile',compact('user'));
    }

}
