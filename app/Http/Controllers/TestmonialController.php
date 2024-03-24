<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Testmonial;
use Carbon\Carbon;
use Image;

class TestmonialController extends Controller
{
public function __construct(){
$this->middleware('auth');
$this->middleware('checkrole');
}
//Testmonial page View Start===============================================================>
function testmonial(){
    $testmonials = Testmonial::latest()->paginate(5);
    $testmonial_delete_infos = Testmonial::onlyTrashed()->get();
    return view('testmonial.index',compact('testmonials','testmonial_delete_infos'));
}
//Testmonial page View End===============================================================>

//Testmonialpost page View Start===============================================================>
function testmonialpost(Request $request){
    $request->validate([
        'testmonial_name'=>'required', 
        'testmonial_title'=>'required', 
        'testmonial_discription'=>'required',
        'testmonial_photo'=>'required',
    ]);
    
    //Photo Uplodae Processing   
    $random_photo_name = Str::random(10).time().".".$request->testmonial_photo->getClientOriginalExtension();
    $product_photo = $request->file('testmonial_photo');
    Image::make($product_photo)->resize(296, 296)->save(base_path('public/uploads/testmonial_photo/').$random_photo_name);
    //Photo Insart Processing
    Testmonial::insert($request->except('_token','testmonial_photo')+[
        'testmonial_photo' =>$random_photo_name,
        'created_at' => Carbon::now(),   
    ]);
    
    return back()->with('testmonial_message','Testmonial Item Added Sucessfull !');
    
}
//Testmonialpost page View End===============================================================>

//Testmonialdelete page View Start===============================================================>
function testmonialdelete($testmonial_id){
    if (Testmonial::where('id',$testmonial_id)->exists()){
        Testmonial::find($testmonial_id)->delete();
    }
    return back()->with('testmonial_delete_message','Testmonial Delete Successful !!');
}
//Testmonialdelete page View End===============================================================>

//Testmonialrestore page View Start===============================================================>
function testmonialrestore($testmonial_id){
        Testmonial::onlyTrashed()->where('id',$testmonial_id)->restore();
        return back()->with('testmonial_restore_message','Testmonial Restore Successful !!');
}
//Testmonialrestore page View End===============================================================>

//Testmonialforcedelete  Start===============================================================>
function testmonialforcedelete($testmonial_id){
    if (Testmonial::onlyTrashed()->where('id',$testmonial_id)->exists()){
        $old_photo_path = base_path('public/uploads/testmonial_photo/').Testmonial::onlyTrashed()->find($testmonial_id)->testmonial_photo;
        unlink($old_photo_path);
        Testmonial::onlyTrashed()->where('id',$testmonial_id)->forceDelete();
     }
        return back()->with('testmonial_restore_message','Testmonial Force Delete Successful !!');
}
//Testmonialforcedelete  End===============================================================>



}
