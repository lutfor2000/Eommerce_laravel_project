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
          <div class="col-8">
            <div class="card">
                    <div class="card-header bg-primary text-light">
                       <h6>Testmonial Table</h6>
                      </div>
                      <div class="card-body">
                        @if (session('banner_delete_status'))
                        <div class="alert alert-success ">{{session('banner_delete_status')}}</div>
                        @endif
                        <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Banner Title</th>
                                <th>Banner Sub Title</th>
                                <th>Banner Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($banner->banner_title))}}</td>
                                <td>{{$banner->banner_sub_title}}</td>
                                <td>
                                  <img src="{{asset('uploads/banner/'.$banner->banner_photo)}}"  width="100" alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                    <a type="submit" class="btn btn-sm btn-outline-info" href = "{{route('banneredit',$banner->id)}}"><i class=" fa-1x fa fa-edit"></i></a>
                                    <a type="submit" class="btn btn-sm  btn-outline-danger" href = "{{route('bannerdelete',$banner->id)}}"><i class=" fa-1x fa fa-trash"></i></a>
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
                        {{$banners->links('pagination::bootstrap-5')}}
                </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Banner Add</div>
                <div class="card-body">
                    @if (session('banner_message'))
                      <div class="alert alert-success">{{session('banner_message')}}</div>
                    @endif
                    
                    <form action="{{route('bannerpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Banner Title</label>
                            <input type="text" class="form-control" name="banner_title" placeholder="Enter Banner Title">
                            @error('banner_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Banner Sub Title</label>
                            <textarea class="form-control" name="banner_sub_title" placeholder="Enter Banner Sub Title" rows="4"></textarea>
                            @error('banner_sub_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Banner Photo</label>
                            <input type="file" class="form-control" name="banner_photo">
                            @error('banner_photo')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
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
                     <div class="card-header bg-primary">
                        <div class="text-light">
                            Banner Delete Item
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('banner_trash_mes'))
                        <div class="alert alert-success ">{{session('banner_trash_mes')}}</div>
                        @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Banner Title</th>
                                <th>Banner Sub Title</th>
                                <th>Banner Photo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($banner_all_deletes as $banner_all_delete)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($banner_all_delete->banner_title))}}</td>
                                <td>{{$banner_all_delete->banner_sub_title}}</td>
                                <td>
                                  <img src="{{asset('uploads/banner/'.$banner_all_delete->banner_photo)}}"  width="100" alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn  btn-outline-success" href = "{{route('bannerrestore',$banner_all_delete->id)}}"><i class=" fa-1x fa fa-undo"></i></a>
                                <a type="submit" class="btn  btn-outline-danger " href = "{{route('bannerforcedelete',$banner_all_delete->id)}}"><i class=" fa-1x fa fa-unlink"></i></a>
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

