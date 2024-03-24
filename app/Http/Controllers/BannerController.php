<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Image;

class BannerController extends Controller
{
public function __construct(){
$this->middleware('auth');
$this->middleware('checkrole');
}   
//Banner Page View Start==========================================================================================>
function banner(){
$banners = Banner::latest()->paginate(4);
$banner_all_deletes = Banner::onlyTrashed()->get();
return view('banner.banner',compact('banners','banner_all_deletes'));
}
//Banner Page View End==========================================================================================>

//Bannerpost Database Connect Start==========================================================================================>
function bannerpost(Request $request){
$request->validate([
'banner_title'=>'required|max:30|min:2', 
'banner_sub_title'=>'required', 
'banner_photo'=>'required',
]);
//Photo Uplodae Processing   
$random_photo_name = Str::random(10).time().".".$request->banner_photo->getClientOriginalExtension();
$banner_photo = $request->file('banner_photo');
Image::make($banner_photo)->resize(1920, 1000)->save(base_path('public/uploads/banner/').$random_photo_name);
//Photo Insart Processing
Banner::insert($request->except('_token','banner_photo')+[
    'banner_photo' =>$random_photo_name,
    'created_at' => Carbon::now(),   
]);

return back()->with('banner_message','Banner Item Added Sucessfull !');

} 
//Bannerpost Database Connect End==========================================================================================>

//Banner Edit Start==========================================================================================>
function banneredit($banner_id){
$banner_info = Banner::find($banner_id);
return view('banner.banner_edit',compact('banner_info'));   
}
//Banner Edit End==========================================================================================>

//Banner Edit End==========================================================================================>
function bannerupdate(Request $request,$banner_id){
if ($request->hasFile('banner_new_photo')){
//Delete Old Photo Start
$old_photo_path = base_path('public/uploads/banner/').Banner::find($banner_id)->banner_photo;
unlink($old_photo_path);

//Upload New Photo Start-------------------------------------->
$random_photo_name = Str::random(10).time().".".$request->banner_new_photo->getClientOriginalExtension();
$banner_photo = $request->file('banner_new_photo');
Image::make($banner_photo)->resize(1920, 1000)->save(base_path('public/uploads/banner/').$random_photo_name);
//Upload New Photo End-------------------------------------->

Banner::find($banner_id)->update($request->except('_token','banner_new_photo')+[
'banner_photo' => $random_photo_name,
]);
}
else{
    echo "Delete Invalid";
}

Banner::find($banner_id)->update($request->except('_token','banner_new_photo')+[  
]);

return redirect('banner')->with('banner_message','Banner Update Successfull');
}
//Banner Edit End==========================================================================================>

//Banner Delete Start==========================================================================================>
function bannerdelete($banner_id){
if (Banner::where('id',$banner_id)->exists()) {
Banner::find($banner_id)->delete();
}
return back()->with('banner_delete_status','Banner Delete Successful !!');
}
//Banner Delete End==========================================================================================>

//Banner Restore Start==========================================================================================>
function bannerrestore($banner_id){
Banner::onlyTrashed()->where('id',$banner_id)->restore();
return back()->with('banner_trash_mes','Restore  Successfull !');
}
//Banner Restore End==========================================================================================>

//Banner Force Delete Start==========================================================================================>
function bannerforcedelete($banner_id){
 //Category Force Delete Start-------->
if (Banner::onlyTrashed()->where('id',$banner_id)->exists()){
$old_photo_path = base_path('public/uploads/banner/').Banner::onlyTrashed()->find($banner_id)->banner_photo;
unlink($old_photo_path);
Banner::onlyTrashed()->where('id',$banner_id)->forceDelete();
}
//Category Force Delete Start-------->
return back()->with('banner_trash_mes','Force Delete  Successfull !');
}
//Banner Force Delete End==========================================================================================>


}
