
<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <span>Sale</span>
            <img src="{{asset('uploads/product_photo/'.$product->product_photo)}}" alt="Not photo">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{route('productdetails',$product->id)}}">{{ucwords(strtolower($product->product_name)) }}</a></h3>
            <p class="pull-left">${{ $product->product_price}}

            </p>
            <ul class="pull-right d-flex">
               
                 @php
                     $product_id =$product->id ; 
                     $stars =App\Models\Review::where('product_id',$product_id)->sum('stars');
                     $total_id =App\Models\Review::where('product_id',$product_id)->count();
                 @endphp

                 @if (isset($stars) && $total_id != 0)
                      @php
                         $overall_review = $stars/$total_id;
                      @endphp
                      @for($i = 1; $i <= floor($overall_review); $i++)
                      <li><i class="fa fa-star"></i></li>
                      @endfor

                      @if(is_float($overall_review))
                      <li><i class="fa fa-star-half-o"></i></li>
                      @endif 
                      @else
                      <li><i class="fa fa-star-half-o"></i></li>
                 @endif

                {{-- <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-o"></i></li> --}}
                
            </ul>
        </div>
    </div>
</li>