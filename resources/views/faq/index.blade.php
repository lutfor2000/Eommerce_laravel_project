@extends('layouts.kubb')

@section('title')
Faq
@endsection
{{-- button page active --}}
@section('faq')
active
@endsection

@section('content')
<div class="container">
    <div class="row">
{{-- From Tabele Data Show part Start=============================================================================>--}}        
        <div class="col-7">
            <div class="card">
                    <div class="card-header text-light bg-primary">
                       Product List
                      </div>
                      <div class="card-body">
                        @if (session('faq_delete_status'))
                        <div class="alert alert-success ">{{session('faq_delete_status')}}</div>
                        @endif

                        @if (session('product_update_mes'))
                        <div class="alert alert-success ">{{session('product_update_mes')}}</div>
                        @endif
                        <table class = "table table-bordered text-center">
                            <thead>
                               <tr>
                                  <th>Serial No</th>
                                  <th>Faq Title</th>
                                  <th>Faq Description</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                                    @forelse ($faqs as $faq)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ ucwords(strtolower($faq->faq_title))}}</td>
                                        <td>{{$faq->faq_discription}}</td>
                                        <td>
                                        <div class="btn-group ">
                                        <a type="submit" class="btn btn-sm btn-outline-danger" href ="{{route('faqdelete',$faq->id)}}">Delete</a>
                                        <a type="submit" class="btn btn-sm btn-outline-warning" href ="#">Edite</a>
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
                       
                        {{$faqs->links('pagination::bootstrap-5')}}

                </div>
            </div>
          </div>
{{-- From Tabele Data Show part End=============================================================================>--}}               

{{-- From Tabele part Start=============================================================================>--}}
        <div class="col-5">
            <div class="card">
                <div class="card-header bg-primary text-light">Faq Item Add</div>
                <div class="card-body">
                    @if (session('faw_add_mess'))
                      <div class="alert alert-success">{{session('faw_add_mess')}}</div>
                    @endif
                    
                    <form action="{{route('faqpost')}}" method="POST">
                        @csrf
                         <div class="form-group mt-3">
                            <label >Faq Title</label>
                            <input type="text" class="form-control" name="faq_title" placeholder="Enter Faq Title">
                            @error('faq_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                         </div>
                     
                        

                         <div class="form-group mt-3">
                            <label >Faq Description</label>
                            <textarea class="form-control" name="faq_discription"  placeholder="Enter Faq Description" rows="4"></textarea>
                            @error('faq_discription')
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

{{-- From Tabele part End=============================================================================>--}}         

{{-- From Tabele Delete Data Show part End=============================================================================>--}} 

          <div class="col-12">
            <div class="card">
                     <div class="card-header bg-primary">
                        <div class="text-light">
                            Faq Delete Item
                        </div>
                      </div>
                      <div class="card-body">
                        @if (session('faq_status'))
                        <div class="alert alert-success ">{{session('faq_status')}}</div>
                        @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                            <tr>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Faq Title</th>
                                    <th>Faq Description</th>
                                    <th>Action</th>
                                 </tr>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($all_delete_faqs as $all_delete_faq)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ ucwords(strtolower($all_delete_faq->faq_title))}}</td>
                                <td>{{$all_delete_faq->faq_discription}}</td>
                                <td>
                                <div class="btn-group ">
                                        <a type="submit" class="btn btn-sm btn-outline-success" href ="{{route('faqrestore',$all_delete_faq->id)}}">Restore</a>
                                        <a type="submit" class="btn btn-sm btn-outline-danger" href = "{{route('faqforcedelete',$all_delete_faq->id)}}">Force Delete</a>
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

{{-- From Tabele Delete Data Show part End=============================================================================>--}}          

    </div>
</div>
@endsection