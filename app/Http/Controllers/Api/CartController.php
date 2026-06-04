<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart_product(Request $request)
    {
        $data = $request->all();
        foreach ($data as $id => $qty) {
            $product = product::where('id', $id)->get();
            $data_product[] = [
                'product' => $product,
                'qty' => $qty
            ];
        }
        if (!empty($data_product)) {
            return response()->json([
                'success' => 'success',
                'data' => $data_product
            ]);
        } else {
            return response()->json([
                'status' => '422',
                'response' => 'error',
                'error' => ['error' => 'dữ liệu không hợp lệ']
            ]);
        }
    }
}
