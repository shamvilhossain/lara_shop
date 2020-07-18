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
         ->where('posts.publication_status',1)
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

    public function SingleBlog($id)
    {
        $post = DB::table('posts')
         ->join('post_category','posts.category_id','=','post_category.id')
         ->select('posts.*','post_category.category_name_en','post_category.category_name_bn')
         ->where('posts.id',$id)
         ->where('posts.publication_status',1)
         ->first();

        $post_category = DB::table('post_category')->get(); 
        $recent_post = DB::table('posts')
                                 ->where('publication_status',1)
                                 ->orderBy('posts.id','desc')
                                 ->limit(3)
                                 ->get(); 
        return view('pages.single_blog',compact('post','post_category','recent_post'));
    }
    
}
