  @extends('layouts.app')
  @section('content')
  @include('layouts.menubar')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <!-- Start slider ()-->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
         <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($slider as $slider_row)
            <li>
              <div class="seq-model">
                <img data-seq src="{{ URL::to($slider_row->slider_img) }}" alt="{{ $slider_row->category_name }}" style="height: 320px;"/>
              </div>
              <div class="seq-title">
               <span data-seq>{{ $slider_row->offer_title }}</span>                
                <h2 data-seq>{{ $slider_row->category_name }}</h2>                
                <p data-seq>{{ $slider_row->description }}</p>
                <?php if($slider_row->btn_url!=null){ ?>
                  <a data-seq href="{{ $slider_row->btn_url }}" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                <?php } ?>
              </div>
            </li>
            @endforeach
            <!-- single slide item -->  
                           
          </ul>
        <!-- slider navigation btn -->
<!--
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
-->
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
              <div class="col-md-5 no-padding">                
                <div class="aa-promo-left">
                  <div class="aa-promo-banner">                    
                    <img src="{{ URL::to($buygetone_product->image_one) }}" alt="{{ $buygetone_product->product_name }}">                    
                    <div class="aa-prom-content">
                      <span>Buy One Get One</span>
                      <h4><a href="#">For {{ $buygetone_product->product_name }}</a></h4>                      
                    </div>
                  </div>
                </div>
              </div>

              <!-- promo right -->
              <div class="col-md-7 no-padding">
                <div class="aa-promo-right">

                  @foreach($mid_slider_product as $row)
                    <div class="aa-single-promo-right">
                      <div class="aa-promo-banner">                      
                        <img src="{{ URL::to($row->image_one) }}" alt="{{ $row->product_name }}">                      
                        <div class="aa-prom-content">
                          
                          @if($row->discount_price == NULL)
                              <span>Exclusive Item</span>
                          @else
                            @php  
                              $amount=$row->selling_price - $row->discount_price;
                              $discount =$amount/$row->selling_price * 100;
                            @endphp   
                              <span>{{ intval($discount) }}% OFF</span>
                          @endif
                          <h4 ><a href="#" >For {{ $row->product_name }}</a></h4>                        
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <div class="aa-latest-blog-area" style="text-align: center;"><h2>Featured Product</h2></div>
                <!-- start prduct navigation -->
                 {{-- <ul class="nav nav-tabs aa-products-tab">
                    <li class="active"><a href="#men" data-toggle="tab">Men</a></li>
                    <li><a href="#women" data-toggle="tab">Women</a></li>
                    <li><a href="#electronics" data-toggle="tab">Electronics</a></li>
                  </ul> --}}
                  <!-- Tab panes -->
                  <div class="">
                    <!-- Start men product category -->
                    <div class="" id="men">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        @foreach($featured_product as $f_product)
                          <li>
                            <figure>
                              <a class="aa-product-img" href="{{url('product/details/'.$f_product->id.'/'.str_slug($f_product->product_name, '-'))}}"><img src="{{asset($f_product->image_one)}}" alt="{{$f_product->product_name}}"></a>
                              <a class="aa-add-card-btn addcart" data-id="{{ $f_product->id }}" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                <h4 class="aa-product-title"><a href="#">{{$f_product->product_name}}</a></h4>
                                
                                @if($f_product->discount_price == NULL)
                                <span class="aa-product-price">${{ $f_product->selling_price }}</span>
                                @else
                                  <span class="aa-product-price">${{ $f_product->discount_price }}</span><span class="aa-product-price"><del>${{ $f_product->selling_price }}</del></span>
                                @endif
                                
                              </figcaption>
                            </figure>                        
                            <div class="aa-product-hvr-content">
                              <a class="addwishlist" data-id="{{ $f_product->id }}" href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                              <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                              <a href="#" id="{{ $f_product->id }}" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" onclick="productview(this.id)"><span class="fa fa-search"></span></a>                          
                            </div>
                            <!-- product badge -->
                            @if($f_product->discount_price != NULL)
                            <span class="aa-badge aa-sale" href="#">Discount!</span>
                            @endif
                          </li>
                        @endforeach
                                               
                      </ul>
                      <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                    </div>
                    <!-- / men product category -->
                  </div>
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
                                          <a class="simpleLens-lens-image" >
                                              <img id="pimage" src="" class="simpleLens-big-image">
                                          </a>
                                      </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            <!-- Modal view content -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="aa-product-view-content">
                                <h3 id="pname"></h3>
                                <div class="aa-price-block">
                                  $<span class="aa-product-view-price" id="pprice"></span>
                                  <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                </div>
                                <p class="aa-product-avilability">Product code: <span id="pcode"></span></p>
                                <p class="aa-product-avilability">Brand: <span id="pbrand"></span></p>
                                <form action="{{route('insert.into.cart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" id="product_id" value="">
                                    <input type="hidden" name="product_size" id="product_size"  value=""/>
                                    <h4 id="size_head">Size</h4>
                                    <div class="aa-prod-view-size" id="sizediv">
                                      
                                    </div>
                                    <div class="form-group" id="colordiv">
                                      <label for="">Color</label>
                                      <select name="color" class="form-control">
                                      </select>
                                    </div>
                                    <div class="aa-prod-quantity">
                                      
                                        <select id="qty" name="qty">
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                        </select>
                                      
                                      <p class="aa-prod-category">
                                        Category: <span id="pcat">Polo T-Shirt</span>
                                      </p>
                                    </div>
                                
                                    <div class="aa-prod-view-bottom">
                                      <button type="submit" class="aa-add-to-cart-btn" ><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                                      <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>                        
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- / quick view modal -->              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->

  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('public/frontend/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#popular" data-toggle="tab">Popular</a></li>
                <li><a href="#trend" data-toggle="tab">Trend</a></li>
                <li><a href="#latest" data-toggle="tab">Latest</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="popular">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    @foreach($popular_product as $row)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="#"><img src="{{asset($row->image_one)}}" alt="{{ $row->product_name }}"></a>
                          <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{ $row->product_name }}</a></h4>
                            @if($row->discount_price == NULL)
                                <span class="aa-product-price">${{ $row->selling_price }}</span>
                            @else
                                <span class="aa-product-price">${{ $row->discount_price }}</span><span class="aa-product-price"><del>${{ $row->selling_price }}</del></span>
                            @endif
                          </figcaption>
                        </figure>                     
                        <div class="aa-product-hvr-content">
                          <a class="addwishlist" data-id="{{ $row->id }}" href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                          <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                        </div>
                        <!-- product badge -->
                        @if($row->discount_price != NULL)
                          <span class="aa-badge aa-sale" href="#">Discount!</span>
                        @endif
                      </li>
                    @endforeach
                                                                                                       
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / popular product category -->
                
                <!-- start trend product category -->
                <div class="tab-pane fade" id="trend">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @foreach($trend_product as $row)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="#"><img src="{{asset($row->image_one)}}" alt="{{ $row->product_name }}"></a>
                          <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{ $row->product_name }}</a></h4>
                            @if($row->discount_price == NULL)
                                <span class="aa-product-price">${{ $row->selling_price }}</span>
                            @else
                                <span class="aa-product-price">${{ $row->discount_price }}</span><span class="aa-product-price"><del>${{ $row->selling_price }}</del></span>
                            @endif
                          </figcaption>
                        </figure>                     
                        <div class="aa-product-hvr-content">
                          <a class="addwishlist" data-id="{{ $row->id }}" href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                          <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                        </div>
                        <!-- product badge -->
                        @if($row->discount_price != NULL)
                          <span class="aa-badge aa-sale" href="#">Discount!</span>
                        @endif
                      </li>
                    @endforeach
                     <!-- start single product item -->
                                                                                                      
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="latest">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    @foreach($latest_product as $row)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="#"><img src="{{asset($row->image_one)}}" alt="{{ $row->product_name }}"></a>
                          <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{ $row->product_name }}</a></h4>
                            @if($row->discount_price == NULL)
                                <span class="aa-product-price">${{ $row->selling_price }}</span>
                            @else
                                <span class="aa-product-price">${{ $row->discount_price }}</span><span class="aa-product-price"><del>${{ $row->selling_price }}</del></span>
                            @endif
                          </figcaption>
                        </figure>                     
                        <div class="aa-product-hvr-content">
                          <a class="addwishlist" data-id="{{ $row->id }}" href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                          <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                        </div>
                        <!-- product badge -->
                        @if($row->discount_price != NULL)
                          <span class="aa-badge aa-sale" href="#">Discount!</span>
                        @endif
                      </li>
                    @endforeach
                                                                                                        
                  </ul>
                   <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->
  <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('public/frontend/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('public/frontend/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('public/frontend/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

  <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>LATEST BLOG</h2>
            <div class="row">
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('public/frontend/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('public/frontend/img/promo-banner-1.jpg')}}" alt="img"></a>   
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                     <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>         
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('public/frontend/img/promo-banner-1.jpg')}}" alt="img"></a>    
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>
  <!-- / Latest Blog -->

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('public/frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

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

<!--product cart add modal should be deleted -->
<div class="modal fade " id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Product Short Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="col-md-4">
              <div class="card" style="width: 16rem;">
              <img src="" class="card-img-top"  style="height: 240px;">
              <div class="card-body">
               
              </div>
            </div>
          </div>
          <div class="col-md-4 ml-auto">
              <ul class="list-group">
                <li class="list-group-item"> <h5 class="card-title" ></h5></span></li>
             <li class="list-group-item">Product code: <span id=""> </span></li>
              <li class="list-group-item">Category:  <span id="pcat"> </span></li>
              <li class="list-group-item">SubCategory:  <span id="psubcat"> </span></li>
              <li class="list-group-item">Brand: <span id=""> </span></li>
              <li class="list-group-item">Stock: <span class="badge " style="background: green; color:white;">Available</span></li>
            </ul>
          </div>
          <div class="col-md-4 ">
              <form action="" method="post">
                @csrf
                
                <div class="form-group" id="colordiv">
                  <label for="">Color</label>
                  <select name="color" class="form-control">
                  </select>
                </div>
                <div class="form-group" id="sizediv1" >
                  <label for="">Size</label>
                  <select name="size" class="form-control" id="size">
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Quantity</label>
                  <input type="number" class="form-control" value="1" name="qty">
                </div>
                <button type="submit" class="btn btn-primary">Add To Cart</button>
              </form>
           </div>
         </div>
      </div>  
    </div>
  </div>
</div>

<!--modal end-->
<script type="text/javascript">
    function productview(id){
          $.ajax({
               url: "{{  url('/cart/product/view/') }}/"+id,
               type:"GET",
               dataType:"json",
               success:function(data) {
                 $('#pname').text(data.product.product_name);
                 $('#pimage').attr('src',data.product.image_one);
                 $('#pcat').text(data.product.category_name);
                 $('#pbrand').text(data.product.brand_name);
                 $('#pcode').text(data.product.product_code);
                 $('#pprice').text(data.price);
                 $('#product_id').val(data.product.id);
                 $('#product_size').val('');

                 var d =$('#sizediv').empty();
                 $('#size_head').hide();
                   $.each(data.size, function(key, value){
                       $('#sizediv').append('<a class="size_cls" style="cursor:pointer" value="'+ value +'">' + value + '</a>');
                        if (data.size == "") {
                              $('#size_head').hide();   
                              $('#sizediv').hide();   
                        }else{
                              $('#size_head').show();
                              $('#sizediv').show();
                        } 
                   });

                  var d =$('select[name="color"]').empty();
                   $.each(data.color, function(key, value){
                       $('select[name="color"]').append('<option value="'+ value +'">' + value + '</option>');
                         if (data.color == "") {
                              $('#colordiv').hide();
                        } else{
                             $('#colordiv').show();
                        }
                   });
              }
      })
    }
</script>
<script type="text/javascript">
    $(document).on('click', '.size_cls', function(e){
      var item = $(this).text();
      $(".size_cls").not($(this)).css({"border-color": "#ddd", "border-width":"2px" });
      $(this).css({"border-color": "green", "border-width":"2px" });
      $('#product_size').val(item);
    });
</script> 

<script type="text/javascript">
      $(document).ready(function() {
            $('.addcart').on('click', function(e){  
              e.preventDefault();
              var id = $(this).data('id');
              if(id) {
                 $.ajax({
                     url: "{{  url('/add/to/cart') }}/"+id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                       const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        })

                       if($.isEmptyObject(data.error)){
                            Toast.fire({
                              type: 'success',
                              title: data.success
                            })
                       }else{
                             Toast.fire({
                                type: 'error',
                                title: data.error
                            })
                       }

                     },
                    
                 });
             } else {
                 alert('danger');
             }
              e.preventDefault();
         });
     });

</script>

@endsection