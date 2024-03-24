@extends('layouts.kubb')

@section('title')
Category Edit
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="col-5 m-auto">
            <div class="card">
                <div class="card-header bg-info text-light">Category {{$category_info->category_name}} Edit</div>
                <div class="card-body">
                    {{-- @if (session('category_insert_message'))
                      <div class="alert alert-success">{{session('category_insert_message')}}</div>
                    @endif --}}
                    
                    <form action="{{url('category_update',$category_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Category Name</label>
                            <input type="text" class="form-control" name="category_name" value="{{$category_info->category_name}}">
                            @if ($errors->all())
                                @foreach ($errors->all() as $error)
                                <span class="text-danger">{{$error}}</span>
                                @endforeach
                            @endif
                         </div>

                         <div class="form-group mt-3">
                          <label >Product Photo</label><br>
                          <img src="{{asset('uploads/category_photo/'.$category_info->category_photo)}}"  width="100" alt="Not found" >
                       </div>

                         <div class="form-group mt-3">
                          <label >Category Photo</label>
                          <input type="file" class="form-control" name="category_photo" placeholder="Enter Category Name">
                        </div>

                         <div class="btn-group  mt-3">
                           <button type="submit" class="btn btn-info">Add Now</button>
                         </div>
                     </form>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection