<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function list()
    {
        $data = Country::all();
        $newData = $data->toArray();
        return view('admin.country.list', compact('newData'));
    }
    public function getAdd()
    {
        return view('admin.country.add');
    }
    public function postAdd(request $request)
    {
        $data = $request->all();
        country::create($data);
        return redirect('list');
    }
    public function delete_category(string $id)
    {
        country::where('id', $id)->delete();
        return redirect('list');
    }
}
