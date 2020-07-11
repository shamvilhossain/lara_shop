<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ReturnCancelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public  function request()
    {
    	 $order=DB::table('orders')->where('cancel_order',1)->get();
    	 return view('admin.return.request',compact('order'));
    }

    public function ApproveCancel($id)
    {
    	  DB::table('orders')->where('id',$id)->update(['cancel_order'=>2]);
          $notification=array(
                              'messege'=>'Cancel Order Successfully done',
                               'alert-type'=>'success'
                         );
                 return Redirect()->back()->with($notification);
    }

    public function AllCancel()
    {
    	 $order=DB::table('orders')->where('cancel_order',2)->get();
    	 return view('admin.return.all',compact('order'));
    }
}
