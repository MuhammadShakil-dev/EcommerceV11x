@php
  $getSettingFooter = App\Models\Backend\SystemSetting::getSingle();
@endphp
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- Main Footer -->
  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2024-{{ date('Y') }} <a href="https://4dtech.com">4Ds Tech</a>.</strong> -->
    <strong>Copyright &copy; 2024-{{ date('Y') }} <a href="#">{{ $getSettingFooter->website_name }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.1
    </div>
  </footer>