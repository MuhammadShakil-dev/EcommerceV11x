@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
@endsection
@section('content')
 <main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Notification</h1>
        </div>
    </div>
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br>
                <div class="row">
                    @include('frontend.user._sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <table class="table table-striped">
                              
                              <tbody>
                                @foreach($getRecordUser as $value)
                                <tr>
                                  <td style="padding: 12px;">
                                    <a style=" {{ empty($value->is_read) ? 'font-weight:bold' : ''  }}" href="{{$value->url}}?notification_id={{ $value->id }}">
                                    {{$value->message}}
                                    </a>
                                    <div>
                                        <small>
                                            {{ date('d-m-Y h:i A', strtotime($value->created_at)) }}
                                        </small>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                              {!! $getRecordUser->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection

@section('script')
<!-- some page script -->
@endsection 

