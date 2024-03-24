<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    //  }
//Cart Add Data Table Start===========================================================>    
    function addtocart(Request $request,$product_id){
        //card quantity Error Chack
        if ($request->cart_quantity > Product::find($product_id)->product_quantity ) {
            return back()->with('quqntity_erorr','Stock Not Available !');
        }

        if (Cart::where('product_id',$product_id)->where('ip_address', request()->ip())->exists()){
            Cart::where('product_id',$product_id)->where('ip_address', request()->ip())->increment('cart_quantity', $request->cart_quantity);
        } else {
            Cart::insert([
                'product_id' => $product_id,
                'cart_quantity' => $request->cart_quantity,
                'ip_address' => request()->ip(),
                'created_at' => Carbon::now(),
            ]);
        }
        
        return back();
    }
//Cart Add Data Table End===========================================================>  

//Cart Add Delete Start===========================================================>  
    function cartdelete($card_id){
        if (Cart::where('id',$card_id)->exists()){
            Cart::find($card_id)->delete();
        }
        return back();
    }
//Cart Add Delete End===========================================================>  

//Cart Add Update Start===========================================================>  
    function cardupdate(Request $request){
       foreach($request->cart_quantity as $card_id => $cart_quantity){
          Cart::find($card_id)->update([
              'cart_quantity' => $cart_quantity,
          ]);
       }
       return back();
    }
//Cart Add Update End===========================================================>  

}
