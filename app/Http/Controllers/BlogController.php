<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class BlogController extends Controller
{
    public function blog()
    {
        $post = DB::table('posts')
         ->join('post_category','posts.category_id','=','post_category.id')
         ->select('posts.*','post_category.category_name_en','post_category.category_name_bn')
         ->get();
        return view('pages.blog',compact('post'));
    }

    public function Bangla()
    {
    	session::get('lang');
    	session::forget('lang');
    	session::put('lang','bangla');
    	return Redirect()->back();
    }

    public function English()
    {
    	session::get('lang');
    	session::forget('lang');
    	session::put('lang','english');
    	return Redirect()->back();
    }
    
}
