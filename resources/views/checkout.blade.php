@extends('layouts.tohoney')
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
@auth
<!-- Customer see checkout-area Process start -->
@if (Auth::user()->role == 2)
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details (Logged in as:<span class="tohoney_customer_color">{{ucwords(strtolower(Auth::user()->name))}}</span>)</h3>
                    <form action="{{route('checkoutpost')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" name="customer_name" value="{{ucwords(strtolower(Auth::user()->name))}}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="customer_email" value="{{Auth::user()->email}}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="customer_phone_number">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select name="customer_country_name">
                                    <option value="bangladesh">Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select name="customer_city_name">
                                    <option value="dhaka">Dhaka</option>
                                    <option value="rangpur">Rangpur</option>
                                    <option value="sylhet">Sylhet</option>
                                    <option value="rajhahi">Rajshahi</option>
                                </select>
                            </div>                                
                            <div class="col-sm-6 col-12">
                                <p>Your Address *</p>
                                <input type="text" name="coustomer_address">
                            </div>                     
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="customer_postcode">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="customer_massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        <li>Coupon Name <span class="pull-right"><strong>{{session('session_coupon_name') ? session('session_coupon_name') : "Not Applicable" }}</strong></span></li>
                        <li>Discount <span class="pull-right"><strong>${{session('session_discount')}}</strong></span></li>
                        <li>Subtotal <span class="pull-right"><strong>${{session('session_subtotal')}}</strong></span></li>
                        <li>Total<span class="pull-right">${{session('session_total')}}</span></li>
                    </ul>
                    <ul class="payment-method">                            
                        <li>
                            <input id="card" type="radio" name="payment_option" value="1" checked>
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment_option" value="2">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button type="submit">Place Order</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!--Customer see checkout-area Process  end -->    
@else
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
             <div class="col-12 text-center">
                   <div class="alert alert-danger">You are admin, You can not Chackut</div>
             </div>
        </div>
    </div>
</div> 
@endif
 
@else  
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
             <div class="col-12 text-center">

                <h2 class="text-danger">You are not Logged</h2>
               <p class="mb-2">If you already have an account <a class="text-info" href="{{route('customerlogin')}}">Login Here</a></p>
               <p>To open new account <a class="text-info" href="{{route('customerregister')}}">Registration Here</a></p>
    
             </div>
        </div>
    </div>
</div>    
@endauth
@endsection