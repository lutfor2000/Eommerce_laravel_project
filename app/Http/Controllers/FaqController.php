<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Faq;
use Carbon\Carbon;

class FaqController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('checkrole');
 }
  
// Faq Part Start=========================================================================> 
   function faq(){
    $faqs = Faq::latest()->paginate(5);
    $all_delete_faqs = Faq::onlyTrashed()->get();
      return view('faq.index',compact('faqs','all_delete_faqs'));
    }

   function faqpost(Request $request){
    $request->validate([
        'faq_title'=>'required',
        'faq_discription'=>'required',
    ]);

     Faq::insert($request->except('_token')+[
        'created_at' => Carbon::now(),
     ]);
     return back()->with('faw_add_mess','Faq Added Successful !!');
   } 

   function faqdelete($faq_id){
        if (Faq::where('id',$faq_id)->exists()){
            Faq::find($faq_id)->delete();
        }
        return back()->with('faq_delete_status','Faq Delete Successful !!');
   }

  function faqrestore($faq_id){
        Faq::onlyTrashed()->where('id',$faq_id)->restore();
        return back()->with('faq_status','Restore  Successfull !');
  }
 
  function faqforcedelete($faq_id){
        Faq::onlyTrashed()->where('id',$faq_id)->forceDelete();
        return back()->with('faq_status','Force Delete  Successfull !');
  }
// Faq Part End=========================================================================> 
}
