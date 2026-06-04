<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestProfile;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListUserController extends Controller
{
    public function list_user()
    {
        $data = User::all();
        return view('admin.list.ListUser', compact('data'));
    }
    public function get_edit_list_user(string $id)
    {
        $user = User::where('id', $id)->first();
        $data_country = Country::all();
        return view('admin.list.Edit_listUser', compact('user', 'data_country'));
    }
    public function post_edit_list_user(RequestProfile $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $data['avatar'] = $filename;
        }
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move(public_path('upload/user'), $file->getClientOriginalName());
            }
            return redirect()->back()->with('success, thay đổi thông tin user thành công');
        } else {
            return redirect()->back()->with('error', 'có lỗi xảy ra');
        }
    }
    public function delete_list_user(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin.deletelistuser');
    }
}
