<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {
    public function getAccount() {
        $id_user = Auth::id();
        $data_user = User::where('id', $id_user)->first();
        $data_country = Country::all();
        return view ('frontend.account.account',compact('data_user', 'data_country'));
    }
    public function postAccount(Request $request){
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $get_data = $request->all();
        if($request->hasFile('avatar')){
            $get_avatar = $request->file('avatar');
            $fileName = $get_avatar->getClientOriginalName();
            $get_data['avatar'] = $fileName;
        }
        if(!empty($get_avatar)){
            $get_data['avatar'] = $get_avatar->getClientOriginalName();
        }
        if($get_data['password']){
            $get_data['password'] = bcrypt($get_data['password']);
        } else {
            $get_data['password'] = $user->password;
        }
        if($user->update($get_data)){
            if(!empty($get_avatar)){
                $get_avatar->move(public_path('/upload_member/user/avatar'), $get_avatar->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('update profile succcess'));
        } else {
            return redirect()->back()->withErrors('upadate profile error');
        }
    }
}
