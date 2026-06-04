<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReigterRequest;
use App\Mail\MailNotify;
use App\Models\User;
use App\Models\history;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function get_checkout()
    {
        return view('frontend.checkout.checkout');
    }
    public function post_order()
    {
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $tong = 0;
            foreach ($cart as $key => $value) {
                $tong += $value['price'] * $value['qty'];
            }
            $data = Auth::user();
            history::create([
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'id_user' => $data->id,
                'price' => $tong
            ]);
            try {
                Mail::to('kiet123pr@gmail.com')->send(new MailNotify($data));
                return response()->json(['Great check ur mail box']);
            } catch (Exception $th) {
                return $th->getMessage();
            }
        }
    }
    public function post_checkout(ReigterRequest $request)
    {
        $data = $request->all();
        $data['level'] = 0;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();
            $data['avatar'] = $fileName;
        }
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if (User::create($data)) {
            if (!empty($file)) {
                $file->move(public_path('upload/user'), $file->getClientOriginalName());
            }
            return redirect('checkout');
        } else {
            return view('frontend.user.registerUser');
        }
        
    }
}
