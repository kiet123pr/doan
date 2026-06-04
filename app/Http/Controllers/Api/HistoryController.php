<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\history;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history()
    {
        $data = history::all();
        return response()->json([
            'data' => $data
        ]);
    }
    public function login(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember =  true;
        }
        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => 'success',
                'token' => $token,
                'Auth' => Auth::user()
            ]);
        } else {
            return response()->json([
                'response' => 'error',
                'error' => ['error' => 'invalid email or password']
            ]);
        }
    }
    public function cart(Request $request)
    {
        $cart = [
            'id_category' => $request->id_category,
            'id_user' => $request->id_user,
            'price' => $request->price,
            'id_brand' => $request->id_brand,
            'status' => $request->status,
            'sale' => $request->sale,
            'company' => $request->company,
            'name' => $request->name
        ];
        if (product::create($cart)) {
            return response()->json([
                'success' => 'sucess',
                'data' => $cart
            ]);
        } else {
            return response()->json([
                'response' => 'error',
                'error' => ['error', 'lỗi']
            ]);
        }
    }
    
}
