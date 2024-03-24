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
                    
                    <form action="{{route('productpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label >Category Name</label>
                            <select class="form-control"  name="category_id" >
                                <option value="">--Choose One--</option>
                                @foreach ($categoris as $categoy_item)
                                <option value="{{$categoy_item->id}}">{{ucwords(strtolower($categoy_item->category_name))}}</option>  
                                @endforeach
                                
                            </select>
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                            @error('product_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                        
                         <div class="form-group mt-3">
                            <label >Product Price</label>
                            <input type="number" class="form-control" name="product_price" placeholder="Enter Product Price">
                            @error('product_price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Quantity</label>
                            <input type="number" class="form-control" name="product_quantity" placeholder="Enter Product Quantity">
                            @error('product_quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Short Description</label>
                            <textarea class="form-control" name="product_short_disc"  placeholder="Enter Product Short Description" rows="4"></textarea>
                            @error('product_short_disc')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Long Description</label>
                            <textarea class="form-control" name="product_long_disc"  placeholder="Enter Product Long Description" rows="4"></textarea>
                            @error('product_long_disc')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Product Alert Quantity</label>
                            <input type="number" class="form-control" name="product_alert_quantity" placeholder="Enter Product Alert Quantity">
                            @error('product_alert_quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Product Photo</label>
                            <input type="file" class="form-control" name="product_photo" placeholder="Enter Product Alert Quantity">
                            @error('product_alert_quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Featured Photo</label>
                            <input type="file" class="form-control" name="product_featured_photo[]" multiple >
                            {{-- @error('product_alert_quantity')
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

          <div class="col-12">
            <div class="card">
                    <div class="card-header text-light bg-primary">
                       Product List
                      </div>
                      <div class="card-body">
                        @if (session('product_delete_status'))
                        <div class="alert alert-success ">{{session('product_delete_status')}}</div>
                        @endif

                        @if (session('product_update_mes'))
                        <div class="alert alert-success ">{{session('product_update_mes')}}</div>
                        @endif

                        <table class = "table table-bordered text-center">
                            <thead>
                               <tr>
                                  <th>Serial No</th>
                                  <th>Product Name</th>
                                  <th>Category Name</th>
                                  <th>Product Price</th>
                                  <th>Product Quantity</th>
                                  <th>Product Short Description</th>
                                  <th>Product Alert Quantity</th>
                                  <th>Add By</th>
                                  <th>Product Image</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ ucwords(strtolower($product->product_name))}}</td>
                                        <td>
                                            @if ($product->category)
                                             {{$product->category->category_name}}
                                            @else
                                               {{ 'Not Entry' }} 
                                            @endif
                                        
                                        </td>
                                        <td>{{$product->product_price}}</td>
                                        <td>{{$product->product_quantity}}</td>
                                        <td>{{$product->product_short_disc}}</td>
                                        <td>{{$product->product_alert_quantity}}</td>
                                        <td>{{App\Models\User::find($product->user_id)->name}}</td>
                                        <td>
                                            <img src="{{asset('uploads/product_photo/'.$product->product_photo)}}"  width="100" alt="Not found" >
                                        </td>
                                        <td>
                                        <div class="btn-group ">
                                        <a type="submit" class="btn btn-sm btn-outline-danger" href ="{{route('productdelete',$product->id)}}">Delete</a>
                                        <a type="submit" class="btn btn-sm btn-outline-warning" href ="{{route('productedit',$product->id)}}">Edite</a>
                                        </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="20" class="text-danger"> <small>No Data To Show</small></td>
                                    </tr>
                                    @endforelse
                               
                            </tbody>
                       </table>
                       
                        {{$products->links('pagination::bootstrap-5')}}

                </div>
            </div>
          </div>
     

          <div class="col-12">
            <div class="card">
                     <div class="card-header bg-primary">
                        <div class="text-light">
                            Product Delete Item
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('category_restore_mes'))
                        <div class="alert alert-success ">{{session('category_restore_mes')}}</div>
                        @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                {{-- <th>Category Name</th> --}}
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product Alert Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($all_delete_products as $all_delete_product)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                {{-- <td>{{$all_delete_product->category_name}}</td> --}}
                                <td>{{ ucwords(strtolower($all_delete_product->product_name))}}</td>
                                <td>{{$all_delete_product->product_price}}</td>
                                <td>{{$all_delete_product->product_quantity}}</td>
                                <td>{{$all_delete_product->product_alert_quantity}}</td>
                                <td>
                                <div class="btn-group ">
                                        <a type="submit" class="btn btn-sm btn-outline-success" href ="{{route('productrestore',$all_delete_product->id)}}">Restore</a>
                                        <a type="submit" class="btn btn-sm btn-outline-danger" href = "{{route('productforcedelete',$all_delete_product->id)}}">Force Delete</a>
                                </div>
                                </td>
                            </tr> 
                            @empty
                            <tr class="text-center">
                                <td colspan="20" class="text-danger"> <small>No Data To Show</small></td>
                            </tr>
                            @endforelse
                        </tbody>
                     </table>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection