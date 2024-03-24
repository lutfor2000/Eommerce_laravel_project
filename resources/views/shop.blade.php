@extends('layouts.tohoney')
@section('body')
     <!-- .breadcumb-area start -->
@foreach ($breadcumbs as $breadcumb)
<div class="breadcumb-area  ptb-100" style="background-image:url(uploads/breadcumb_photo/{{$breadcumb->breadcumb_photo}})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{route('tohoney_home')}}">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
</div>
@endforeach
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($all_categorys as $all_category)
                            <li>
                                <a data-toggle="tab" href="#dynamic_id_{{$all_category->id}}">{{$all_category->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">

                       @foreach ($all_productes as $product)
                         @php
                         $product_id= App\Models\Review::find($product->product_id) 
                         @endphp
                          @include('little_part.product_all',compact('product_id'))
                       @endforeach

                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>
                @foreach ($all_categorys as $all_category)
                <div class="tab-pane" id="dynamic_id_{{$all_category->id}}">
                    <ul class="row">
                      @foreach (App\Models\Product::where('category_id', $all_category->id)->get() as $product)
                          @include('little_part.product_all')
                      @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection