@extends('layouts.tohoney')
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('cardupdate')}}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- product to chack out button chack process --> 
                                @php
                                  $flage = false;  
                                  $subtotal = 0;
                                @endphp
                                 <!-- product to chack out button chack process -->
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="images"><img src="{{asset('uploads/product_photo/'.$cart->productreletion->product_photo)}}" alt="Not Found"></td>
                                        <td class="product"><a href="#">
                                            {{$cart->productreletion->product_name}}
                                            @if($cart->productreletion->product_quantity < $cart->cart_quantity)
                                            <span class="badge badge-danger">Available Stock:{{$cart->productreletion->product_quantity}}</span>
                                            @php
                                              $flage = true;  
                                            @endphp
                                            @endif
                                        </td>
                                        <td class="ptice">${{$cart->productreletion->product_price}}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{$cart->cart_quantity}}" name="cart_quantity[{{$cart->id}}]" />
                                        </td>
                                        <td class="total">
                                            ${{$cart->productreletion->product_price * $cart->cart_quantity}}
                                            @php
                                                $subtotal += ($cart->productreletion->product_price * $cart->cart_quantity);
                                            @endphp
                                        </td>
                                        <td class="remove"> <a href="{{route('cartdelete',$cart->id)}}"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        <li><a href="{{route('shop')}}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Coupon Code" id="coupon_input" value="{{$coupon_name}}">
                                        <button type="button" id="apply_coupon_btn">Apply Cupon</button>
                                        @if (session('coupon_errors'))
                                        <span class="alert text-danger">{{session('coupon_errors')}}</span>
                                      @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{$subtotal}}</li>
                                        <li><span class="pull-left">Discount(%)</span>{{$coupon_discount}}</li>
                                        <li><span class="pull-left">Discount(in Discount)</span>{{($coupon_discount/100) * $subtotal}}</li>
                                        <li><span class="pull-left"> Total Price </span> ${{$subtotal - (($coupon_discount/100) * $subtotal)}}</li>
                                       <!-- Cart to checkout page Data Trainsfer Stert --> 
                                        @php
                                           session([
                                            'session_coupon_name' => $coupon_name,
                                            'session_subtotal' => $subtotal,
                                            'session_discount' => $coupon_discount,
                                            'session_total' => $subtotal - (($coupon_discount/100) * $subtotal),
                                         ]);
                                        @endphp
                                      <!-- Cart to checkout page Data Trainsfer Stert --> 
                                    </ul>
                                    <!-- product to chack out button chack process -->
                                    @if ($flage )
                                     <a href="#">Place Check Quantity</a>
                                    @else
                                      <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                    @endif
                                   <!-- product to chack out button chack process -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection

@section('tohaoney_footer_script')
 <script>
        $(document).ready(function(){
            $('#apply_coupon_btn').click(function(){
                var coupon_name = $('#coupon_input').val();
                var link_to_go = "{{route('cart')}}/" + coupon_name;
                // alert(link_to_go);
                window.location.href = link_to_go;
            });
        });
 </script>
@endsection