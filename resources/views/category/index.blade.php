@extends('layouts.kubb')

@section('title')
Category
@endsection
{{-- button page active --}}
@section('category')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="col-8">
            <div class="card">
                    <div class="card-header bg-primary">
                        <div class="w-50 text-light">
                            Category List
                        </div>
                        <div class=" w-50  text-right">
                            @if($categories->count() != 0)
                            <button id="alldelete_btn_alert" class="btn btn-sm  btn-outline-danger">All Delete</button>
                            @endif
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('category_delete_status'))
                        <div class="alert alert-success ">{{session('category_delete_status')}}</div>
                        @endif

                        @if (session('category_update_status'))
                        <div class="alert alert-success ">{{session('category_update_status')}}</div>
                        @endif

                        <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Delete !</th>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Category Photo</th>
                                <th>Created Time</th>
                                <th>Update Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{route('categorychackalldelete')}}" method="POST">
                             @csrf
                            @forelse ($categories as $category)
                            <tr>
                                <td><input type="checkbox" class="chackall_box" name="category_check_id[]" value="{{$category->id}}"></td>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($category->category_name))}}</td>
                                <td>
                                  <img src="{{asset('uploads/category_photo/'.$category->category_photo)}}"  width="100" alt="Not found" >
                                </td>
                                <td>{{$category->created_at->format('d/m/y h:i:s A')}}</td>
                                <td>
                                    @if ($category->updated_at )
                                    {{$category->updated_at->format('d/m/y h:i:s A')}}
                                    @else
                                        Not time
                                    @endif
                                </td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-danger cate_delet_alert" href = "{{url('category/delete')}}/{{$category->id}}">Delete</a>
                                <a type="submit" class="btn btn-sm btn-outline-warning " href = "{{url('category/edite')}}/{{$category->id}}">Edite</a>
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
                        <div class="btn-group text-center ">
                            @if ($categories->count() != 0)
                            <button type="button" id="category_chack_all_btn" class="btn btn-sm btn-outline-info ">Chack All</button>
                            <button type="button" id="categoty_uncheck_btn" class="btn btn-sm btn-outline-secondary">Unchack All</button>
                            <button type="submit" id="category_check_all_delete" class="btn btn-sm btn-outline-danger">Chack All Delete</button>
                             @endif
                        </div>
                       
                        {{$categories->links('pagination::bootstrap-5')}}
                    </form>

                </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Category Item Add</div>
                <div class="card-body">
                    @if (session('category_insert_message'))
                      <div class="alert alert-success">{{session('category_insert_message')}}</div>
                    @endif
                    
                    <form action="{{url('category/post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Category Name</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
                            @error('category_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                         <div class="form-group mt-3">
                            <label >Category Photo</label>
                            <input type="file" class="form-control" name="category_photo" placeholder="Enter Category Name">
                            @error('category_photo')
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

          <div class="col-8">
            <div class="card">
                     <div class="card-header bg-primary">
                        <div class="text-light">
                            Category Delete Item
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('category_restore_mes'))
                        <div class="alert alert-success ">{{session('category_restore_mes')}}</div>
                        @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($category_all_deletes as $category_all_delete)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ucwords(strtolower($category_all_delete->category_name))}}</td>
                                <td>{{$category_all_delete->created_at->format('d/m/y h:i:s A')}}</td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-success" href = "{{url('category/restore',$category_all_delete->id)}}">Restore</a>
                                <a type="submit" class="btn btn-sm btn-outline-danger " href = "{{url('category/force/delete',$category_all_delete->id)}}">Force Delete</a>
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

@section('footer_script')
<script>
  //All Delete Sweet Alert Start========================================================>  
    $(document).ready(function(){
       $('#alldelete_btn_alert').click(function(){
         
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "category/all/delete";
            }
            });


       });
    });
//All Delete Sweet Alert End========================================================> 

//delete button
      document.querySelector(".cate_delet_alert").addEventListener("click",function(){
        let timerInterval;
        Swal.fire({
        title: "Delete Processing...",
        html: "I will close in <b></b> milliseconds.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
        timer.textContent = `${Swal.getTimerLeft()}`;
        }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
        });
     });
//Chacked Alert Start========================================================================>
    //   var allseletctbtb = document.querySelector('.chackall_box'); 
    //   document.querySelector('.chack_all_btn').addEventListener('click',function(){
    //     allseletctbtb.innerHTML = "checked";
    //   });

      $(document).ready(function(){
        $('#category_chack_all_btn').click(function(){
           $('.chackall_box').attr('checked','checked');
        });

       $('#categoty_uncheck_btn').click(function(){
           $('.chackall_box').removeAttr('checked','checked');
       }); 

      });
//Chacked Alert End========================================================================>     

// Categoty Check All Delete----------------------------------------->
     document.querySelector('#category_check_all_delete').addEventListener('click',function(){
        let timerInterval;
        Swal.fire({
        title: "Delete Processing...",
        html: "I will close in <b></b> milliseconds.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
        timer.textContent = `${Swal.getTimerLeft()}`;
        }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
        });
     })

</script>
@endsection

