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
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                          $i=1;
                          foreach ($content as $v_contents) {  
                      ?>
                      
                      <tr>
                        <td><a class="remove" href="{{URL::to('/remove/cart/'.$v_contents->rowId)}}"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img width="50" height="50" src="{{$v_contents->options['image']}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$v_contents->name}}</a></td>
                        <td>$ {{$v_contents->price}}</td>
                        <td>
                          <?php if($v_contents->options->color_list=='' || $v_contents->options->color_list== NULL){ 
                                echo 'N/A';
                                echo '<input  type="hidden" value="0" name="product_color[]">';
                               }else{
                                $product_colors= explode(',', $v_contents->options->color_list); 
                                echo '<select id="product_color<?=$i?>" name="product_color[]">';
                                foreach($product_colors as $color){
                          ?>
                                <option value="{{ $color }}" <?php if ($color == $v_contents->options->color) {
                                        echo "selected"; } ?>>{{ $color }}
                                </option>
                            
                          <?php 
                              
                            } 
                            echo'</select>';

                          } ?>
                        </td>

                        <td>
                          <?php if($v_contents->options->size_list=='' || $v_contents->options->size_list== NULL){ 
                                echo 'N/A';
                                echo '<input  type="hidden" value="0" name="product_size[]">';
                               }else{
                                $product_sizes= explode(',', $v_contents->options->size_list); 
                                echo '<select id="product_size<?=$i?>" name="product_size[]">';
                                foreach($product_sizes as $size){
                          ?>
                                <option value="{{ $size }}" <?php if ($size == $v_contents->options->size) {
                                        echo "selected"; } ?>>{{ $size }}
                                </option>
                            
                          <?php 
                              
                            } 
                            echo'</select>';

                          } ?>
                        </td>
                        <td > 
                               <select name="qty[]" id="product_qty<?=$i?>">
                                <option value="1" <?= $v_contents->qty == 1 ? 'selected' : '' ?> >1</option>
                                <option value="2" <?= $v_contents->qty == 2 ? 'selected' : '' ?>  >2</option>
                                <option value="3" <?= $v_contents->qty == 3 ? 'selected' : '' ?>  >3</option>
                                <option value="4" <?= $v_contents->qty == 4 ? 'selected' : '' ?>  >4</option>
                                <option value="5" <?= $v_contents->qty == 5 ? 'selected' : '' ?>  >5</option>
                              </select>
                        </td>

                        <td>$ {{$v_contents->subtotal}}</td>
                          <input  type="hidden" value="{{$v_contents->rowId}}" name="cart_rowid[]">
                          <input  type="hidden" value="{{$v_contents->options->size_list}}" name="size_list[]">
                          <input  type="hidden" value="{{$v_contents->options->color_list}}" name="color_list[]">
                          <input  type="hidden" value="{{$v_contents->options->image}}" name="img_list[]">
                          <input  type="hidden" value="{{$v_contents->id}}" name="product_id<?=$i?>">
                          <input  type="hidden" value="{{$v_contents->name}}" name="product_name<?=$i?>">
                          <input  type="hidden" value="{{$v_contents->options['color']}}" name="old_color<?=$i?>">
                          
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
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Sub Total</th>
                     <td>$ {{Cart::Subtotal()}}</td>
                   </tr>
                   <tr>
                     <th>Shipping Charge</th>
                     <td>$ {{Cart::Subtotal()}}</td>
                   </tr>
                   <tr>
                     <th>Vat 4.5%</th>
                     <td>
                       <?php 
                        $total = (double) str_replace(',','',Cart::Subtotal());
                        $vat= (($total * 4.5)/100);
                        echo '$ '.$vat;
                       ?>
                     </td>
                   </tr>
                   <tr>
                     <th>Grand Total</th>
                     <td>$ {{$grand_total = $total + $vat}}

                      <?php Session::put('grand_total',$grand_total); ?>
                     </td>
                   </tr>
                 </tbody>
               </table>
              
                <a href="{{ route('user.checkout')}}" class="aa-cart-view-btn">Proceed to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection  