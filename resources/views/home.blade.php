@extends('layouts.kubb')
@section('title')
Dashboard
@endsection
{{-- button page active --}}
@section('dashboard')
active
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role == 1)
        <!-----------------------Admine Dashboard Start------------------------------>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light dashboard_head_color"><h5>Admin Dashboard</h5></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="alert alert-light text-center">Total : {{$users->count()}}</div>
                    <table class = "table table-bordered text-center">
                        <thead>
                           <tr>
                              <th>Serial No</th>
                              <th>Admin/Customer</th>
                              <th>User Name</th>
                              <th>Email</th>
                              <th>Creat Time</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                       
                          @foreach ($users as $item)
                             <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    @if($item->role == 1)
                                        Admin
                                    @else
                                        Coustomer
                                    @endif
                                </td>
                                <td>{{ ucwords(strtolower($item->name)) }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>
                                <div class="btn-group text-center ">
                                <a type="submit" class="btn btn-sm btn-outline-danger" href = "">Delete</a>
                                <a type="submit" class="btn btn-sm btn-outline-warning" href = "">Edite</a>
                                </div>
                                </td>
                             </tr>
                          @endforeach
                        </tbody>
                   </table>
                  {{--pagination stert --}}
                   {{$users->links('pagination::bootstrap-5')}}
                   {{--pagination End --}}
                </div>
            </div>
        </div>  
        <!----------------------Admine Dashboard End---------------------------------->
        @else
        <!----------------------Customer Dashboard Start------------------------------>
        @include('little_part.customer_dashboard')  
        <!---------------------Customer Dashboard End---------------------------------->
        @endif
    </div>
</div>
@endsection
