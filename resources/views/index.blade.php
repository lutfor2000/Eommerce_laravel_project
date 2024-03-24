@extends('layouts.tohoney')
@section('body')
     <!-- slider-area start -->
     <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
               @foreach ($banners as $banner)
               <div class="swiper-slide overlay">
                <div class="single-slider slide-inner " style="background-image:url({{asset('uploads/banner/'.$banner->banner_photo)}})">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-lg-9 col-12">
                                <div class="slider-content">
                                    <div class="slider-shape">
                                        <h2 data-swiper-parallax="-500">{{ $banner->banner_title}}</h2>
                                        <p data-swiper-parallax="-400">{{ $banner->banner_sub_title}}</p>
                                        <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>  
               @endforeach
                {{-- <div class="swiper-slide">
                    <div class="slide-inner slide-inner7">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Amazing Pure Nature Coconut Oil</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner8">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Amazing Pure Nut Oil</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">

                       @foreach ($categories as $category)
                       <div class="featured-wrap">
                        <div class="featured-img">
                            {{-- <img src="{{asset('tohoney_assets')}}/images/featured/6.jpg" alt=""> --}}
                            <img src="{{asset('uploads/category_photo/'.$category->category_photo)}}" alt="Not photo">
                            <div class="featured-content">
                                <a href="{{route('categorywiseshop',$category->id)}}">{{ucwords(strtolower($category->category_name))}}</a>
                            </div>
                        </div>
                     </div>
                       @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="{{asset('tohoney_assets')}}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach ($sorted_best_seller as $pro)
                 @php
                    $product = App\Models\Product::find($pro->product_id) 
                 @endphp
                @include('little_part.product_all')
                @endforeach
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="{{asset('tohoney_assets')}}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
<!-------All Product Show Part Start--------------------------------------------------------------->
                @foreach ($productes as $product)
                   @include('little_part.product_all')
                @endforeach
<!-------All Product Show Part End--------------------------------------------------------------->
                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                      @foreach ($testmonials as $testmonial)
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{$testmonial->testmonial_discription}}</p>
                                <h2>{{$testmonial->testmonial_name}}</h2>
                                <p>{{$testmonial->testmonial_title}}</p>
                            </div>
                            <div class="test-img2 testmonial_img">
                                <img src="{{asset('uploads/testmonial_photo/'.$testmonial->testmonial_photo)}}" alt="img Not Found">
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
   
@endsection