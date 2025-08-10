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
            <h1>Slider List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a href="{{url('sliders/slider/add')}}" class="btn btn-primary" >Add New Slider</a>
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
                <h3 class="card-title">Slider List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Button Name</th>
                      <th>Button Link</th>
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
                        @if(!empty($value->getSliderImage()))
                        <img src="{{ $value->getSliderImage() }}" style="height: 100px;">
                        @endif
                      </td>
                      <td>{{$value->title}}</td>
                      <!-- <td>{{$value->image_name}}</td> -->
                      <td>{{$value->button_name}}</td>
                      <td>{{$value->button_link}}</td>
                      <td>{{($value->status == 0) ? 'Active' : 'Inactive'}}</td>
                      <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                      <td>
                       <a href="{{url('sliders/slider/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                       <a href="{{url('sliders/slider/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
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