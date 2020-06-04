@php  
  $category=DB::table('categories')->get();
  //$category = Category::with('children')->get();
@endphp
<!-- menu -->
<section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="index.html">Home</a></li>
              @foreach( $category as $cat)
                    @php  
                        $subcategory=DB::table('subcategories')->where('category_id',$cat->id)->get();
                    @endphp
              <li><a href="#">{{ $cat->category_name }} {!! count($subcategory) > 0 ? '<span class="caret"></span>' : '' !!} </a> 
                <?php
                    if(count($subcategory) > 0){
                ?>
                <ul class="dropdown-menu">  
                    
                    @foreach($subcategory as $row)               
                        <li><a href="{{ url('products/'.$row->id) }}">{{  $row->subcategory_name }}</a></li>
                    @endforeach
                  {{-- <li><a href="#">And more.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Sleep Wear</a></li>                                     
                    </ul>
                  </li> --}}
                </ul>
                <?php }  ?>
              </li>
              @endforeach
             {{-- <li><a href="#">Sports</a></li>
             
              <li><a href="#">Pages <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="product.html">Shop Page</a></li>
                  <li><a href="product-detail.html">Shop Single</a></li>                
                  <li><a href="404.html">404 Page</a></li>                
                </ul>
              </li> --}}
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->