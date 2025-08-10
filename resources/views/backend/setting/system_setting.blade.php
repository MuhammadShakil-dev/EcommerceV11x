@extends('backend.layouts.app')
@section('style')
<!-- some page style -->
@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System Setting</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('validation._message')
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">

                  <div class="form-group">
                    <label>Website Name <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->website_name}}" name="website_name" placeholder="Enter Website Name">
                  </div>

                  <div class="form-group">
                    <label>Logo <span style="color:red;"></span></label>
                    <input type="file" class="form-control"  name="logo">
                    @if(!empty($getRecord->getLogo()))
                    <img src="{{$getRecord->getLogo()}}" style="width: 200px;">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Fevicon <span style="color:red;"></span></label>
                    <input type="file" class="form-control"  name="fevicon">
                    @if(!empty($getRecord->getFevicon()))
                    <img src="{{$getRecord->getFevicon()}}" style="width: 200px;">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Footer Description</label>
                    <textarea class="form-control" placeholder="footer description" name="footer_description">{{$getRecord->footer_description}}</textarea>
                  </div>

                  <div class="form-group">
                    <label>Footer Payment Icon <span style="color:red;"></span></label>
                    <input type="file" class="form-control"  name="footer_payment_icon">
                    @if(!empty($getRecord->getPaymentIcon()))
                    <img src="{{$getRecord->getPaymentIcon()}}" style="width: 200px;">
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                  <hr>
                  <div class="card-body">

                  <div class="form-group">
                    <label>Address <span style="color:red;"></span></label>
                    <textarea class="form-control" placeholder="Address" name="address">{{$getRecord->address}}</textarea>
                  </div>

                  <div class="form-group">
                    <label>Phone <span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->phone}}"  name="phone" placeholder="Phone">
                  </div>

                  <div class="form-group">
                    <label>Mobile <span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->mobile}}" name="mobile" placeholder="Mobile">
                  </div>

                  <div class="form-group">
                    <label>Email <span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->email}}" name="email" placeholder="Email">
                  </div>

                  <div class="form-group">
                    <label> Office Email <span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->office_email}}" name="office_email" placeholder="Office Email">
                  </div>

                  <div class="form-group">
                    <label>Submit Contact Email <span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->submit_contact_email}}" name="submit_contact_email" placeholder="Submit Contact Email">
                  </div>

                  <div class="form-group">
                    <label>Working Hour</label>
                    <textarea class="form-control" placeholder="Working Hour" name="working_hour">{{$getRecord->working_hour}}</textarea>
                  </div>
                </div>

                <hr>
                <div class="card-body">

                  <div class="form-group">
                    <label>Facebook Link<span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->facebook_link}}" name="facebook_link" placeholder="Facebook Link">
                  </div>

                  <div class="form-group">
                    <label>Twitter Link<span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->twitter_link}}" name="twitter_link" placeholder="Twitter Link">
                  </div>

                  <div class="form-group">
                    <label>Instagram Link<span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->instagram_link}}" name="instagram_link" placeholder="Instagram Link">
                  </div>

                  <div class="form-group">
                    <label>Youtube Link<span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->youtube_link}}" name="youtube_link" placeholder="Youtube Link">
                  </div>

                  <div class="form-group">
                    <label>Pinterest Link<span style="color:red;"></span></label>
                    <input type="text" class="form-control" value="{{$getRecord->pinterest_link}}" name="pinterest_link" placeholder="Pinterest Link">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('script')
<!-- some page script -->
@endsection