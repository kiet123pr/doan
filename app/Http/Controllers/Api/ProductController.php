<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function add_product(Request $request)
    {
        $data = $request->all();
        $images = [];
        if ($request->hasfile('avatar')) {
            foreach ($request->file('avatar') as $xx) {
                $image = Image::read($xx);
                $name = $xx->getClientOriginalName();
                $name2 = "hinh50_" . $xx->getClientOriginalName();
                $name3 = "hinh200_" . $xx->getClientOriginalName();

                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name2);
                $path3 = public_path('upload/product/' . $name3);
                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 3009)->save($path3);
                $images[] = $name;
            }
        }
        $data['id_user'] = Auth::id();
        $data['avatar'] = json_encode($images);
        if (product::create($data)) {
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => '422',
                'response' => 'error',
                'error' => ['error' => 'dữ liệu không hợp lệ ']
            ]);
        }
    }
    public function my_product()
    {
        $data = product::all();
        if ($data) {
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
    public function get_edit_product(string $id)
    {
        $data = product::where('id', $id)->first();
        if ($data) {
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
    public function post_edit_product(Request $request, string $id)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data_product = product::where('id', $id)->first();
        $old = json_decode($data_product['avatar'], true);
        if (!empty($data['hinhxoa'])) {
            foreach ($old as $key_old => $value_old) {
                foreach ($data['hinhxoa'] as $key_hinhxoa => $value_hinhxoa) {
                    if ($value_old == $value_hinhxoa) {
                        unset($old[$key_old]);
                    }
                }
            }
        }
        $old = array_values($old);
        $data_image = $old;
        if ($request->hasfile('image')) {
            $new_image = array_merge($old, $request['image']);
            if (count($new_image) > 3) {
                return response()->json([
                    'response' => 'error',
                    'error' => ['error', 'loi']
                ]);
            } else {
                foreach ($request->file('image') as $xx) {
                    $image =  Image::read($xx);
                    $name = $xx->getClientOriginalName();
                    $name_2 = "hinh50_" . $xx->getClientOriginalName();
                    $name_3 = "hinh200_" . $xx->getClientOriginalName();

                    $path = public_path('/upload/product' . $name);
                    $path_2 = public_path('/upload/product' . $name_2);
                    $path_3 = public_path('/upload/product' . $name_3);

                    $image->save($path);
                    $image->resize(50, 70)->save($path_2);
                    $image->resize(200, 300)->save($path_3);

                    $data_image[] = $name;
                }
            }
        }
        $data['avatar'] = json_encode($data_image, true);
        if ($data_product->upload($data)) {
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
    public function delete_product(string $id){
        product::where('id',$id)->delete();
        return response()->json([
            'success' => 'da xoa thanh cong'
        ]);
    }
    public function home_product(){
        $data = product::all();
        if(!empty($data)){
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
    public function home_product_detail(string $id){
        $data = product::where('id', $id)->first();
        if($data){
            return response()->json([
                'success' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'response' => 'error',
                'error' => ['error' => 'không tìm thấy dữ liệu']
            ]);
        }
    }
}
