<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReigterRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update_user(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $data['avatar'] = $filename;
        } else {
            $data['avatar'] = $user->avatar;
        }
        if ($data['c_password']) {
            if (Hash::check($data['c_password'], $user->password)) {
                $data['password'] = $data['newPassword'];
            } else {
                return response()->json([
                    'response' => 'error',
                    'error' => ['error', 'mật khẩu không trùng khớp']
                ]);
            }
        } else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move(public_path('upload/user'), $file->getClientOriginalName());
            }
            return response()->json([
                'success' => 'success',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'response' => 'error',
                'error' => ['error', 'lỗi']
            ]);
        }
    }
    public function register(ReigterRequest $request)
    {
        $data = $request->all();
        $data['level'] = 0;
        $data['password'] = bcrypt($data['password']);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalName();
            $data['avatar'] = $fileName;
        }
        if (User::create($data)) {
            if (!empty($file)) {
                $file->move(public_path('upload/user'), $fileName);
            }
            return response()->json([
                'message' => 'success',
                'data' => $data
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json(['errors' => 'error sever'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
