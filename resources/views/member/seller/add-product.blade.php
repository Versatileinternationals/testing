<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.seller.layouts.sidebar') 
@endsection

@section('header')
   @include('member.seller.layouts.header') 
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            
            <div class="flex-md-row-fluid ms-lg-12">
                
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Add Product</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">
                        <!--begin::Form-->
                        <!--error msg -->
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                        <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                        @endif
                        <!--error msg -->
                        <form id="kt_account_profile_details_form" class="form" action="{{ url('seller/add-product') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control" type="text" value="{{old('name')}}" name="name" onblur="aaa()" placeholder="Enter Name" required>
                                    @error('name')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Sku</label>
                                    <input class="form-control" type="text" value="{{old('sku')}}" name="sku" placeholder="Enter Sku" required>
                                    @error('sku')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                              </div>
                            </div>
                            <div class="row">      
                                <div class="col-lg-6">
                                  <div class="form-group mb-3">
                                    <label class="col-form-label">Category</label>
                                    <select class="js-example-basic-single select2 col-sm-12 form-select" name="category_id" id="category_id" onchange="getSubcategory(this.value)" required>                                                  
                                      <option value="">Select Category</option>
                                      @foreach ($category as $value)
                                      <option value="{{$value->id}}" {{old('category_id') ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                                      @endforeach
                                    </select>  
                                    @error('category_id')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                  </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                      <label class="col-form-label">Sub Category</label>
                                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="subcategory_id" id="subcategory_id" required>                                                  
                                        <option value="">Select Sub Category</option>
                                      </select>  
                                      @error('subcategory_id')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                    </div>
                                </div>        
                            </div> 
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Sale Price</label>
                                      <input class="form-control" type="number" value="{{old('sale_price')}}" name="sale_price" placeholder="Product Sale Price">
                                      @error('sale_price')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Regular Price</label>
                                      <input class="form-control" type="number" value="{{old('regular_price')}}" name="regular_price" placeholder="Product Regular Price" required>
                                      @error('regular_price')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                            </div>   
                            <input type="hidden" name="company" value="{{$sellerData->company}}">
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Brand</label>                          
                                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="brand" id="brand" required>                                                  
                                        <option value="">Select Brand</option>
                                        @foreach ($brand as $value)
                                        <option value="{{$value->id}}" {{old('brand') ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                                        @endforeach
                                      </select>  
                                      @error('brand')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                 <!-- <div class="form-group">
                                      <label class="col-form-label">Short Description</label>
                                      <input class="form-control" type="text" value="{{old('short_description')}}" name="short_description" placeholder="Enter Product Short Description">
                                      @error('short_description')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>-->
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Stock</label>
                                      <input class="form-control" type="number"  min="0" value="{{old('stock')}}" name="stock" placeholder="Stock">
                                      @error('stock')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Minimum Stock</label>
                                      <input class="form-control" type="number"  min="1" value="{{old('minimum_stock')}}" name="minimum_stock" placeholder="Enter Minimum Stock Value" required>
                                      @error('short_description')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                            </div> 
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Maximum Order Quantity</label>
                                    <input class="form-control" min="1" type="number" value="{{old('max_order_qty')}}" name="max_order_qty" placeholder="Maximum Order Quantity">
                                    @error('max_order_qty')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Product Image</label>
                                    <input class="form-control" type="file" name="main_image" placeholder="Image" required>
                                    @error('main_image')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                              </div>
                            </div>    
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Sale Start Date</label>
                                      <input class="form-control" type="date" value="{{old('sale_start_date')}}" name="sale_start_date" placeholder="Sale Start Date" required>
                                      @error('sale_start_date')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Sale End Date</label>
                                      <input class="form-control" type="date" value="{{old('sale_end_date')}}" name="sale_end_date" placeholder="Sale End Date" required>
                                      @error('sale_end_date')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Weight(kg)</label>
                                      <input class="form-control" type="number" value="{{old('weight')}}" name="weight" placeholder="Weight" required>
                                      @error('weight')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Length(cm.)</label>
                                      <input class="form-control" type="number" value="{{old('length')}}" name="length" placeholder="Length" >
                                      @error('length')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Width(cm.)</label>
                                      <input class="form-control" type="number" value="{{old('width')}}" name="width" placeholder="Width">
                                      @error('width')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                      <label class="col-form-label">Height(cm.)</label>
                                      <input class="form-control" type="number" value="{{old('height')}}" name="height" placeholder="Height">
                                      @error('height')
                                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                                      @enderror
                                  </div>
                                </div>
                            </div>  
                           
                            <div class="row">
							<div class="col-lg-6">
                                <div class="form-group">
                                  <label class="col-form-label">Tags</label>
                                  <input class="form-control inputtags" type="text" value="{{old('tags')}}" name="tags" placeholder="Available Tags">
                                  @error('tags')
                                  <div class="text-danger show"><strong>{{$message}}</strong></div>
                                  @enderror
                              </div>
                              </div>
                              <!--<div class="col-6">  -->
                              <!--  <label class="col-form-label">Status</label>-->
                              <!--    <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  -->
                              <!--      <option value="0" {{old('status') =="0"? 'selected' : ''}}>InActive</option>-->
                              <!--      <option value="1" {{old('status') =="1"? 'selected' : ''}}>Active</option>-->
                              <!--    </select>  -->
                              <!--    @error('status')-->
                              <!--    <div class="text-danger show"><strong>{{$message}}</strong></div>-->
                              <!--    @enderror-->
                              <!--</div>-->
                              
                            </div>  
                          
                           
                            <div class="row">      
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label class="col-form-label">Description</label>
                                  <textarea class="ckeditor form-control" id="description" name="description" cols="30" rows="10" required>{{old('description')}}
                                  </textarea>
                                  @error('description')
                                  <div class="text-danger show"><strong>{{$message}}</strong></div>
                                  @enderror
                              </div>
                              </div>           
                            </div>
                           <br>
                            <div class="row">
                              <div class="col-12">
                                <div>
                                  <button type="submit" class="btn btn-primary me-3">Add</button>
                                  <a href="{{url('product')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                </div>
                              </div>
                            </div>
                        
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                
            </div>
            <!--end::Layout-->
        </div>
    </div>
    <!--end::Container-->
</div>
		
<script>

function getSubcategory(categoryId){
    //var categoryId = $(this).val();
    
    if (categoryId != '') {
        $("#subcategory_id").val('').trigger('change').prop('disabled', true);
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url:"{{ url('getSubcategory') }}",
            type:'POST',
            dataType:'json',
            data:{
              category_id:categoryId
            },
            success:function(res){
                $("#subcategory_id").val('').trigger('change');
                $("#subcategory_id").html('<option value="">Select Sub Category</option>');
                $.each(res,function(key,value) {
                  $("#subcategory_id").append('<option value="'+key+'">'+value+'</option>');
                });
                $("#subcategory_id").prop('disabled', false);
            }
        });
    } else {
        $('#subcategory_id').val('').trigger('change').html('<option value="">Select Sub Category</option>');
        $("#subcategory_id").prop('disabled', false);
    }
    
}
    
$(document).ready(function() {

    $('body').on('click',".add",function(){
        var $tr = $(this).closest('.specification-div');
        var $clone = $tr.clone();
        console.log('$clone',$clone)            
        $clone.find('input').val('');
        $tr.after($clone);
    });

    $('body').on('click','.minus' ,function(event){
        if($(".specification-div").length > 1){
            $(this).closest(".specification-div").remove();                
        }
    });

  $(".inputtags").tagsinput({
        // confirmKeys: [13, 188]
      });

    $('.inputtags').on('keypress', function(e){
        alert(e.keyCode);
        if (e.keyCode == 13){
          e.keyCode = 188;
          e.preventDefault();
        };
      });

    

});
// Default ckeditor

</script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection


@section('footer')
   @include('member.seller.layouts.footer') 
@endsection

