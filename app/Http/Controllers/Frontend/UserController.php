<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ReigterRequest;
use App\Http\Requests\resertPass;
use App\Mail\ForgotPasswordMail;
use App\Models\Country;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('blogList');
        }
        return view('frontend.user.loginUser');
    }
    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();

            if ($user->level == 1) {
                return redirect('/');
            }
            return redirect('blogList');
        } else {
            return redirect()->back()->withErrors('email or pass is not correct.');
        }
    }
    public function getRegister()
    {
        return view('frontend.user.registerUser');
    }
    public function postRegister(ReigterRequest $request)
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
            return redirect('loginUser');
        } else {
            return view('frontend.user.registerUser');
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/loginUser');
    }
    public function forget_pass_get()
    {
        return view('frontend.user.forgetPass');
    }
    public function forget_pass_post(resertPass $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $data['id'] = $user->id;
        $data['subject'] = "quên mật khẩu";
        try {
            Mail::to('kiet123pr@gmail.com')->send(new ForgotPasswordMail($data));
            return response()->json(['great check ur email']);
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }
    public function changePass_get(string $id)
    {
        $user = User::where('id', $id)->first();
        $email = $user->email;
        return view('frontend.user.ChangePass', compact('email', 'id'));
    }
    public function changePass_post(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
        $data = $request->all();
        if ($data['email'] == $user->email && $data['id'] == $user->id) {
            if ($data['password'] == $data['confirm_password']) {
                $data['password'] = bcrypt($data['password']);
                if ($user->update($data)) {
                    return redirect()->back()->with('success', 'thay đổi mật khẩu thành công');
                } else {
                    return redirect()->back()->with('error', 'thay đổi mật khẩu thất bại');
                }
            } else {
                return redirect()->back()->with('error', 'mật khẩu không trùng khớp');
            }
        }
    }
}
