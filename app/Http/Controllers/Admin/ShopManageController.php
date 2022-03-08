<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\DeliveryType;
use App\Models\ProductType;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopManageController extends Controller
{
    public function index()
    {
        return view('admin.pages.shops-manage.index');
    }

    public function show($slug)
    {
        $shop = Shop::where('slug',$slug)->first();
        if(!$shop){abort(404);}
        $categories = Category::where('shop_type_id',$shop->type_id)->where('type_id', CategoryType::PRODUCT)->where('is_active', true)->get();
        $productTypes = ProductType::get();
        $deliveryTypes = DeliveryType::where('is_active', true)->get();
        return view('admin.pages.shops-manage.profile',compact('shop','categories','productTypes','deliveryTypes'));
    }

    public function verifyActive(Request $request)
    {
        Shop::where('id',$request->get('shop_id_v'))->update([
            'is_verified' => true,
            'is_active' => true,
        ]);
        toastr()->success('Shop Verified & Activated','Success');
        return redirect()->back();
    }

}
