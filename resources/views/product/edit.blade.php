@extends('layouts.kubb')

@section('title')
Product
@endsection
{{-- button page active --}}
@section('product')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Product Item Add</div>
                <div class="card-body">
                    @if (session('product_insert_message'))
                      <div class="alert alert-success">{{session('product_insert_message')}}</div>
                    @endif
                    
                    <form action="{{route('productupdate',$product_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label >Category Name</label>
                            <select class="form-control"  name="category_id" >
                                <option value="">--Choose One--</option>
                                @foreach ($categoris as $categoy_item)
                                <option value="{{$categoy_item->id}}" {{($product_info->category_id == $categoy_item->id) ? 'selected' :''}}>{{ucwords(strtolower($categoy_item->category_name))}}</option>  
                                @endforeach
                            </select>
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product_info->product_name}}">
                            @error('product_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                        
                         <div class="form-group mt-3">
                            <label >Product Price</label>
                            <input type="number" class="form-control" name="product_price" placeholder="Enter Product Price"  value="{{$product_info->product_price}}">
                            @error('product_price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Quantity</label>
                            <input type="number" class="form-control" name="product_quantity" placeholder="Enter Product Quantity" value="{{$product_info->product_quantity}}">
                            @error('product_quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Short Description</label>
                            <textarea class="form-control" name="product_short_disc"  placeholder="Enter Product Short Description" rows="4">{{$product_info->product_short_disc}}</textarea>
                            @error('product_short_disc')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Long Description</label>
                            <textarea class="form-control" name="product_long_disc"  placeholder="Enter Product Long Description" rows="4">{{$product_info->product_long_disc}}</textarea>
                            @error('product_long_disc')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Product Alert Quantity</label>
                            <input type="number" class="form-control" name="product_alert_quantity" placeholder="Enter Product Alert Quantity" value="{{$product_info->product_alert_quantity}}">
                            @error('product_alert_quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                           <label >Product Photo</label><br>
                           <img src="{{asset('uploads/product_photo/'.$product_info->product_photo)}}"  width="100" alt="Not found" >
                        </div>
                        <div class="form-group mt-3">
                           <label >Product New Photo</label>
                           <input type="file" class="form-control" name="product_new_photo">
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