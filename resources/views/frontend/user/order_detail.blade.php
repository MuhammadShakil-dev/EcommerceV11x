@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->
<style type="text/css">
  .form-group {
    margin-bottom: 2px;
  }
</style>
@endsection
@section('content') 
 <main class="main">
        	<div class="page-header text-center">
        		<div class="container">
        			<h1 class="page-title">Orders Detail</h1>
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

	                				<!-- form start -->
					                <div class="">

					                  <div class="form-group">
					                    <label>Order Number : <span style="font-weight: normal;">{{ $getUserDetailRecord->order_number }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Name : <span style="font-weight: normal;">{{ $getUserDetailRecord->first_name }} {{ $getUserDetailRecord->last_name }} </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Compny Name : <span style="font-weight: normal;">{{ $getUserDetailRecord->company_name }} </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Country :{{ $getUserDetailRecord->country }}  </label> 
					                  </div>

					                  <div class="form-group">
					                    <label> Address : <span style="font-weight: normal;">{{ $getUserDetailRecord->street_address_one }}, {{ $getUserDetailRecord->street_address_two }} </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>City : <span style="font-weight: normal;">{{ $getUserDetailRecord->city }}  </span></label>
					                  </div>

					                  <div class="form-group"> 
					                    <label>State : <span style="font-weight: normal;">{{ $getUserDetailRecord->state }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Postcode : <span style="font-weight: normal;">{{ $getUserDetailRecord->postcode }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Phone : <span style="font-weight: normal;">{{ $getUserDetailRecord->phone }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Email : <span style="font-weight: normal;">{{ $getUserDetailRecord->email }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Discount Code : <span style="font-weight: normal;">{{ $getUserDetailRecord->discount_code }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Discount Amount ($) : <span style="font-weight: normal;">{{ number_format($getUserDetailRecord->discount_amount, 2) }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Shipping Name : <span style="font-weight: normal;">{{ $getUserDetailRecord->getShipping->name }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Shipping Amount ($) : <span style="font-weight: normal;">{{ number_format($getUserDetailRecord->shipping_amount, 2) }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Total Amount ($) : <span style="font-weight: normal;">{{ number_format($getUserDetailRecord->total_amount, 2) }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Payment Method : <span style="font-weight: normal; text-transform: capitalize;">{{ $getUserDetailRecord->payment_method }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Status : <span style="font-weight: normal;">

					             @if($getUserDetailRecord->status == 0)
											 Pending
											 @elseif($getUserDetailRecord->status == 1)
											 In Progress
											 @elseif($getUserDetailRecord->status == 2)
											 Delivered
											 @elseif($getUserDetailRecord->status == 3)
											 Completed
											 @elseif($getUserDetailRecord->status == 4)
											 Cancelled
											 @endif

					                     </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Notes : <span style="font-weight: normal;">{{ $getUserDetailRecord->notes }}  </span></label>
					                  </div>

					                  <div class="form-group">
					                    <label>Created date : <span style="font-weight: normal;">{{ date('d-m-Y h:i A',strtotime($getUserDetailRecord->created_at)) }}  </span></label>
					                  </div>

					                </div>
					                <!-- /.card -->
					                <br>
					                <!-- .Details -->
					                <div class="card">
						              <div class="card-header" style="margin-top: 20px;">
						                <h3 class="card-title">Product Details</h3>
						              </div>
						              <!-- /.card-header -->
						              <div class="card-body p-0" style="overflow: auto;">
						                <table class="table table-striped">
						                  <thead>
						                    <tr>
						                      <th>Image</th>
						                      <th>Product Name</th>
						                      <th>Qty</th>
						                      <th>Price </th>
						                      <th>Size Amount($)</th>
						                      <th>Total Amount($)</th>
						                    </tr>
						                  </thead>
						                  <tbody>
						                    @foreach($getUserDetailRecord->getItem as $item)

						                    @php
						                      $getProducrImage = $item->getProduct->getImageSingleFront($item->getProduct->id);
						                    @endphp

						                    <tr>
						                      <td>
						                        <img style="width: 100px; height: 100px;" src="{{$getProducrImage->getImageLog()}}">
						                      </td> 
						                      <td style="max-width: 250px;">
						                        <a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a>

						                        <br>
						                         @if(!empty($item->color_name))
						                         <b>Color Name</b>: {{$item->color_name}} <br/>
						                         @endif
						                         @if(!empty($item->size_name))
						                         <b>Size Name</b>: {{$item->size_name}}
						                         @endif
						                         <br><br>
						                         @if($getUserDetailRecord->status == 3)

						                          @php
						                          $getReview = $item->getReview($item->getProduct->id, $getUserDetailRecord->id);
						                          @endphp

						                          <hr>

						                          @if(!empty($getReview))
						                           <b>Rating</b> :{{ $getReview->rating }} <br>
						                           <b>Review</b> :{{ $getReview->review }} <br>
						                          @else
						                         <button class="btn btn-primary MakeReview" id="{{$item->getProduct->id}}" data-order={{ $getUserDetailRecord->id }}>Make Review</button>
						                          @endif

						                         @endif

						                      </td>
						                      <td>{{$item->quantity}}</td>
						                      <td>{{$item->price}}</td>
						                      <td>{{number_format($item->size_amount, 2)}}</td>
						                      <td>{{number_format($item->total_price, 2)}}</td>
						                    @endforeach
						                  </tbody>
						                </table>
						              </div>
						              <!-- /.card-body -->
						            </div>
					                <!-- /.Details -->




								</div>
	                		</div>
	                	</div>
	                </div>
                </div>
            </div>
        </main>

				<!-- Modal -->
				<div class="modal fade" id="makeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				     <form action="{{ url('user/make-review') }}" method="post">
                  {{ csrf_field() }}
				     	 <input type="hidden" required id="getProductId" name="product_id">
				     	 <input type="hidden" required id="getOrderId" name="order_id">
				       <div class="modal-body" style="padding: 20px;">
				        
				         <div class="form-group" style="margin-bottom: 15px;">
				        	 <label>How Many Rating/Star? *</label>
				        	 <select class="form-control" required name="rating">
				        		 <option value="">Select</option>
				        		 <option value="1">1</option>
				        		 <option value="2">2</option>
				        		 <option value="3">3</option>
				        		 <option value="4">4</option>
				        		 <option value="5">5</option>
				        	 </select>
				         </div>

				         <div class="form-group">
				        	 <label>Review *</label>
				        	 <textarea class="form-control" required name="review"></textarea>
				         </div>

				       </div>
				       <div class="modal-footer">
				         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Submit</button>
				       </div>
				     </form>
				    </div>
				  </div>
				</div>


@endsection
@section('script')
<!-- some page script -->
<script type="text/javascript">
$('body').delegate('.MakeReview', 'click', function() {
	var product_id = $(this).attr('id');
	var order_id = $(this).attr('data-order');

	$('#getProductId').val(product_id);
	$('#getOrderId').val(order_id);
	$('#makeReviewModal').modal('show');
});
	
</script>
@endsection 

