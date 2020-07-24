<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
use Session;
use Mail;
use App\Mail\invoiceMail;
use Mollie\Laravel\Facades\Mollie;
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
    	$data['total_amount']= $request->total_amount;

    	if($request->payment_type=='paypal'){
    		
    	}elseif($request->payment_type=='stripe') {
    		return view('pages.payment.stripe',compact('data'));
    	}elseif($request->payment_type=='ideal') {

    		$payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "USD",
                    "value" => number_format($request->total_amount,2) // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Lara Shop Mollie",
                "redirectUrl" => route('payment.success'),
                //"webhookUrl" => route('webhooks.mollie'),
                "metadata" => [
                    "order_id" => uniqid(),
                    "shipping" => $request->shipping,
                    "vat" => $request->vat,
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "city" => $request->city,
                    "zip_code" => $request->zip_code
                ],
            ]);

            $payment = Mollie::api()->payments->get($payment->id);
            session::put('mollie',[
                'payment_id'=> $payment->id
            ]);

            // redirect customer to Mollie checkout page
            return redirect($payment->getCheckoutUrl(), 303);

    	}else{  // Cash on delivery'
    		
            $email=Auth::user()->email;
            $uniq_id =uniqid();
            $order=array();
            $order['user_id']=Auth::id();
            $order['payment_id']='cod-'.$uniq_id;
            $order['paying_amount']=$request->total_amount;
            $order['blnc_transection']='COD';
            $order['stripe_order_id']=$uniq_id;
            $order['shipping']=$request->shipping;
            $order['vat']=$request->vat;
            $order['total']=$request->total_amount;
            $order['payment_type']='Cash on Delivery';
             if (Session::has('coupon')) {
                 $order['subtotal']=intval(Session::get('coupon')['balance']);
             }else{
                  $order['subtotal']=intval(Cart::Subtotal()) ;
            }
            $order['status']=0;
            $order['date']=date('d-m-y');
            $order['month']=date('F');
            $order['year']=date('Y');
            $order['status_code']=mt_rand(100000,999999); 
            $order_id=DB::table('orders')->insertGetId($order);

            //Mail::to($email)->send(new invoiceMail($order));

            $shipping=array();
            $shipping['order_id']=$order_id;
            $shipping['ship_name']=$request->name;;
            $shipping['ship_email']=$request->email;
            $shipping['ship_phone']=$request->phone;
            $shipping['ship_address']=$request->address;
            $shipping['ship_city']=$request->city;
            $shipping['ship_zipcode']=$request->zip_code;
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
            //return Redirect()->to('/')->with($notification);
            return Redirect()->to('/success_payment/'.$uniq_id)->with($notification);
    	}

    }

    public function MolliepaymentSuccess() {
        //echo 'payment has been received';
        $email=Auth::user()->email;
        if (Session::has('mollie')) {
            $payment_id = Session::get('mollie')['payment_id'];
            $payment = Mollie::api()->payments->get($payment_id);
            //dd($payment);
            $data=array();
            $data['user_id']=Auth::id();
            $data['payment_id']=$payment_id;
            $data['paying_amount']=$payment->amount->value;
            $data['blnc_transection']=$payment->details->cardLabel.'-'.$payment->details->cardNumber;
            $data['stripe_order_id']=$payment->metadata->order_id;
            $data['shipping']=$payment->metadata->shipping;
            $data['vat']=$payment->metadata->vat;
            $data['total']=$payment->amount->value;
            $data['payment_type']='mollie';
             if (Session::has('coupon')) {
                 $data['subtotal']=intval(Session::get('coupon')['balance']);
             }else{
                  $data['subtotal']=intval(Cart::Subtotal()) ;
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
            $shipping['ship_name']=$payment->metadata->name;
            $shipping['ship_email']=$payment->metadata->email;
            $shipping['ship_phone']=$payment->metadata->phone;
            $shipping['ship_address']=$payment->metadata->address;
            $shipping['ship_city']=$payment->metadata->city;
            $shipping['ship_zipcode']=$payment->metadata->zip_code;
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
            Session::forget('mollie');
            if (Session::has('coupon')) {
               Session::forget('coupon');
            }

            $notification=array(
                      'messege'=>'Successfully Done',
                      'alert-type'=>'success'
            );
            // return Redirect()->to('/')->with($notification);
            return Redirect()->to('/success_payment/'.$payment->metadata->order_id)->with($notification);
        }else{
            $notification=array(
                      'messege'=>'Payment Unsuccesful',
                      'alert-type'=>'warning'
            );
            return Redirect()->to('/')->with($notification);
        }

    }

    public function Molliehandle(Request $request) {  // used by webhook. should work on live
        if (! $request->has('id')) {
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid()) {
            dd($payment);
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
		  'description' => 'Lara Shop Stripe',
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
			 	 $data['subtotal']=intval(Session::get('coupon')['balance']);
    	     }else{
    	  	      $data['subtotal']=intval(Cart::Subtotal()) ;
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
            return Redirect()->to('/success_payment/'.$charge->metadata->order_id)->with($notification);
			
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
