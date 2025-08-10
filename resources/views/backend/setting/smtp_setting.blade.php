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
           <h1>SMTP Setting</h1>
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
                   <input type="text" required class="form-control" value="{{$getRecord->name}}" name="name">
                 </div>

                 <div class="form-group">
                   <label>Mail Mailer <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_mailer}}" name="mail_mailer">
                 </div>

                 <div class="form-group">
                   <label>Mail Host <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_host}}" name="mail_host">
                 </div>

                 <div class="form-group">
                   <label>Mail Port <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_port}}" name="mail_port">
                 </div>

                 <div class="form-group">
                   <label>Mail User name <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_user_name}}" name="mail_user_name">
                 </div>

                 <div class="form-group">
                   <label>Mail password <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_password}}" name="mail_password">
                 </div>

                 <div class="form-group">
                   <label>Mail Encryption <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_encryption}}" name="mail_encryption">
                 </div>

                 <div class="form-group">
                   <label>Mail Form Address <span style="color:red;">*</span> </label>
                   <input type="text" required class="form-control" value="{{$getRecord->mail_form_address}}" name="mail_form_address">
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