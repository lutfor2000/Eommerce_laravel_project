@extends('layouts.kubb')

@section('title')
Rewiew
@endsection
{{-- button page active --}}
@section('content')
<div class="container">
    <div class="row">
          <div class="col-10 m-auto">
            <div class="card">
                @forelse ($order_details as $order_detail)
                @if (App\Models\Review::where('order_details_id',$order_detail->id)->exists())
                <div class="card-header">
                   <div class="card-body">
                      <li style="list-style-type: none"> Review {{$order_detail->producttoorderdreletion->product_name}}
                         <span class="badge badge-warning">Done</span></li>
                   </div>
                </div>
                @else
                <div class="card-header bg-white text-info">
                    Give Review <span class="ml-1"> {{$order_detail->producttoorderdreletion->product_name}}</span> 
                    <span class="ml-1 text-warning"> <i class="fa fa-star fs-1x"></i>  <i class="fa fa-star "></i> <i class="fa fa-star-half"></i></span>
                    </div>
                    <div class="card-body">
                    <form action="{{route('givereviewpost',$order_detail->id)}}" method="post">
                        @csrf
                        @error('review_text')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="text" name="review_text" class="form-control mb-1">
                        <input type="range" id="points" name="stars" min="1" max="5" step="1" value="1"><br>
                        <button class="btn btn-sm btn-outline-warning" type="submit">Give Review</button>
                    </form>
                    </div>     
                @endif
                @empty
                Empty Item
                @endforelse
          </div>
    </div>
</div>
@endsection
