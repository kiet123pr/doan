<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.cart.cart');
    }
    public function cart_ajax(Request $request)
    {
        $get_id_up = $request->id_up;
        $get_id_down = $request->id_down;
        $get_id_delete = $request->id_delete;
        if (session()->has('cart')) {
            $get_data = session()->get('cart');
            foreach ($get_data as $key => $value) {
                if ($value['id'] == $get_id_up) {
                    $get_data[$key]['qty'] += 1;
                    session()->put('cart',$get_data);
                }
                if ($value['id'] == $get_id_down) {
                    if ($get_data[$key]['qty'] > 1) {
                        $get_data[$key]['qty'] -= 1;
                        session()->put('cart',$get_data);
                    }
                }
                if ($value['id'] == $get_id_delete) {
                    unset($get_data[$key]);
                    session()->put('cart',$get_data);
                }
            }
        }
        return response()->json([
            'data' => session('cart')
        ]);
    }
}
