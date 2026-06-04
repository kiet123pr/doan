<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update_user(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $request->avatar
        ];
        $user = User::findOrFail($id);
        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $data['filename'] = $filename;
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
            if(!empty($file)){
                $file->remove(public_path('upload/user'), $file->getClientOriginalName());
            }
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => 'success',
                'token' => $token,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'response' => 'error',
                'error' => ['error', 'lỗi']
            ]);
        }
    }
}
