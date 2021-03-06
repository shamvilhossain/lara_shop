<!DOCTYPE html>
<html lang="en">
 @php
  $language = session()->get('lang');
  $setting = DB::table('sitesetting')->first();
  $first_part= explode(' ',trim($setting->company_name))[0];
  $last_part= substr(strstr($setting->company_name," "), 1);
 @endphp
  <head>
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5f09b62ce9f145001203b9d0&product=inline-share-buttons" async="async"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <meta name="csrf" value="{{ csrf_token() }}">  
    <title>{{$setting->company_name}}</title>
    
    <!-- Font awesome -->
    <link href="{{asset('public/frontend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('public/frontend/css/bootstrap.css') }}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{asset('public/frontend/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/jquery.simpleLens.css')}}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/slick.css')}}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/nouislider.css')}}">
    <!-- Theme color -->
    <link id="switcher" href="{{asset('public/frontend/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->

    <!-- Main style sheet -->
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">    
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="https://js.stripe.com/v3/"></script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style type="text/css">

    .social-login a {
        text-decoration: none;
        color: #fff;
        margin: 2px;
        height: 33px;
        display: inline-block;
        width: 97%;
        padding: 4px 0;
        text-align: center;
        cursor: pointer;
    }
    .btn-facebook{
        background-color: #3B5998;
    } 
    
    .btn-google{
        background-color: #DD4B39;
    } 
   </style> 

  </head>
  <body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=703106813755692&autoLogAppEvents=1" nonce="yQySKgut"></script> 
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Welcome</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      @if(session()->get('lang')=='bangla')
                      <img src="{{asset('public/frontend/img/flag/bangla.png')}}" alt="english flag">BANGLA
                      @else  
                      <img src="{{asset('public/frontend/img/flag/english.jpg')}}" alt="english flag">ENGLISH
                      @endif
                      <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @if(session()->get('lang')=='bangla')
                      <li><a href="{{route('language.english')}}"><img src="{{asset('public/frontend/img/flag/english.jpg')}}" alt="">ENGLISH</a></li>
                    @else  
                      <li><a href="{{route('language.bangla')}}"><img src="{{asset('public/frontend/img/flag/bangla.png')}}" alt="">BANGLA</a></li>
                    @endif  
                      
                    </ul>
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-usd"></i>USD
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                      <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>{{$setting->phone_one}}</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                    
                    
                    <li class="hidden-xs"><a href="{{ route('user.checkout')}}">Checkout</a></li>
                    <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#track-modal">Order Tracking</a></li>  
                  @guest
                    <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                  @else
                   @php
                    $wishlists=DB::table('wishlists')->where('user_id',Auth::id())->get();
                   @endphp  
                    <li class="hidden-xs"><a href="{{ route('user.wishlist')}}">Wishlist(<span id="wish_count">{{count($wishlists)}}</span>)</a></li>
                    <li><a href="{{route('home')}}">Profile</a></li>  
                    <li class="hidden-xs"><a href="{{ route('user.logout') }}">Logout</a></li>         
                  @endguest
                    
                  
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{url('/')}}">
                  <span class="fa fa-shopping-cart"></span>
                  @if(session()->get('lang')=='bangla')
                    <p>লারা<strong>শপ</strong> <span>আপনার কেনাকাটার সঙ্গী  </span></p>
                  @else
                    <p>{{$first_part }}<strong>{{$last_part}}</strong> <span>Your Shopping Partner</span></p>
                  @endif
                  
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="{{route('show.cart')}}">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify" id="cart_count">{{Cart::count()}}</span>
                </a>
                <!-- <div class="aa-cartbox-summary">
                  <ul>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{asset('public/frontend/img/woman-small-2.jpg')}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">Product Name</a></h4>
                        <p>1 x $250</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{asset('public/frontend/img/woman-small-1.jpg')}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">Product Name</a></h4>
                        <p>1 x $250</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>                    
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        $500
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                </div> -->
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form  action="{{ route('full-text-search.action') }}" method="GET">
                  <input type="text" name="full_text_search" id="full_text_search" value="{{ request()->input('full_text_search') }}" placeholder="Search Here ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  
  
  @yield('content')

  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{route('blog.post')}}">Blog</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="{{route('footer.contact_us')}}">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <!-- <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div> -->
              <div class="col-md-4 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="{{route('footer.our_story')}}">Our Story</a></li>
                      <li><a href="{{route('footer.privacy_policy')}}">Privacy Policy</a></li>
                      <li><a href="{{route('footer.terms_of_use')}}">Terms of Use</a></li>
                      <li><a href="{{route('footer.faq')}}">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> {{$setting->company_address}}</p>
                      <p><span class="fa fa-phone"></span>{{$setting->phone_one}}</p>
                      <p><span class="fa fa-envelope"></span>{{$setting->email}}</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="{{$setting->facebook}}"><span class="fa fa-facebook"></span></a>
                      <a href="{{$setting->twitter}}"><span class="fa fa-twitter"></span></a>
                      <a href="{{$setting->instagram}}"><span class="fa fa-instagram"></span></a>
                      <a href="{{$setting->youtube}}"><span class="fa fa-youtube"></span></a>
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
    <!-- footer-bottom -->
  </footer>
  <!-- / footer -->

  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="{{ route('login') }}" method="post">
            @csrf
            <label for="">Email address<span>*</span></label>
            <input type="email" name="email" placeholder="Email" required="required">
            <label for="">Password<span>*</span></label>
            <input type="password" name="password" placeholder="Password" required="required" autocomplete="on">
            <button class="aa-browse-btn" type="submit">Login</button>
            <!-- <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label> -->
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            
            <div class="aa-register-now">
              Don't have an account?<a href="{{ route('register') }}">Register now!</a>
            </div>
            <div class="social-login text-center">OR<br/>
                    <a class=" btn-facebook  text-uppercase" href="{{ url('/auth/redirect/facebook') }}" style="border-radius: 25px;"><i class="fa fa-facebook-f mr-2 ml-2">&nbsp;&nbsp;&nbsp;&nbsp; Facebook</i> </a>
                    <a class=" btn-google  text-uppercase" href="{{ url('/auth/redirect/google') }}" style="border-radius: 25px;"><i class="fa fa-google mr-2 ml-2"> &nbsp;&nbsp;&nbsp; Google</i></a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>   


  <!-- Order Tracking Modal -->  
  <div class="modal fade" id="track-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Track Your Order</h4>
          <form class="aa-login-form" action="{{route('order.tracking')}}" method="post">
            @csrf
            <input type="text" name="code" placeholder="Order Status Code">
            <button class="aa-browse-btn" type="submit">Submit</button>
            <br/>
            <br/>
            <br/>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>   

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('public/frontend/js/bootstrap.js')}}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{asset('public/frontend/js/jquery.smartmenus.js')}}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{asset('public/frontend/js/jquery.smartmenus.bootstrap.js')}}"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="{{asset('public/frontend/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/frontend/js/jquery.simpleLens.js')}}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{asset('public/frontend/js/slick.js')}}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{asset('public/frontend/js/nouislider.js')}}"></script>
<!--  july 17 - for form validation -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <!-- Custom js -->
  <script src="{{asset('public/frontend/js/custom.js')}}"></script> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
  <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script> 
    <script type="text/javascript">
       $(document).ready(function() {
            $('.size_cls').on('click', function(e){
              var item = $(this).text();
              $(".size_cls").not($(this)).css({"border-color": "#ddd", "border-width":"2px" });
              $(this).css({"border-color": "green", "border-width":"2px" });
              $('#product_size').val(item);
            });
       });

  </script> 
  
    <script type="text/javascript">
          $(document).ready(function() {
                $('.addwishlist').on('click', function(e){  
                  e.preventDefault();
                  var id = $(this).data('id');
                  //var id = $(this).attr('data-id');
                  if(id) {
                     $.ajax({
                         url: "{{  url('/add/wishlist/') }}/"+id,
                         type:"GET",
                         dataType:"json",
                         success:function(data) {
                          var wish_count = parseInt($('#wish_count').text());
                          $('#wish_count').text(++wish_count);
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

            $(document).on("click", "#cancel", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to Cancel Order?",
                  text: "Once Cancel,You will be returned your money!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Cancel");
                  }
                });
            });
         });

    </script>

    <script>
$(document).ready(function(){

 if($("#contact_form").length > 0)
  {
    $('#contact_form').validate({
      rules:{
        name : {
          required : true,
          maxlength : 50
        },
        email : {
          required : true,
          maxlength : 50, 
          email : true
        },
        phone : {
          required : true,
          digits : true,
          minlength : 11,
          maxlength : 13
        },
        password: {
            required: true,
            minlength: 5
        },
        password: {
            required: true,
            minlength: 5
        },
        password_confirmation: {
            required: true,
            minlength: 5
        }
      },
      messages : {
        name : {
          required : 'Enter Name',
          maxlength : 'Name should not be more than 50 character'
        },
        email : {
          required : 'Enter Email Detail',
          email : 'Enter Valid Email Detail',
          maxlength : 'Email should not be more than 50 character'
        },
        phone : {
          required : 'Enter Phone Number',
          digits    : "Please enter valid phone number",
          minlength : 'Phone Number must be minimum 11 character long',
          maxlength : 'Phone Number must be maximum 13 character long'
        },
        password : {
          required : 'Enter Password',
          minlength : 'Password must be minimum 5 character long'
        },
        password_confirmation : {
          required : 'Enter Password',
          minlength : 'Password must be minimum 5 character long'
        }

      },
      errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
    });
  }

});
</script>

<!--track modal -->
<script type="text/javascript">
    function orderview(id){
          $.ajax({
               url: "{{  url('/order/view/') }}/"+id,
               type:"GET",
               dataType:"json",
               success:function(data) {
                 $('#stripe_order_id').text(data.order.stripe_order_id);
                 $('#order_date').text(data.order.date);
                 $('#order_subtotal').text('$'.concat(data.order.subtotal));
                 $('#order_shipping').text('$'.concat(data.order.shipping));
                 $('#order_total').text('$'.concat(data.order.total));
                 $('#ship_address').text(data.shipping.ship_address);
                 $('#track_code').val(data.order.status_code);

                  var d =$('#order_items').empty();
                  $.each(data.order_details, function(key, value){
                       $('#order_items').append('<div class="row" style="padding: 1vh 0 1vh 0;"><div class="col-xs-4"><img  width="75px;" class="img-fluid " src="'+value.image_one+'" ></div><div class="col-xs-4" style="padding-top: 2vh;"><ul type="none"><li style="color: green;">'+value.product_name+'</li><li>Code: '+value.product_code+'</li></ul></div><div class="col-xs-4" style="padding-top: 2vh;"><ul type="none"><li>Quantity: '+value.quantity+'</li><li>Unit Price: $'+value.singleprice+'</li></ul></div></div>');
                  });
              }
      })
    }
</script>
<!-- ///////// -->
<script type="text/javascript">
    function productview(id){
          $.ajax({
               url: "{{  url('/cart/product/view/') }}/"+id,
               type:"GET",
               dataType:"json",
               success:function(data) {
                 $('#pname').text(data.product.product_name);
                 $('#pimage').attr('src','{{ url("/") }}/' + data.product.image_one);
                 $('#pcat').text(data.product.category_name);
                 $('#pbrand').text(data.product.brand_name);
                 $('#pcode').text(data.product.product_code);
                 $('#pprice').text(data.price);
                 $('#product_id').val(data.product.id);
                 $('#product_size').val('');
                 
                 var url = '{{ url("product/details/") }}/'+ data.url_part ;
                 $('#pdetails').attr('href',url);

                 var p_qty= data.product.product_quantity;
                  if(p_qty >= 5){
                    $('#avilability').text('In Stock');
                  }else if(p_qty < 5 && p_qty > 0 ){
                    $('#avilability').text('Limited');
                  }else{
                    $('#avilability').text('Out of Stock');
                  }
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
                      var cart_count = parseInt($('#cart_count').text());
                      $('#cart_count').text(++cart_count);
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

  </body>
</html>