@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<?php 
  $setting=DB::table('settings')->first();
  $shipping_charge = $setting->shipping_charge;
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
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="first_name" value="" placeholder="First Name*">
                                <input type="hidden" name="customer_id" value="" >
                               
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="last_name" value="" placeholder="Last Name*">
                              </div>
                            </div>
                          </div> 
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="email_address" value="" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="mobile" value="" placeholder="Mobile*">
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
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select name="country">
                                  <option value="0">Select Your Country</option>
                                  <option value="1">Australia</option>
                                  <option value="2">Afganistan</option>
                                  <option value="3">Bangladesh</option>
                                  <option value="4">Belgium</option>
                                  <option value="5">Brazil</option>
                                  <option value="6">Canada</option>
                                  <option value="7">China</option>
                                  <option value="8">Denmark</option>
                                  <option value="9">Egypt</option>
                                  <option value="10">India</option>
                                  <option value="11">Iran</option>
                                  <option value="12">Israel</option>
                                  <option value="13">Mexico</option>
                                  <option value="14">UAE</option>
                                  <option value="15">UK</option>
                                  <option value="16">USA</option>
                                </select>
                              </div>                             
                            </div>                            
                          </div>
                          <div class="row">
                           
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city" placeholder="City / Town*">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="zip_code" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    
                    <!-- Login section -->
                    <div class="panel panel-default aa-checkout-login">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Client Login 
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat voluptatibus modi pariatur qui reprehenderit asperiores fugiat deleniti praesentium enim incidunt.</p>
                          <input type="text" placeholder="Username or email">
                          <input type="password" placeholder="Password">
                          <button type="button" class="aa-browse-btn">Login</button>
                          <label for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                          <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                        </div>
                      </div>
                    </div>
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Billing Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                         {!! Form::open(['url' => '','method' => 'post']) !!}   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="first_name" placeholder="First Name*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="last_name" placeholder="Last Name*">
                              </div>
                            </div>
                          </div> 
                           
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                              
                                <input type="email" name="email_address" placeholder="Email Address*" >
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="password" name="password"  placeholder="Password*">
                              </div>
                            </div>
                          </div> 
   
                          <div class="row">
                            
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="mobile" placeholder="Mobile">
                              </div>
                               <button type="submit" class="aa-browse-btn">Login</button>
                            </div>

                          </div> 
                          {!! Form::close() !!}                                    
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
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="payment_type" value="cash_on_delivery"> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" name="payment_type" value="paypal" checked> Via Paypal </label>
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
                    <input type="submit" value="Place Order" class="aa-browse-btn">                
                  </div>
                  
                </div>
              </div>
            </div>
      
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection  