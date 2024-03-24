<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
   public function __construct(){
      $this->middleware('auth');
      $this->middleware('checkrole');
   }
//Category View Page----------------------------->
   function category(){
        $categories = Category::latest()->paginate(5);
        $category_all_deletes = Category::onlyTrashed()->get();
       return view('category/index',compact('categories','category_all_deletes'));
      }

//Category Insert Proccess------------------------>
   function categorypost(Request $request){
    
       $request->validate([
        'category_name'=>'required|max:10|min:2|unique:categories,category_name',
        'category_photo'=>'required'
        ],[
        'category_name.required'=>'Pless Enter Your Category Name !!'
        ]);

      //Photo Upload Start------>  
        $random_photo_name = Str::random(10).time().".".$request->category_photo->getClientOriginalExtension();
        $category_photo = $request->file('category_photo');
        Image::make($category_photo)->resize(600, 470)->save(base_path('public/uploads/category_photo/').$random_photo_name);
      //Photo Upload End------>  

       Category::insert([
        'category_name' => $request->category_name,
        'category_photo' => $random_photo_name,
        'created_at' => Carbon::now(),
        ]);
       return back()->with('category_insert_message','Category'.' '. $request->category_name.' '.'Added Successful !!');
     }

//Category Single Delete------------------------------>
   function categorydelete($category_id){
       if (Category::where('id',$category_id)->exists()) {
         Category::find($category_id)->delete();
         // Product::where('category_id',$category_id)->delete();
         // Featured_photo::where('category_id',$category_id)->delete();
       }
       return back()->with('category_delete_status','Category Delete Successful !!');
   }

//Category All Delete Process------------------------->
   function categoryalldelete (){
    
      Category::whereNull('deleted_at')->delete();
      return back();
      
   }

//Category Edite-------------------------------------> 
  function categoryedite($category_id){
     $category_info = Category::find($category_id);
     return view('category/category_edit',compact('category_info'));
  }

//Category Update Process-------------------------------->
  function categoryupdate(Request $request,$category_id){
   
     if($request->category_name == Category::find($category_id)->category_name){
     return back()->withErrors('The Name have Alredy Database');
   //   return back()->withErrors('The Name have Database');
     }
       
     $request->validate([
      'category_name'=>'required|max:10|min:2|unique:categories,category_name'
      ],[
      'category_name.required'=>'Pless Enter Your Category Name !!'
      ]); 

       //Delete Old Photo Start
        if ($request->hasFile('category_photo')){
         $old_photo_path = base_path('public/uploads/category_photo/').Category::find($category_id)->category_photo;
         unlink($old_photo_path);
         }
         else{
             echo "Delete Invalid";
         }
        //Delete Old Photo end---------------------------------->
        
          //Upload New Photo Start-------------------------------------->
          $random_photo_name = Str::random(10).time().".".$request->category_photo->getClientOriginalExtension();
          $category_photo_file = $request->file('category_photo');
          Image::make($category_photo_file)->resize(600, 470)->save(base_path('public/uploads/category_photo/').$random_photo_name);
          //Upload New Photo End-------------------------------------->

      Category::find($category_id)->update([
         'category_name' => $request->category_name,
         'category_photo' => $random_photo_name,
      ]);
      return redirect('category')->with('category_update_status','Category'.' '.$request->category_name.' '.'Update Successful !!');
   }

//Category Restore----------------------------------------------->
   function categoryrestore($id){
     Category::onlyTrashed()->where('id',$id)->restore();
   //   Product::onlyTrashed()->where('category_id',$id)->restore();
     return back()->with('category_restore_mes','Restore  Successfull !');
   }

//Category Force Delete------------------------------------------->
   function categoryforcedelete($category_id){
      //Category Force Delete Start-------->
      if (Category::onlyTrashed()->where('id',$category_id)->exists()){

            $old_photo_path = base_path('public/uploads/category_photo/').Category::onlyTrashed()->find($category_id)->category_photo;
            unlink($old_photo_path);
           Category::onlyTrashed()->where('id',$category_id)->forceDelete();
      }
      //Category Force Delete Start-------->
      
   return back()->with('category_restore_mes','Force Delete  Successfull !');
   
  }  
// Categoty Check All Delete----------------------------------------->
  function  categorychackalldelete(Request $request){
     $request->validate([
      'category_check_id' => 'required',
     ]);
      foreach ($request->category_check_id as $single_check_id) {
      Category::find($single_check_id)->delete();
      }
      return back();
  }

}
