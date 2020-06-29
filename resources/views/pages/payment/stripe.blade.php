@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<?php 
  $setting=DB::table('settings')->first();
  $shipping_charge = $setting->shipping_charge;
  $cart=Cart::content();
  $customer_info = DB::table('users')->where('id',Auth::id())->first();
  $total=0;
  if(Session::has('coupon')){
    $total = Session::get('coupon')['balance'] + $shipping_charge;
  }
  else{
    $total = Cart::Subtotal() + $shipping_charge;
  }
?>

<style type="text/css">
  /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
       
            <div class="row">


              <div class="col-md-8">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $i=1;
                          foreach ($cart as $v_contents) {  
                      ?>
                      
                      <tr>
                       
                        <td><a href="#"><img width="50" height="50" src="{{asset($v_contents->options->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$v_contents->name}}</a></td>
                        <td>$ {{$v_contents->price}}</td>
                        <td>
                          <?php if($v_contents->options->color == NULL){ 
                                echo 'N/A';
                               }else{
                                echo $v_contents->options->color;
                          } ?>
                        </td>

                        <td>
                          <?php if($v_contents->options->size == NULL){ 
                                echo 'N/A';
                               }else{
                                echo $v_contents->options->size;
                          } ?>
                        </td>
                        <td > {{$v_contents->qty}} </td>
                        <td>$ {{$v_contents->subtotal}}</td>
                       
                      </tr>

                      <?php
                        $i++; 
                      } 
                      ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="6">Subtotal</th>
                          @if(Session::has('coupon'))
                            <td>${{Session::get('coupon')['balance']}}</td>
                          @else
                            <td>${{Cart::Subtotal()}}</td>
                          @endif
                        </tr>
                        @if(Session::has('coupon'))
                        <tr >
                          <th colspan="6">Coupon: {{Session::get('coupon')['name']}} 
                            <a href="{{route('coupon.remove')}}"class="btn btn-danger btn-sm">X</a>
                          </th>
                          <td>${{Session::get('coupon')['discount']}}</td>
                        </tr>
                        @endif
                        
                        <tr >
                          <th colspan="6">Shipping Charge</th>
                          <td>${{ $shipping_charge}}</td>
                        </tr>
                        <tr>
                          <th colspan="6">Vat</th>
                          <td>${{$setting->vat}}</td>
                        </tr>
                       
                        <tr>
                          <th colspan="6">Total</th>
                            <td>${{$total}}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                
                </div>
              </div>


              <div class="col-md-4">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                   

                   
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
                              <!-- <div class="aa-checkout-single-bill">
                                <input type="text" name="name" value="{{ $customer_info->name ? $customer_info->name : '' }}" placeholder="Full Name*">
                                <input type="hidden" name="customer_id" value="" >
                               
                              </div>  -->  

                                <form action="{{route('stripe.charge')}}" method="post" id="payment-form">
                                  @csrf
                                  <div class="form-row">
                                    <label for="card-element">
                                      Credit or debit card
                                    </label>
                                    <div id="card-element">
                                      <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                  </div><br>
                                  <!-- extra data -->
                                   <input type="hidden" name="shipping" value="{{$setting->shipping_charge}}" > 
                                   <input type="hidden" name="vat" value="{{$setting->vat}}" > 
                                   <input type="hidden" name="total" value="{{$total}}" > 
                                   <!-- Shipping data -->
                                   <input type="hidden" name="ship_name" value="{{$data['name']}}" > 
                                   <input type="hidden" name="ship_email" value="{{$data['email']}}" > 
                                   <input type="hidden" name="ship_phone" value="{{$data['phone']}}" > 
                                   <input type="hidden" name="ship_address" value="{{$data['address']}}" > 
                                   <input type="hidden" name="ship_city" value="{{$data['city']}}" > 
                                   <input type="hidden" name="ship_zip_code" value="{{$data['zip_code']}}" > 
                                  <button class="btn btn-info">Pay Now</button>
                                </form>     

                            </div>
                             <!-- <div class="panel-body">
                                <input type="submit" value="Confirm Payment" class="aa-browse-btn">
                              </div>  -->
                          </div> 
                          
                          
                        </div>
                      </div>
                    </div>
                     
                   
                  </div>
                </div>
              </div>

            </div>
  
         </div>
       </div>
     </div>
   </div>
 </section>

 <script type="text/javascript">
// Create a Stripe client.
var stripe = Stripe('pk_test_51GyVvWIu0VuBnOuuV89bTJEceb6ye8K3SfnieLAsEXRqXwvhYzAJKiNHXkGscco7sNa91o59PNvZCu4cMT7QdyNC005xBPL0ny');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
 </script>
 @endsection  