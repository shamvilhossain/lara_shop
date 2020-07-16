<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Mail;
use Cart;
use Auth;
use Session;
class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
        //print_r($request);exit;
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $data = json_decode($request->cart_json,true);
        //dd($data);

        $post_data = array();
        $post_data['total_amount'] = $data['amount']; # You cant not pay less than 10
        $post_data['currency'] = "USD";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $data['cus_name']; //mandatory
        $post_data['cus_email'] = $data['cus_email'];  //mandatory
        $post_data['cus_add1'] =$data['cus_addr1']; //mandatory
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $data['cus_phone'];
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $data['cus_addr1'];
        $post_data['value_b'] = $data['cus_phone'];
        $post_data['value_c'] = $data['cus_city'];
        $post_data['value_d'] = $data['cus_postcode'];


        #Before  going to initiate the payment order status need to update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        //dd($request);exit;
        //$result = json_decode($request);
        //var_dump($request->tran_id);
        $setting=DB::table('settings')->first();
        $shipping_charge = $setting->shipping_charge; 
        $vat = $setting->vat; 
        
        $name=Auth::user()->name;
        $email=Auth::user()->email;
        $data=array();
        $data['user_id']=Auth::id();
        $data['payment_id']=$request->bank_tran_id;
        $data['paying_amount']=$request->amount;
        $data['blnc_transection']=$request->card_issuer;
        $data['stripe_order_id']=$request->tran_id;
        $data['shipping']=$shipping_charge;
        $data['vat']=$vat;
        $data['total']=$request->amount;
        $data['payment_type']='SslCommerz';
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

        //Mail::to($email)->send(new invoiceMail($data));
        // insert shipping details table

        $shipping=array();
        $shipping['order_id']=$order_id;
        $shipping['ship_name']=$name;
        $shipping['ship_email']=$email;
        $shipping['ship_phone']=$request->value_b;
        $shipping['ship_address']=$request->value_a;
        $shipping['ship_city']=$request->value_c;
        $shipping['ship_zipcode']=$request->value_d;
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

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        print_r($request);exit;
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            echo "ipn";

        } else {
            echo "Invalid Data";
        }
    }

}
