@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<!-- 404 error section -->
  <section id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area">
            <span style="color:#ff6666">Congratulations!</span>
            <h3>Your Payment Completed Successfully</h3>
            <p>Your order tracking code is <strong>{{ $order->status_code }}</strong>. We have sent order summery to your email.</p>
            <a href="{{url('/')}}"> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / 404 error section -->
 <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Subscribe to our newsletter and stay updated on the special offers!</p>
            <form action="{{route('store.newslater')}}" method="post" class="aa-subscribe-form">
              @csrf
              <input type="email" name="email" id="email" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->
@endsection  

