@extends('backend.layouts.app')
@section('style')
<!-- some page style -->

<!-- summernote Editor-->
  <!-- <link rel="stylesheet" href="{{url('public/assets/plugins/summernote/summernote-bs4.min.css')}}"> -->

@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
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

            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                       <label>Title <span style="color:red;">*</span> </label>
                       <input type="text" class="form-control" required value="{{ old('title', $product->title) }}" name="title" placeholder="Edit Product Title">
                      </div>
                     </div>

                      <div class="col-md-6">
                      <div class="form-group">
                       <label>SKU <span style="color:red;">*</span> </label>
                       <input type="text" class="form-control" required value="{{ old('sku', $product->sku) }}" name="sku" placeholder="Edit  SKU">
                     </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                       <label>Category <span style="color:red;">*</span> </label>
                       <select class="form-control" required id="changeCategory" name="category_id">
                         <option value="">Select</option>
                         @foreach($getCategory as $category)
                         <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{$category->id}}"> {{$category->name}} </option>
                         @endforeach
                       </select>
                     </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                       <label>Sub Category <span style="color:red;">*</span> </label>
                       <select class="form-control" required id="getSubCategory" name="sub_category_id">
                         <option value="">Select</option> 
                         @foreach($getSubCategory as $subCategory)
                         <option {{ ($product->sub_category_id == $subCategory->id) ? 'selected' : '' }} value="{{$subCategory->id}}"> {{$subCategory->name}} </option>
                         @endforeach
                       </select>
                     </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                       <label>Brand <span style="color:red;">*</span> </label>
                       <select class="form-control" name="brand_id">
                         <option value="">Select</option>
                         @foreach($getBrand as $brand)
                         <option {{ ($product->brand_id == $brand->id) ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name}}</option>
                         @endforeach
                       </select>
                     </div>
                    </div>

                    <div class="col-md-6" style="text-align: center;">
                      <div class="form-group">
                       <label>Trendy Product <span style="color:red;"></span> </label>
                       <div>
                       <label> <input  type="checkbox" name="is_trendy" {{ !empty($product->is_trendy) ? 'checked' : '' }}></label>
                       </div>
                     </div>
                    </div>


                  </div>

                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Colors <span style="color:red;">*</span> </label>
                       @foreach($getColor as $color)
                         @php
                           $checked = '';
                         @endphp
                          @foreach($product->getColor as $pColor)
                           @if($pColor->color_id == $color->id)
                             @php
                              $checked = 'checked';
                             @endphp
                           @endif
                          @endforeach
                         
                         <div>
                       <label> <input {{ $checked }} type="checkbox" name="color_id[]" value="{{$color->id}}"> {{$color->name}}</label>
                       </div>
                         @endforeach
                      </div>
                     </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                       <label>Price ($) <span style="color:red;">*</span> </label>
                       <input type="text" class="form-control" required value="{{ !empty($product->price) ? $product->price : '' }}" name="price" placeholder="Edit Product Price">
                      </div>
                     </div>

                      <div class="col-md-6">
                      <div class="form-group">
                       <label>Old Price ($) <span style="color:red;">*</span> </label>
                       <input type="text" class="form-control" required value="{{ !empty($product->old_price) ? $product->old_price : '' }}" name="old_price" placeholder="Edit  Old Price">
                     </div>
                     </div>
                  </div>

                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Size <span style="color:red;">*</span> </label>
                       <div>
                         <table class="table table-striped">
                          <thead>
                            <tr>
                             <th>Name</th>
                             <th>Price ($)</th>
                             <th>Action</th>
                           </tr>
                          </thead>
                          <tbody id="appendSize">
                            @php
                             $i_s = 1;
                            @endphp

                            @foreach($product->getSize as $size)
                              <tr id="deleteSize{{$i_s}}">
                              <td>
                                <input type="text" value="{{ $size->name }}" name="size[{{$i_s}}][name]" placeholder="Name" class="form-control">
                              </td>
                              <td>
                                <input type="text" value="{{ $size->price }}" name="size[{{$i_s}}][price]" placeholder="Price" class="form-control">
                              </td>
                              <td style="width: 100px;">
                                <button type="button" id="{{$i_s}}" class="btn btn-danger deleteSize">Delete</button>
                              </td>
                             </tr>
                              @php
                               $i_s++;
                              @endphp
                           @endforeach
                           <tr>
                              <td>
                                <input type="text" name="size[100][name]" placeholder="Name" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="size[100][price]" placeholder="Price" class="form-control">
                              </td>
                              <td style="width: 100px;">
                                <button type="button" class="btn btn-primary addSize">Add</button>

                                <!-- <button type="button" class="btn btn-danger deleteSize">Delete</button> -->
                              </td>
                            </tr>
                          </tbody>
                         </table>
                       </div>
                      </div>
                     </div>
                  </div>

                  <hr>
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                       <label>Image <span style="color:red;"></span> </label>
                       <input type="file" class="form-control" style="padding: 5px;" name="image[]" multiple accept="image/*">
                      </div>
                     </div>
                  </div>

                   @if(!empty($product->getImage->count()))
                     <div class="row" id="sortable">
                      @foreach($product->getImage as $image)
                        @if(!empty($image->getImageLog()))

                       <div class="col-md-1 sortableImage" id="{{$image->id}}" style="text-align: center;">
                         <img style="width: 100px; height: 100px;" src="{{$image->getImageLog()}}">
                         <a onclick="return confirm('Are you sure you want to delete?')" href="{{url('products/product/imageDelete/'.$image->id)}}" style="margin-top: 10px;" class="btn btn-danger btn-sm">Delete</a>
                       </div>
                        @endif
                       @endforeach
                     </div>
                   @endif



                  <hr> <br>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Short Description <span style="color:red;">*</span> </label>
                       <textarea class="form-control" name="short_description" placeholder="Short Description">{{ $product->short_description }}
                       </textarea>
                      </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Description <span style="color:red;">*</span> </label>
                       <textarea class="form-control editor" name="description" placeholder="Description">{{ $product->description }}
                       </textarea>
                      </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Additional Information<span style="color:red;">*</span> </label>
                       <textarea class="form-control editor" name="additional_information" placeholder="Additional Information">{{ $product->additional_information }}
                       </textarea>
                      </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group ">
                       <label>Shipping Returns<span style="color:red;">*</span> </label>
                       <textarea class="form-control editor" name="shipping_returns" placeholder="Shipping Returns">{{ $product->shipping_returns }}
                       </textarea>
                      </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       <label>Status <span style="color:red;">*</span></label>
                       <select class="form-control" required name="status">
                         <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Active</option>
                         <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                       </select>
                     </div>
                    </div>
                  </div>
                    

                  

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
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

 <!-- Summernote Editor-->
