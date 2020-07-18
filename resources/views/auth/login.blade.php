@extends('layouts.app')
<style>/*-------define root colors---------*/
    :root {
        --color-facebook: #3b5998;
        --color-google: #ea4335;
    
        --style-1-color: #009688;
        --style-2-color: #009688;
        --style-3-color: #009688;
        --style-4-color: #ff6666;
    }
    
    
    /*-------------------------------------------------
     * Modal Style 1 CSS start
     *-----------------------------------------------*/
     .aa-search-box button{
         height:72% !important;
     }
    
    .modal-style-1 .modal-login {
        width: 350px;
        font-size: 13px;
    }
    .modal-style-1 .modal-login .modal-header {
        border-bottom: none;
        position: relative;
        justify-content: center;
    }
    .modal-style-1 .modal-login h4 {
        color: var(--style-1-color);
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
        border-bottom: 0;
        text-transform: uppercase;
        line-height: 1;
        letter-spacing: 3px;
        font-weight: 900;
        width: 100%;
    }
    .modal-style-1 .modal-header .close{
        position: absolute;
        right: 20px;
    }
    .modal-style-1  .close:focus, .modal-style-1 .close:active {
       outline: none !important;
       box-shadow: none;
    }
    .modal-style-1 .modal-login a{
        text-decoration: none;
    }
    
    .modal-style-1 .modal-login form{
        width: 280px;
        margin: 0 auto;
    }
    
    .modal-style-1 .modal-login span.input-group-addon {
        width: 60px;
        text-align: center;
        border-radius: 25px 0 0 25px;
        border: 1px solid var(--style-1-color);
        padding: 8px;
        margin-right: 5px;
        background: var(--style-1-color);
        color: #fff;
    }
    .modal-style-1 .modal-login span.input-group-addon i{
        font-size: 16px;
    }
    
    .modal-style-1 input.form-control {
        border-radius: 0 25px 25px 0;
        font-size: 13px;
        border: 1px solid var(--style-1-color);
    }
    .modal-style-1 .btn-signin {
        border-radius: 25px;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background-color: var(--style-4-color);
        border: 1px solid var(--style-1-color);
    }
    
    .modal-style-1 p.hint-text {
        text-align: center;
    }
    
    .modal-style-1 .register{
        color: var(--style-1-color);
        font-weight: 600px;
    }
    
    .modal-style-1 .social-login a {
        text-decoration: none;
        color: #fff;
        margin: 2px;
        height: 30px;
        display: inline-block;
        width: 160px;
        padding: 8px 0;
        text-align: center;
        cursor: pointer;
    }
    .modal-style-1 .btn-facebook{
        background-color: var(--color-facebook);
    } 
    
    .modal-style-1 .btn-google{
        background-color: var(--color-google);
    } 
    
   
    @media only screen and (max-width: 360px) {
        .modal-style-1 .modal-login {width: 100%; margin:5px;}
        .modal-style-1 .modal-login form{width: 100%;}
    }
    
    
    /*------extra css----------*/
    
    .main-container{
        width:1140px;
        margin: 0 auto;
    }
    .text-12{
        font-size: 12px;
    }
    
    .button-card {
        margin: 0 auto;
        box-shadow: 1px 2px 5px 2px #d1d1d1;
        padding: 20px;
        border-radius: 5px;
    }
    .button-card img {
        border: 1px solid #f1f1f1;
        border-radius: 5px;
        max-height: 350px;
        position: relative;
    }
    
    .btn-theme{
        width: 100px;
        height: 35px;
        padding: 3px;
        border-radius: 26px;
    }
    
    @media only screen and (max-width: 1140px) {
        .main-container{ width: 100%; margin: 0 15px;}
    }
    
    @media only screen and (max-width: 480px) {
        .button-card img {width: 100%; height: auto;}
    }
    
</style>
@section('content')
@include('layouts.menubar')      

        <section id="aa-myaccount">
            <div class="container">
                 <div class="aa-myaccount-area">         
                     <div class="row">

                        
                       <div class="col-md-6 modal-style-1" style=" border-right: 2px dashed #ccc;">
                         <div class="aa-myaccount-login">
                         <h4>Login</h4>
                         <form action="{{ route('login') }}" id="login_form" method="post">
                            @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email or Phone" required="required">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required="required" autocomplete="on">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success btn-signin">Login</button>
                                </div>
                                <a href="{{ route('password.request') }}">I Forgot My Password.</a>
                                <p class="hint-text mt-3">or Login with</p>
                                <!-- social login area -->
                                <div class="social-login text-center">
                                    <a class=" btn-facebook  text-uppercase" href="{{ url('/auth/redirect/facebook') }}" style="border-radius: 25px;"><i class="fa fa-facebook-f mr-2 ml-2">&nbsp;&nbsp;&nbsp;&nbsp; Facebook</i> </a>
                                    <a class=" btn-google  text-uppercase" href="{{ url('/auth/redirect/google') }}" style="border-radius: 25px;"><i class="fa fa-google mr-2 ml-2"> &nbsp;&nbsp;&nbsp; Google</i></a>
                                </div>

                            </form>
                         </div>
                       </div>



                       <div class="col-md-6 modal-style-1">
                        <div class="aa-myaccount-login">
                        <h4>Register</h4>
                        <form action="{{ route('register') }}" id="contact_form" method="post">
                            @csrf
                               <div class="form-group">
                                   <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                       <input type="text" id="name" data-error="#errNm1" class="form-control" name="name" placeholder="Enter your name" required="required">
                                   </div>
                                   <span style="color:red;" id="errNm1" ></span>
                               </div>
                               <div class="form-group">
                                   <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                       <input type="email" id="email" data-error="#errNm2" class="form-control @error('email') is-invalid @enderror"  name="email"  value="" placeholder="Enter email address" required="required">
                                   </div>
                                   <span style="color:red;" id="errNm2" ></span>
                               </div>
                               <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="phone" data-error="#errNm3" class="form-control @error('phone') is-invalid @enderror" name="phone" value="" placeholder="Enter Phone Number" required="required">
                                    </div>
                                    <span style="color:red;" id="errNm3" ></span>
                                </div>
                               <div class="form-group">
                                   <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                       <input id="password" type="password" data-error="#errNm4" class="form-control" name="password" placeholder="Enter password" required="required" autocomplete="on">
                                   </div>
                                   <span style="color:red;" id="errNm4" ></span>
                               </div>
                               <div class="form-group">
                                   <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                       <input id="password_confirmation" data-error="#errNm5" data-rule-equalTo="#password" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required="required" autocomplete="on">
                                   </div>
                                   <span style="color:red;" id="errNm5" ></span>
                               </div>
                               <div class="form-group text-center">
                                   <button type="submit" class="btn btn-primary btn-signin">Register</button>
                                   
                               </div>
                               
                           </form>
                        </div>
                      </div>

                      
                     </div>          
                  </div>
              
            </div>
          </section>


@endsection
