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
            <h1>Home Setting</h1>
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
                    <label>Trendy Product Title <span style="color:red;">*</span> </label>
                    <input type="text" required class="form-control" value="{{$getRecord->trendy_product_title}}" name="trendy_product_title" placeholder="Enter Trendy Product Title">
                  </div>

                  <div class="form-group">
                    <label>Shop Category Title <span style="color:red;">*</span> </label>
                    <input type="text"required class="form-control" value="{{$getRecord->shop_category_title}}" name="shop_category_title" placeholder="Enter Shop Category Title">
                  </div>

                  <div class="form-group">
                    <label>Recenta Arrival Title <span style="color:red;">*</span> </label>
                    <input type="text" required class="form-control" value="{{$getRecord->recenta_arrival_title}}" name="recenta_arrival_title" placeholder="Enter Recenta Arrival Title">
                  </div>

                  <div class="form-group">
                    <label>Blog Title <span style="color:red;">*</span> </label>
                    <input type="text" required class="form-control" value="{{$getRecord->blog_title}}" name="blog_title" placeholder="Enter Blog Title">
                  </div>

                  <br><hr>

                  <div class="form-group">
                    <label>Payment Delivery Title <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->payment_delivery_title}}" name="payment_delivery_title" placeholder="Enter Payment Delivery Title">
                  </div>

                  <div class="form-group">
                    <label>Payment Delivery Description <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->payment_delivery_description}}" name="payment_delivery_description" placeholder="Enter Payment Delivery Description">
                  </div>

                  <div class="form-group">
                    <label>Payment Delivery Image <span style="color:red;"></span> </label>
                    <input type="file" class="form-control"  name="payment_delivery_image">
                    @if(!empty($getRecord->getPaymentDeliveryImage()))
                    <img src="{{$getRecord->getPaymentDeliveryImage()}}" style="width: 200px;">
                    @endif
                  </div>

                  <br><hr>

                  <div class="form-group">
                    <label>Refund Title <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->refund_title}}" name="refund_title" placeholder="Enter Refund Title">
                  </div>

                  <div class="form-group">
                    <label>Refund Description <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->refund_description}}" name="refund_description" placeholder="Enter Refund Description">
                  </div>

                  <div class="form-group">
                    <label>Refund Image <span style="color:red;"></span> </label>
                    <input type="file" class="form-control"  name="refund_image">
                    @if(!empty($getRecord->getRefundImage()))
                    <img src="{{$getRecord->getRefundImage()}}" style="width: 200px;">
                    @endif
                  </div>


                  <br><hr>

                  <div class="form-group">
                    <label>Support Title <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->support_title}}" name="support_title" placeholder="Enter Support Title">
                  </div>

                  <div class="form-group">
                    <label>Support Description <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->support_description}}" name="support_description" placeholder="Enter Support Description">
                  </div>

                  <div class="form-group">
                    <label>Support Image <span style="color:red;"></span> </label>
                    <input type="file" class="form-control"  name="support_image">
                    @if(!empty($getRecord->getSupportImage()))
                    <img src="{{$getRecord->getSupportImage()}}" style="width: 200px;">
                    @endif
                  </div>



                  <br><hr>

                  <div class="form-group">
                    <label>SignUp Title <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->signup_title}}" name="signup_title" placeholder="Enter SignUp Title">
                  </div>

                  <div class="form-group">
                    <label>SignUp Description <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{$getRecord->signup_description}}" name="signup_description" placeholder="Enter SignUp Description">
                  </div>

                  <div class="form-group">
                    <label>SignUp Image <span style="color:red;"></span> </label>
                    <input type="file" class="form-control"  name="signup_image">
                    @if(!empty($getRecord->getSignupImage()))
                    <img src="{{$getRecord->getSignupImage()}}" style="width: 200px;">
                    @endif
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