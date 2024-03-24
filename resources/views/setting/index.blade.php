@extends('layouts.kubb')

@section('title')
Setting
@endsection
{{-- button page active --}}
@section('setting')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Setting</div>
                <div class="card-body">
                    @if (session('setting_message'))
                      <div class="alert alert-success">{{session('setting_message')}}</div>
                    @endif
                    
                    <form action="{{route('settingpost')}}" method="POST" >
                        @csrf
                         <div class="form-group mt-3">
                            <label >Phone Number</label>
                            <input type="number" class="form-control" name="phone" value="{{$settings->where('setting_name','phone')->first()->setting_value}}">
                         </div>

                         <div class="form-group mt-3">
                            <label >Email Number</label>
                            <input type="email" class="form-control" name="email" value="{{$settings->where('setting_name','email')->first()->setting_value}}">
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