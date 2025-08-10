@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->  
@endsection
@section('content')

<main class="main">

            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{url('public/frontend/assets/images/backgrounds/login-bg.jpg')}}')">
                <div class="container">
                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Forgot Password</a>
                                </li>

                                <!-- 
                                <li class="nav-item">
                                    <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                                </li> -->


                            </ul>
                            <div class="tab-content">
                                <div class="" style="display: block;">
                                    @include('validation._message')
                                    <form action="" method="post">
                                      {{ csrf_field() }}
                                        <div class="form-group" style="margin-top: 40px;">
                                            <label for="forgot-email">email address *</label>
                                            <input type="text" class="form-control" id="forgot-email" name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Forgot</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                         

                                        </div><!-- End .form-footer -->
                                    </form>
                                
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->

@endsection

@section('script')
<!-- some page script --> 
@endsection        