<!-- <script src="{{url('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script> -->
 <!-- sortable Image Plugins-->
<script src="{{url('public/assets/sortableImagePlugins/jquery-ui.js')}}"></script>

<script type="text/javascript">
  //sortable Image 
  $(document).ready(function(){
    $( "#sortable" ).sortable({
      update : function(event, ui){
        var photo_id = new Array();
        $('.sortableImage').each(function(){
          var id = $(this).attr('id');
          // console.log(id);
          photo_id.push(id);
        });
        // console.log(photo_id);
        $.ajax({
          type : "POST",
          url : "{{ url('products/product/sortableImage') }}",
          data : {
          "photo_id" : photo_id,
          // "_token" : "{{ csrf_field() }}"
          "_token" : "{{ csrf_token() }}"
          },
         dataType : "json",
         success: function(data){
         },
         error: function(data){}
        });
      }
    });
  });

  // Summernote Editor
    // $('.editor').summernote({
    //   height: 150
    // });


  var i = 101;
  $('body').delegate('.addSize', 'click', function(){
    // alert('asalam o alykum');
    var html = '<tr id="deleteSize'+i+'" >\n\
                              <td>\n\
                                <input type="text" name="size['+i+'][name]" placeholder="Name" class="form-control">\n\
                              </td>\n\
                              <td>\n\
                                <input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control">\n\
                              </td>\n\
                              <td>\n\
                                <button type="button" id="'+i+'" class="btn btn-danger deleteSize">Delete</button>\n\
                              </td>\n\
                            </tr>';

     i++;
     $('#appendSize').append(html);                   
  });


  $('body').delegate('.deleteSize', 'click', function(){
    var id= $(this).attr('id');
    // alert(id);
    $('#deleteSize'+id).remove();
  });


  $('body').delegate('#changeCategory', 'change', function(e){
    // e.preventDefault();
    var id = $(this).val();

    $.ajax({
      type : "POST",
      url : "{{ url('subCategories/subCategory/get_sub_categories') }}",
      data : {
        "id" : id,
        // "_token" : "{{ csrf_field() }}"
        "_token" : "{{ csrf_token() }}"
      },
      dataType : "json",
      success: function(data){
        $('#getSubCategory').html(data.html);
      },
      error: function(data){}
    });
  });
</script>
@endsection