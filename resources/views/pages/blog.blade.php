@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('public/frontend/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Blog Archive</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Blog Archive</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- Blog Archive -->
  <section id="aa-blog-archive">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-blog-archive-area">
            <div class="row">
              <div class="col-md-9">
                <div class="aa-blog-content">
                  <div class="row">

                    @foreach($post as $row)
                    <div class="col-md-4 col-sm-4">
                      <article class="aa-blog-content-single">                        
                        <h4>
                        @if(session()->get('lang')=='bangla')
                          <a href="{{  url('/single/blog/'.$row->id) }}">{{ str_limit($row->post_title_bn, 40, '') }}</a>
                      @else
                          <a href="{{  url('/single/blog/'.$row->id) }}">{{ str_limit($row->post_title_en, 40, '') }}</a>
                      @endif
                        	
                        </h4>
                        <figure class="aa-blog-img">
                          <a href="{{  url('/single/blog/'.$row->id) }}"><img src="{{ URL::to($row->post_image) }}" alt="{{$row->post_title_bn}}"></a>
                        </figure>
                        
                        @if(session()->get('lang')=='bangla')
			                <p>{!! str_limit($row->details_bn, 100, '') !!} </p>
		                @else
		                    <p>{!! str_limit($row->details_en, 100, '') !!}</p>
		                @endif
                        <div class="aa-article-bottom">
                          <div class="aa-post-author">
                            Posted By <a href="#">Admin</a>
                          </div>
                          <div class="aa-post-date">
                            {{ date( 'd-M-Y', strtotime( $row->created_at ) )}}
                          </div>
                        </div>
                      </article>
                    </div>
                    @endforeach
                    
                  </div>
                </div>
                <!-- Blog Pagination -->
                <div class="aa-blog-archive-pagination">
                  <nav>
                    <ul class="pagination">
                      <li>
                        <a aria-label="Previous" href="#">
                          <span aria-hidden="true">«</span>
                        </a>
                      </li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li>
                        <a aria-label="Next" href="#">
                          <span aria-hidden="true">»</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-md-3">
                <aside class="aa-blog-sidebar">
                  <div class="aa-sidebar-widget">
                    <h3>Category</h3>
                    <ul class="aa-catg-nav">
                      <li><a href="#">Men</a></li>
                      <li><a href="">Women</a></li>
                      <li><a href="">Kids</a></li>
                      <li><a href="">Electornics</a></li>
                      <li><a href="">Sports</a></li>
                    </ul>
                  </div>
                  <div class="aa-sidebar-widget">
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
                  </div>
                  <div class="aa-sidebar-widget">
                    <h3>Recent Post</h3>
                    <div class="aa-recently-views">
                      <ul>
                        <li>
                          <a class="aa-cartbox-img" href="#"><img src="{{asset('public/frontend/img/woman-small-2.jpg')}}" alt="img"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="#">Lorem ipsum dolor sit amet.</a></h4>
                            <p>March 26th 2016</p>
                          </div>                    
                        </li>
                        <li>
                          <a class="aa-cartbox-img" href="#"><img src="{{asset('public/frontend/img/woman-small-1.jpg')}}" alt="img"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="#">Lorem ipsum dolor.</a></h4>
                            <p>March 26th 2016</p>
                          </div>                    
                        </li>
                         <li>
                          <a class="aa-cartbox-img" href="#"><img src="{{asset('public/frontend/img/woman-small-2.jpg')}}" alt="img"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="#">Lorem ipsum dolor.</a></h4>
                            <p>March 26th 2016</p>
                          </div>                    
                        </li>                                      
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