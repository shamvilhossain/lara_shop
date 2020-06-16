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
            $data['options']['color_list']=$product->product_color;
            $data['options']['size_list']=$product->product_size;
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
    	    $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size;     
    	    Cart::add($data);  
    	    return response()->json(['success' => 'Successfully Added on your Cart']);   
    	 }
    }

    public function check()
    {
        //Cart::destroy();
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
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size;  
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
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size;  
            Cart::add($data);  
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->to('/')->with($notification);  
         }
    }

    public function ShowCart()
    {
        
        $content = Cart::content();
        return view('pages.cart',compact('content'));
    }

    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        return Redirect()->back();
    }

    public function UpdateCart(Request $request)
    {
        
        $cart_rowids = $request->cart_rowid; 
        $qtys = $request->qty;
        $product_colors = $request->product_color;
        $product_sizes = $request->product_size;
        $size_list = $request->size_list;
        $color_list = $request->color_list;
        $image_list = $request->img_list;
       // Cart::update($rowId, ['options'  => ['size' => 'small']]);
        
        foreach ($cart_rowids as $index => $cart_rowid){
                $data=array();
                $data['qty']=$qtys[$index];
                $data['options']['image']=$image_list[$index];  
                //$data['options']['color']= isset($product_colors[$index]) ? $product_colors[$index] : ''; 
                $data['options']['color']= ($product_colors[$index] != '0' ? $product_colors[$index] : ''); 
                $data['options']['size']= ($product_sizes[$index] != '0' ? $product_sizes[$index] : '');
                $data['options']['color_list']= $color_list[$index];
                $data['options']['size_list']= $size_list[$index]; 
                $rowId = $cart_rowid;
                //$qty = $qtys[$index];
                Cart::update($rowId, $data);
                //Cart::update($rowId, $qtys[$index]); 
                // Cart::update($rowId, 
                //     ['options'  => ['color' => $product_colors[$index]]], 
                //     ['options'  => ['size' => $product_sizes[$index]]]
                //     );
        }
        
        return Redirect()->back();                      
    }

}
