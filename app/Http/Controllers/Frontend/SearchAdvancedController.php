<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class SearchAdvancedController extends Controller
{
    public function Advanced()
    {
        $brand = Brand::all();
        $category = Category::all();
        $data = product::orderby('id', 'desc')->get();
        return view('frontend.home_product.Advanced', compact('brand', 'category', 'data'));
    }
    public function get_searchAdvanced(Request $request)
    {
        $brand = Brand::all();
        $category = Category::all();
        $q = product::query();
        if ($request->search) {
            $q->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $q->where('id_category', $request->category);
        }
        if ($request->brand) {
            $q->where('id_brand', $request->brand);
        }
        if ($request->price) {
            $price = explode('-', $request->price);
            $q->whereBetween('price', [$price[0], $price[1]]);
        }
        if ($request->status != NULL) {
            $q->where('status', $request->status);
        }

        // append giữ các giá trị $request trên url khi chuyển trang
        $data = $q->paginate(3)->appends($request->all());
        return view('frontend.home_product.searchAdvanced', compact('data', 'brand', 'category'));
    }
    public function post_ajax_search(Request $request)
    {
        $q = product::query();
        if ($request->min != NULL && $request->max != NULL) {
            $q->whereBetween('price', [$request->min, $request->max]);
        }
        $data = $q->paginate(6);
        return response()->json([
            'data' => $data
        ]);
    }
}
