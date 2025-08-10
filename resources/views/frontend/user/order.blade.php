@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
@endsection
@section('content')
 <main class="main">
        	<div class="page-header text-center">
        		<div class="container">
        			<h1 class="page-title">Orders</h1>
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
						              <thead>
						                <tr>
						                  <th>Order Number</th>
						                  <th>Total Amount ($)</th>
						                  <th>Payment Method</th>
						                  <th>Status</th>
						                  <th>Created date</th>
						                  <th>Action</th>
						                </tr>
						              </thead>
						              <tbody>
						                @foreach($getUserRecord as $value)
						                <tr>
						                  <td>{{$value->order_number}}</td> 
						                  <td>{{number_format($value->total_amount, 2)}}</td>
						                  <td style="text-transform: capitalize;">{{$value->payment_method}}</td>
						                  <td>
						                  	 @if($value->status == 0)
											 Pending
											 @elseif($value->status == 1)
											 In Progress
											 @elseif($value->status == 2)
											 Delivered
											 @elseif($value->status == 3)
											 Completed
											 @elseif($value->status == 4)
											 Cancelled
											 @endif
						                  </td>
						                  <td>{{ date('d-m-Y h:i A',strtotime($value->created_at)) }}</td>
						                  <td>
						                   <a href="{{url('user/order/detail/'.$value->id)}}" class="btn btn-primary btn-sm">Detail</a>
						                  </td>
						                </tr>
						                @endforeach
						              </tbody>
						            </table>
						            <div style="padding: 10px; float: right;">
						              {!! $getUserRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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

