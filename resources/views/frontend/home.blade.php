@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
@endsection
@section('content')
<main class="main">
            <div class="intro-section bg-lighter pt-5 pb-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                                <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            } 
                                        }
                                    }'>

                                    @foreach($getSlider as $slider)

                                     @if(!empty($slider->getSliderImage()))
                                        <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <source media="(max-width: 480px)" srcset="{{ $slider->getSliderImage() }}">
                                                <img src="{{ $slider->getSliderImage() }}" alt="Image Desc">
                                            </picture>
                                        </figure><!-- End .slide-image -->

                                        <div class="intro-content">
                                            <!-- <h3 class="intro-subtitle">Topsale Collection</h3> -->
                                            <h1 class="intro-title">{!! $slider->title !!}</h1>

                                            @if(!empty($slider->button_link) && !empty($slider->button_name))
                                            <a href="{{ $slider->button_link }}" class="btn btn-outline-white">
                                                <span>{{ $slider->button_name }}</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                            @endif
                                        </div><!-- End .intro-content -->
                                        </div><!-- End .intro-slide -->
                                      @endif
                                    @endforeach


                                    <!-- <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <source media="(max-width: 480px)" srcset="assets/images/slider/slide-3-480w.jpg">
                                                <img src="{{url('public/frontend/assets/images/slider/slide-3.jpg')}}" alt="Image Desc">
                                            </picture>
                                        </figure>

                                        <div class="intro-content">
                                            <h3 class="intro-subtitle">Outdoor Furniture</h3>
                                            <h1 class="intro-title">Outdoor Dining <br>Furniture</h1>

                                            <a href="category.html" class="btn btn-outline-white">
                                                <span>SHOP NOW</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div> -->

                                </div><!-- End .intro-slider owl-carousel owl-simple -->
                                
                                <span class="slider-loader"></span><!-- End .slider-loader -->
                            </div><!-- End .intro-slider-container -->
                        </div><!-- End .col-lg-8 -->

                        
                        <!--  <div class="col-lg-4">
                            <div class="intro-banners">
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="banner banner-display">
                                            <a href="#">
                                                <img src="{{url('public/frontend/assets/images/banners/home/intro/banner-1.jpg')}}" alt="Banner">
                                            </a>

                                            <div class="banner-content">
                                                <h4 class="banner-subtitle text-darkwhite"><a href="#">Clearence</a></h4>
                                                <h3 class="banner-title text-white"><a href="#">Chairs & Chaises <br>Up to 40% off</a></h3>
                                                <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12">
                                        <div class="banner banner-display mb-0">
                                            <a href="#">
                                                <img src="{{url('public/frontend/assets/images/banners/home/intro/banner-2.jpg')}}" alt="Banner">
                                            </a>

                                            <div class="banner-content">
                                                <h4 class="banner-subtitle text-darkwhite"><a href="#">New in</a></h4>
                                                <h3 class="banner-title text-white"><a href="#">Best Lighting <br>Collection</a></h3><a href="#" class="btn btn-outline-white banner-link">Discover Now<i class="icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                    </div><!-- End .row -->
       
                  @if(!empty($getPartner->count()))
                    <div class="mb-6"></div><!-- End .mb-6 -->

                    <div class="owl-carousel owl-simple" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                        
                        @foreach($getPartner as $partner)
                          @if(!empty($partner->getPartnerLogo()))
                           <a href="{{ !empty($partner->button_link) ?$partner->button_link : '#' }}" class="brand">
                             <img src="{{ $partner->getPartnerLogo() }}">
                           </a>
                         @endif
                        @endforeach

                        <!-- <a href="#" class="brand">
                            <img src="{{url('public/frontend/assets/images/brands/2.png')}}" alt="Brand Name">
                        </a> -->
                    </div><!-- End .owl-carousel -->
                  @endif
                </div><!-- End .container -->
            </div><!-- End .bg-lighter -->
            <div class="mb-6"></div><!-- End .mb-6 -->
              
            @if(!empty($getProductTrendy->count()))  
            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title-lg">{{!empty($getHomeSetting->trendy_product_title) ? $getHomeSetting->trendy_product_title : 'Trendy Products'}}</h2><!-- End .title -->

                    <!-- <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab" aria-controls="trendy-all-tab" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trendy-fur-link" data-toggle="tab" href="#trendy-fur-tab" role="tab" aria-controls="trendy-fur-tab" aria-selected="false">Furniture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trendy-decor-link" data-toggle="tab" href="#trendy-decor-tab" role="tab" aria-controls="trendy-decor-tab" aria-selected="false">Decor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trendy-light-link" data-toggle="tab" href="#trendy-light-tab" role="tab" aria-controls="trendy-light-tab" aria-selected="false">Lighting</a>
                        </li>
                    </ul> -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                            @foreach($getProductTrendy as $value)
                             @php
                              $getProducrImage = $value->getImageSingleFront($value->id); 
                             @endphp


                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <!-- <span class="product-label label-new">New</span> -->
                                    <a href="{{url($value->slug)}}">
                                        @if(!empty($getProducrImage) && !empty($getProducrImage->getImageLog()))
                                        <img style="height: 280px;width: 100%;object-fit: cover;" src="{{ $getProducrImage->getImageLog() }}" alt="{{ $value->title }}" class="product-image">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">
                                         @if(!empty(Auth::check())) 
                                          <a href="javascript:;" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{ $value->id }} btn-product-icon btn-wishlist btn-expandable {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist" id="{{ $value->id }}"><span>add to wishlist</span></a>
                                         @else
                                          <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>add to wishlist</span></a>
                                        @endif
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ url($value->category_slug.'/'.$value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{url($value->slug)}}">{{ $value->title }}</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        ${{ number_format($value->price, 2) }}
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: {{ $value->getReviewRating($value->id)}}%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( {{ $value->getTotalReview()}} Reviews )</span>
                                    </div><!-- End .rating-container -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                           @endforeach


                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .container --> 
            @endif

            @if(!empty($getCategoryHome->count()))
            <div class="container categories pt-6">
                <h2 class="title-lg text-center mb-4">{{!empty($getHomeSetting->shop_category_title) ? $getHomeSetting->shop_category_title : 'Shop by Categories'}}</h2><!-- End .title-lg text-center -->

                <div class="row">
                    @foreach($getCategoryHome as $categoryHome)
                     @if(!empty($categoryHome->getImage()))

                      <div class="col-sm-12 col-lg-4 banners-sm">
                         <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                             <a href="{{ url($categoryHome->slug) }}">
                                 <img src="{{ $categoryHome->getImage() }}" alt="{{ $categoryHome->name }}">
                              </a>

                          <div class="banner-content banner-content-center">
                             <h3 class="banner-title text-white"><a href="{{ url($categoryHome->slug) }}">{{ $categoryHome->name }}</a></h3><!-- End .banner-title -->

                             @if(!empty($categoryHome->button_name))
                              <a href="{{ url($categoryHome->slug) }}" class="btn btn-outline-white banner-link">{{ $categoryHome->button_name }}<i class="icon-long-arrow-right"></i></a>
                             @endif
                                </div><!-- End .banner-content -->
                             </div><!-- End .banner -->

                    </div><!-- End .col-sm-6 col-lg-3 -->
                    @endif
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- End .mb-6 -->               
            @endif

            
            <div class="container">
                <div class="heading heading-center mb-6">
                    <h2 class="title">{{!empty($getHomeSetting->recenta_arrival_title) ? $getHomeSetting->recenta_arrival_title : 'Recent Arrivals'}}</h2><!-- End .title -->

                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                        </li>
                       @foreach($getCategoryHome as $categoryHome)
                        <li class="nav-item">
                            <a class="nav-link getCategoryProduct" data-val="{{ $categoryHome->id }}" id="top-{{ $categoryHome->slug }}-link" data-toggle="tab" href="#top-{{ $categoryHome->slug }}-tab" role="tab" aria-controls="top-{{ $categoryHome->slug }}-tab" aria-selected="false">{{ $categoryHome->name }}</a>
                        </li>
                       @endforeach

                        <!-- <li class="nav-item">
                            <a class="nav-link" id="top-decor-link" data-toggle="tab" href="#top-decor-tab" role="tab" aria-controls="top-decor-tab" aria-selected="false">Decor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="top-light-link" data-toggle="tab" href="#top-light-tab" role="tab" aria-controls="top-light-tab" aria-selected="false">Lighting</a>
                        </li> -->

                    </ul>
                </div><!-- End .heading -->

                <div class="tab-content">

                    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                        <div class="products">
                            @php
                              $is_home = 1;
                            @endphp
                            @include('frontend.product._list')
                            
                        </div><!-- End .products -->


                        <div class="more-container text-center">
                         <a href="{{url('search')}}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
                       </div><!-- End .more-container -->


                    </div><!-- .End .tab-pane -->

                  @foreach($getCategoryHome as $categoryHome)

                     <div class="tab-pane p-0 fade getCategoryProduct{{ $categoryHome->id }}" id="top-{{ $categoryHome->slug }}-tab" role="tabpanel" aria-labelledby="top-{{ $categoryHome->slug }}-link">

                       

                     </div><!-- .End .tab-pane -->
                  @endforeach

                    <!-- <div class="tab-pane p-0 fade" id="top-decor-tab" role="tabpanel" aria-labelledby="top-decor-link">
                        <div class="products">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-11 mt-v3 text-center">
                                        <figure class="product-media">
                                            <a href="product.html">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-8-1.jpg')}}" alt="Product image" class="product-image">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-8-2.jpg')}}" alt="Product image" class="product-image-hover">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                            </div>
                                        </figure>

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.html">Madra Log Holder</a></h3>
                                            <div class="product-price">
                                                $104,00
                                            </div>

                                            <div class="product-nav product-nav-dots">
                                                <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                                <a href="#" style="background: #927764;"><span class="sr-only">Color name</span></a>
                                            </div>

                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-11 mt-v3 text-center">
                                        <figure class="product-media">
                                            <a href="product.html">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-11-1.jpg')}}" alt="Product image" class="product-image">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-11-2.jpg')}}" alt="Product image" class="product-image-hover">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                            </div>
                                        </figure>

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.html">Original Outdoor Beanbag</a></h3>
                                            <div class="product-price">
                                                $259,00
                                            </div>
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-11 mt-v3 text-center">
                                        <figure class="product-media">
                                            <a href="product.html">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-14-1.jpg')}}" alt="Product image" class="product-image">
                                                <img src="{{url('public/frontend/assets/images/demos/demo-2/products/product-14-2.jpg')}}" alt="Product image" class="product-image-hover">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                            </div>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3>
                                            <div class="product-price">
                                                $2.486,00
                                            </div>

                                            <div class="product-nav product-nav-dots">
                                                <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color name</span></a>
                                                <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                                            </div>
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div><!-- End .tab-content -->


            </div><!-- End .container -->

            <div class="container">
                <hr>
                <div class="row justify-content-center">
                     @if(!empty($getHomeSetting->payment_delivery_title))
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            @if(!empty($getHomeSetting->getPaymentDeliveryImage()))
                            <span class="icon-box-icon">
                                <img style="width: 50px;" src="{{$getHomeSetting->getPaymentDeliveryImage()}}">
                            </span>
                            @endif
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">{{$getHomeSetting->payment_delivery_title}}</h3><!-- End .icon-box-title -->
                                <p>{{$getHomeSetting->payment_delivery_description}}</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                    @endif


                     @if(!empty($getHomeSetting->refund_title))
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            @if(!empty($getHomeSetting->getRefundImage()))
                            <span class="icon-box-icon">
                                <img style="width: 50px;" src="{{$getHomeSetting->getRefundImage()}}">
                            </span>
                            @endif
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">{{$getHomeSetting->refund_title}}</h3><!-- End .icon-box-title -->
                                <p>{{$getHomeSetting->refund_description}}</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                    @endif


                    @if(!empty($getHomeSetting->support_title))
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            @if(!empty($getHomeSetting->getSupportImage()))
                            <span class="icon-box-icon">
                                <img style="width: 50px;" src="{{$getHomeSetting->getSupportImage()}}">
                            </span>
                            @endif
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">{{$getHomeSetting->support_title}}</h3><!-- End .icon-box-title -->
                                <p>{{$getHomeSetting->support_description}}</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                    @endif

                </div><!-- End .row -->

                <div class="mb-2"></div><!-- End .mb-2 -->
            </div><!-- End .container -->
             @if(!empty($getBlog->count()))
            <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
                <div class="container">
                   <h2 class="title-lg text-center mb-3 mb-md-4">{{!empty($getHomeSetting->blog_title) ? $getHomeSetting->blog_title : 'Our Blog'}}</h2><!-- End .title-lg text-center -->

                    <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                        @foreach($getBlog as $blog)
                        <article class="entry entry-display">
                            <figure class="entry-media">
                                <a href="{{url('blog/'.$blog->slug)}}">
                                    <img style="height: 260px;object-fit: cover;" src="{{$blog->getImage()}}" alt="{{$blog->title}}">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body pb-4 text-center">
                                <div class="entry-meta">
                                    <a href="#">{{ date('M d, Y', strtotime($blog->created_at)) }}</a>, {{ $blog->getCommentCount() }} Comments
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <p>{{$blog->short_description}} </p>
                                    <a href="{{url('blog/'.$blog->slug)}}" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                        @endforeach

                    </div><!-- End .owl-carousel -->
                </div><!-- container -->

                <div class="more-container text-center mb-0 mt-3">
                    <a href="{{url('blog')}}" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .more-container -->
            </div>
            @endif

            @if(!empty($getHomeSetting->signup_title))
            <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url('{{$getHomeSetting->getSignupImage()}}');">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-9 col-xl-8">
                            <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                                <div class="col">
                                    <h3 class="cta-title text-white">{{$getHomeSetting->signup_title}}</h3><!-- End .cta-title -->
                                    <p class="cta-desc text-white">{{$getHomeSetting->signup_description}}</p><!-- End .cta-desc -->
                                </div><!-- End .col -->

                                <div class="col-auto">
                                    @if(empty(Auth::check()))
                                     <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                                    @endif
                                </div><!-- End .col-auto -->
                            </div><!-- End .row no-gutters -->
                        </div><!-- End .col-md-10 col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cta -->
            @endif
        </main><!-- End .main -->
@endsection

@section('script')
<!-- some page script -->
<script type="text/javascript">
   
   // Recent Arrival Category
 $('body').delegate('.getCategoryProduct', 'click', function(){

     var category_id = $(this).attr('data-val'); 

     // console.log(category_id);

     $.ajax({
        url : "{{ url('recent_arrival_category_product') }}",
        type : "POST",
        data :{
            "_token": "{{ csrf_token() }}",
            category_id:category_id,
        },
        dataType : "json",
        success: function (response) 
        {
            $('.getCategoryProduct'+category_id).html(response.success)

        },
    });
 });
    
</script>
@endsection        