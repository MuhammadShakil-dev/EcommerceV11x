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
            <h1>Edit Page</h1>
          </div>
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
                    <label>Page Name <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Enter Page Name">
                  </div>

                  <div class="form-group">
                    <label>Page Title <span style="color:red;"></span> </label>
                    <input type="text" class="form-control" required value="{{ old('title', $getRecord->title) }}" name="title" placeholder="Enter Page Title">
                  </div>

                  <div class="form-group">
                    <label>Page Image<span style="color:red;"></span></label>
                    <input type="file" class="form-control"  name="image">
                    @if(!empty($getRecord->getPageImage()))
                     <img style="width: 150px; height: 150px;" src="{{$getRecord->getPageImage()}}">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Page Description <span style="color:red;"></span> </label>
                    <textarea class="form-control editor" name="description" placeholder="Description">{{ old('description', $getRecord->description) }}
                    </textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                  <hr>
                  <div class="card-body">

                  <div class="form-group">
                    <label>Page Meta title <span style="color:red;"></span></label>
                    <input type="text" class="form-control" required value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title" placeholder="Meta title">
                  </div>
                  <div class="form-group">
                    <label>Page Meta description</label>
                    <textarea class="form-control" placeholder="Meta description" name="meta_description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Page Meta keywords</label>
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