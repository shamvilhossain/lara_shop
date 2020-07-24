<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewOrder()
    {
    	$order=DB::table('orders')->where('status',0)->where('cancel_order', '!=' , 2)->orderBy('id','desc')->get();
    	return view('admin.order.pending',compact('order'));
    }

    public function ViewOrder($id)
    {
    	 $order=DB::table('orders')->join('users','orders.user_id','users.id')
    	 		->select('users.name','users.phone','orders.*')->where('orders.id',$id)->first();

    	 $shipping=DB::table('shipping')->where('order_id',$id)->first();

    	 $details=DB::table('order_details')->join('products','order_details.product_id','products.id')
    	 		->select('products.product_code','products.image_one','products.buyone_getone','order_details.*')
    	 		->where('order_details.order_id',$id)->get();

        return view('admin.order.view_order',compact('order','shipping','details'));
    	 
    }

    public function PaymentAccept($id)
    {
    	DB::table('orders')->where('id',$id)->update(['status'=>1]);
    	$notification=array(
              'messege'=>'Payment Accepted',
              'alert-type'=>'success'
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function PaymentCancel($id)
    {
    	DB::table('orders')->where('id',$id)->update(['status'=>4]);
    	$notification=array(
              'messege'=>'Order Canceled',
              'alert-type'=>'error'
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function AcceptPaymentOrder()
    {
    	$order=DB::table('orders')->where('status',1)->where('cancel_order', '!=' , 2)->get();
    	return view('admin.order.pending',compact('order'));
    }

    public function CancelPaymentOrder()
    {
    	$order=DB::table('orders')->where('status',4)->get();
    	return view('admin.order.pending',compact('order'));
    }

    public function ProgressDeliveryOrder()
    {
    	$order=DB::table('orders')->where('status',2)->where('cancel_order', '!=' , 2)->get();
    	return view('admin.order.pending',compact('order'));
    }

    public function SuccessDeliveryOrder()
    {
    	$order=DB::table('orders')->where('status',3)->where('cancel_order', '!=' , 2)->get();
    	return view('admin.order.pending',compact('order'));
    }

    public function DeliveryProgress($id)
    {
    	DB::table('orders')->where('id',$id)->update(['status'=>2]);
    	$notification=array(
              'messege'=>'Sent to Delivery',
              'alert-type'=>'success'
        );
        return Redirect()->route('admin.accept.payment')->with($notification);
    }

    public function Stock()
    {
        $product=DB::table('products')
                     ->join('categories','products.category_id','categories.id')
                     ->select('products.*','categories.category_name')
                     ->get();
        return view('admin.stock.stock',compact('product'));

    }

    public function DeliveryDone($id)
    {
        $order_details=DB::table('order_details')->where('order_id',$id)->get();

        foreach ($order_details as $row) {
            $product=DB::table('products')->where('id',$row->product_id)->first();
            $final_qty=$row->quantity;
            if($product->buyone_getone == 1){
                $final_qty= $row->quantity * 2;
            }    
                DB::table('products')
                ->where('id',$row->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity -'.$final_qty)]);
            
        }

        DB::table('orders')->where('id',$id)->update(['status'=>3]);
        $notification=array(
                 'messege'=>'Send To delevery',
                 'alert-type'=>'success'
                       );
        return Redirect()->route('admin.success.delivery')->with($notification);
    }

}
