<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestProfile;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\history;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class ListProductController extends Controller
{
    public function list_product()
    {
        $data = product::all();
        $user = User::all();
        foreach ($data as $key_data => $value_data) {
            foreach ($user as $key_user => $value_user) {
                if ($value_data['id_user'] == $value_user['id']) {
                    $value_data['name_user'] = $value_user['name'];
                }
            }
        }
        return view('admin.ListProduct.ListProduct', compact('data'));
    }
    public function get_edit_list_product(string $id)
    {
        $data_category = category::all();
        $data_brand = Brand::all();
        $data_product = product::where('id', $id)->first();
        $user = User::all();
        foreach ($user as $key_user => $value_user) {
            if ($data_product['id_user'] == $value_user['id']) {
                $data_product['name_user'] = $value_user['name'];
            }
        }
        return view('admin.ListProduct.Edit_listProduct', compact('data_category', 'data_brand', 'data_product'));
    }
    public function post_edit_list_product(Request $request, string $id)
    {
        $data = $request->all();
        $data_product = product::where('id', $id)->first();
        $old = json_decode($data_product['avatar'], true);
        if (!empty($data['hinhxoa'])) {
            foreach ($old as $key_old => $value_old) {
                foreach ($data['hinhxoa'] as $key => $value_hinhxoa) {
                    if ($value_old == $value_hinhxoa) {
                        unset($old[$key_old]);
                    }
                }
            }
        }
        $old = array_values($old);
        $data_image = $old;
        if ($request->hasFile('image')) {
            $new_avatar = array_merge($old, $data['image']);
            if (count($new_avatar) > 3) {
                return redirect()->back()->withErrors('upload tối đa 3 ảnh.');
            } else {
                foreach ($request->file('image') as $xx) {
                    $image = Image::read($xx);
                    $name = $xx->getClientOriginalName();
                    $name_2 = "hinh50_" . $xx->getClientOriginalName();
                    $name_3 = "hinh200_" . $xx->getClientOriginalName();

                    $path = public_path('upload/product/' . $name);
                    $path_2 = public_path('upload/product/' . $name_2);
                    $path_3 = public_path('upload/product/' . $name_3);

                    $image->save($path);
                    $image->resize(50, 70)->save($path_2);
                    $image->resize(200, 300)->save($path_3);

                    $data_image[] = $name;
                }
            }
        }
        $data['avatar'] = json_encode($data_image);
        if ($data_product->update($data)) {
            return redirect()->back()->with('success', 'cập nhật thành công');
        }
    }
    public function delete_list_product(string $id)
    {
        product::where('id', $id)->delete();
        return redirect()->route('admin.listproduct');
    }
    public function user_product(string $id_user){
            $data = product::where('id_user', $id_user)->get();
        return view('admin.ListProduct.UserProduct', compact('data'));
    }
    public function history_product(){
        $data = history::all();
        return view('admin.history.history',compact('data'));
    }
}
