@extends('admin.layouts.light.master')
@section('title', 'Edit Product')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Edit </li>
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('product/'.$product->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('name',$product->name)}}" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Sku</label>
                        <input class="form-control" type="text" value="{{old('sku',$product->sku)}}" name="sku" placeholder="Enter Sku">
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
                          <option value="{{$value->id}}" {{old('category_id',$product->category_id) ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
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
                            @foreach ($subcategory as $value)
                            <option value="{{$value->id}}" {{old('subcategory_id',$product->subcategory_id) ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                            @endforeach
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
                          <input class="form-control" type="number" value="{{old('sale_price',$product->sale_price)}}" name="sale_price" placeholder="Product Sale Price">
                          @error('sale_price')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Regular Price</label>
                          <input class="form-control" type="number" value="{{old('regular_price',$product->regular_price)}}" name="regular_price" placeholder="Product Regular Price">
                          @error('regular_price')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label class="col-form-label">Brand</label>                          
                        <select class="js-example-basic-single select2 col-sm-12 form-select" name="brand" id="brand">                                                  
                          <option value="">Select Brand</option>
                          @foreach ($brand as $value)
                          <option value="{{$value->id}}" {{old('brand',$product->brand) ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                          @endforeach
                        </select>  
                        @error('brand')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Short Description</label>
                          <input class="form-control" type="text" value="{{old('short_description',$product->short_description)}}" name="short_description" placeholder="Enter Product Short Description">
                          @error('short_description')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Stock</label>
                          <input class="form-control" type="number" value="{{old('stock',$product->stock)}}" name="stock" placeholder="Stock">
                          @error('stock')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Minimum Stock</label>
                          <input class="form-control" type="number" value="{{old('minimum_stock',$product->minimum_stock)}}" name="minimum_stock" placeholder="Enter Minimum Stock Value">
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
                        <input class="form-control" min="1" type="number" value="{{old('max_order_qty',$product->max_order_qty)}}" name="max_order_qty" placeholder="Maximum Order Quantity">
                        @error('max_order_qty')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Product Image</label>
                        <input class="form-control" type="file" name="main_image" placeholder="Image">
                        <img src="{{url('assets/images/upload/'.$product->main_image)}}" class="form-img">
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
                          <input class="form-control" type="date" value="{{old('sale_start_date',$product->sale_start_date)}}" name="sale_start_date" placeholder="Sale Start Date">
                          @error('sale_start_date')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Sale End Date</label>
                          <input class="form-control" type="date" value="{{old('sale_end_date',$product->sale_end_date)}}" name="sale_end_date" placeholder="Sale End Date">
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
                          <input class="form-control" type="number" value="{{old('weight',$product->weight)}}" name="weight" placeholder="Weight">
                          @error('weight')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Length</label>
                          <input class="form-control" type="number" value="{{old('length',$product->length)}}" name="length" placeholder="Length">
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
                          <input class="form-control" type="number" value="{{old('width',$product->width)}}" name="width" placeholder="Width">
                          @error('width')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Height</label>
                          <input class="form-control" type="number" value="{{old('height',$product->height)}}" name="height" placeholder="Height">
                          @error('height')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                </div>  
                
                
                  <div class="row">
                    <div class="col-6">
                      <label class="col-form-label">Colors</label>
                      <div class="form-group">                       
                          <input class="form-control" type="color" value="{{old('colors',$product->colors)}}" name="colors" placeholder="Available Colors">
                          @error('colors')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Tags</label>
                          <input class="form-control inputtags" type="text" value="{{old('tags',$product->tags)}}" name="tags" placeholder="Available Tags">
                          @error('tags')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                  </div> 
               
                <div class="row">
                    
                    <div class="col-12">
                      <div class="form-group">
                          <label class="col-form-label">Purchase Note</label>
                          <input type= "text" class="form-control" name="purchase_note" value="{{old('purchase_note',$product->purchase_note)}}" placeholder="Purchase Note">
                          @error('purchase_note')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                </div>          
               
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Shipping Class</label>
                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="free" type="radio" {{old('shipping_class',$product->shipping_class == "free" ?'checked': '')}} name="shipping_class" value="free">
                            <label class="form-check-label mb-0" for="free">Free</label>
                          </div>
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="charge" type="radio" {{old('shipping_class',$product->shipping_class == "charge" ?'checked': '')}} name="shipping_class" value="charge">
                            <label class="form-check-label mb-0" for="charge">Chargable</label>
                          </div>                            
                        </div>
                        @error('shipping_class')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Cart Button Text</label>                          
                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="add_to_cart" type="radio" {{old('button_text',$product->button_text == "Add to Cart" ?'checked': '')}} name="button_text" value="Add to Cart">
                            <label class="form-check-label mb-0" for="add_to_cart">Add to Cart</label>
                          </div>
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="call_for_price" type="radio" {{old('button_text',$product->button_text == "Call For Price" ?'checked': '')}} name="button_text" value="Call For Price">
                            <label class="form-check-label mb-0" for="call_for_price">Call For Price</label>
                          </div>                            
                        </div>
                        @error('button_text')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
              </div> 
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Page Title</label>
                          <input class="form-control" type="text" value="{{old('page_title',$product->page_title)}}" name="page_title" placeholder="Page Title">
                          @error('page_title')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <label class="col-form-label">Page Meta Keyword</label>
                          <input class="form-control inputtags" type="text" value="{{old('page_keywords',$product->page_keywords)}}" name="page_keywords" placeholder="Page Meta Keyword">
                          @error('page_keywords')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                          <label class="col-form-label">Page Description</label>
                          <textarea class="form-control" name="page_description" placeholder="Page Description">{{old('page_description',$product->page_description)}}</textarea>
                          @error('page_description')
                          <div class="text-danger show"><strong>{{$message}}</strong></div>
                          @enderror
                      </div>
                    </div>
                  
                </div> 
                <div class="row">      
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="col-form-label">Description</label>
                      <textarea id="description" name="description" cols="30" rows="10">{{old('description',$product->description)}}
                      </textarea>
                      @error('description')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                  </div>
                  </div>           
                </div>
                <label class="col-form-label">Product Specification</label>
                @if(count($product->specification ) == 0)
                <div class="row specification-div">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <input class="form-control" type="text" name="key[]" placeholder="Title">
                    </div>
                  </div> 
                  <div class="col-lg-5">
                    <div class="form-group">
                      <input class="form-control"  type="text" name="value[]" placeholder="Value">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <button class="btn btn-success add" type="button" >+</button>
                    <button class="btn btn-danger minus" type="button" >-</button>
                  </div>
                </div>
                @else
                @foreach ($product->specification  as  $value)
                  <div class="row specification-div">
                    <div class="col-lg-5">
                      <div class="form-group">
                        <input class="form-control" type="text" value="{{$value->title}}" name="key[]" placeholder="Title">
                      </div>
                    </div> 
                    <div class="col-lg-5">
                      <div class="form-group">
                        <input class="form-control"  type="text" value="{{$value->value}}" name="value[]" placeholder="Value">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-success add" type="button" >+</button>
                      <button class="btn btn-danger minus" type="button" >-</button>
                    </div>
                  </div>
                @endforeach

                @endif
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
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Related Product</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" multiple name="related_product[]" id="related_product">                                                  
                        
                        @foreach ($products as $value)
                        <option value="{{$value->id}}" {{in_array($value->id,old('related_product',array_filter(explode(',',$product->related_product)))) ==true? 'selected' : ''}} >{{$value->name}}</option>    
                        @endforeach
                      </select>  
                      @error('related_product')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div> 
                </div>
                <div class="row">      
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <div class="media mb-2">
                        <label class="col-form-label m-r-10">Allow Customer Review:</label>
                        <div class="media-body text-right icon-state">
                          <label class="switch">
                            <input type="checkbox" name="allow_customer_review" value="1" {{$product->allow_customer_review == 1? 'checked':''}}>
                              <span class="switch-state"></span>
                          </label>
                        </div>
                      </div>
                      <div class="media mb-2">
                        <label class="col-form-label m-r-10">Sold Available:</label>
                        <div class="media-body text-right icon-state">
                          <label class="switch">
                            <input type="checkbox" name="sold_avaliable" value="1" {{$product->sold_avaliable == 1? 'checked':''}}>
                            <span class="switch-state"></span>
                          </label>
                        </div>
                      </div>
                      <div class="media mb-2">
                        <label class="col-form-label m-r-10">Allow Return:</label>
                        <div class="media-body text-right icon-state">
                          <label class="switch">
                            <input type="checkbox" name="allow_return" value="1" {{$product->allow_return == 1? 'checked':''}}>
                            <span class="switch-state"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="0" {{old('status',$product->status) =="0"? 'selected' : ''}}>Save As Draft</option>
                        <option value="1" {{old('status',$product->status) =="1"? 'selected' : ''}}>Published</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>          
                </div>               
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('product')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </form>
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

    $('.inputtags').on('click', function(e){
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

</script>
@endsection