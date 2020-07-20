@extends('layouts.app')
@section('content')
@include('layouts.menubar')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<style type="text/css">
	

.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 80px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 38px;
    line-height: 81px;
    z-index: 5
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #ff6666
}

.steps .step.completed .step-icon {
    border-color: #ff6666;
    background-color: #ff6666;
    color: #fff
}



@media (max-width: 576px) {
    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {
    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {
    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {
    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

.bg-faded, .bg-secondary {
    background-color: #f5f5f5 !important;
}

.row {
    border-bottom: 1px solid rgba(0, 0, 0, .2);
    /*padding: 2vh 0 2vh 0;*/
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0
}

.modal-body {
    padding: 2vh
}

.modal-footer {
    border-top: none;
    justify-content: center;
    padding-top: 0;
    text-align: center;
}

.modal-title {
    text-align: center;
    font-size: 3vh;
    font-weight: bold
}


ul {
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around
}

ul li {
    font-size: 2vh;
    /*font-weight: bold;*/
    line-height: 4vh
}

.left {
    float: left;
    font-weight: normal;
    color: rgb(126, 123, 123)
}

.right {
    float: right;
    text-align: right
}

.col {
    padding-left: 0
}
                                    
</style>
<?php 
$track_sts=$track->status;
$sts_txt='';

$completed_1='';
$completed_2='';
$completed_3='';
$completed_4='';

if($track_sts==0){
  $completed_1='completed';
  $sts_txt=' Review & Confirming Order';
}elseif($track_sts==1){
    $completed_1='completed';
    $completed_2='completed';
    $sts_txt=' Processing Order';
}elseif($track_sts==2){
    $completed_1='completed';
    $completed_2='completed';
    $completed_3='completed';
    $sts_txt=' Product Dispatched';
}elseif($track_sts==3){
    $completed_1='completed';
    $completed_2='completed';
    $completed_3='completed';
    $completed_4='completed';
    $sts_txt=' Product Delivered';
}elseif($track_sts==4){
  $sts_txt=' Order Canceled';
}


?>
<section><div class="container"><div class="row">&nbsp;</div></div></section>
<section>
    <div style="margin-bottom: .25rem !important;" class="container padding-bottom-3x mb-1">
        <div class="card mb-3">
          <div style="padding: 1.5rem !important;background-color: #343a40;color: #ff6666;" class="text-center text-lg rounded-top">
          <span class="text-uppercase">Tracking Code - </span>
          <span class="text-medium">{{$track->status_code}}</span>
        </div>
          <div style="display:flex;padding:1rem;" class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">

            <div style="width:50%" class="w-100  py-1 px-2">
              <span class="text-medium">Status:</span> {{$sts_txt}}
            </div>
            <div style="width:50%">
                <a id="{{$track->id}}" style="color: #007bff; border-color: #007bff;float:right" class=" btn  btn-rounded btn-sm" href="#" data-toggle="modal" data-target="#orderDetails" onclick="orderview(this.id)">View Order Details</a>
            </div>
          </div>
          <div class="card-body">
            <div style=" display:flex" class="steps d-flex  flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              @if($track->status != 4)
                <div class="step {{$completed_1}}">
                  <div class="step-icon-wrap">
                    <div class="step-icon"><i class="pe-7s-cart"></i></div>
                  </div>
                  <h4 class="step-title">Review & Confirming Order</h4>
                </div>
             
                <div class="step {{$completed_2}}">
                  <div class="step-icon-wrap">
                    <div class="step-icon"><i class="pe-7s-config fa-spin"></i></div>
                  </div>
                  <h4 class="step-title">Processing Order</h4>
                </div>
            <!--   <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-medal"></i></div>
                </div>
                <h4 class="step-title">Quality Check</h4>
              </div> -->
            
                <div class="step {{$completed_3}}">
                  <div class="step-icon-wrap">
                    <div class="step-icon"><i class="pe-7s-car"></i></div>
                  </div>
                  <h4 class="step-title">Product Dispatched</h4>
                </div>
             
                <div class="step {{$completed_4}}">
                  <div class="step-icon-wrap">
                    <div class="step-icon"><i class="pe-7s-home"></i></div>
                  </div>
                  <h4 class="step-title">Product Delivered</h4>
                </div>
             @else
                <div class="step" >
                  <div class="step-icon-wrap">
                    <div class="step-icon" ><i class="fa fa-ban text-danger"></i></div>
                  </div>
                  <h4 class="step-title" style="color:red">Order Canceled</h4>
                </div>

             @endif
            </div>
          </div>
        </div>

        <div class="modal fade" id="orderDetails">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #ff6666;">Order Summery</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> <!-- Modal body -->
                <div class="modal-body">
                    
                        <h5>Item Details</h5>
                        <div id="order_items">
                          
                        </div>
                        <h5>Order Details</h5>
                        <div class="row">
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="left">Order number:</li>
                                    <li class="left">Date:</li>
                                    <li class="left">Subtotal:</li>
                                    <li class="left">Shipping:</li>
                                    <li class="left">Total Price:</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul class="right" type="none">
                                    <li class="right" id="stripe_order_id"></li>
                                    <li class="right" id="order_date"></li>
                                    <li class="right" id="order_subtotal"></li>
                                    <li class="right" id="order_shipping"></li>
                                    <li class="right" id="order_total"></li>
                                </ul>
                            </div>
                        </div>
                        <h5>Shipment</h5>
                        <div class="row" style="border-bottom: none">
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="left">Address</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="right" id="ship_address">25-03-2020</li>
                                </ul>
                            </div>
                        </div>
                    
                </div> <!-- Modal footer -->
                <div class="modal-footer"> 
                  <form action="{{route('order.tracking')}}" method="post">
                    @csrf
                    <input type="hidden" name="code" id="track_code" value="">
                    <button type="submit" class="aa-browse-btn">Track Order</button> 
                  </form>
                </div>
            </div>
        </div>
    </div>
         <br/>
      </div>
</section>

@endsection