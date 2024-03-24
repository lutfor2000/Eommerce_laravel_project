<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkrole');
     }


    function setting(){
        $settings = Setting::all();
       return view('setting.index',compact('settings'));
    }

    function settingpost(Request $request){
        foreach ($request->except('_token') as $key => $value) {
           Setting::where('setting_name',$key)->update([
            'setting_value' => $value
           ]);
        }
        return back()->with('setting_message','Update Successful !!');
       
    }
}
