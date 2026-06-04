<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_product()
    {
        $brand = Brand::all();
        $category = Category::all();
        $data = product::orderby('id', 'desc')->get();
        return view('frontend.home_product.home_product', compact('data', 'brand', 'category'));
    }
    public function product_detail(string $id)
    {
        $data = product::where('id', $id)->first();
        return view('frontend.home_product.product_detail', compact('data'));
    }
    public function add_to_cart(Request $request)
    {
        $id = $request->id;
        $data = product::where('id', $id)->first();
        $data['qty'] = 1;
        // Session::flush();
        $x = 1;
        if (session()->has('cart')) {
            $get_data = session()->get('cart');
            foreach ($get_data as $key => $value) {
                if ($data['id'] == $value['id']) {
                    $get_data[$key]['qty'] += 1;
                    $x = 2;
                    session()->put('cart', $get_data);
                }
            }
        }
        if ($x == 1) {
            session()->push('cart', $data);
        }
        return response()->json([
            'session' => session('cart')
        ]);
    }
    public function get_search(Request $request)
    {
        $data = [];
        $keyword = $request->search;
        if ($keyword) {
            $data = Product::where('name', 'like', '%' . $keyword . '%')->get();
        }
        return view('frontend.home_product.search', compact('data'));
    }
}
