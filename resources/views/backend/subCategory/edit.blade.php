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
            <h1>Edit Sub Category</h1>
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
                    <label>Category Name <span style="color:red;">*</span> </label>
                    <select class="form-control" name="category_id">
                      <option value="">Select</option>
                      @foreach($getCategory as $value)
                      <option {{ ($value->id == $getRecord->category_id) ? 'selected': '' }} value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Category Name <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Enter Category">
                  </div>
                  <div class="form-group">
                    <label>Slug <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" required value="{{ old('slug', $getRecord->slug) }}" name="slug" placeholder="Enter Slug Ex. URL">
                    <div style="color:red;">{{ $errors->first('slug') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Status <span style="color:red;">*</span></label>
                    <select class="form-control" required name="status">
                      <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>
                  </div>
                <!-- /.card-body -->

                  <hr>
                  <div class="card-body">

                  <div class="form-group">
                    <label>Meta title <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" required value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title" placeholder="Meta title">
                  </div>
                  <div class="form-group">
                    <label>Meta description</label>
                    <textarea class="form-control" placeholder="Meta description" name="meta_description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Meta keywords</label>
                    <input type="text" class="form-control" value="{{ old('meta_keywords', $getRecord->meta_keywords) }}" name="meta_keywords" placeholder="Meta keywords">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Updated</button>
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