<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Featured_photo;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Image,Auth;




class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkrole');
     }
//Product Page View Start=================================================================>
    function product(){
        $categoris = Category::latest()->get();
        $products = Product::where('user_id',Auth::id())->latest()->paginate(5);
        $all_delete_products = Product::onlyTrashed()->get();
        return view('product/index',compact('products','categoris','all_delete_products'));
    }
//Product Page View End=================================================================>

//Product Post Start=======================================================================>   
    function productpost(Request $request){
        $request->validate([
            'product_name'=>'required|max:30|min:2', 
            'product_price'=>'required', 
            'product_quantity'=>'required',
            'product_short_disc'=>'required',
            'product_long_disc'=>'required',
            'product_alert_quantity'=>'required',
            'product_photo'=>'required',
        ]);
     //Photo Uplodae Processing   
        $random_photo_name = Str::random(10).time().".".$request->product_photo->getClientOriginalExtension();
        $product_photo = $request->file('product_photo');
        Image::make($product_photo)->resize(600, 550)->save(base_path('public/uploads/product_photo/').$random_photo_name);
    //Photo Insart Processing
        $product_id = Product::insertGetId($request->except('_token','product_photo','product_featured_photo')+[
            'user_id' =>Auth::id(),
            'product_photo' =>$random_photo_name,
            'created_at' => Carbon::now(),
            
        ]);
//featured Photo Processin Start-------------------------------->
       if ($request->hasFile('product_featured_photo')){
            foreach ($request->file('product_featured_photo') as $single_featured_photo){
                //Photo Uplodae Processing   
                $random_photo_name = Str::random(10).time().".".$single_featured_photo->getClientOriginalExtension();
                $product_photo = $single_featured_photo;
                Image::make($product_photo)->resize(600, 550)->save(base_path('public/uploads/product_featured_photo/').$random_photo_name);
                //Photo database Insart Processing
                Featured_photo::insert([
                'product_id' => $product_id,
                'featured_photo_name' => $random_photo_name,
                'created_at' => Carbon::now()
                ]);

          }
       }
//featured Photo Processin End--------------------------------> 

        // Product::insert([
        //     'product_name' => $request->product_name,
        //     'created_at' => Carbon::now(),
        // ]);

        return back()->with('product_insert_message','Product'.' '. $request->product_name.' '.'Added Successful !!');

    }
//Product Post End=======================================================================> 
   
//Product Delete Start=======================================================================> 
    function productdelete($product_id){
        if (Product::where('id',$product_id)->exists()){
            Product::find($product_id)->delete();
            Featured_photo::where('product_id',$product_id)->delete();
        }
        return back()->with('product_delete_status','Product Delete Successful !!');
    }
//Product Delete End=======================================================================> 

//Product Edite End=======================================================================> 
    function productedit($product_id){
        $categoris = Category::all();
        $product_info = Product::find($product_id);
        return view('product/edit',compact('product_info','categoris'));
    }
//Product Edite Start=======================================================================> 


//Product Update End=======================================================================> 
    function productupdate(Request $request ,$product_id){
        $request->validate([
            'product_name'=>'required|max:30|min:2', 
            'product_price'=>'required', 
            'product_quantity'=>'required',
            'product_short_disc'=>'required',
            'product_long_disc'=>'required',
            'product_alert_quantity'=>'required',
        ]);

          if ($request->hasFile('product_new_photo')){
            //Delete Old Photo Start
            $old_photo_path = base_path('public/uploads/product_photo/').Product::find($product_id)->product_photo;
            unlink($old_photo_path);

            //Upload New Photo Start-------------------------------------->
            $random_photo_name = Str::random(10).time().".".$request->product_new_photo->getClientOriginalExtension();
            $product_photo = $request->file('product_new_photo');
            Image::make($product_photo)->resize(600, 550)->save(base_path('public/uploads/product_photo/').$random_photo_name);
           //Upload New Photo End-------------------------------------->

            Product::find($product_id)->update($request->except('_token','product_new_photo')+[
              'product_photo' => $random_photo_name,
            ]);

            }
            else{
                echo "Delete Invalid";
            }

            Product::find($product_id)->update($request->except('_token')+[
                
            ]);
          
        
           return redirect('product')->with('product_update_mes','Product Update Successfull');
       } 
//Product Update Start=======================================================================>

//Product Restore End=======================================================================> 
function productrestore($product_id){
Product::onlyTrashed()->where('id',$product_id)->restore();
Featured_photo::onlyTrashed()->where('product_id',$product_id)->restore();
return back()->with('product_delete_status','Restore  Successfull !');
}
//Product Restore Start=======================================================================> 

//Product Force Delete Start=======================================================================> 
function productforcedelete($product_id){
//Featured Photo Force Delete Process Start------------>
if (Featured_photo::onlyTrashed()->where('product_id',$product_id)->exists()) {
foreach (Featured_photo::onlyTrashed()->where('product_id',$product_id)->get() as  $single_featured_photo){
$feature_photo_path = base_path('public/uploads/product_featured_photo/').$single_featured_photo->featured_photo_name;
unlink($feature_photo_path);
Featured_photo::onlyTrashed()->where('product_id',$product_id)->forceDelete();
}
}
//Featured Photo Force Delete Process End------------>   

//Product Force Delete  
if (Product::onlyTrashed()->where('id',$product_id)->exists()){

$old_photo_path = base_path('public/uploads/product_photo/').Product::onlyTrashed()->find($product_id)->product_photo;
unlink($old_photo_path);

Product::onlyTrashed()->where('id',$product_id)->forceDelete();

}
return back();
}
//Product Force Delete End=======================================================================> 

//Product Delete Start=======================================================================> 
 
//Product Delete End=======================================================================> 
}
