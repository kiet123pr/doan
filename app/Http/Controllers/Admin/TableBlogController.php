<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBlogupdate;
use App\Http\Requests\RequestProfile;
use App\Models\Blog;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableBlogController extends Controller
{
    public function listBLog()
    {
        $data = Blog::all();
        $newData = $data->toArray();
        return view('admin.TableBlog.listBlog', compact('newData'));
    }
    public function getAddBlog()
    {
        return view('admin.TableBlog.addBlog');
    }
    public function postAddBlog(RequestBlogupdate $request1)
    {
        $data = $request1->all();
        // Kt có file ảnh ko
        if ($request1->hasFile('image')) {
            $file = $request1->file('image');
            $file->move('public/uploads/blogs', $file->getClientOriginalName());
            $data['image'] = $file->getClientOriginalName();
        }
        Blog::create($data);
        return redirect('listBlog');
    }
    public function delete(string $id)
    {
        Blog::where('id', $id)->delete();
        return redirect('listBlog');
    }
    public function getEdit(string $id)
    {
        $data = Blog::where('id', $id)->first();
        $newData1 = $data->toArray();
        return view('admin.TableBlog.editBlog', compact('newData1'));
    }
    public function postEdit(Request $request, string $id)
    {
        $user = Blog::findOrFail($id);
        $data = $request->all();
        $user->update($data);
        return redirect('listBlog');
    }
}
