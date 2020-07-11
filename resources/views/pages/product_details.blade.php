@extends('layouts.app')
@section('content')
@include('layouts.menubar')
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container">
                          <a data-lens-image="{{URL::to($product_info->image_one)}}" class="simpleLens-lens-image" >{{-- hover --}}
                            <img src="{{URL::to($product_info->image_one)}}" class="simpleLens-big-image"> {{-- main img --}}
                          </a>
                        </div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{URL::to($product_info->image_two)}}" data-lens-image="{{URL::to($product_info->image_two)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{URL::to($product_info->image_two)}}" height="55" width="45">
                          </a>                                    
                          <a data-big-image="{{URL::to($product_info->image_three)}}" data-lens-image="{{URL::to($product_info->image_three)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{URL::to($product_info->image_three)}}" height="55" width="45">
                          </a>
                          
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$product_info->product_name}}</h3>
                    <div class="aa-price-block">
                      @if($product_info->discount_price == NULL)
                      <span class="aa-product-view-price">${{ $product_info->selling_price }}</span>
                      @else
                        <span class="aa-product-view-price">${{ $product_info->discount_price }}</span>&nbsp;&nbsp;<span class="aa-product-view-price" style="color:red"><del>${{ $product_info->selling_price }}</del></span>
                      @endif
                      <p class="aa-product-avilability">Brand: <span>{{$product_info->brand_name}}</span></p>
                      <p class="aa-product-avilability">Avilability: <span>
                        <?php if($product_info->status > 0){ echo 'In Stock';}else{ echo 'Out of Stock';}?>
                      </span></p>
                    </div>
                    <p>{{$product_info->video_link }}</p>

                  {!! Form::open(['url' => '/cart/product/add/'.$product_info->id,'method' => 'post']) !!}

                      <?php if($product_info->product_size){ ?>
                      <h4>Size</h4>
                      <div class="aa-prod-view-size">
                      <?php 
                        $product_sizes= explode(',', $product_info->product_size);
                        foreach($product_sizes as $size){
                      ?>  
                        <a class="size_cls" value="{{ $size }}">{{ $size }}</a>
                      <?php } ?>
                      </div>
                      <?php } ?>
                    
                    <?php if($product_info->product_color){ ?>
                    
                      <div class="aa-color-tag">
                        <p></p>
                        Color : 
                          <select class="selectpicker" data-style="btn-info" name="product_color">
                          <!-- <a href="#" class="aa-color-green"></a>
                          <a href="#" class="aa-color-yellow"></a>
                          <a href="#" class="aa-color-pink"></a>                      
                          <a href="#" class="aa-color-black"></a>
                          <a href="#" class="aa-color-white"></a>  -->
                          <?php 
                              $product_colors= explode(',', $product_info->product_color);
                              foreach($product_colors as $color){
                          ?>   
                            <option value="{{ $color }}">{{ $color }}</option>
                          <?php } ?>
                          </select>                    
                      </div> 
                      <?php } ?> 
                      

                      <div class="aa-prod-quantity">

                        <input  name="product_id" type="hidden" value="{{$product_info->id}}"/>
                        <input  name="product_size" id="product_size" type="hidden" value=""/>
                        <input  name="product_quantity" id="product_quantity" type="hidden" value="{{$product_info->status}}"/>
                          <br>
                          <select id="qty" name="qty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                     
                        <p class="aa-prod-category">
                          Category: <a href="#" style="color:#ff6666;">{{$product_info->category_name}}</a>
                        </p>
                      </div>
                      <div class="sharethis-inline-share-buttons"></div>
                      <div class="aa-prod-view-bottom">
                        <button type="submit" class="aa-add-to-cart-btn" ><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                        <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                        <!-- <a class="aa-add-to-cart-btn" href="#">Compare</a> -->
                      </div>


                {!! Form::close() !!}  

                     

                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  {!! $product_info->product_details !!}
                
                 
                </div>

                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5" data-width="100%"></div>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
              <?php foreach ($related_product_info as $v_product) { ?>  
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{URL::to('/product-details/'.$v_product->id)}}"><img src="{{asset($v_product->image_one)}}" alt="Sale img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">{{$v_product->product_name}}</a></h4>
                      @if($v_product->discount_price == NULL)
                      <span class="aa-product-price">${{ $v_product->selling_price }}</span>
                      @else
                        <span class="aa-product-price">${{ $v_product->discount_price }}</span><span class="aa-product-price"><del>${{ $v_product->selling_price }}</del></span>
                      @endif
                    </figcaption>
                  </figure>                    
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                 <!-- start single product item -->
                <?php } ?>
                
                                                                                                  
              </ul>
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section> 
     
@endsection  