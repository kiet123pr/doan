<?php

namespace App\Http\Controllers\Frontend;

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
        $data = Blog::orderBy('id', 'desc')->paginate(1);
        return view('frontend.blog.blogList', compact('data'));
    }
    public function blogdetail(string $id)
    {
        $data = Blog::where('id', $id)->first();
        $data1 = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $data2 = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $dataCmt = Cmt::where('id_blog', $id)->get();
        $cmtCon = Cmt::where('id_blog', $id)->where('level', '!=', 0)->get();
        //hàm avg 
        $tbc = Rate::where('id_Blog', $id)->avg('rate');
        $newRate = round($tbc, 1);
        return view('frontend.blog.blogDetail', compact('data', 'data1', 'data2', 'newRate', 'dataCmt', 'cmtCon'));
    }
    public function rating(Request $request)
    {
        $id_user = Auth::id();
        $newRating = $request->all();
        $data = [
            'id_blog' => $newRating['id_blog'],
            'rate' => $newRating['rate'],
            'id_user' => $id_user
        ];
        if (Rate::create($data)) {
            return redirect('blogdetail');
        } else {
            return redirect()->back()->withErrors('loi rating sao');
        }
    }
    public function cmt(Request $request)
    {
        $id_user = Auth::id();
        $user = User::where('id', $id_user)->first();
        $name_user = $user['name'];
        $avatar = $user['avatar'];
        $cmt = $request->all();
        $data = [
            'id_blog' => $cmt['id_blog'],
            'id_user' => $id_user,
            'cmt' => $cmt['cmt'],
            'name_user' => $name_user,
            'avatar' => $avatar,
            'level' => $cmt['level'] ? $cmt['level'] : 0
        ];
        if (Cmt::create($data)) {
            return response()->json(['data' => $data]);
        } else {
            return redirect()->back()->withErrors('loi comment');
        }
    }
}
