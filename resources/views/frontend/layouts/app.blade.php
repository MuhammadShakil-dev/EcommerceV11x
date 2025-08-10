<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <title>eCommerce </title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes"> -->

    <title>{{ !empty($meta_title) ? $meta_title : '' }} </title> 

    @if(!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">
    @endif
    
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{ $meta_keywords }}">
    @endif


    @php
     $getSystemSettingApp =  App\Models\Backend\SystemSetting::getSingle();
    @endphp



    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="{{url('public/frontend/assets/images/icons/favicon.ico')}}"> -->
    <link rel="shortcut icon" href="{{ $getSystemSettingApp->getFevicon() }}">




    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{url('public/frontend/assets/images/icons/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{url('public/frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{url('public/frontend/assets/css/style.css')}}">

    <style type="text/css">
        .btn-wishlist-add::before{
            content: '\f233' !important;
        }
    </style>

    @yield('style')
</head>

<body>
    <div class="page-wrapper">

            <!-- header -->
     @include('frontend.layouts._header')
  

       <!-- main content-->
       @yield('content')

            <!-- footer -->
     @include('frontend.layouts._footer')

          


        
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

           <!-- Mobile Menu  -->
     @include('frontend.layouts.mobileMenu')

    

    <!-- Sign in / Register Modal -->
    @include('frontend.layouts.SignRegister')


    <!-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{url('public/frontend/assets/images/popup/newsletter/logo.png')}}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{url('public/frontend/assets/images/popup/newsletter/img-1.jpg')}}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <!-- Plugins JS File -->
    <script src="{{url('public/frontend/assets/js/jquery.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/superfish.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('public/frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{url('public/frontend/assets/js/main.js')}}"></script> 

    <script type="text/javascript">
    // <!-- Frontend form register -->
        $('body').delegate('#frontendFormRegister', 'submit',function(e) {
            
            e.preventDefault();
            // console.log('asalam o alykum');
            $.ajax({
              type : "POST",
              url  : "{{ url('frontend_auth_register') }}",
              data : $(this).serialize(),
              dataType : "json",
              success: function (data) 
              {
                alert(data.message);
                if (data.status) 
                 {
                    location.reload();
                 }
              },
              error: function (data) 
              {
                // body...
              }
            });
        });

        // <!-- Frontend login form -->
        $('body').delegate('#frontendFormLogin', 'submit',function(e) {
            
            e.preventDefault();
            // console.log('asalam o alykum');
            $.ajax({
              type : "POST",
              url  : "{{ url('frontend_auth_login') }}",
              data : $(this).serialize(),
              dataType : "json",
              success: function (data) 
              {
                if (data.status) 
                 {
                    location.reload();
                 }
                 else
                 {
                    alert(data.message);
                 }
              },
              error: function (data) 
              {
                // body...
              }
            });
        });


        // <!-- Add to wishlist -->
        $('body').delegate('.add_to_wishlist', 'click',function(e) {
            var product_id = $(this).attr('id');
            
            console.log('asalam o alykum');
            $.ajax({
              type : "POST",
              url  : "{{ url('add_to_wishlist') }}",
              data : {
                     "_token": "{{ csrf_token() }}",
                     product_id:product_id,
              },
              dataType : "json",
              success: function (data) {
                if (data.is_wishlist == 0) 
                 {
                    $('.add_to_wishlist'+product_id).removeClass('btn-wishlist-add');
                 }
                 else
                 {
                    $('.add_to_wishlist'+product_id).addClass('btn-wishlist-add');

                 }
              }
            });
        });
        
    </script>



    @yield('script') 

</body>


<!-- molla/index-2.html  22 Nov 2019 09:55:42 GMT -->
</html>