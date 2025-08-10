@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
<style type="text/css">
	.box-btn{
		padding: 10px;
        text-align: center;
        border-radius: 5px;
        /* border: 2px solid #fafafa; */
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
	}
</style>
@endsection
@section('content')
 <main class="main">
        	<div class="page-header text-center">
        		<div class="container">
        			<h1 class="page-title">Dashboard</h1>
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
	                				<div class="row">

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalUserOrder}}</div>
	                						    <div style="font-size: 16px;">Total Order</div>
	                						</div>	                					
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalUserTodayOrder}}</div>
	                						    <div style="font-size: 16px;">Today Order</div>
	                						</div>
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">${{ number_format($totalUserAmount, 2) }}</div>
	                						    <div style="font-size: 16px;">Total Amount</div>
	                						</div>
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">${{ number_format($totalUserTodayAmount, 2) }}</div>
	                						    <div style="font-size: 16px;">Today Amount</div>
	                						</div>	
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalPendingUser}}</div>
	                						    <div style="font-size: 16px;">Pending Order</div>
	                						</div>
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalInProgressUser}}</div>
	                						    <div style="font-size: 16px;">In Progress Order </div>
	                						</div>
	                					</div>

	                					<!-- <div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">5</div>
	                						    <div style="font-size: 16px;">Delivered Order</div>
	                						</div>
	                					</div> -->

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalCompletedUser}}</div>
	                						    <div style="font-size: 16px;">Completed Order</div>
	                						</div>
	                					</div>

	                					<div class="col-md-3" style="margin-bottom: 20px;">
	                						<div class="box-btn">
	                							<div style="font-size: 20px;font-weight: bold;">{{$totalCancelledUser}}</div>
	                						    <div style="font-size: 16px;">Cancelled Order</div>
	                						</div>
	                					</div>


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

