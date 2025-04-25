<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesAndParmissionController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['role:supper-admin|Admin']], function () {
        Route::resource('/admin/categories', CategoryController::class);
        Route::resource('/admin/brand', BrandController::class);
        Route::resource('/admin/product', ProductController::class);
        Route::resource('/admin/users', UsersController::class);
        Route::resource('/admin/shipping', ShippingController::class);

        Route::get('rolesandpermission', [RolesAndParmissionController::class, 'index'])->name('rolesandpermissions.index');
        Route::post('rolesandpermission/update', [RolesAndParmissionController::class, 'update'])->name('rolespermission.update');
        Route::post('rolesandpermission/role/add', [RolesAndParmissionController::class, 'addNewRole'])->name('rolesandpermission.role.add');
        Route::delete('rolesandpermission/role/{role}/delete', [RolesAndParmissionController::class, 'deleteRole'])->name('rolesandpermission.role.delete');
        Route::delete('rolesandpermission/permission/{permission}/delete', [RolesAndParmissionController::class, 'deletePermission'])->name('rolesandpermission.permission.delete');
        Route::post('rolesandpermission/permission/add', [RolesAndParmissionController::class, 'addNewPermission'])->name('rolesandpermission.permission.add');
        // Ajax for sub category
        Route::post('admin/category/{id}/child', [CategoryController::class, 'getChildByParent']);

        Route::get('/file-manager', function () {
            return view('backend.layouts.file-manager');
        })->name('file-manager');

    });
});
Route::get('products', [FrontendController::class, 'productList'])->name('products');
Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
