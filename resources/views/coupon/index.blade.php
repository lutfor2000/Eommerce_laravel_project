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
          <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Coupon</div>
                <div class="card-body">
                     @if (session('coupon_mess'))
                     <div class="alert alert-success">{{session('coupon_mess')}}</div>
                     @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                           <tr>
                              <th>Serial No</th>
                              <th>Coupon Name</th>
                              <th>Discount Amount</th>
                              <th>Expart Date</th>
                              <th>User Limit</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                              @foreach ($coupons as $coupon)
                                 <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ucwords(strtolower($coupon->coupon_name))}}</td>
                                    <td>{{$coupon->discount_amount}}</td>
                                    <td>{{$coupon->expire_date}}</td>
                                    <td>{{$coupon->uses_limit}}</td>
                                    <td>
                                    <div class="btn-group ">
                                       <a type="submit" class="btn btn-sm btn-outline-warning" href = "{{route('coupon.edit',$coupon->id)}}">Edit</a>
                                       <form action="{{route('coupon.destroy',$coupon->id)}}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-sm btn-outline-danger">Delete</button>
                                       </form>
                                    </div>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                   </table>
                </div>
             </div>
          </div>
          <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Coupon Item Add</div>
                <div class="card-body">
                    @if (session('coupon_message'))
                      <div class="alert alert-success">{{session('coupon_message')}}</div>
                    @endif
                    
                    <form action="{{route('coupon.store')}}" method="POST">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Coupon Name</label>
                            <input type="text" class="form-control" name="coupon_name" placeholder="Enter Coupon Name">
                            @error('coupon_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Coupon Discount Amount</label>
                            <input type="number" class="form-control" name="discount_amount" placeholder="Enter Coupon Discount Amount">
                            @error('discount_amount')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Coupon Expart Date</label>
                            <input type="date" class="form-control" name="expire_date">
                            {{-- @error('category_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="form-group mt-3">
                            <label >Coupon User Limit</label>
                            <input type="number" class="form-control" name="uses_limit" placeholder="Enter Coupon User Limit">
                            {{-- @error('category_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="btn-group  mt-3">
                         <button type="submit" class="btn btn-primary">Add Now</button>
                         </div>
                     </form>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection
