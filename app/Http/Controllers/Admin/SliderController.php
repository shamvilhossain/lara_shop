<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $slider = DB::table('sliders')->get();
        return view('admin.slider.index',compact('slider'));
    }

    public function create()
    {
        $category=DB::table('categories')->get();
        return view('admin.slider.create',compact('category'));
    }

    public function store(Request $request)
    {
        $data=array();
    	$data['offer_title']=$request->offer_title;
    	$data['category_name']=$request->category_name;
    	$data['description']=$request->description;
    	$data['btn_url']=$request->btn_url;
    	$data['publication_status']=$request->publication_status;
        $data['created_at']=date("Y-m-d H:i:s");

    	$image_one=$request->slider_img;
        
        //using laravel image intervention
        if($image_one){
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(1920,700)->save('public/media/slider/'.$image_one_name);
            $data['slider_img']='public/media/slider/'.$image_one_name;

            $slider=DB::table('sliders')->insert($data);
            $notification=array(
                'messege'=>'Successfully Slider Added',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.main_sliders')->with($notification);   
        }

    }

    public function destroy($id)
    {
        $slider_info = DB::table('sliders')->where('id',$id)->first();
        $image_one=$slider_info->slider_img;
    	
        unlink($image_one);

        DB::table('sliders')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Successfully Slider Deleted ',
            'alert-type'=>'success'
           );
       return Redirect()->back()->with($notification); 
    }

    public function edit($id)
    {
        $slider = DB::table('sliders')->where('id',$id)->first();
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request,$id)
    {
        $data=array();
    	$data['offer_title']=$request->offer_title;
    	$data['category_name']=$request->category_name;
    	$data['description']=$request->description;
    	$data['btn_url']=$request->btn_url;
    	$data['publication_status']=$request->publication_status;
        $data['updated_at']=date("Y-m-d H:i:s");
        $old_image=$request->old_image;
    	$image_one=$request->slider_img;
        
        //using laravel image intervention
        if($image_one){
            unlink($old_image);
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(1920,700)->save('public/media/slider/'.$image_one_name);
            $data['slider_img']='public/media/slider/'.$image_one_name;

            $slider=DB::table('sliders')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Successfully Slider Added',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.main_sliders')->with($notification);   
        }else{
            $data['slider_img']=$old_image;
            $slider=DB::table('sliders')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Successfully Slider Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.main_sliders')->with($notification);
        }

    }
}
