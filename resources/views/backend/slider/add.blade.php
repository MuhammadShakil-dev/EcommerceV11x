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
            <h1>Add New Slider</h1>
          </div>
          <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Title <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" required value="{{ old('title') }}" name="title" placeholder="Enter Slider Title">
                  </div>

                  <div class="form-group">
                    <label>Image<span style="color:red;">*</span> </label>
                    <input type="file" class="form-control" required name="image_name">
                  </div>

                  <div class="form-group">
                    <label>Button Name <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{ old('button_name') }}" name="button_name" placeholder="Enter Button Name">
                  </div>

                  <div class="form-group">
                    <label>Button Link <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" value="{{ old('button_link') }}" name="button_link" placeholder="Enter Button Link">
                  </div>
                 
                  <div class="form-group">
                    <label>Status <span style="color:red;">*</span></label>
                    <select class="form-control" required name="status">
                      <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
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