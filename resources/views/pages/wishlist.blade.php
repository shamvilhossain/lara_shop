@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             {!! Form::open(['url' => '/update-cart','method' => 'post', 'id' => 'update_cart_form']) !!}  
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                          $i=1;
                          foreach ($product as $v_contents) {  
                      ?>
                      
                      <tr>
                        <td><a class="remove" href="{{URL::to('/remove/cart/'.$v_contents->id)}}"><fa class="fa fa-close"></fa></a></td>
                        <td><img width="50" height="50" src="{{URL::to($v_contents->image_one)}}" alt="img"></td>
                        <td><a class="aa-cart-title" href="#">{{$v_contents->product_name}}</a></td>
                        
                        @if($v_contents->discount_price == NULL)
                          <td>${{ $v_contents->selling_price }}</td>
                        @else
                          <td>${{ $v_contents->discount_price }}</td>
                        @endif
                        
                          <input  type="hidden" value="{{$v_contents->id}}" name="product_id<?=$i?>">
                          <td>{{ $v_contents->product_color }}</td>
                          <td><a href="#" class="aa-add-to-cart-btn">Add To Cart</a></td>
                      </tr>

                      <?php
                        $i++; 
                      } 
                      ?>
                      
                      <tr>
                        <td colspan="8" class="aa-cart-view-bottom">
                          <!-- <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div> -->
                          <input  type="hidden" value="{{$i}}" name="counter" id="counter">
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart"> 
                          
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             {!! Form::close() !!} 
             <!-- Cart Total view -->
             
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection  