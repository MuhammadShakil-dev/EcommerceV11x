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
            <h1>Contact Us List</h1>
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

             <form method="get">
             <div class="card">
               <div class="card-header">
                 <h3 class="card-title">Contact Us Serch</h3>
               </div>
              
               <div class="card-body">
                <div class="row">

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="id" placeholder="ID" class="form-control" value="{{Request::get('id')}}">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" placeholder=" Name" class="form-control" value="{{Request::get('name')}}">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" placeholder="Email" class="form-control" value="{{Request::get('email')}}">
                    </div>
                  </div>

                   <div class="col-md-2">
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{Request::get('phone')}}">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" name="subject" placeholder="Subject" class="form-control" value="{{Request::get('subject')}}">
                    </div>
                  </div>

                </div>

                 <div class="row">
                   <div class="col-md-12">
                     <button class="btn btn-primary">Serch</button>
                     <a href="{{url('contacts/contactus/list')}}" class="btn btn-primary">Reset</a>
                   </div>
                 </div>

               </div>

             </div>
            </form>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Us List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Login Name</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{$value->id}}</td>
                      <td>{{ !empty($value->getUser) ? $value->getUser->name : ''}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->phone}}</td>
                      <td>{{$value->subject}}</td>
                      <td>{{$value->message}}</td>
                      <td>{{$value->created_at}}</td>
                      <td>
                       <!-- <a href="{{url('contacts/contactus/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a> -->
                       <a href="{{url('contacts/contactus/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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