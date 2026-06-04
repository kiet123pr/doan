<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class Category_BrandController extends Controller
{
    public function category_brand()
    {
        $category = Category::all();
        $brand = Brand::all();
        $data = [
            'category' => $category,
            'brand' => $brand
        ];
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
}
