<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
use Session;
use Mail;
use App\Mail\invoiceMail;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Payment(Request $request)
    {
    	$data=array();
    	$data['name']= $request->name;
    	$data['email']= $request->email;
    	$data['phone']= $request->phone;
    	$data['address']= $request->address;
    	$data['city']= $request->city;
    	$data['zip_code']= $request->zip_code;
    	$data['payment_type']= $request->payment_type;

    	if($request->payment_type=='paypal'){
    		
    	}elseif($request->payment_type=='stripe') {
    		return view('pages.payment.stripe',compact('data'));
    	}elseif($request->payment_type=='ideal') {
    		# code...
    	}else{
    		echo 'Cash on delivery';
    	}

    }

    public function StripeCharge(Request $request)
    {
        $email=Auth::user()->email;
    	$total=$request->total;
    	// from https://stripe.com/docs/payments/charges-api

    	// Set your secret key. Remember to switch to your live secret key in production!
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey('sk_test_51GyVvWIu0VuBnOuuzrRxXmkhFhdAORprp41OAbe8AHa0PJAVtRs7v6EA6I5bzi4NfEdh4Fw7Fq0swV50W9Lo525M00ygPynIdl');

		// Token is created using Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $_POST['stripeToken'];

		$charge = \Stripe\Charge::create([
		  'amount' => $total*100, // 100 should multiply to convert into doller
		  'currency' => 'usd',
		  'description' => 'Lara Ecom Details',
		  'source' => $token,
		  'metadata' => ['order_id' => uniqid()],
		]);
		//dd($charge);

			$data=array();
			$data['user_id']=Auth::id();
			$data['payment_id']=$charge->payment_method;
			$data['paying_amount']=$charge->amount/100;
			$data['blnc_transection']=$charge->balance_transaction;
			$data['stripe_order_id']=$charge->metadata->order_id;
			$data['shipping']=$request->shipping;
			$data['vat']=$request->vat;
			$data['total']=$request->total;
            $data['payment_type']=$request->payment_type;
			 if (Session::has('coupon')) {
			 	 $data['subtotal']=Session::get('coupon')['balance'];
    	     }else{
    	  	      $data['subtotal']=Cart::Subtotal() ;
    	    }
    	    $data['status']=0;
    	    $data['date']=date('d-m-y');
    	    $data['month']=date('F');
    	    $data['year']=date('Y');
            $data['status_code']=mt_rand(100000,999999); 
    	    $order_id=DB::table('orders')->insertGetId($data);

             Mail::to($email)->send(new invoiceMail($data)); //mail send to user

    	    // insert shipping details table

    	    	$shipping=array();
    	    	$shipping['order_id']=$order_id;
    	    	$shipping['ship_name']=$request->ship_name;
    	    	$shipping['ship_email']=$request->ship_email;
    	    	$shipping['ship_phone']=$request->ship_phone;
    	    	$shipping['ship_address']=$request->ship_address;
    	    	$shipping['ship_city']=$request->ship_city;
    	    	$shipping['ship_zipcode']=$request->ship_zip_code;
    	    	DB::table('shipping')->insert($shipping);
                

    	    	//insert data into orderdeatils
    	    	$content=Cart::content();
    	    	$details=array();
    	    	foreach ($content as $row) {
    	    		$details['order_id']= $order_id;
    	    		$details['product_id']=$row->id;
    	    		$details['product_name']=$row->name;
    	    		$details['color']=$row->options->color;
    	    		$details['size']=$row->options->size;
    	    		$details['quantity']=$row->qty;
    	    		$details['singleprice']=$row->price;
    	    		$details['totalprice']=$row->qty * $row->price;
    	    		DB::table('order_details')->insert($details);
    	    	}
                
    	    	Cart::destroy();
    	    	 if (Session::has('coupon')) {
			 	 Session::forget('coupon');
    	     }

	        $notification=array(
                      'messege'=>'Successfully Done',
                      'alert-type'=>'success'
            );
            return Redirect()->to('/')->with($notification);
			
    }

    public function RequestCancel($id)
    {
        DB::table('orders')->where('id',$id)->update(['cancel_order'=>1]);
        $notification=array(
            'messege'=>'Order Cancel request done please wait for our confirmation email',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
