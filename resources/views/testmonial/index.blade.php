@extends('layouts.kubb')

@section('title')
Testmonial
@endsection
{{-- button page active --}}
@section('testmonial')
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
                        @if (session('testmonial_delete_message'))
                        <div class="alert alert-success ">{{session('testmonial_delete_message')}}</div>
                        @endif
                        <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Testmonial Name</th>
                                <th>Testmonial Title</th>
                                <th>Testmonial Description</th>
                                <th>Testmonial Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testmonials as $testmonial)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($testmonial->testmonial_name))}}</td>
                                <td>{{$testmonial->testmonial_title}}</td>
                                <td>{{$testmonial->testmonial_discription}}</td>
                                <td>
                                  <img src="{{asset('uploads/testmonial_photo/'.$testmonial->testmonial_photo)}}"  width="100" alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                    <a type="submit" class="btn btn-sm btn-outline-warning " href = "#">Edite</a>
                                    <a type="submit" class="btn btn-sm btn-outline-danger cate_delet_alert" href = "{{route('testmonialdelete',$testmonial->id)}}">Delete</a>
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
                        {{$testmonials->links('pagination::bootstrap-5')}}
                </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Testmonial Add</div>
                <div class="card-body">
                    @if (session('testmonial_message'))
                      <div class="alert alert-success">{{session('testmonial_message')}}</div>
                    @endif
                    
                    <form action="{{route('testmonialpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Testmonial Name</label>
                            <input type="text" class="form-control" name="testmonial_name" placeholder="Enter Testmonial Name">
                            @error('testmonial_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Testmonial Title</label>
                            <textarea class="form-control" name="testmonial_title" placeholder="Enter Testmonial Title" rows="4"></textarea>
                            @error('testmonial_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Testmonial Description</label>
                            <textarea class="form-control" name="testmonial_discription"  placeholder="Enter Testmonial Description" rows="4"></textarea>
                            @error('testmonial_discription')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>

                         <div class="form-group mt-3">
                            <label >Testmonial Photo</label>
                            <input type="file" class="form-control" name="testmonial_photo">
                            @error('testmonial_photo')
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
                            Category Delete Item
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('testmonial_restore_message'))
                        <div class="alert alert-success ">{{session('testmonial_restore_message')}}</div>
                        @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Testmonial Name</th>
                                <th>Testmonial Title</th>
                                <th>Testmonial Description</th>
                                <th>Testmonial Photo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($testmonial_delete_infos as $testmonial_delete_info)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($testmonial_delete_info->testmonial_name))}}</td>
                                <td>{{$testmonial_delete_info->testmonial_title}}</td>
                                <td>{{$testmonial_delete_info->testmonial_discription}}</td>
                                <td>
                                  <img src="{{asset('uploads/testmonial_photo/'.$testmonial_delete_info->testmonial_photo)}}"  width="100" alt="Not found" >
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-success" href = "{{route('testmonialrestore',$testmonial_delete_info->id)}}">Restore</a>
                                <a type="submit" class="btn btn-sm btn-outline-danger " href = "{{route('testmonialforcedelete',$testmonial_delete_info->id)}}">Force Delete</a>
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

