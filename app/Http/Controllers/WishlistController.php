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
                return response()->json(['error' => 'Product already exists in Wishlist']);
    		}else{
               DB::table('wishlists')->insert($data); 
               return response()->json(['success' => 'Successfully Added into wishlist']);
    		}

    	}else{
    		return response()->json(['error' => 'At first login your account']); 
    	}
    	
    }
}
