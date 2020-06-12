<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;

class CartController extends Controller
{
    public function AddCart($id)
    {
    	$product=DB::table('products')->where('id',$id)->first();
    	$data=array();
    	if ($product->discount_price == NULL) {
	        $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=1;
            $data['price']= $product->selling_price;          
			$data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']='';
            $data['options']['size']='';
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on your Cart']);
    	}else{
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=1;
            $data['price']= $product->discount_price;          
			$data['weight']=1;
            $data['options']['image']=$product->image_one;  
            $data['options']['color']='';
            $data['options']['size']=''; 
    	             
    	    Cart::add($data);  
    	    return response()->json(['success' => 'Successfully Added on your Cart']);   
    	 }
    }

    public function check()
    {
    	$content=Cart::content();
    	return response()->json($content);
    }

    public function ProductAddCart(Request $resuest,$id)
    {
        //print_r($resuest);exit;
        $product=DB::table('products')->where('id',$id)->first();
        $data=array();
        if ($product->discount_price == NULL) {
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$resuest->qty;
            $data['price']= $product->selling_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']=$resuest->product_color;
            $data['options']['size']=$resuest->product_size;
            Cart::add($data);
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->to('/')->with($notification);
        }else{
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$resuest->qty;
            $data['price']= $product->discount_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;  
            $data['options']['color']=$resuest->product_color;
            $data['options']['size']=$resuest->product_size;
            Cart::add($data);  
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->to('/')->with($notification);  
         }
    }
}
