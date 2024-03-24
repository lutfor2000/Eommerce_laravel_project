<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkrole');
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $coupons = Coupon::latest()->get();
      return view('coupon.index',compact('coupons'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name'=>'required', 
            'discount_amount'=>'required', 
            'expire_date'=>'required',
            'uses_limit'=>'required',
        ]);

        Coupon::create($request->except('_token'));
        return back()->with('coupon_message','Coupon Add Successfull !');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
       $coupon_edit = Coupon::find($coupon->id);
       return view('coupon.edit',compact('coupon_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
       Coupon::find($coupon->id)->update($request->except('_token'));
       return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
    //  Coupon::find($coupon->id)->delete();
        $coupon->delete();
        return back()->with('coupon_mess','Delete Successfull !');
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
