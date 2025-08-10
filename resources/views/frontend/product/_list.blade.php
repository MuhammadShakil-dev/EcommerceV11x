<div class="products mb-3"> 
<div class="row justify-content-center">
@foreach($getProduct as $value)
@php
$getProducrImage = $value->getImageSingleFront($value->id); 
@endphp

<div class="col-12 @if(!empty($is_home)) col-md-3 col-lg-3 @else col-md-4 col-lg-4 @endif">
<div class="product product-7 text-center">
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
        </div> --><!-- End .product-action -->
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

        <!-- <div class="product-nav product-nav-thumbs">
            <a href="#" class="active">
                <img src="{{url('')}}/public/frontend/assets/images/products/product-4-thumb.jpg" alt="product desc">
            </a>
            <a href="#">
                <img src="{{url('')}}/public/frontend/assets/images/products/product-4-2-thumb.jpg" alt="product desc">
            </a>

            <a href="#">
                <img src="{{url('')}}/public/frontend/assets/images/products/product-4-3-thumb.jpg" alt="product desc">
            </a>
        </div> End .product-nav -->
    </div><!-- End .product-body -->
</div><!-- End .product -->
</div><!-- End .col-sm-6 col-lg-4 -->

@endforeach
</div><!-- End .row -->
</div><!-- End .products -->


