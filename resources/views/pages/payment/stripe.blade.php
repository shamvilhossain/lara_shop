@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<?php 
  $setting=DB::table('settings')->first();
  $shipping_charge = $setting->shipping_charge;
  $cart=Cart::content();
  $customer_info = DB::table('users')->where('id',Auth::id())->first();
?>

 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
       
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    
                    <!-- Coupon section -->
                    @if(Session::has('coupon'))
                    @else
                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Have a Coupon?
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <form action="{{route('apply.coupon')}}" method="post">
                          @csrf
                          <div class="panel-body">
                            <input type="text" name="coupon" placeholder="Coupon Code" class="aa-coupon-code" required>
                            <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                          </div>
                        </form> 
                      </div>
                    </div>
                    @endif

                    {!! Form::open(['route' => 'payment.process','method' => 'post']) !!} 
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Shippping Address
                          </a>
                        </h4>
                      </div>
                     
                      <div id="collapseFour" class="panel-collapse collapse in">
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="name" value="{{ $customer_info->name ? $customer_info->name : '' }}" placeholder="Full Name*">
                                <input type="hidden" name="customer_id" value="" >
                               
                              </div>                             
                            </div>
                            
                          </div> 
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="email" value="{{ $customer_info->email ? $customer_info->email : '' }}" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="phone" value="{{ $customer_info->phone ? $customer_info->phone : '' }}" placeholder="Phone*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address" >Address*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <!-- <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select name="country">
                                  <option value="0">Select Your Country</option>
                                  <option value="1">Australia</option>
                                  <option value="2">Afganistan</option>
                                  <option value="3">Bangladesh</option>
                                  <option value="4">Belgium</option>
                                </select>
                              </div>                             
                            </div>                            
                          </div> -->
                          <div class="row">
                           
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city" value="" placeholder="City / Town*" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="zip_code" value="" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                     
                   
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>T-Shirt <strong> x  1</strong></td>
                          <td>$150</td>
                        </tr>
                        <tr>
                          <td>Polo T-Shirt <strong> x  1</strong></td>
                          <td>$250</td>
                        </tr>
                        <tr>
                          <td>Shoes <strong> x  1</strong></td>
                          <td>$350</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Subtotal</th>
                          @if(Session::has('coupon'))
                            <td>${{Session::get('coupon')['balance']}}</td>
                          @else
                            <td>${{Cart::Subtotal()}}</td>
                          @endif
                        </tr>
                        @if(Session::has('coupon'))
                        <tr>
                          <th>Coupon: {{Session::get('coupon')['name']}} 
                            <a href="{{route('coupon.remove')}}"class="btn btn-danger btn-sm">X</a>
                          </th>
                          <td>${{Session::get('coupon')['discount']}}</td>
                        </tr>
                        @endif
                        
                        <tr>
                          <th>Shipping Charge</th>
                          <td>${{ $shipping_charge}}</td>
                        </tr>
                        <tr>
                          <th>Vat</th>
                          <td>$0</td>
                        </tr>
                       
                        <tr>
                          <th>Total</th>
                          @if(Session::has('coupon'))
                            <td>${{Session::get('coupon')['balance'] + $shipping_charge}}</td>
                          @else
                            <td>${{Cart::Subtotal() + $shipping_charge}}</td>
                          @endif
                          
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="payment_type" value="cash_on_delivery" checked> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" name="payment_type" value="paypal" > Via Paypal </label>
                    <img src="{{asset('public/frontend/img/paypal.jpg')}}" border="0" alt="PayPal Acceptance Mark">    
                    <label for="stripe"><input type="radio" id="stripe" name="payment_type" value="stripe" > Via Stripe </label>
                    <img src="{{asset('public/frontend/img/stripe.png')}}" border="0" alt="Stripe Acceptance Mark"> 
                    <label for="mollie"><input type="radio" id="paypal" name="payment_type" value="ideal" > Via ideal Mollie </label>
                    <img src="{{asset('public/frontend/img/mollie.png')}}" border="0" alt="PayPal Acceptance Mark">    
                    <input type="submit" value="Place Order" class="aa-browse-btn">                
                  </div>
                      {!! Form::close() !!}  
                </div>
              </div>
            </div>
  
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection  