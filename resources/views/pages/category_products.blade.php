@extends('layouts.app')
@section('content')
@include('layouts.menubar')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<section id="aa-product-category">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3"><br/>
        <h2 style="text-align: center;">{{ count($products) > 0 ? $products[0]->category_name.' Products' : 'No Products ' }} </h2>

          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">

                <form action="" class="aa-sort-form" action="" method="get">
                
                  
                  <label for="">Sort by</label>
                  <!-- <select name="zzz" onchange="this.form.submit()"> -->
                  <select name="sort_val">
                    <option value="1" {{($sort_val==1) ? 'selected' : ''}}>Latest</option>
                    <option value="2" {{($sort_val==2) ? 'selected' : ''}}>Name</option>
                    <option value="3" {{($sort_val==3) ? 'selected' : ''}}>Price (High to Low)</option>
                    <option value="4" {{($sort_val==4) ? 'selected' : ''}}>Price (Low to High)</option>
                  </select>
                <!-- </form>
                <form action="" class="aa-show-form" > -->
                  &nbsp;&nbsp;<label for="">Show</label>
                  <select name="limit">
                    <option value="9" {{($limit==9) ? 'selected' : ''}}>9</option>
                    <option value="15" {{($limit==15) ? 'selected' : ''}}>15</option>
                    <option value="24" {{($limit==24) ? 'selected' : ''}}>24</option>
                  </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;<button class="aa-filter-btn" type="submit" >Filter</button>
                </form>
              </div>

              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
               
                  @foreach($products as $f_product)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('product/details/'.$f_product->id.'/'.str_slug($f_product->product_name, '-'))}}"><img src="{{asset($f_product->image_one)}}" alt="{{$f_product->product_name}}"></a>
                        <a class="aa-add-card-btn addcart" data-id="{{ $f_product->id }}" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('product/details/'.$f_product->id.'/'.str_slug($f_product->product_name, '-'))}}">{{$f_product->product_name}}</a></h4>
                          
                          @if($f_product->discount_price == NULL)
                          <span class="aa-product-price">${{ $f_product->selling_price }}</span>
                          @else
                            <span class="aa-product-price">${{ $f_product->discount_price }}</span><span class="aa-product-price"><del>${{ $f_product->selling_price }}</del></span>
                          @endif
                          
                        </figcaption>
                      </figure>                        
                      <div class="aa-product-hvr-content">
                        <a class="addwishlist" data-id="{{ $f_product->id }}" href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        
                        <a href="#" id="{{ $f_product->id }}" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" onclick="productview(this.id)"><span class="fa fa-search"></span></a>                          
                      </div>
                      <!-- product badge -->
                      @if($f_product->discount_price != NULL)
                      <span class="aa-badge aa-sale" href="#">Discount!</span>
                      @endif
                    </li>
                  @endforeach
                                                        
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
                                  <p class="aa-product-avilability">Avilability: <span id="avilability"> </span></p>
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
                                      <a href="#" id="pdetails" class="aa-add-to-cart-btn">View Details</a>
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
            <div class="aa-product-catg-pagination">
              <nav>
              {{ $products->links() }}
                
              </nav>
            </div>
          </div>
        </div>



        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9"><br/>
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                @foreach($categories as $category)
                 <li><a href="{{url('category_product/'.$category->id.'/'.str_slug($category->category_name, '-'))}}">{{ $category->category_name }}</a></li>
                @endforeach
              </ul>
            </div>
            <!-- single sidebar -->
            <!-- <div class="aa-sidebar-widget">
              <h3>Brands</h3>
              <div class="tag-cloud">
                @foreach($brands as $brand)
                  <a href="#">{{ $brand->brand_name }}</a>
                @endforeach
              </div>
            </div> -->
            
            <!-- single sidebar -->
            <!-- <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <a class="aa-color-green" href="#"></a>
                <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a>
              </div>                            
            </div> -->
            <!-- single sidebar -->
            
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Latest Products</h3>
              <div class="aa-recently-views">
                <ul>
                  @foreach ($latest_product as $v_product) 
                  <li>
                    <a href="{{url('product/details/'.$v_product->id.'/'.str_slug($v_product->product_name, '-'))}}" class="aa-cartbox-img"><img alt="img" src="{{asset($v_product->image_one)}}"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="{{url('product/details/'.$v_product->id.'/'.str_slug($v_product->product_name, '-'))}}">{{$v_product->product_name}}</a></h4>
                      @if($v_product->discount_price == NULL)
                        <p>${{ $v_product->selling_price }}</p>
                      @else
                        <p>${{ $v_product->discount_price }}</p>
                      @endif
                      
                    </div>                    
                  </li>
                @endforeach 
                                                       
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>


<script type="text/javascript">
    $(document).on('click', '.size_cls', function(e){
      var item = $(this).text();
      $(".size_cls").not($(this)).css({"border-color": "#ddd", "border-width":"2px" });
      $(this).css({"border-color": "green", "border-width":"2px" });
      $('#product_size').val(item);
    });
</script> 
 @endsection      