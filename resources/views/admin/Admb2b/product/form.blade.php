@extends('admin.layouts.light.master')
@section('title', 'Add Product')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Add </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('product')}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('name')}}" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Sku</label>
                        <input class="form-control" type="text" value="{{old('sku')}}" name="sku" placeholder="Enter Sku">
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
                        <select class="js-example-basic-single select2 col-sm-12 form-select" name="category_id" id="category_id">                                                  
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
                          <select class="js-example-basic-single select2 col-sm-12 form-select" name="subcategory_id" id="subcategory_id">                                                  
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
                         
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Regular Price</label>
                          <input class="form-control" type="number" value="{{old('regular_price')}}" name="regular_price" placeholder="Product Regular Price">
                          @error('regular_price')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
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
                          <input class="form-control" type="number"  min="1" value="{{old('minimum_stock')}}" name="minimum_stock" placeholder="Enter Minimum Stock Value">
                          @error('minimum_stock')
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
                        <input class="form-control" type="file" name="main_image" placeholder="Image">
                       
                    </div>
                  </div>
              </div>    
              
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Weight(kg)</label>
                          <input class="form-control" type="number" value="{{old('weight')}}" name="weight" placeholder="Weight">
                         
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Length</label>
                          <input class="form-control" type="number" value="{{old('length')}}" name="length" placeholder="Length">
                        
                      </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Width(cm.)</label>
                          <input class="form-control" type="number" value="{{old('width')}}" name="width" placeholder="Width">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Height</label>
                          <input class="form-control" type="number" value="{{old('height')}}" name="height" placeholder="Height">
                         
                      </div>
                    </div>
                </div>  
               
                <div class="row">
                  
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="col-form-label">Tags</label>
                      <input class="form-control inputtags" type="text" value="{{old('tags')}}" name="tags" placeholder="Available Tags">
                     
                  </div>
                  </div>
                </div>  
               
               
                
                <div class="row">      
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="col-form-label">Description</label>
                      <textarea id="description" name="description" cols="30" rows="10">{{old('description')}}
                      </textarea>
                      @error('description')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                  </div>
                  </div>           
                </div>
               
                <div class="row">
                  <div class="col-lg-5">
                    @if( $errors->has('key.0') ) 
                    <div class="text-danger show"><strong>Specification key is required.</strong></div>
                    @endif
                  </div>
                  <div class="col-lg-5">
                    @if( $errors->has('value.0') ) 
                    <div class="text-danger show"><strong>Specification value is required.</strong></div>
                    @endif
                  </div>
                </div>

                
                <div class="row">      
                  
				  
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="0" {{old('status') =="0"? 'selected' : ''}}>Save As Draft</option>
                        <option value="1" {{old('status') =="1"? 'selected' : ''}}>Published</option>
                      </select>  
                     
                    </div>
                  </div>          
                </div>              
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('product')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('script')
<script>

jQuery(document).ready(function() {

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

    $('body').on('change', '#category_id', function(e){
        var categoryId = $(this).val();
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
    });

});
// Default ckeditor

</script>
@endsection