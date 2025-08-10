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
            <h1>Category List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a href="{{url('categories/category/add')}}" class="btn btn-primary" >Add New Category</a>
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
            @include('validation._message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Meta title </th>
                      <th>Meta description</th>
                      <th>Meta keywords</th>
                      <th>Created by</th>
                      <th>Home</th>
                      <th>Menu</th>
                      <th>Status</th>
                      <th>Created date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{$value->id}}</td>
                      <td>
                        @if(!empty($value->getImage()))
                        <img src="{{ $value->getImage() }}" style="height: 100px;">
                        @endif
                      </td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->slug}}</td>
                      <td>{{$value->meta_title}}</td>
                      <td>{{$value->meta_description}}</td> 
                      <td>{{$value->meta_keywords}}</td>
                      <td>{{$value->created_by_name}}</td>
                      <!-- <td class="right badge badge-info">{{($value->status == 0) ? 'Active' : 'Inactive'}}</td> -->
                      <td>{{($value->is_home == 1) ? 'Yes' : 'No'}}</td>
                      <td>{{($value->is_menu == 1) ? 'Yes' : 'No'}}</td>
                      <td>{{($value->status == 0) ? 'Active' : 'Inactive'}}</td>
                      <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                      <td>
                       <a href="{{url('categories/category/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                       <a href="{{url('categories/category/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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