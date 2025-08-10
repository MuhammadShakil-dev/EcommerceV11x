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
           <h1>Payment Setting</h1>
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
                   <label style="display: block;">Cash On Delivery (On/Off): <span style="color:red;"></span> </label>
                   <input type="checkbox" name="is_cash_delivery" {{ !empty($getRecord->is_cash_delivery) ? 'checked' : ''}}>
                 </div>

                 <hr><br>

                 <div class="form-group">
                   <label style="display: block;">Paypal (On/Off):<span style="color:red;"></span> </label>
                   <input type="checkbox" name="is_paypal" {{ !empty($getRecord->is_paypal) ? 'checked' : ''}}>
                 </div>

                 <div class="form-group">
                   <label>Paypal Email Id <span style="color:red;"></span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->paypal_id}}" name="paypal_id">
                 </div>

                 <div class="form-group">
                   <label>Paypal Status <span style="color:red;"></span> </label>
                   <select class="form-control" name="paypal_status">
                     <option {{ ($getRecord->paypal_status == 'sandbox') ? 'selected' : '' }} value="sandbox">Sandbox</option>
                     <option {{ ($getRecord->paypal_status == 'live') ? 'selected' : '' }} value="live">Live</option>
                   </select>
                 </div>

                  <br><hr><br>

                 <div class="form-group">
                   <label style="display: block;" >Stripe (On/Off):<span style="color:red;"></span> </label>
                   <input type="checkbox" name="is_stripe" {{ !empty($getRecord->is_stripe) ? 'checked' : '' }}>
                 </div>

                 <div class="form-group">
                   <label>Stripe Public Key <span style="color:red;"></span> </label>
                   <input type="text" class="form-control" value="{{$getRecord->stripe_public_key}}" name="stripe_public_key">
                 </div>

                 <div class="form-group">
                   <label>Stripe Secret Key <span style="color:red;"></span> </label>
                   <input type="text" class="form-control" value="{{$getRecord->stripe_secret_key}}" name="stripe_secret_key">
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