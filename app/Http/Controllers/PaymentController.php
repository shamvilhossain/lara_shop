<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;

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
}
