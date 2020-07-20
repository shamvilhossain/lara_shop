<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
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
        $post = DB::table('posts')
                                 ->where('publication_status',1)
                                 ->orderBy('posts.id','desc')
                                 ->limit(3)
                                 ->get();  
        $brands = DB::table('brands')
                                 ->orderBy('id','desc')
                                 ->get();                                                                                                                                              
        return view('pages.index',compact('slider','featured_product','popular_product','trend_product','latest_product','mid_slider_product','buygetone_product','post','brands'));
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

    public function ViewOrder($order_id)
    {
        $order_info=DB::table('orders')->where('id',$order_id)->first();
        $shipping=DB::table('shipping')->where('order_id',$order_id)->first();
        $order_details=DB::table('order_details')->join('products','order_details.product_id','products.id')
          ->select('products.product_code','products.image_one','order_details.*')
          ->where('order_details.order_id',$order_id)->get();

        return response::json(array(
                'order' => $order_info,
                'shipping' => $shipping,
                'order_details' => $order_details
         ));                        
               
    }

    public function our_story()
    {
        $title = 'Our Story';
        $setting = DB::table('sitesetting')->first();
        $data = $setting->our_story;
        return view('pages.footer_page',compact('data','title'));
    }

    public function privacy_policy()
    {
        $title = 'Privacy Policy';
        $setting = DB::table('sitesetting')->first();
        $data = $setting->privacy_policy;
        return view('pages.footer_page',compact('data','title'));
    }

    public function terms_of_use()
    {
        $title = 'Terms Of Use';
        $setting = DB::table('sitesetting')->first();
        $data = $setting->terms_of_use;
        return view('pages.footer_page',compact('data','title'));
    }

    public function faq()
    {
        $title = 'FAQ';
        $setting = DB::table('sitesetting')->first();
        $data = $setting->faq;
        return view('pages.footer_page',compact('data','title'));
    }

    public function contact_us()
    {
        $setting = DB::table('sitesetting')->first();
        return view('pages.contact_us',compact('setting'));
    }
}
