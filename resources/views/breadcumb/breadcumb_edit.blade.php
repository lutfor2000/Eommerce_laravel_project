@extends('layouts.kubb')

@section('title')
Breadcumb
@endsection
{{-- button page active --}}
@section('breadcumb')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Breadcumb Photo Update</div>
                <div class="card-body">
                    <form action="{{route('breadcumbupdate',$breadcumb_infos->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                        <label >Breadcumb Photo</label><br>
                        <img src="{{asset('uploads/breadcumb_photo/'.$breadcumb_infos->breadcumb_photo)}}" class="w-100" alt="Not found" >
                        </div>

                        <div class="form-group mt-3">
                        <label >New Breadcumb Photo</label>
                        <input type="file" class="form-control" name="breadcumb_new_photo">
                        @error('breadcumb_photo')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>

                         <div class="btn-group  mt-3">
                         <button type="submit" class="btn btn-primary">Update Now</button>
                         </div>
                     </form>
                </div>
            </div>
          </div>

    </div>
</div>
@endsection

