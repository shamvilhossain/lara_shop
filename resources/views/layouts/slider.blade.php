@extends('master')
@section('slider')
<div id="sequence" class="seq">
         <ul class="seq-canvas">
            <!-- single slide item -->
            <li>
              <div class="seq-model">
                <img data-seq src="public/img/slider/1.jpg" alt="Men slide img" style="height: 400px;" />
              </div>
              <div class="seq-title">
               <span data-seq>Save Up to 75% Off</span>                
                <h2 data-seq>Men Collection</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
            <!-- single slide item -->
            <li>
              <div class="seq-model">
                <img data-seq src="public/img/slider/2.jpg" alt="Wristwatch slide img" style="height: 400px;" />
              </div>
              <div class="seq-title">
                <span data-seq>Save Up to 40% Off</span>                
                <h2 data-seq>Wristwatch Collection</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
            <!-- single slide item -->
            <li>
              <div class="seq-model">
                <img data-seq src="public/img/slider/3.jpg" alt="Women Jeans slide img" style="height: 400px;" />
              </div>
              <div class="seq-title">
                <span data-seq>Save Up to 75% Off</span>                
                <h2 data-seq>Jeans Collection</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
            <!-- single slide item -->           
            <li>
              <div class="seq-model">
                <img data-seq src="public/img/slider/4.jpg" alt="Shoes slide img" style="height: 400px;" />
              </div>
              <div class="seq-title">
                <span data-seq>Save Up to 75% Off</span>                
                <h2 data-seq>Exclusive Shoes</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
            <!-- single slide item -->  
             <li>
              <div class="seq-model">
                <img data-seq src="public/img/slider/5.jpg" alt="Male Female slide img" style="height: 400px;" />
              </div>
              <div class="seq-title">
                <span data-seq>Save Up to 50% Off</span>                
                <h2 data-seq>Best Collection</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>                   
          </ul>
        <!-- slider navigation btn -->
<!--
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
-->
      </div>

@endsection