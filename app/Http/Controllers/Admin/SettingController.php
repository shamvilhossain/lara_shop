<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use Image;
class SettingController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function SiteSetting()
    {
    	 $setting=DB::table('sitesetting')->first();
    	 return view('admin.setting.site_setting',compact('setting'));
    }

    public function UpdateSetting(Request $request)
    {
    	 $id=$request->id;
    	 $data=array();
    	 $data['phone_one']=$request->phone_one;
    	 $data['phone_two']=$request->phone_two;
    	 $data['email']=$request->email;
    	 $data['company_name']=$request->company_name;
         $data['company_address']=$request->company_address;
         $data['vat']=$request->vat;
    	 $data['shipping_charge']=$request->shipping_charge;
    	 $data['facebook']=$request->facebook;
    	 $data['youtube']=$request->youtube;
    	 $data['instagram']=$request->instagram;
         $data['twitter']=$request->twitter; 
         $data['our_story']=$request->our_story; 
         $data['privacy_policy']=$request->privacy_policy; 
         $data['terms_of_use']=$request->terms_of_use; 
    	 $data['faq']=$request->faq; 
    	 // DB::table('sitesetting')->where('id',$id)->update($data);
    	 // $notification=array(
      //            'messege'=>'Setting Updated',
      //            'alert-type'=>'success'
      //                  );
      //   return Redirect()->back()->with($notification);

        // logo
        $old_image=$request->old_image;
        $image_one=$request->logo;
        
        if($image_one){
            //unlink($old_image);
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(100,50)->save('public/media/slider/'.$image_one_name);
            $data['logo']='public/media/slider/'.$image_one_name;

            $slider=DB::table('sitesetting')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Setting Updated',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);   
        }else{
            $data['logo']=$old_image;
            $slider=DB::table('sitesetting')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Setting Updated',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    
    public function DatabaseBackup()
    {
          return view('admin.setting.db_backup')->with('files', File::allFiles('storage/app/Laravel'));
    }

    public function BackupNow()
    {
         \Artisan::call('backup:run');
         $notification=array(
                       'messege'=>'Successfully Database Backup ',
                       'alert-type'=>'success'
                  );    
        return Redirect()->back()->with($notification);      
    }

    public function DeleteDatabase($getFilename)
    {
       Storage::delete('Laravel/'.$getFilename);
       $notification=array(
                       'messege'=>'Successfully Backup Delete  ',
                       'alert-type'=>'success'
                  );    
        return Redirect()->back()->with($notification);  
    }

    public function DownloadDatabase($getFilename)
    {
        $path=storage_path('app\Laravel/'.$getFilename);
        return response()->download($path);
    }

}
