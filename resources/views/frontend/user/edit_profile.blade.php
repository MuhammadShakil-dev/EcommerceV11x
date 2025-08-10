@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
@endsection
@section('content')
 <main class="main">
        	<div class="page-header text-center">
        		<div class="container">
        			<h1 class="page-title">Edit Profile</h1>
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
	                			 @include('validation._message')
	                				
	                			<form action="" id="" method="post">
                                     {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" name="name" value="{{$getSingleRecord->name}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" value="{{$getSingleRecord->last_name}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Email address </label>
                                    <input type="email" name="email" value="{{$getSingleRecord->email}}" class="form-control" readonly>

                                    <label>Company Name (Optional)</label>
                                    <input type="text" name="company_name" value="{{$getSingleRecord->company_name}}" class="form-control">

                                    <label>Country *</label>
                                    <input type="text" name="country" value="{{$getSingleRecord->country}}" class="form-control" required>

                                    <label>Street address *</label>
                                    <input type="text"name="street_address_one" value="{{$getSingleRecord->street_address_one}}" class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" name="street_address_two" value="{{$getSingleRecord->street_address_two}}" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" name="city" value="{{$getSingleRecord->city}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>State *</label>
                                            <input type="text" name="state" value="{{$getSingleRecord->state}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" name="postcode" value="{{$getSingleRecord->postcode}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" name="phone" value="{{$getSingleRecord->phone}}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <button type="submit" style="width: 100px;" class="btn btn-outline-primary-2 btn-order btn-block">
	                                    <span>Submit</span>
                                    </button>

                                </form>
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

