<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddproductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{
    public function my_product()
    {
        $data = product::all();
        return view('frontend.account.my-product', compact('data'));
    }
    public function get_add_product()
    {
        $data_category = Category::all();
        $data_brand = Brand::all();
        return view('frontend.account.add_product', compact('data_category', 'data_brand'));
    }
    public function post_add_product(AddproductRequest $request)
    {
        $data = [];
        if ($request->hasFile('avatar')) {
            foreach ($request->file('avatar') as $xx) {
                $image = Image::read($xx);
                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_" . $xx->getClientOriginalName();
                $name_3 = "hinh200_" . $xx->getClientOriginalName();

                $path =  public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $data[] = $name;
            }
        }
        $product = $request->all();
        if ($product['status'] == 0) {
            $product['sale'] = 0;
        }
        $product['id_user'] = Auth::id();
        $product['avatar']  = json_encode($data);
        // dd($product);
        if (product::create($product)) {
            return redirect()->route('account.product');
        }

        return back()->with('success', 'your images has been successfully');
    }
    public function get_edit_product(string $id)
    {
        $data_category = Category::all();
        $data_brand = Brand::all();
        $data_product = product::where('id', $id)->first();
        return view('frontend.account.edit_product', compact('data_brand', 'data_category', 'data_product'));
    }
    public function post_edit_product(request $request, string $id)
    {
        $data = $request->all();
        $data['id_user'] = Auth::id();
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
            return back()->with('success');
        }
    }
    public function delete_product(string $id)
    {
        product::where('id', $id)->delete();
        return redirect()->route('account.product');
    }
}
