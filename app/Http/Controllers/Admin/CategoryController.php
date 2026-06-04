<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_add_category()
    {
        return view('admin.category.add_category');
    }
    public function post_add_category(Request $request)
    {
        $data = $request->all();
        if (Category::create($data)) {
            return redirect()->route('category.list');
        } else {
            return redirect()->back()->withErrors('create error');
        }
    }
    public function list_category()
    {
        $newData = Category::all();
        // dd($newData);
        return view('admin.category.list_category', compact('newData'));
    }
    public function delete_category(string $id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('category.list');
    }
}
