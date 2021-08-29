<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function (){
    Route::get('users/login',[LoginController::class,'index'])->name('admin.login');
    Route::post('users/store',[LoginController::class,'store'])->name('admin.store');
    Route::middleware(['auth'])->group(function (){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);
    });
    #menu
    Route::prefix('category')->group(function (){
        Route::get('list',[MenuController::class,'index'])->name('category.index');
        Route::get('create',[MenuController::class,'create'])->name('category.create');
        Route::post('store',[MenuController::class,'store'])->name('category.store');
        Route::get('edit/{menu}',[MenuController::class,'show'])->name('category.edit');
        Route::post('edit/{menu}', [MenuController::class, 'update']);
        Route::DELETE('destroy', [MenuController::class, 'destroy']);

    });

    #Product
    Route::prefix('product')->group(function (){
        Route::get('add',[ProductController::class,'create'])->name('product.create');
        Route::post('add',[ProductController::class,'store'])->name('product.store');
        Route::get('list',[ProductController::class,'index'])->name('product.index');
        Route::get('edit/{product}',[ProductController::class,'show'])->name('product.edit');
        Route::post('edit/{product}',[ProductController::class,'update']);
        Route::DELETE('destroy', [ProductController::class, 'destroy']);
    });


    #slide
    Route::prefix('slide')->group(function (){
        Route::get('add',[SlideController::class,'create'])->name('slide.create');
        Route::post('add',[SlideController::class,'store'])->name('slide.store');
        Route::get('list',[SlideController::class,'index'])->name('slide.index');
        Route::get('edit/{slide}',[SlideController::class,'show'])->name('slide.edit');
        Route::post('edit/{slide}',[SlideController::class,'update']);
        Route::DELETE('destroy', [SlideController::class, 'destroy'])->name('slide.destroy');
    });

    #Upload
    Route::post('upload/services',[UploadController::class,'store']);

    #Cart

    Route::get('customer',[\App\Http\Controllers\Admin\CartController::class,'index'])->name('cart.index');
    Route::get('customer/view/{customer}',[\App\Http\Controllers\Admin\CartController::class,'view'])->name('cart.view');

});
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('about',[HomeController::class,'about'])->name('home.about');
Route::get('contact',[HomeController::class,'contact'])->name('home.contact');

Route::post('services/load-product',[HomeController::class,'loadProduct']);
Route::get('category/{id}-{slug}.html',[\App\Http\Controllers\MenuController::class,'index']);
Route::get('product/{id}-{slug}.html',[\App\Http\Controllers\ProductController::class,'index']);
Route::post('add-cart',[\App\Http\Controllers\CartController::class,'index']);
Route::get('carts',[\App\Http\Controllers\CartController::class,'show']);
Route::post('update-cart',[\App\Http\Controllers\CartController::class,'update']);
Route::get('cart/delete/{id}',[\App\Http\Controllers\CartController::class,'remove']);
Route::post('carts',[\App\Http\Controllers\CartController::class,'addCart']);

