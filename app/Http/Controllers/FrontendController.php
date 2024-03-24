<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Faq;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Testmonial;
use App\Models\Breadcumb;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Banner;
use App\Models\Review;
use Carbon\Carbon;
use Hash,Auth,DB;


class FrontendController extends Controller
{
public function home(){
    
$categories = Category::latest()->get();
$productes = Product::latest()->get();
$testmonials = Testmonial::latest()->get();
$banners = Banner::latest()->get();

//Best seler Part Start-------->
$order_details_info = Order_detail::select('product_id',DB::raw('count(*) as total'))->groupBy('product_id')->get();
$collection = collect($order_details_info);
$sorted_best_seller =  $collection->sortByDesc('total')->take(4);
//Best seler Part End-------->

return view('index',compact('categories','productes','testmonials','banners','sorted_best_seller'));
}
    
// Product Details Page Start=========================================================================> 
function productdetails($product_id){
$product_info = Product::find($product_id);
$faqs = Faq::latest()->get();
//Releted Product Part Start    
$product_category_id = Product::find($product_id)->category_id;
$releted_products = Product::where('category_id',$product_category_id)->where('id','!=',$product_id)->get();
//Releted Product Part End  

//Customer Review Start  
$customer_reviews = Review::where('product_id',$product_id)->get();

$stars = Review::where('product_id',$product_id)->sum('stars');
 $product_id =Review::where('product_id',$product_id)->count();
if (isset($stars) && $product_id != 0) {
   $overall_review = $stars/$product_id;
}else{
    $overall_review = 0;
}

// $overall_review = Review::where('product_id',$product_id)->sum('stars') / Review::where('product_id',$product_id)->count();
//Customer Review End  
return view('product.productdetails',compact('product_info','faqs','releted_products','customer_reviews','overall_review'));
}
// Product Details Page End=========================================================================> 

// Shop Page Start=========================================================================> 
function shop(){
$all_categorys = Category::latest()->get();
$all_productes = Product::latest()->get();
$breadcumbs = Breadcumb::latest()->limit(1)->get();
return view('shop',compact('all_productes','all_categorys','breadcumbs',));
}
// Shop Page End=========================================================================>  

// categorywiseshop Page Start=========================================================================>
function categorywiseshop($category_id){
$products = Product::where('category_id',$category_id)->get();
return view('categorywiseshop',compact('products'));
}

// categorywiseshop Page End=========================================================================> 


// cart Page Start=========================================================================>
    // function cart(){
    //     $carts = Cart::where('ip_address', request()->ip())->get();
    //    return view('cart',compact('carts'));
    // }
function cart($coupon_name = ""){
$coupon_discount = 0;
if ($coupon_name == ""){
$coupon_discount = 0;
}
else {

if (Coupon::where('coupon_name',$coupon_name)->exists()){
if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_name)->first()->expire_date){
return back()->with('coupon_errors','Coupon Date Expart');
}
else{
if (Coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
$coupon_discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
} 
else{
return back()->with('coupon_errors','Coupon Limit End');
}
}
} 
else{
echo "Invalit Coupon Name";
return back()->with('coupon_errors','Invaliat Coupon Name');  
}

}

$carts = Cart::where('ip_address', request()->ip())->get();
return view('cart',compact('carts','coupon_discount','coupon_name'));
   
    // return view('cart',[
    //      'carts' => Cart::where('ip_address', request()->ip())->get(),
    //      'coupon_discount' =>$coupon_discount,
    //   ]);
    }
// cart Page Start=========================================================================>

// checkout Page Start=========================================================================>
function checkout(){
return view('checkout');
}
// checkout Page End=========================================================================>

// Checkoutpost Page Start=========================================================================>
function checkoutpost(Request $request){
if ($request->payment_option == 1) {
echo "Online Payment";
}else{
//order Tabale data insert
$order_id = Order::insertGetId($request->except('_token')+[
'user_id' => Auth::id(),
'payment_status' => 1,
'discount' => session('session_discount'),
'subtotal' => session('session_subtotal'),
'total' => session('session_total'),
'created_at' => Carbon::now()
]);
//Order details Tabale data insert
$carts = Cart::where('ip_address', request()->ip())->select('id','product_id','cart_quantity')->get();
foreach ($carts as $cart){
Order_detail::insert([
'order_id' => $order_id,
'product_id' => $cart->product_id,
'quantity' => $cart->cart_quantity,
'created_at' => Carbon::now()
]);
//Product quantity decerement to product tabele
Product::find($cart->product_id)->decrement('product_quantity',$cart->cart_quantity);
//cart Item delete
Cart::find($cart->id)->delete();
}
return redirect('home');
}

}
// Checkoutpost Page End=========================================================================>

// customerregister Page Start=========================================================================>
function customerregister(){
return view('customerregister');
}
// customerregister Page End=========================================================================>

// coustomerregispost Page Start=========================================================================>
function coustomerregispost(Request $request){
$request->validate([
'name'=>'required', 
'email'=>'required', 
'password'=>'required',
]);
User::insert([
'name' => $request->name,
'email' => $request->email,
'password' => bcrypt($request->password),
'role' => 2,
'created_at' => Carbon::now()
]);
return back();
}
// coustomerregispost Page End=========================================================================>

// customerlogin Page Start=========================================================================>
function customerlogin(){
return View('customerlogin');
}
// customerlogin Page End=========================================================================>

// customerloginpost Page Start=========================================================================>
function customerloginpost(Request $request){
//User Email Chack Start--------------------------------->
if (User::where('email',$request->email)->exists()){

//User password Chack Start--------------------------------->
$db_password = User::where('email',$request->email)->first()->password;
if ( Hash::check($request->password, $db_password)) {
if (Auth::attempt($request->except('_token'))){
return redirect()->intended('home');
}
} else {
return back()->with('customer_login_eror','Your Password Wrong !');
}
//User password Chack End--------------------------------->

}else{
return back()->with('customer_login_eror','Your Email Wrong !');
}
//User Email Chack End--------------------------------->
}
// customerloginpost Page End=========================================================================>


// customerloginpost Page End=========================================================================>
public function about(){
$breadcumbs = Breadcumb::latest()->limit(1)->get();
//Best seler Part Start-------->
$order_details_info = Order_detail::select('product_id',DB::raw('count(*) as total'))->groupBy('product_id')->get();
$collection = collect($order_details_info);
$sorted_best_seller =  $collection->sortByDesc('total')->take(4);
//Best seler Part Start-------->
return view('about',compact('breadcumbs','sorted_best_seller'));
}
// customerloginpost Page End=========================================================================>

}
