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
            <h1>Edit Blog</h1>
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
                    <label>Blog Title <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" required value="{{ $getRecord->title }}" name="title" placeholder="Enter Blog Title">
                  </div>

                  <div class="form-group">
                    <label>Category Name <span style="color:red;">*</span> </label>
                    <select class="form-control" name="blog_category_id" required>
                      <option value="">Select</option>
                      @foreach($getCategory as $category)
                      <option {{ ($getRecord->blog_category_id == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Image <span style="color:red;"></span></label>
                    <input type="file" class="form-control" name="image_name">
                    @if(!empty($getRecord->getImage()))
                    <img src="{{ $getRecord->getImage() }}" style="height: 200px;">
                    @endif
                  </div>

                      <div class="form-group">
                       <label>Short Description <span style="color:red;">*</span> </label>
                       <textarea class="form-control" required name="short_description" placeholder="Short Description">
                        {{ $getRecord->short_description }}
                       </textarea>
                      </div>

                      <div class="form-group">
                       <label>Description <span style="color:red;">*</span> </label>
                       <textarea class="form-control editor" name="description" placeholder="Description">
                         {{ $getRecord->description }}
                       </textarea>
                      </div>

                  <div class="form-group">
                    <label>Status <span style="color:red;">*</span></label>
                    <select class="form-control" required name="status">
                      <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>
                  </div>
                <!-- /.card-body -->

                  <hr>
                  <div class="card-body">

                  <div class="form-group">
                    <label>Meta title <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" required value="{{ $getRecord->meta_title }}" name="meta_title" placeholder="Meta title">
                  </div>
                  <div class="form-group">
                    <label>Meta description</label>
                    <textarea class="form-control" placeholder="Meta description" name="meta_description">{{ $getRecord->meta_description }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Meta keywords</label>
                    <input type="text" class="form-control" value="{{ $getRecord->meta_keywords }}" name="meta_keywords" placeholder="Meta keywords">
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