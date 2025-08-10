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
            <h1>Add New Discount Code</h1>
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
              <form action="" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Discount Code Name <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" required value="{{ old('name') }}" name="name" placeholder="Enter Discount Code Name">
                  </div>

                  <div class="form-group">
                    <label>type <span style="color:red;">*</span></label>
                    <select class="form-control" required name="type">
                      <option {{ (old('type') == 'Amount') ? 'selected' : '' }} value="Amount">Amount ($)</option>
                      <option {{ (old('type') == 'Percent') ? 'selected' : '' }} value="Percent">Percent (%)</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Percent / Amount<span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" required value="{{ old('percent_amount') }}" name="percent_amount" placeholder="Enter Percent / Amount">
                  </div>

                  <div class="form-group">
                    <label>Expire date<span style="color:red;">*</span> </label>
                    <input type="date" class="form-control" required value="{{ old('expire_date') }}" name="expire_date">
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