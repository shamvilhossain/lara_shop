@extends('layouts.app')
@section('content')
@include('layouts.menubar')

  <!-- catg header banner section -->
  <!-- <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Blog Details</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Blog Details</li>
        </ol>
      </div>
     </div>
   </div>
  </section> -->
  <!-- / catg header banner section -->

  <!-- Blog Archive -->
  <section id="aa-blog-archive">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-blog-archive-area">
            <div class="row">
              <div class="col-md-9">
                <!-- Blog details -->
                <div class="aa-blog-content aa-blog-details">
                  <article class="aa-blog-content-single">                        
                    <h2>
                      @if(session()->get('lang')=='bangla')
                          <a href="#">{{ $post->post_title_bn }}</a>
                      @else
                          <a href="#">{{ $post->post_title_en }}</a>
                      @endif
                    </h2>
                     <div class="aa-article-bottom">
                      <div class="aa-post-author">
                        Posted By Admin
                      </div>
                      <div class="aa-post-date">
                        {{ date( 'd-M-Y', strtotime( $post->created_at ) )}}
                      </div>
                    </div>
                    <figure class="aa-blog-img">
                      <a href="#"><img src="{{ URL::to($post->post_image) }}" alt="{{$post->post_title_en}}"></a>
                    </figure>
                    @if(session()->get('lang')=='bangla')
                      <p>{!! $post->details_bn !!} </p>
                    @else
                      <p>{!! $post->details_en !!}</p>
                    @endif
                    <div class="blog-single-bottom">
                      <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <div class="blog-single-tag">
                            <span>Category:</span>
                            @if(session()->get('lang')=='bangla')
                                {{ $post->category_name_bn }}
                            @else
                                {{ $post->category_name_en }}
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-single-social">
                            <!-- <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                   
                  </article>
                  <!-- blog navigation -->
                  <div class="aa-blog-navigation">
                    <!-- <a class="aa-blog-prev" href="#"><span class="fa fa-arrow-left"></span>Prev Post</a>
                    <a class="aa-blog-next" href="#">Next Post<span class="fa fa-arrow-right"></span></a> -->
                  </div>
                  <!-- Blog Comment threats -->
                  <div class="aa-blog-comment-threat">

                  <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5" data-width="100%"></div>
                 </div>
                </div> 

                  
                  </div>
                  
                </div>
              </div>

              <!-- blog sidebar -->
              <div class="col-md-3">
                <aside class="aa-blog-sidebar">
                  <div class="aa-sidebar-widget">
                    <h3>Category</h3>
                    <ul class="aa-catg-nav">
                    @foreach($post_category as $row)
                      @if(session()->get('lang')=='bangla')
                         <li><a href="#">{{$row->category_name_bn}}</a></li>
                      @else
                         <li><a href="#">{{$row->category_name_en}}</a></li>
                      @endif
                      
                    @endforeach 
                    </ul>
                  </div>
                  <!-- <div class="aa-sidebar-widget">
                    <h3>Tags</h3>
                    <div class="tag-cloud">
                      <a href="#">Fashion</a>
                      <a href="#">Ecommerce</a>
                      <a href="#">Shop</a>
                      <a href="#">Hand Bag</a>
                      <a href="#">Laptop</a>
                      <a href="#">Head Phone</a>
                      <a href="#">Pen Drive</a>
                    </div>
                  </div> -->
                  <div class="aa-sidebar-widget">
                    <h3>Recent Post</h3>
                    <div class="aa-recently-views">
                      <ul>
                      @foreach($recent_post as $row)
                        <li>
                          <a class="aa-cartbox-img" href="{{  url('/single/blog/'.$row->id) }}"><img src="{{ URL::to($row->post_image) }}" alt="{{$row->post_title_en}}"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="{{  url('/single/blog/'.$row->id) }}">{{ str_limit($row->post_title_en, 30, '') }}</a></h4>
                            <p>{{ date( 'd-M-Y', strtotime( $row->created_at ) )}}</p>
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
        </div>
      </div>
    </div>
  </section>
  <!-- / Blog Archive -->
  <!-- / Blog Archive -->
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