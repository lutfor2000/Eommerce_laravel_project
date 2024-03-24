<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<Style>
.main_div{
margin-left: 60px;  
}  
.order_info{
margin-top: 50px;
}  
.order_info li{
list-style-type: none;
font-size: 18px;
font-weight:normal;
font-family: sans-serif;
margin-top: 5px;
}
.table{
  
    margin-top: 10px;
    text-align: center;
}
.thead{
    padding: 10px;   
}
.table, th, td{
    border-collapse:collapse;
    padding: 10px;
    ;
}

</Style>
</head>
<body>
<div class="main_div">
    <div class="order_info">
        <li>Order ID : {{$data->id}}</li>
        <li>Order Time : {{$data->created_at}}</li>
        <li>Name : {{$data->customer_name}}</li>
        <li>Phone Number : {{$data->customer_phone_number}}</li>
        <li>Discount : {{$data->discount}}%</li>
        <li>Total : {{$data->total}}</li>
   </div>
   <table class="table" border="1" >
        <tr>
          <th class="thead">Si No</th>
          <th class="thead">Product Name</th>
          <th class="thead">Product Quantity</th>
          <th class="thead">Product Price</th>
          <th class="thead">Product Price</th>
       
        </tr>
        @foreach ($order_details as $order_detail)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$order_detail->producttoorderdreletion->product_name}}</td>
            <td>{{$order_detail->quantity}}</td>
            <td>{{$order_detail->producttoorderdreletion->product_price}}</td>
            <td>{{$order_detail->producttoorderdreletion->product_price * $order_detail->quantity}}</td>
        </tr>
        @endforeach
   </table>
</div>   
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table text="center">
          <tr>
            <td>Coustomer Name :{{$data->customer_name}}</td><br/><br/>
          </tr>
          <tr>
            <td>Phone Number :{{$data->customer_phone_number}}</td><br>
          </tr>
          <tr>
            <td>Total Amount :{{$data->total}}</td>
          </tr>
    </table>
</body>
</html> --}}
