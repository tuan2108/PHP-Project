<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //
    public function edit(Request $request){
        $settings = DB::table('settings')->get();

        $settingConvert = [];

        if($settings){
            foreach($settings as $settingItem)
            {
                $settingConvert[$settingItem->name] = $settingItem->value;
            }
        }

        $data = [
            'settingConvert' =>$settingConvert
        ];

        return view("backend.settings.edit");
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'site_name' => 'required',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'meta_keyword' => 'required',
        ]);

        $site_name = $request->input('site_name', '');

        $site_name_db = DB::table('settings')->where("name", "=", "site_name")->first();

        if(isset($site_name_db->id) && $site_name_db->id > 0){
            DB::table('settings')->where('id', $site_name_db->id)->update(['value'=> $sit_name]);
        }else{
            DB::table('settings')->insert(['name'=> 'site_name', 'value' => $site_name, 'default_value'=> ""]);
        }

        if($request->hasFile('logo')){
            $logo_db = DB::table('settings')->where("name", "", "logo")->first();
            if(isset($logo_db->logo)){
                Storage::delete($logo_db->logo);
            }

            $pathLogoImage = $request->file('logo')->store('public/settings');
            if(isset($logo_db->id) && $logo_db->id > 0){
                DB::table('settings')->where('id', $logo_db->id)->update(['value'=> $pathLogoImage]);
            }else{
                DB::table('settings')->insert(['name'=>'logo', 'value'=>$pathLogoImage, 'default_value' => ""]);
            }
        }

        $restConfig = ["meta_title", "meta_desc", "meta_keyword"];

        foreach($restConfig as $configName){
            $configVal = $request->input($configName,'');
            $configDb = DB::table('settings')->where("name", "=", $configName)->first();

            if(isset($configDb->id) && $configDb->id > 0){
                DB::table('settings')->where('id', $configDb->id)->update(['value'=>$configVal]);
            }else{
                DB::table('settings')->insert(['name'=>$configName, 'value'=> $configVal, 'default_value'=>""]);
            }
        }

        return redirect("/backend/settings")->with('status', 'Cập nhật thành công');
    }
}
