 <!----------------------Customer Dashboard Start------------------------------>
 <div class="col-md-12">
   <div class="card">
       <div class="card-header bg-light dashboard_head_color"><h5>Coustomer Dashboard</h5></div>
       <div class="card-body"> 
         <table class = "table table-bordered text-center">
            <thead>
               <tr>
                  <th>Serial No</th>
                  <th>Customer Name</th>
                  <th>Phone Number</th>
                  <th>Total</th>
                  <th>Review</th>
                  <th>Action</th>

               </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr>
               <td>{{$loop->index+1}}</td>
               <td>{{$order->customer_name}}</td>
               <td>{{$order->customer_phone_number}}</td>
               <td>{{$order->total}}</td>
               <td><a href="{{route('givereview',$order->id)}}" class="btn btn-sm text-warning"> <i class="fa fa-star "><i class="fa fa-star "><i class="fa fa-star "></a></td>
               <td>
               <a href="{{route('downloadpdfinvice',$order->id)}}"><i class="fa fa-download"></i></a>
                  <a href="#"> <i class="fa fa-trash text-danger"></i></a>
               </td>
            </tr> 
            @endforeach
            </tbody>
       </table>
       </div>
   </div>
</div> 
<!---------------------Customer Dashboard End---------------------------------->
