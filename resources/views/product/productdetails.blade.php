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
                            <li><a href="{{route('tohoney_home')}}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- single-product-area start-->
    <div class="single-product-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            <div class="item">
                                <img src="{{asset('uploads/product_photo/'.$product_info->product_photo)}}" alt=" Not Photo">
                            </div>
                            @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $Featured_photo)
                            <div class="item">
                                <img src="{{asset('uploads/product_featured_photo/'.$Featured_photo->featured_photo_name)}}" alt=" Not Photo">
                            </div>
                            @endforeach
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                            <div class="item">
                                <img src="{{asset('uploads/product_photo/'.$product_info->product_photo)}}" alt=" Not Photo">
                            </div>

                            @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $Featured_photo)
                                <div class="item">
                                    <img src="{{asset('uploads/product_featured_photo/'.$Featured_photo->featured_photo_name)}}" alt=" Not Photo">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-single-content">
                        <h3>{{ ucwords(strtolower($product_info->product_name))}}</h3>
                        <span class="badge badge-warning">Available Stokes:{{$product_info->product_quantity}}</span>
                        <div class="rating-wrap fix">
                            <span class="pull-left">Price : ${{$product_info->product_price}}</span>
                            <ul class="rating pull-right">
                               @if ($overall_review != 0)
                               @for($i = 1; $i <= floor($overall_review); $i++)
                               <li><i class="fa fa-star"></i></li>
                               @endfor

                               @if(is_float($overall_review))
                               <li><i class="fa fa-star-half-o"></i></li>
                               @endif
                               <li>(05 Customar Review)</li> 
                               @else
                                (0 Customar Review)
                               @endif
                            </ul>
                        </div>
                        <p>{{$product_info->product_short_disc}}</p>
                 <!-- Product Add to Cart Start-->
                        <form action="{{route('addtocart',$product_info->id)}}" method="POST">
                            @csrf
                            <ul class="input-style">
                                <li class="quantity cart-plus-minus">
                                    <input type="number" value="1" name="cart_quantity" />
                                </li>
                                <li><button class="btn btn-danger ">Add to Cart</button></li>
                            </ul>
                         
                        </form>
                          @if (session('quqntity_erorr'))
                              <div class="alert alert-danger">{{session('quqntity_erorr')}}</div>
                          @endif
                 <!-- Product Add to Cart Start-->     
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a href="#">{{ucwords(strtolower($product_info->category->category_name))}}</a></li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                            <li><a data-toggle="tab" href="#tag">Faq</a></li>
                            <li><a data-toggle="tab" href="#review">Review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="description-wrap">
                                <p>{{$product_info->product_long_disc}}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tag">
                            <div class="faq-wrap" id="accordion">
                                @foreach ($faqs as $faq)
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5><button class="collapsed"  data-toggle="collapse" data-target="#collapseTwo{{$faq->id}}" aria-expanded="true" aria-controls="collapseTwo">{{$faq->faq_title}}</button></h5>
                                    </div>
                                    <div id="collapseTwo{{$faq->id}}" class="collapse {{($loop->index==0) ? 'show':'' }} " aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            {{$faq->faq_discription}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="review">
                            <div class="review-wrap">
                                <ul>
                                    @foreach ($customer_reviews as $customer_review)
                                    <li class="review-items">
                                        <div class="review-img">
                                            <img src="{{asset('tohoney_assets')}}/images/comment/1.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <h3><a href="#">{{$customer_review->usertabelereletion->name}}</a></h3>
                                            <span>{{$customer_review->created_at->format('d M, Y')}} at {{$customer_review->created_at->format('h:i A')}}</span>
                                            <p>{{$customer_review->review_text}}</p>
                                            <ul class="rating">
                                                @for ($i = 1; $i<=$customer_review->stars; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area end-->
    <!-- featured-product-area start -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($releted_products as $releted_product)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="{{asset('uploads/product_photo/'.$releted_product->product_photo)}}" alt="Image Not Found">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="{{route('productdetails',$releted_product->id)}}">{{ucwords(strtolower($releted_product->product_name))}}</a></h3>
                                        <p>${{$releted_product->product_price}}</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="col-lg-12 col-sm-6 col-12 text-center">
                        <div class="alert alert-danger">Related Product Not Found</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- featured-product-area end -->
@endsection