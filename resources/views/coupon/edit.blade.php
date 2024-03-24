@extends('layouts.kubb')

@section('title')
Coupon
@endsection
{{-- button page active --}}
@section('coupon')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-light">Coupon Item Add</div>
                <div class="card-body">
                    <form action="{{route('coupon.update',$coupon_edit->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                         <div class="form-group mt-3">
                            <label >Coupon Name</label>
                            <input type="text" class="form-control" name="coupon_name" value="{{$coupon_edit->coupon_name}}" >
                            @error('coupon_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Coupon Discount Amount</label>
                            <input type="number" class="form-control" name="discount_amount" value="{{$coupon_edit->discount_amount}}">
                            @error('discount_amount')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Coupon Expart Date</label>
                            <input type="date" class="form-control" name="expire_date" value="{{$coupon_edit->expire_date}}">
                            {{-- @error('category_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="form-group mt-3">
                            <label >Coupon User Limit</label>
                            <input type="number" class="form-control" name="uses_limit" value="{{$coupon_edit->uses_limit}}">
                            {{-- @error('category_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="btn-group  mt-3">
                         <button type="submit" class="btn btn-primary">Update Now</button>
                         </div>
                     </form>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection
