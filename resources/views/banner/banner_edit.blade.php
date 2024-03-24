@extends('layouts.kubb')

@section('title')
Banner
@endsection
{{-- button page active --}}
@section('banner')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="col-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-light">Banner Add</div>
                <div class="card-body">
                    @if (session('banner_message'))
                      <div class="alert alert-success">{{session('banner_message')}}</div>
                    @endif
                    
                    <form action="{{route('bannerupdate',$banner_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Banner Title</label>
                            <input type="text" class="form-control" name="banner_title" value="{{$banner_info->banner_title}}">
                            {{-- @error('testmonial_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>
                         <div class="form-group mt-3">
                            <label >Banner Sub Title</label>
                            <textarea class="form-control" name="banner_sub_title" rows="4">{{$banner_info->banner_sub_title}}</textarea>
                            {{-- @error('testmonial_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="form-group mt-3">
                            <label >Banner Photo</label><br>
                            <img src="{{asset('uploads/banner/'.$banner_info->banner_photo)}}"  width="100" alt="Not found" >
                         </div>

                         <div class="form-group mt-3">
                            <label >Banner New Photo</label>
                            <input type="file" class="form-control" name="banner_new_photo">
                            {{-- @error('testmonial_photo')
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

