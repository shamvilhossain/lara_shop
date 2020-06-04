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
        return view('pages.index',compact('slider','featured_product','popular_product','trend_product','latest_product'));
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
}
