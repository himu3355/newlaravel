<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesAndParmissionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AttributeCategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\FrontendController;
use App\Models\Banner;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {



    Route::group(['middleware' => ['role:supper-admin|admin']], function () {
        Route::get('/admin', function () {
            return redirect()->route('dashboard');
        });
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::resource('/admin/categories', CategoryController::class);
        Route::resource('/admin/brand', BrandController::class);
        Route::resource('/admin/product', ProductController::class);
        Route::resource('/admin/users', UsersController::class);
        Route::resource('/admin/shipping', ShippingController::class);
        // Banner
        Route::resource('banner', BannerController::class);

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
        Route::prefix('admin')->name('admin.')->group(function () {

            // Attributes
            Route::get('attributes', [AttributeController::class, 'index'])->name('attributes.index');

            // Attribute Categories
            Route::get('attributes/categories/create', [AttributeCategoryController::class, 'create'])->name('attributes.categories.create');
            Route::post('attributes/categories', [AttributeCategoryController::class, 'store'])->name('attributes.categories.store');
            Route::get('attributes/categories/{category}/edit', [AttributeCategoryController::class, 'edit'])->name('attributes.categories.edit');
            Route::put('attributes/categories/{category}', [AttributeCategoryController::class, 'update'])->name('attributes.categories.update');
            Route::delete('attributes/categories/{category}', [AttributeCategoryController::class, 'destroy'])->name('attributes.categories.destroy');

            // Attributes within Categories
            Route::get('attributes/categories/{category}/attributes/create', [AttributeController::class, 'createAttribute'])->name('attributes.create');
            Route::post('attributes/categories/{category}/attributes', [AttributeController::class, 'storeAttribute'])->name('attributes.store');
            Route::get('attributes/{attribute}/edit', [AttributeController::class, 'editAttribute'])->name('attributes.edit');
            Route::put('attributes/{attribute}', [AttributeController::class, 'updateAttribute'])->name('attributes.update');
            Route::delete('attributes/{attribute}', [AttributeController::class, 'destroyAttribute'])->name('attributes.destroy');

        // Settings
            Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
            Route::post('setting/update', [SettingsController::class, 'settingsUpdate'])->name('settings.update');
        });
    });
});



Route::get('/', [FrontendController::class,'home'])->name('home');
Route::get('products', [FrontendController::class, 'productList'])->name('products');
Route::get('product-detail/{product}', [FrontendController::class, 'productDetail'])->name('product-detail');
Route::get('/products/filter', [FrontendController::class, 'filter'])->name('products.filter');
Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('aboutus');
Route::get('/contactus', [FrontendController::class, 'contactus'])->name('contactus');
Route::post('/contactus', [FrontendController::class, 'contactusstore'])->name('contactus.store');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
