@extends('frontend.layouts.app')
@section('style')
<!-- some page style --> 
<link rel="stylesheet" href="{{url('public/frontend/assets/css/plugins/nouislider/nouislider.css')}}"> 
@endsection


@section('content')
<main class="main">
  <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
     <div class="container d-flex align-items-center">
         <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url($getProduct->getCategory->slug)}}">{{$getProduct->getCategory->name}}</a></li>
                <li class="breadcrumb-item"><a href="{{url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a></li>

                <!-- <li class="breadcrumb-item active" aria-current="page">Extended Description</li> -->
                <li class="breadcrumb-item active" aria-current="page">{{$getProduct->title}}</li>
         </ol>

         <!-- <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i> 
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
        </nav> -->  <!-- End .pager-nav --> 
     </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->

  <div class="page-content">
    <div class="container">
        @include('validation._message')
        <div class="product-details-top mb-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <figure class="product-main-image">
                          @php
                            $getProducrImage = $getProduct->getImageSingleFront($getProduct->id);
                          @endphp 

                             @if(!empty($getProducrImage) && !empty($getProducrImage->getImageLog())) 
                            <img id="product-zoom" src="{{ $getProducrImage->getImageLog() }}" data-zoom-image="{{ $getProducrImage->getImageLog() }}" alt="product image">

                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                <i class="icon-arrows"></i>
                            </a>
                            @endif
                        </figure><!-- End .product-main-image -->

                        <div id="product-zoom-gallery" class="product-image-gallery">

                            @foreach($getProduct->getImage as $image)                                    
                            <a class="product-gallery-item" href="#" data-image="{{$image->getImageLog()}}" data-zoom-image="{{$image->getImageLog()}}">
                                <img style="height: 120px; width: 100%;object-fit: cover;" src="{{$image->getImageLog()}}" alt="product side">
                            </a>
                            @endforeach

                           <!--  <a class="product-gallery-item" href="#" data-image="public/frontend/assets/images/products/single/extended/2.jpg" data-zoom-image="public/frontend/assets/images/products/single/extended/2-big.jpg">
                                <img src="public/frontend/assets/images/products/single/extended/2-small.jpg" alt="product cross">
                            </a>

                            <a class="product-gallery-item active" href="#" data-image="public/frontend/assets/images/products/single/extended/3.jpg" data-zoom-image="public/frontend/assets/images/products/single/extended/3-big.jpg">
                                <img src="public/frontend/assets/images/products/single/extended/3-small.jpg" alt="product with model">
                            </a>

                            <a class="product-gallery-item" href="#" data-image="public/frontend/assets/images/products/single/extended/4.jpg" data-zoom-image="public/frontend/assets/images/products/single/extended/4-big.jpg">
                                <img src="public/frontend/assets/images/products/single/extended/4-small.jpg" alt="product back">
                            </a> -->

                        </div><!-- End .product-image-gallery -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{$getProduct->title}}</h1><!-- End .product-title -->

                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: {{ $getProduct->getReviewRating($getProduct->id)}}%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->




                            <a class="ratings-text" href="#product-review-link" id="review-link">({{ $getProduct->getTotalReview()}} Reviews )</a>
                        </div><!-- End .rating-container -->

                        <div class="product-price">
                            $<span id="getTotalSizePrice">{{ number_format($getProduct->price, 2) }}</span>
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>{{$getProduct->short_description}} </p>
                        </div><!-- End .product-content -->

                        <!-- <div class="details-filter-row details-row-size">
                            <label>Color:</label>

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #eab656;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #3a588b;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #caab97;"><span class="sr-only">Color name</span></a>
                            </div>
                        </div> -->

                    <form action="{{url('product/addToCart')}}" method="post">
                     {{ csrf_field() }}
                     <input type="hidden" name="product_id" value="{{$getProduct->id}}">
                        @if(!empty($getProduct->getColor->count()))
                        <div class="details-filter-row details-row-size">
                            <label for="Color">Color:</label>
                            <div class="select-custom">
                                <select name="colour_id" id="colour_id" required class="form-control">
                                    <option value="">Select a color</option>
                                    @foreach($getProduct->getColor as $color)
                                    <option value="{{$color->getColorP->id}}">{{$color->getColorP->name}}</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom --> 
                        </div>
                        @endif  

                        @if(!empty($getProduct->getSize->count()))
                        <div class="details-filter-row details-row-size">
                            <label for="size">Size:</label>
                            <div class="select-custom">
                                <select name="size_id" id="size" required class="form-control getSizePrice">
                                    <option data-price="0" value="">Select a size</option>
                                    @foreach($getProduct->getSize as $size)
                                    <option data-price="{{ !empty($size->price) ? $size->price : 0 }}" value="{{$size->id}}">{{$size->name}} @if(!empty($size->price)) (${{ number_format($size->price,2)}}) @endif</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->

                            <!-- <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a> -->
                        </div><!-- End .details-filter-row -->
                        @endif 

                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control" value="1" min="1" max="100" name="qty" step="1" data-decimals="0" required>
                            </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->

                        <div class="product-details-action">
                            <button style="background:#fff; color: #c96;" type="submit" class="btn-product btn-cart">add to cart</button>

                    </form>    

                            <div class="details-action-wrapper">
                               @if(!empty(Auth::check())) 
                                <a href="javascript:;" class="add_to_wishlist add_to_wishlist{{ $getProduct->id }} {{ !empty($getProduct->checkWishlist($getProduct->id)) ? 'btn-wishlist-add' : '' }} btn-product btn-wishlist" title="Wishlist" id="{{ $getProduct->id }}"><span>Add to Wishlist</span></a>
                                @else
                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                @endif 
                                <!-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> -->
                            </div><!-- End .details-action-wrapper -->
                        </div><!-- End .product-details-action -->

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>

                                <a href="{{url($getProduct->getCategory->slug)}}">{{$getProduct->getCategory->name}}</a>,
                                <a href="{{url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a>,



                                <!-- <a href="#">Women</a>,
                                <a href="#">Shoes</a>,
                                <a href="#">Sandals</a>,
                                <a href="#">Yellow</a> -->
                            </div><!-- End .product-cat -->

                           <!--  <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div> -->
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->
    </div><!-- End .container -->

    <div class="product-details-tab product-details-extended">
        <div class="container">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $getProduct->getTotalReview() }})</a>
                </li>
            </ul>
        </div><!-- End .container -->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                <div class="product-desc-content">
                    <div class="container" style="margin-top: 20px;">
                        {!! $getProduct->description !!} 
                    </div><!-- End .container -->
                </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                <div class="product-desc-content" style="margin-top: 20px;">
                    <div class="container">
                        {!! $getProduct->additional_information!!} 
                    </div><!-- End .container -->
                </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                <div class="product-desc-content" style="margin-top: 20px;">
                    <div class="container">
                        {!! $getProduct->shipping_returns !!} 
                    </div><!-- End .container -->
                </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                <div class="reviews">
                    <div class="container">
                        <h3>Reviews ({{ $getProduct->getTotalReview() }})</h3>
                        @foreach($getProductReview as $review)
                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">{{$review->name}}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: {{ $review->getProductReviewPercent() }}%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                    </div><!-- End .rating-container -->
                                    <span class="review-date">{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                </div><!-- End .col -->
                                <div class="col">
                                    <h4>{{$review->review}}</h4>
                                </div><!-- End .col-auto -->
                            </div><!-- End .row -->
                        </div><!-- End .review -->
                        @endforeach

                        {!! $getProductReview->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                       
                    </div><!-- End .container -->
                </div><!-- End .reviews -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .product-details-tab -->

    <div class="container">
        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
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

            @foreach($getRelatedProduct as $value)
              @php
                $getProducrImage = $value->getImageSingleFront($value->id);
              @endphp
                                    
            <div class="product product-7">
                <figure class="product-media">
                    <!-- <span class="product-label label-new">New</span> -->
                    <a href="{{url($value->slug)}}">
                        @if(!empty($getProducrImage) && !empty($getProducrImage->getImageLog()))
                        <img style="height: 280px;width: 100%;object-fit: cover;" src="{{ $getProducrImage->getImageLog() }}" alt="{{ $value->title }}" class="product-image">
                        @endif
                    </a>

                    <div class="product-action-vertical">
                        <!-- <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a> -->
                         @if(!empty(Auth::check())) 

                          <a href="javascript:;" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{ $value->id }} btn-product-icon btn-wishlist btn-expandable {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist" id="{{ $value->id }}"><span>add to wishlist</span></a>

                         @else
                          <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>add to wishlist</span></a>
                        @endif
                        <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                    </div><!-- End .product-action-vertical -->

                    <!-- <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div> -->  <!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <!-- <a href="#">Women</a> -->
                        <a href="{{ url($value->category_slug.'/'.$value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                    </div><!-- End .product-cat -->
                    <!-- <h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil skirt</a></h3> -->
                    <h3 class="product-title"><a href="{{url($value->slug)}}">{{ $value->title }}</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        <!-- $60.00 -->
                        ${{ number_format($value->price, 2) }}
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <!-- <div class="product-nav product-nav-dots">
                        <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                    </div> -->      <!-- End .product-nav -->


                </div><!-- End .product-body -->
            </div><!-- End .product -->

            @endforeach

            <!-- <div class="product product-7">
                <figure class="product-media">
                    <span class="product-label label-out">Out of Stock</span>
                    <a href="product.html">
                        <img src="public/frontend/assets/images/products/product-6.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jackets</a>
                    </div>
                    <h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3>
                    <div class="product-price">
                        <span class="out-price">$120.00</span>
                    </div> 
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                        </div>
                        <span class="ratings-text">( 6 Reviews )</span>
                    </div>
                </div>
            </div>  -->

            
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
  </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<!-- some page script -->
<script src="{{url('public/frontend/assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{url('public/frontend/assets/js/jquery.elevateZoom.min.js')}}"></script>
<script src="{{url('public/frontend/assets/js/bootstrap-input-spinner.js')}}"></script>

   <script type="text/javascript">
       
     // getSizePrice 
     $('.getSizePrice').change(function(){
        var ProductPrice = '{{ $getProduct->price }}';
        var price = $('option:selected', this).attr('data-price');
        var total = parseFloat(ProductPrice) + parseFloat(price);
        $('#getTotalSizePrice').html(total.toFixed(2));

        // var total = ProductPrice + price;  

        // console.log(total);


        // var ids = '';
        // $('.getSizePrice').each(function(){
        //   if (this.checked) 
        //   {
        //     var id = $(this).val();
        //         ids += id+',';
        //   }
        //    });
        //    $('#get_brand_id').val(ids);
        //    filterForm();
            
         });
   </script>

@endsection        