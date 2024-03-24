<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Breadcumb;
use Carbon\Carbon;
use Image;

class BreadcumbController extends Controller
{

//Breadcumb Page View Start===========================================================================>
function breadcumb(){
$breadcumbs = Breadcumb::latest()->get();
$breadcumbs_delete_items = Breadcumb::onlyTrashed()->get();
return view('breadcumb.breadcumb',compact('breadcumbs','breadcumbs_delete_items'));
}
//Breadcumb Page View End===========================================================================>

//Breadcumbpost Data Insert Start===========================================================================>
function breadcumbpost(Request $request){
$request->validate([
'breadcumb_photo'=>'required', 
]);

//Photo Uplodae Processing   
$random_photo_name = Str::random(10).time().".".$request->breadcumb_photo->getClientOriginalExtension();
$product_photo = $request->file('breadcumb_photo');
Image::make($product_photo)->resize(1920, 330)->save(base_path('public/uploads/breadcumb_photo/').$random_photo_name);
//Photo Insart Processing

Breadcumb::insert($request->except('_token','breadcumb_photo')+[
'breadcumb_photo' =>$random_photo_name,
'created_at' => Carbon::now(),   
]);

return back()->with('breadcumb_message','Breadcumb Item Added Sucessfull !');
}
//Breadcumbpost Data Insert End===========================================================================> 

//Breadcumbpost Data Delete Start===========================================================================> 
function breadcumbdelete($breadcumb_id){
if (Breadcumb::where('id',$breadcumb_id)->exists()){
Breadcumb::find($breadcumb_id)->delete();
}
return back()->with('breadcumb_delete_message','Breadcumb Delete Successful !!');   
}
//Breadcumbpost Data Delete End===========================================================================> 

//Breadcumbrestore Data Restore Start===========================================================================> 
function breadcumbrestore($breadcumb_id){
Breadcumb::onlyTrashed()->where('id',$breadcumb_id)->restore();
return back()->with('breadcumb_restore_message','Breadcumb Restore Successful !!');
}
//Breadcumbrestore Data Restore End===========================================================================> 

//Breadcumbforcedelete Data ForceDelete Start===========================================================================> 
function breadcumbforcedelete($breadcumb_id){
if (Breadcumb::onlyTrashed()->where('id',$breadcumb_id)->exists()){
$old_photo_path = base_path('public/uploads/breadcumb_photo/').Breadcumb::onlyTrashed()->find($breadcumb_id)->breadcumb_photo;
unlink($old_photo_path);
}
Breadcumb::onlyTrashed()->where('id',$breadcumb_id)->forceDelete();
return back()->with('breadcumb_restore_message','Breadcumb Force Delete Successful !!');
}
//Breadcumbforcedelete Data ForceDelete End===========================================================================> 

//Breadcumb Data Edit Start===========================================================================> 
function breadcumbedit($breadcumb_id){
$breadcumb_infos = Breadcumb::find($breadcumb_id);
return view('breadcumb.breadcumb_edit',compact('breadcumb_infos'));
}
//Breadcumb Data Edit End===========================================================================> 

//Breadcumb Data Edit Start===========================================================================> 
function breadcumbupdate(Request $request,$breadcumb_id){
if ($request->hasFile('breadcumb_new_photo')){
//Delete Old Photo Start
$old_photo_path = base_path('public/uploads/breadcumb_photo/').Breadcumb::find($breadcumb_id)->breadcumb_photo;
unlink($old_photo_path);

//Upload New Photo Start-------------------------------------->
$random_photo_name = Str::random(10).time().".".$request->breadcumb_new_photo->getClientOriginalExtension();
$breadcumb_photo = $request->file('breadcumb_new_photo');
Image::make($breadcumb_photo)->resize(1920, 330)->save(base_path('public/uploads/breadcumb_photo/').$random_photo_name);
//Upload New Photo End-------------------------------------->

Breadcumb::find($breadcumb_id)->update($request->except('_token','breadcumb_new_photo')+[
    'breadcumb_photo' => $random_photo_name,
]);

}
else{
    echo "Delete Invalid";
}
return redirect('breadcumb')->with('breadcumb_message','Breadcumb Update Successfull');
}
//Breadcumb Data Edit End===========================================================================> 

}
