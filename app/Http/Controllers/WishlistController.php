<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class WishlistController extends Controller
{
    public function AddWishlist($id)
    {
    	$user_id = Auth::id();
    	$check=DB::table('wishlists')->where('user_id',$user_id)->where('product_id',$id)->first();
    	$data=array(
    		'user_id'=>$user_id,
    		'product_id'=>$id,
    		'created_at'=>date("Y-m-d H:i:s")
    		);
    	if(Auth::check()){
    		if($check){
				$notification=array(
	            'messege'=>'Product already exists in Wishlist',
	            'alert-type'=>'error'
	            );
	           return Redirect()->back()->with($notification);
    		}else{
    			DB::table('wishlists')->insert($data);
    			$notification=array(
	            'messege'=>'Product added into Wishlist !',
	            'alert-type'=>'success'
	            );
	           return Redirect()->back()->with($notification);
    		}

    	}else{
    		$notification=array(
            'messege'=>'At first login your account !',
            'alert-type'=>'warning'
            );
           return Redirect()->back()->with($notification);
    	}
    	
    }
}
