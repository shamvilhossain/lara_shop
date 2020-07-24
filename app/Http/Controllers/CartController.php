<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Cart;
use DB;
use Auth;
use Session;
class CartController extends Controller
{
    public function AddCart($id)
    {
    	$product=DB::table('products')->where('id',$id)->first();
        if($product->product_quantity < 1){
            $notification=array(
                'messege'=>'Out of stock!',
                'alert-type'=>'error'
                 );
            return Redirect()->back()->with($notification);
        }
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
            $data['options']['buyone_getone']=$product->buyone_getone;
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
            $data['options']['buyone_getone']=$product->buyone_getone;     
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

    public function ProductAddCart(Request $request,$id)
    {
        //print_r($resuest);exit;
        $product=DB::table('products')->where('id',$id)->first();
        if($request->qty > $product->product_quantity){
            $notification=array(
                'messege'=>'Out of stock!',
                'alert-type'=>'error'
                 );
            return Redirect()->back()->with($notification);
        }
        $data=array();
        if ($product->discount_price == NULL) {
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->selling_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']=$request->product_color;
            $data['options']['size']=$request->product_size;
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size; 
            $data['options']['buyone_getone']=$product->buyone_getone; 
            Cart::add($data);
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->to('/')->with($notification);
        }else{
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->discount_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;  
            $data['options']['color']=$request->product_color;
            $data['options']['size']=$request->product_size;
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size;  
            $data['options']['buyone_getone']=$product->buyone_getone;
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
        if(Cart::count() > 0){
            $content = Cart::content();
            return view('pages.cart',compact('content'));
        }else{
            $notification=array(
            'messege'=>'Cart is Empty !',
            'alert-type'=>'error'
             );
        return Redirect()->back()->with($notification);  

        }
        
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
        $buyone_getone = $request->buyone_getone;
        
        foreach ($cart_rowids as $index => $cart_rowid){
                $data=array();
                $data['qty']=$qtys[$index];
                $data['options']['image']=$image_list[$index];  
                $data['options']['color']= ($product_colors[$index] != '0' ? $product_colors[$index] : ''); 
                $data['options']['size']= ($product_sizes[$index] != '0' ? $product_sizes[$index] : '');
                $data['options']['color_list']= $color_list[$index];
                $data['options']['size_list']= $size_list[$index]; 
                $data['options']['buyone_getone']= $buyone_getone[$index]; 
                $rowId = $cart_rowid;
                //$qty = $qtys[$index];
                Cart::update($rowId, $data);
                
        }
        
        return Redirect()->back();                      
    }

    public function ViewProduct($product_id)
    {
        $price=0; 
        $product_info = DB::table('products')
                                 ->join('brands','products.brand_id','=','brands.id')
                                 ->join('categories','products.category_id','=','categories.id')
                                 ->select('products.*','brands.brand_name','categories.category_name')
                                 ->where('products.id',$product_id)
                                 ->where('products.status',1)
                                 ->first();
        $product_color= explode(',', $product_info->product_color); 
        $product_size= explode(',', $product_info->product_size);
        if($product_info->discount_price == NULL){ $price = $product_info->selling_price; }
        else{ $price=$product_info->discount_price;} 
        $url = $product_id."/".str_slug($product_info->product_name, '-');
        
       // return response()->json($product_color);
        return response::json(array(
                'product' => $product_info,
                'price' => $price,
                'color' => $product_color,
                'size' => $product_size,
                'url_part' => $url
         ));                        
               
    }

    public function InsertCart(Request $request)
    {
        $id= $request->product_id;
        $product=DB::table('products')->where('id',$id)->first();
        if($request->qty > $product->product_quantity){
            $notification=array(
                'messege'=>'Out of stock!',
                'alert-type'=>'error'
                 );
            return Redirect()->back()->with($notification);
        }
        $data=array();
        if ($product->discount_price == NULL) {
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->selling_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']=$request->color;
            $data['options']['size']=$request->product_size;
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size; 
            $data['options']['buyone_getone']=$product->buyone_getone; 
            Cart::add($data);
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->back()->with($notification);
        }else{
            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->discount_price;          
            $data['weight']=1;
            $data['options']['image']=$product->image_one;  
            $data['options']['color']=$request->color;
            $data['options']['size']=$request->product_size;
            $data['options']['color_list']= $product->product_color;
            $data['options']['size_list']= $product->product_size;
            $data['options']['buyone_getone']=$product->buyone_getone;  
            Cart::add($data);  
            $notification=array(
                'messege'=>'Product Added on your Cart',
                'alert-type'=>'success'
                 );
            return Redirect()->back()->with($notification);  
         }
    }

    public function Checkout()
    {
        if(Auth::check()){
            if(Cart::count() > 0){
                $cart = Cart::content();
                $customer_id = Auth::id();
                $customer_info = DB::table('users')->where('id',$customer_id)->first();
                return view('pages.checkout',compact('cart','customer_info'));
            }else{
                $notification=array(
                'messege'=>'Cart is Empty !',
                'alert-type'=>'error'
                 );
            return Redirect()->back()->with($notification);  

            }
        }else{
            $notification=array(
                'messege'=>'At First Login Your Account',
                'alert-type'=>'warning'
                 );
            return redirect()->route('login')->with($notification);
        }
        
    }

    public function Wishlist()
    {
        $user_id=Auth::id();
        $product = DB::table('wishlists')
         ->join('products','wishlists.product_id','=','products.id')
         ->select('products.*','wishlists.user_id')
         ->where('wishlists.user_id',$user_id)
         ->get();

        return view('pages.wishlist',compact('product'));
    }

    public function Coupon(Request $request)
    {
        $coupon=$request->coupon;
        $check = DB::table('coupons')->where('coupon',$coupon)->first();
        if($check){
            session::put('coupon',[
                'name'=> $check->coupon,
                'discount'=> $check->discount,
                'balance'=> Cart::Subtotal() - $check->discount
            ]);
            $notification=array(
                'messege'=>'Successfully Coupon Applied !',
                'alert-type'=>'success'
                 );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Invalid Coupon',
                'alert-type'=>'error'
                 );
            return redirect()->back()->with($notification);
        }
        
    }

    public function CouponRemove()
    {
        session::forget('coupon');
        $notification=array(
                'messege'=>'Coupon Removed!',
                'alert-type'=>'warning'
                 );
        return redirect()->back()->with($notification);
        
    }

}
