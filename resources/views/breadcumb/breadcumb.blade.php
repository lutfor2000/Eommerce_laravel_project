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
          <div class="col-8">
            <div class="card">
                    <div class="card-header bg-primary text-light">
                       <h6>Testmonial Table</h6>
                      </div>
                      <div class="card-body">
                        @if (session('breadcumb_delete_message'))
                        <div class="alert alert-success ">{{session('breadcumb_delete_message')}}</div>
                        @endif
                        <table class = "table table-bordered text-center">
                        <thead>
                              <tr>
                                <th>Serial No</th>
                                <th>Testmonial Photo</th>
                                <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @forelse ($breadcumbs as $breadcumb)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                <img src="{{asset('uploads/breadcumb_photo/'.$breadcumb->breadcumb_photo)}}" class="w-100"  alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-warning " href = "{{route('breadcumbedit',$breadcumb->id)}}">Edite</a>
                                <a type="submit" class="btn btn-sm btn-outline-danger cate_delet_alert" href ="{{route('breadcumbdelete',$breadcumb->id)}}">Delete</a>
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
                        {{-- {{$testmonials->links('pagination::bootstrap-5')}} --}}
                </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Breadcumb Add</div>
                <div class="card-body">
                    @if (session('breadcumb_message'))
                      <div class="alert alert-success">{{session('breadcumb_message')}}</div>
                    @endif
                    
                    <form action="{{route('breadcumbpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Breadcumb Photo</label>
                            <input type="file" class="form-control" name="breadcumb_photo">
                            @error('breadcumb_photo')
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
                    <div class="card-header bg-primary text-light">
                       <h6>Testmonial Delete Item</h6>
                      </div>
                      <div class="card-body">
                        @if (session('breadcumb_restore_message'))
                        <div class="alert alert-success ">{{session('breadcumb_restore_message')}}</div>
                        @endif
                        <table class = "table table-bordered text-center">
                        <thead>
                              <tr>
                                <th>Serial No</th>
                                <th>Testmonial Photo</th>
                                <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @forelse ($breadcumbs_delete_items as $breadcumbs_delete_item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                <img src="{{asset('uploads/breadcumb_photo/'.$breadcumbs_delete_item->breadcumb_photo)}}" class="w-100"  alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-warning " href = "{{route('breadcumbrestore',$breadcumbs_delete_item->id)}}">Restore</a>
                                <a type="submit" class="btn btn-sm btn-outline-danger cate_delet_alert" href ="{{route('breadcumbforcedelete',$breadcumbs_delete_item->id)}}">ForceDelete</a>
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
                        {{-- {{$testmonials->links('pagination::bootstrap-5')}} --}}
                </div>
            </div>
          </div>

    </div>
</div>
@endsection

