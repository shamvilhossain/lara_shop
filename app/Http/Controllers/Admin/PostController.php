<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $post = DB::table('posts')
        ->join('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name_en')
        ->get();
        return view('admin.blog.index',compact('post'));
    }

    public function create()
    {
        $category=DB::table('post_category')->get();
        return view('admin.blog.create',compact('category'));
    }

    public function store(Request $request)
    {
        $data=array();
        $data['category_id']=$request->category_id;
    	$data['post_title_en']=$request->post_title_en;
    	$data['post_title_bn']=$request->post_title_bn;
        $data['details_en']=$request->details_en;
        $data['details_bn']=$request->details_bn;
        $data['publication_status']=$request->publication_status;
        $data['created_at']=date("Y-m-d H:i:s");

        $post_image=$request->post_image;
        if($post_image){
            $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,240)->save('public/media/post/'.$image_one_name);
            $data['post_image']='public/media/post/'.$image_one_name;

            $post=DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Successfully Post Inserted ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);   
        }else{
            $data['post_image']='';
            $post=DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Successfully Post Inserted ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function destroy($id)
    {
        $post_info = DB::table('posts')->where('id',$id)->first();
        $image_one=$post_info->post_image;
        unlink($image_one);

        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Successfully Post Deleted ',
            'alert-type'=>'success'
           );
       return Redirect()->back()->with($notification); 
    }

    public function edit($id)
    {
        $post = DB::table('posts')->where('id',$id)->first();
        return view('admin.blog.edit',compact('post'));
    }

    public function update(Request $request,$id)
    {
        $old_image = $request->old_image;
        $data=array();
        $data['category_id']=$request->category_id;
    	$data['post_title_en']=$request->post_title_en;
    	$data['post_title_bn']=$request->post_title_bn;
        $data['details_en']=$request->details_en;
        $data['details_bn']=$request->details_bn;
        $data['publication_status']=$request->publication_status;
        $data['updated_at']=date("Y-m-d H:i:s");

        $post_image=$request->post_image;
        if($post_image){
            unlink($old_image);
            $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,240)->save('public/media/post/'.$image_one_name);
            $data['post_image']='public/media/post/'.$image_one_name;

            $post=DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Successfully Post Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);   
        }else{
            $data['post_image']=$old_image;
            $post=DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Successfully Post Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);
        }
    }
}
