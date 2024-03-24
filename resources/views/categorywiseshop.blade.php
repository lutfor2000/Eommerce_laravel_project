@extends('layouts.tohoney')
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">

                       @forelse ($products as $product) 
                          @include('little_part.product_all')

                        @empty
                            <div class="col-lg-12 col-sm-6 col-12 text-center">
                                <div class="alert alert-danger">Related Product Not Found</div>
                            </div>
                       @endforelse

                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection