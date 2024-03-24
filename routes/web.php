<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TestmonialController;
use App\Http\Controllers\BreadcumbController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;

Route::get('contract', function () {
    return view('contract');
});

Auth::routes();
//HomeController 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('download/pdfinvice/{order_id}', [App\Http\Controllers\HomeController::class, 'downloadpdfinvice'])->name('downloadpdfinvice');
Route::get('give/review/{order_id}', [App\Http\Controllers\HomeController::class, 'givereview'])->name('givereview');
Route::post('give/review/post/{order_details_id}', [App\Http\Controllers\HomeController::class, 'givereviewpost'])->name('givereviewpost');
//CategoryController
Route::get('category', [App\Http\Controllers\CategoryController::class, 'category'])->name('category');
Route::post('category/post', [App\Http\Controllers\CategoryController::class, 'categorypost']);
Route::get('category/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'categorydelete']);
Route::get('category/all/delete', [App\Http\Controllers\CategoryController::class, 'categoryalldelete']);
Route::get('category/edite/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryedite']);
Route::post('category_update/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryupdate']);
Route::get('category/restore/{id}', [App\Http\Controllers\CategoryController::class, 'categoryrestore']);
Route::get('category/force/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryforcedelete']);
Route::post('category/chacked/alldelete',[CategoryController::class, 'categorychackalldelete'])->name('categorychackalldelete');

//ProductController Stert------------------------>
Route::get('product',[ProductController::class, 'product'])->name('product');
Route::post('product/post',[ProductController::class, 'productpost'])->name('productpost');
Route::get('product/delete/{product_id}',[ProductController::class, 'productdelete'])->name('productdelete');
Route::get('product/edit/{product_id}',[ProductController::class, 'productedit'])->name('productedit'); 
Route::post('product/update/{product_id}',[ProductController::class, 'productupdate'])->name('productupdate');
Route::get('product/restore/{product_id}',[ProductController::class, 'productrestore'])->name('productrestore');
Route::get('product/force/delete/{product_id}',[ProductController::class, 'productforcedelete'])->name('productforcedelete');
//ProductController End------------------------>

//FrontendController Stert------------------------>
Route::get('/', [FrontendController::class, 'home'])->name('tohoney_home');
Route::get('about', [FrontendController::class, 'about'])->name('about');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('product/details/{product_id}',[FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('category/wiseshop/{category_id}',[FrontendController::class, 'categorywiseshop'])->name('categorywiseshop');
Route::get('cart',[FrontendController::class, 'cart'])->name('cart');
Route::get('cart/{coupon_name}',[FrontendController::class, 'cart'])->name('cartwithcoupon');
Route::get('checkout',[FrontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post',[FrontendController::class, 'checkoutpost'])->name('checkoutpost');
Route::get('customer/register',[FrontendController::class, 'customerregister'])->name('customerregister');
Route::post('customer/register/post',[FrontendController::class, 'coustomerregispost'])->name('coustomerregispost');
Route::get('customer/login',[FrontendController::class, 'customerlogin'])->name('customerlogin');
Route::post('customer/login/post',[FrontendController::class, 'customerloginpost'])->name('customerloginpost');
//FrontendController End------------------------>

//FaqController Start------------------------>
Route::get('faq/index',[FaqController::class,'faq'])->name('faq');
Route::post('faq/post',[FaqController::class,'faqpost'])->name('faqpost');
Route::get('faq/delete/{faq_id}',[FaqController::class,'faqdelete'])->name('faqdelete');
Route::get('faq/restore/{faq_id}',[FaqController::class,'faqrestore'])->name('faqrestore');
Route::get('faq/force/delete/{faq_id}',[FaqController::class,'faqforcedelete'])->name('faqforcedelete');
//FaqController End------------------------>

//SettingController Start--------------------------------------->
Route::get('setting',[SettingController::class,'setting'])->name('setting');
Route::post('setting/post',[SettingController::class,'settingpost'])->name('settingpost');
//SettingController End---------------------------------------> 

//CartController Start--------------------------------------->
Route::get('add/to/cart/delete/{card_id}',[CartController::class,'cartdelete'])->name('cartdelete');
Route::post('add/to/cart/{product_id}',[CartController::class,'addtocart'])->name('addtocart');
Route::post('cart/update/',[CartController::class,'cardupdate'])->name('cardupdate');
//CartController End--------------------------------------->

//TestmonialController Start--------------------------------------->
Route::get('testmonial',[TestmonialController::class,'testmonial'])->name('testmonial');
Route::post('testmonial/post',[TestmonialController::class,'testmonialpost'])->name('testmonialpost');
Route::get('testmonial/delete{tesmonial_id}',[TestmonialController::class,'testmonialdelete'])->name('testmonialdelete');
Route::get('testmonial/restore{tesmonial_id}',[TestmonialController::class,'testmonialrestore'])->name('testmonialrestore');
Route::get('testmonial/force/delete{tesmonial_id}',[TestmonialController::class,'testmonialforcedelete'])->name('testmonialforcedelete');
//TestmonialController End--------------------------------------->

//BreadcumbController Start--------------------------------------->
Route::get('breadcumb',[BreadcumbController::class,'breadcumb'])->name('breadcumb');
Route::post('breadcumb/post',[BreadcumbController::class,'breadcumbpost'])->name('breadcumbpost');
Route::get('breadcumb/delete{breadcumb_id}',[BreadcumbController::class,'breadcumbdelete'])->name('breadcumbdelete');
Route::get('breadcumb/restore{breadcumb_id}',[BreadcumbController::class,'breadcumbrestore'])->name('breadcumbrestore');
Route::get('breadcumb/forcedelete{breadcumb_id}',[BreadcumbController::class,'breadcumbforcedelete'])->name('breadcumbforcedelete');
Route::get('breadcumb/edit{breadcumb_id}',[BreadcumbController::class,'breadcumbedit'])->name('breadcumbedit');
Route::post('breadcumb/update{breadcumb_id}',[BreadcumbController::class,'breadcumbupdate'])->name('breadcumbupdate');
//BreadcumbController End--------------------------------------->

//BannerController End--------------------------------------->
Route::get('banner',[BannerController::class,'banner'])->name('banner');
Route::post('banner/post',[BannerController::class,'bannerpost'])->name('bannerpost');
Route::get('banner/edit{banner_id}',[BannerController::class,'banneredit'])->name('banneredit');
Route::post('banner/update{banner_id}',[BannerController::class,'bannerupdate'])->name('bannerupdate');
Route::get('banner/delete{banner_id}',[BannerController::class,'bannerdelete'])->name('bannerdelete');
Route::get('banner/restore{banner_id}',[BannerController::class,'bannerrestore'])->name('bannerrestore');
Route::get('banner/force/delete{banner_id}',[BannerController::class,'bannerforcedelete'])->name('bannerforcedelete');
//BannerController End--------------------------------------->

//CouponController Start--------------------------------------->
Route::resource('coupon',CouponController::class);
//CouponController End--------------------------------------->