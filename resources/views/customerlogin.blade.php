@extends('layouts.tohoney')
@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                @if (session('customer_login_eror'))
                <div class="alert alert-danger">{{session('customer_login_eror')}}</div>
                @endif

              <form action="{{route('customerloginpost')}}" method="post">
                @csrf
                    <div class="account-form form-style">
                        <p>Email Address</p>
                        <input type="email" name="email">
                        <p>Password *</p>
                        <input type="Password" name="password">
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="password" type="checkbox">
                                <label for="password">Save Password</label>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#">Forget Your Password?</a>
                            </div>
                        </div>
                        <button>SIGN IN</button>
                        <div class="text-center">
                            <a href="{{route('customerregister')}}">Or Creat an Account</a>
                        </div>
                    </div>
              </form>

            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection