<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Review;
use Carbon\Carbon;
use Auth;
use PDF;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index()
{

// $users = User::latest()->get();
// $users = User::limit(4)->get();
$users = User::latest()->paginate(5);
$orders = Order::where('user_id',Auth::id())->latest()->get();
$order_details = Order_detail::all();
return view('home',compact('users','orders','order_details'));
}

function downloadpdfinvice($order_id){
$data = Order::find($order_id);
$order_details = Order_detail::where('order_id',$order_id)->get();
$pdf = PDF::loadView('pdf.invoice',compact('data','order_details'));
$download_date = "invoice".Carbon::now().".pdf";
return $pdf->download($download_date);
}
//Give Review  Page View Start=========================================================================================>
function givereview($order_id){
$order_details = Order_detail::where('order_id',$order_id)->get();
return view('review.givereview',compact('order_details'));
}
//Give Review Page View End=========================================================================================>

//Give Review  Page View Start=========================================================================================>
function givereviewpost(Request $request ,$order_details_id){
$request->validate([
'review_text'=>'required', 
]);
Review::insert([
'product_id' =>Order_detail::find($order_details_id)->product_id,
'user_id' =>Auth::id(),
'order_details_id' => $order_details_id,
'review_text' =>$request->review_text,
'stars' =>$request->stars,
'created_at' => Carbon::now()
]);
return back();
}
//Give Review Page View End=========================================================================================>
//Give Review Part Start=========================================================================================>
//Give Review Part Start=========================================================================================>

}
