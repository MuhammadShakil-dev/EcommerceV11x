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
            <h1>Page List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a href="{{url('pages/page/add')}}" class="btn btn-primary" >Add New Page</a>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Page List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{$value->id}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->slug}}</td>
                      <td>{{$value->title}}</td>
                      <td>
                       <a href="{{url('pages/page/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                       <!-- <a href="{{url('pages/page/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a> -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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