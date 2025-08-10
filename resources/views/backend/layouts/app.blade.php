@php
  $getSettingHeader = App\Models\Backend\SystemSetting::getSingle();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <title> {{ !empty($header_title) ? $header_title : '' }}| Ecommerce</title> -->
  <title> {{ !empty($header_title) ? $header_title : '' }}| {{ $getSettingHeader->website_name }}</title>

  <link rel="shortcut icon" href="{{ $getSettingHeader->getFevicon() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('public/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/assets/dist/css/adminlte.min.css')}}">
  <!-- summernote Editor-->
  <link rel="stylesheet" href="{{url('public/assets/plugins/summernote/summernote-bs4.min.css')}}">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">
  <!-- ======= Header and Sidebar ======= -->
     @include('backend.layouts.header')

     @include('backend.layouts.sidebar')
  <!-- ======= End Header and Sidebar ======= -->
  

     <!-- main content-->
     @yield('content')

  <!-- ======= Footer ======= -->
     @include('backend.layouts.footer')
</div>


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{url('public/assets/dist/js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{url('public/assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('public/assets/dist/js/demo.js')}}"></script>
<!-- Summernote Editor-->
<script src="{{url('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript">
  // Summernote Editor
    $('.editor').summernote({
      height: 150
    });
</script>
@yield('script')
</body>
</html>
