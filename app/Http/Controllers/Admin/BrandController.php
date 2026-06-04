<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requestbrand;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function list_brand(){
        $newData = Brand::all();
        return view ('admin.brand.list_brand', compact('newData'));
    }
    public function get_add_brand(){
        return view ('admin.brand.add_brand');
    }
    public function post_add_brand(Requestbrand $request){
        $data = $request->all();
        Brand::create($data);
        return redirect()->route('brand.list');
    }
}