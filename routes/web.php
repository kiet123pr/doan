<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Frontend\SearchAdvancedController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['member']
], function () {
    Route::get('/registerUser', [UserController::class, 'getRegister']);
    Route::post('/registerUser', [UserController::class, 'postRegister']);
    Route::get('/loginUser', [UserController::class, 'getLogin'])->name('login');
    Route::post('/loginUser', [UserController::class, 'postLogin']);
});
Route::group([
    'middleware' => ['memberIslogin']
], function(){
    Route::get('/account/update', [AccountController::class, 'getAccount'])->name('account.update');
    Route::post('/account/update', [AccountController::class, 'postAccount']);
    Route::get('/account/my-product', [ProductController::class, 'my_product'])->name('account.product');
    Route::get('/account/add-product', [ProductController::class, 'get_add_product'])->name('account.add_product');
    Route::post('/account/add-product', [ProductController::class, 'post_add_product']);
    Route::get('/account/product/edit/{id}', [ProductController::class, 'get_edit_product'])->name('account.edit');
    Route::post('/account/product/edit/{id}', [ProductController::class, 'post_edit_product']);
    Route::get('/account/product/delete/{id}', [ProductController::class, 'delete_product'])->name('account.delete');
});

Route::get('/blogList', [BlogController::class, 'blog']);
Route::get('/blogDetail/{id}', [BlogController::class, 'blogdetail']);
Route::post('/blog/rating/ajax', [BlogController::class, 'rating']);
Route::post('blog/cmt/ajax', [BlogController::class, 'cmt']);
Route::post('/logoutUser', [UserController::class, 'logout'])->name('user.logout');
Route::get('/home/product', [HomeController::class, 'home_product'])->name('home.product');
Route::post('/home/product/ajax', [HomeController::class, 'add_to_cart']);
Route::get('/product/detail/{id}', [HomeController::class, 'product_detail'])->name('product.detail');
Route::get('/cart', [CartController::class, 'cart']);
Route::post('/cart/ajax', [CartController::class, 'cart_ajax']);
Route::get('/checkout', [CheckoutController::class, 'get_checkout']);
Route::post('/checkout', [CheckoutController::class, 'post_checkout']);
Route::post('/checkout', [CheckoutController::class, 'post_order'])->name('checkout.order');
// Route::get('/send-mail',[MailController::class,'send_mail']);
Route::get('/home/product/search', [HomeController::class, 'get_search'])->name('home.search');
Route::get('/home/product/Advanced', [SearchAdvancedController::class, 'Advanced'])->name('home.Advanced');
// Route::post('/home/product/searchAdvanced',[SearchAdvancedController::class,'post_searchAdvanced']);
Route::get('/home/product/searchAdvanced/{param?}', [SearchAdvancedController::class, 'get_searchAdvanced'])->name('home.searchAdvanced');
Route::get('/home/ajax/searchAdvanced/{param?}', [SearchAdvancedController::class, 'get_ajax_search'])->name('ajax.search');
Route::post('/home/ajax/searchAdvanced', [SearchAdvancedController::class, 'post_ajax_search']);
Route::get('/user/forgetPass', [UserController::class, 'forget_pass_get'])->name('forgetpass.user');
Route::post('/user/forgetPass', [UserController::class, 'forget_pass_post']);
Route::get('/home/user/ChangePass/{id}', [UserController::class, 'changePass_get'])->name('changepass.user');
Route::post('/home/user/ChangePass/{id}', [UserController::class, 'changePass_post']);

Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashBoardController::class, 'index'])->name('Dashboard');
    Route::get('/Profile', [App\Http\Controllers\Admin\UserController::class, 'getProfile'])->name('Profile');
    Route::post('/Profile', [App\Http\Controllers\Admin\UserController::class, 'postProfile'])->name('Profile');
    Route::get('/list', [App\Http\Controllers\Admin\CountryController::class, 'list'])->name('list');
    Route::get('/add', [App\Http\Controllers\Admin\CountryController::class, 'getAdd'])->name('add');
    Route::post('/add', [App\Http\Controllers\Admin\CountryController::class, 'postAdd'])->name('add');
    Route::get('/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('delete');
    Route::get('/listBlog', [App\Http\Controllers\Admin\TableBlogController::class, 'listBlog'])->name('listBLog');
    Route::get('/addBlog', [App\Http\Controllers\Admin\TableBlogController::class, 'getAddBlog'])->name('addBlog');
    Route::post('/addBlog', [App\Http\Controllers\Admin\TableBlogController::class, 'postAddBlog'])->name('addBlog');
    Route::get('/deleteBlog/{id}', [App\Http\Controllers\Admin\TableBlogController::class, 'delete'])->name('deleteBlog');
    Route::get('editBlog/{id}', [App\Http\Controllers\Admin\TableBlogController::class, 'getEdit'])->name('editBlog');
    Route::post('/editBlog/{id}', [App\Http\Controllers\Admin\TableBlogController::class, 'postEdit'])->name('editBlog');
    Route::get('/category/add', [App\Http\Controllers\Admin\CategoryController::class, 'get_add_category'])->name('category.add');
    route::post('/category/add', [App\Http\Controllers\Admin\CategoryController::class, 'post_add_category']);
    Route::get('/category/list', [App\Http\Controllers\Admin\CategoryController::class, 'list_category'])->name('category.list');
    Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete_category'])->name('category.delete');
    Route::get('/brand/list', [App\Http\Controllers\Admin\BrandController::class, 'list_brand'])->name('brand.list');
    Route::get('/brand/add', [App\Http\Controllers\Admin\BrandController::class, 'get_add_brand'])->name('brand.add');
    Route::post('/brand/add', [App\Http\Controllers\Admin\BrandController::class, 'post_add_brand']);
    Route::get('/brand/delete', [App\Http\Controllers\Admin\BrandController::class, 'delete_brand'])->name('brand.delete');
    Route::get('/admin/list/user', [App\Http\Controllers\Admin\ListUserController::class, 'list_user'])->name('admin.listuser');
    Route::get('/admin/list/user/edit/{id}', [App\Http\Controllers\Admin\ListUserController::class, 'get_edit_list_user'])->name('admin.editlistuser');
    Route::post('/admin/list/user/edit/{id}', [App\Http\Controllers\Admin\ListUserController::class, 'post_edit_list_user']);
    Route::get('/admin/list/user/delete/{id}', [App\Http\Controllers\Admin\ListUserController::class, 'delete_list_user'])->name('admin.deletelistuser');
    Route::get('/admin/list/product', [App\Http\Controllers\Admin\ListProductController::class, 'list_product'])->name('admin.listproduct');
    Route::get('/admin/list/product/edit/{id}', [App\Http\Controllers\Admin\ListProductController::class, 'get_edit_list_product'])->name('admin.editlistproduct');
    Route::post('/admin/list/product/edit/{id}', [App\Http\Controllers\Admin\ListProductController::class, 'post_edit_list_product']);
    Route::get('/admin/list/product/delete/{id}', [App\Http\Controllers\Admin\ListProductController::class, 'delete_list_product'])->name('admin.deletelistproduct');
    Route::get('/admin/product/user/{id_user}', [App\Http\Controllers\Admin\ListProductController::class, 'user_product'])->name('user.list');
    Route::get('/admin/history/product', [App\Http\Controllers\Admin\ListProductController::class, 'history_product'])->name('admin.historyproduct');
});

