<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Add Testimonials')

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
                            <h3 class="fw-bolder m-0">Add Testimonials</h3>
							
							@if(session()->has('message'))
							<div class="alert alert-success">
								{{ session()->get('message') }}
							</div>
						@endif
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
                        <form id="kt_account_profile_details_form" class="form" action="{{ url('seller/store_testimonial') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Clinet Name</label>
                        <input class="form-control" type="text" value="{{old('name')}}" name="name" placeholder="Clinet Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                 <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Designation</label>
                      <input class="form-control" type="text" value="{{old('designation')}}" name="designation" placeholder="Enter Designation">                      
                      @error('event_type')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Country</label>
                      <input class="form-control" type="text" value="{{old('country')}}" name="country" placeholder="Enter country">   
                      @error('country')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
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

