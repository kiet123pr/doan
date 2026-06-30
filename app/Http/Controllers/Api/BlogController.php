<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cmt;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blog()
    {
        $data = Blog::all();
        return response()->json([
            'blog' => $data
        ]);
    }
    public function blog_detail(string $id)
    {
        $data = Blog::where('id', $id)->first();
        if (!empty($data)) {
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'response' => 'error',
                'error' => ['error' => 'không tìm thấy dữ liệu']
            ]);
        }
    }
    public function cmt(Request $request)
    {
        $id_user = Auth::id();
        $cmt = $request->cmt;
        $id_blog = $request->id_blog;
        $user = User::where('id', $id_user)->first();
        $avatar = $user->avatar;
        $name_user = $user->name;
        $data = [
            'cmt' => $cmt,
            'id_blog' => $id_blog,
            'id_user' => $id_user,
            'avatar' => $avatar,
            'name_user' => $name_user,
            'level' => $request->level ? $request->level : 0
        ];
        if (Cmt::create($data)) {
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => '422',
                'response' => 'error',
                'error' => ['error' => 'dữ liệu không hợp lệ']
            ]);
        }
    }
    public function rate(Request $request, string $id)
    {
        $rate = $request->rate;
        $id_blog = $id;
        $id_user = $request->id_user;
        $data = [
            'rate' => $rate,
            'id_blog' => $id_blog,
            'id_user' => $id_user
        ];
        if (Rate::create($data)) {
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => '422',
                'response' => 'error',
                'error' => ['error' => 'dữ liệu không hợp lệ']
            ]);
        }
    }
    public function get_rate(string $id)
    {
        $data = Rate::where('id_blog', $id)->get();
        if ($data->isNotEmpty()) {
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'response' => 'error',
                'error' => ['error' => 'không tìm thấy dữ liệu']
            ]);
        }
    }
}
