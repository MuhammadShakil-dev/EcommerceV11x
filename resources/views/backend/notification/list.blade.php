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
            <h1>Notification List</h1>
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
                <h3 class="card-title">Notification List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <!-- <td>{{$value->id}}</td> -->
                      <td>
                         <a style=" {{ empty($value->is_read) ? 'font-weight:bold' : ''  }}" href="{{$value->url}}?notification_id={{ $value->id }}">
                          {{$value->message}}
                         </a>
                         <div>
                           <small>
                             {{ date('d-m-Y h:i A', strtotime($value->created_at)) }}
                           </small>
                          </div>           
                      </td>
                      
                      <td>
                       <!-- <a href="{{url('contacts/contactus/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a> -->
                       <!-- <a href="{{url('contacts/contactus/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a> -->
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