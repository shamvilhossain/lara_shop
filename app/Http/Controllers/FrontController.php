<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{
    public function index()
    {
        $slider=DB::table('sliders')->where('publication_status',1)->get();
        $featured_product = DB::table('products')
                                 ->where('products.featured',1)
                                 ->where('products.status',1)
                                 ->orderBy('products.id','desc')
                                 ->limit(8)
                                 ->get();
        $popular_product=DB::table('products')
                                 ->where('status',1)
                                 ->orderBy('view_count','desc')
                                 ->limit(8)
                                 ->get();   
        $trend_product=DB::table('products')
                                 ->where('trend',1)
                                 ->where('status',1)
                                 ->orderBy('id','desc')
                                 ->limit(8)
                                 ->get();  
        $latest_product=DB::table('products')
                                 ->where('status',1)
                                 ->latest()
                                 ->limit(8)
                                 ->get();   
        $mid_slider_product=DB::table('products')
                                 ->where('mid_slider',1)
                                 ->where('status',1)
                                 ->orderBy('id','desc')
                                 ->limit(4)
                                 ->get();  
        $buygetone_product=DB::table('products')
                                 ->where('buyone_getone',1)
                                 ->where('status',1)
                                 ->latest()
                                 ->first();                                                                                               
        return view('pages.index',compact('slider','featured_product','popular_product','trend_product','latest_product','mid_slider_product','buygetone_product'));
    }
    public function StoreNewslater(Request $request)
    {
    	$validatedData = $request->validate([
            'email' => 'required|unique:newslaters|max:255'
        ]);
        $data=array();
        $data['email']= $request->email;
        DB::table('newslaters')->insert($data);
        $notification=array(
            'messege'=>'Thanks for Subscribing !',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    public function OrderTracking(Request $request)
    {
        //return view('pages.track');
         $code=$request->code;
         $track=DB::table('orders')->where('status_code',$code)->first();
         if ($track) {             
             return view('pages.track',compact('track'));
         }else{
            $notification=array(
                'messege'=>'Status code invalid ',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
         }

    }
}