// Auth::routes();
// Route::get('/', [App\Http\Controllers\Admin\DashBoardController::class, 'index'])->name('Dashboard');
// Route::get('/Profile', [App\Http\Controllers\Admin\UserController::class, 'getProfile'])->name('Profile');
// Route::post('/Profile', [App\Http\Controllers\Admin\UserController::class, 'postProfile'])->name('Profile');
// Route::get('/list', [App\Http\Controllers\Admin\CountryController::class, 'list'])->name('list');
// Route::get('/add', [App\Http\Controllers\Admin\CountryController::class, 'getAdd'])->name('add');
// Route::post('/add', [App\Http\Controllers\Admin\CountryController::class, 'postAdd'])->name('add');
// Route::get('/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('delete');
// Route::get('/listBlog',[App\Http\Controllers\Admin\TableBlogController::class,'listBlog'])->name('listBLog');
// Route::get('/addBlog',[App\Http\Controllers\Admin\TableBlogController::class,'getAddBlog'])->name('addBlog');
// Route::post('/addBlog',[App\Http\Controllers\Admin\TableBlogController::class,'postAddBlog'])->name('addBlog');
// Route::get('/deleteBlog/{id}', [App\Http\Controllers\Admin\TableBlogController::class,'delete'])->name('deleteBlog');
// Route::get('editBlog/{id}', [App\Http\Controllers\Admin\TableBlogController::class,'getEdit'])->name('editBlog');
// Route::post('/editBlog/{id}',[App\Http\Controllers\Admin\TableBlogController::class,'postEdit'])->name('editBlog');
// Route::get('/category/add',[App\Http\Controllers\Admin\CategoryController::class,'get_add_category'])->name('category.add');
// route::post('/category/add',[App\Http\Controllers\Admin\CategoryController::class,'post_add_category']);
// Route::get('/category/list',[App\Http\Controllers\Admin\CategoryController::class,'list_category'])->name('category.list');
// Route::get('/category/delete/{id}',[App\Http\Controllers\Admin\CategoryController::class,'delete_category'])->name('category.delete');
// Route::get('/brand/list',[App\Http\Controllers\Admin\BrandController::class,'list_brand'])->name('brand.list');
// Route::get('/brand/add',[App\Http\Controllers\Admin\BrandController::class,'get_add_brand'])->name('brand.add');
// Route::post('/brand/add',[App\Http\Controllers\Admin\BrandController::class,'post_add_brand']);
// Route::get('/brand/delete',[App\Http\Controllers\Admin\BrandController::class,'delete_brand'])->name('brand.delete');
// Route::get('/admin/list/user',[App\Http\Controllers\Admin\ListUserController::class,'list_user'])->name('admin.listuser');
// Route::get('/admin/list/user/edit/{id}',[App\Http\Controllers\Admin\ListUserController::class,'get_edit_list_user'])->name('admin.editlistuser');
// Route::post('/admin/list/user/edit/{id}',[App\Http\Controllers\Admin\ListUserController::class,'post_edit_list_user']);
// Route::get('/admin/list/user/delete/{id}',[App\Http\Controllers\Admin\ListUserController::class,'delete_list_user'])->name('admin.deletelistuser');
// Route::get('/admin/list/product',[App\Http\Controllers\Admin\ListProductController::class,'list_product'])->name('admin.listproduct');
// Route::get('/admin/list/product/edit/{id}',[App\Http\Controllers\Admin\ListProductController::class,'get_edit_list_product'])->name('admin.editlistproduct');
// Route::post('/admin/list/product/edit/{id}',[App\Http\Controllers\Admin\ListProductController::class,'post_edit_list_product']);
// Route::get('/admin/list/product/delete/{id}',[App\Http\Controllers\Admin\ListProductController::class,'delete_list_product'])->name('admin.deletelistproduct');
// Route::get('/admin/product/user/{id_user}',[App\Http\Controllers\Admin\ListProductController::class,'user_product'])->name('user.list');
// Route::get('/admin/history/product',[App\Http\Controllers\Admin\ListProductController::class,'history_product'])->name('admin.historyproduct');
