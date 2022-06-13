<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Concept From')

@section('sidebar')
   @include('member.investor.layouts.sidebar') 
@endsection

@section('header')
   @include('member.investor.layouts.header') 
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
                            <h3 class="fw-bolder m-0"> Concept Profile From </h3>
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
                        <form id="kt_account_profile_details_form" class="form" action="{{ url('/investor/create-concept') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
							<div style="font-size:24px; margin-bottom:10px;" class="row text-center"><b>Contact Information</b></div>
							
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Government Ministry/ Organization:</label>
                                    <input class="form-control" type="text" name="Government_name"value="{{old('Government_name')}}" placeholder="Enter Government Ministry/ Organization">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Department/ Agency:</label>
                                    <input class="form-control" type="text" name="Department"value="{{old('Department')}}" placeholder="Enter Department/ Agency">
                                </div>
                              </div>
                            </div>
                            <div class="row">      
                                <div class="col-lg-6">
                                  <div class="form-group mb-3">
                                    <label class="col-form-label">* Lead Point of Contact</label>
                                    <input class="form-control" type="text"  name="LeadPoint"value="{{old('LeadPoint')}}" placeholder="Enter Lead Point of Contact">
                                </div> 
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                      <label class="col-form-label">* Job Title</label>
                                      <input class="form-control" type="text"  name="job_title"value="{{old('job_title')}}" placeholder="Enter Job Title">
                                    </div>
                                </div>        
                            </div> 
							
							<div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Email Address:</label>
                                    <input class="form-control" type="text"  name="email"value="{{old('email')}}" placeholder="Enter Email Address">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Work Phone</label>
                                    <input class="form-control" type="text"  name="phone"value="{{old('phone')}}" placeholder="Enter Work Phone">
                                </div>
                              </div>
                            </div>
                           
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Mobile Phone:</label>
                                    <input class="form-control" type="text"  name="mobile"value="{{old('mobile')}}" placeholder="Enter Mobile Phone">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Mailing Address:</label>
                                    <input class="form-control" type="text" name="mailing_address"value="{{old('mailing_address')}}" placeholder="Enter Mailing Address">
                                </div>
                              </div>
                            </div>
                           
						   <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label"> City / District:</label>
                                    <input class="form-control" type="text"  name="city"value="{{old('city')}}" placeholder="Enter City / District">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">SKYPE ID:</label>
                                    <input class="form-control" type="text"  name="skyp_id"value="{{old('skyp_id')}}" placeholder="Enter SKYPE ID">
                                </div>
                              </div>
                            </div>
					 
                        <!--end::Form-->
                    </div>
					</div>
					<div class="card mb-5 mb-xl-10">
					<div class="card-body">
						<div style="font-size:24px; margin-bottom:10px;" class="row text-center"><b>Business/Project Validation</b></div>
					<div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Concept Name:</label>
                                    <input class="form-control" type="text"  name="concept_name"value="{{old('concept_name')}}" placeholder="Enter Concept Name">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Description of Concept:</label>
                                    <input class="form-control" type="text"  name="Description"value="{{old('Description')}}" placeholder="Enter Description of Concept">
                                </div>
                              </div>
                            </div>
							
							
							
							<div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Target Market and Marketing Channels:</label>
                                    <input class="form-control" type="text"  name="Marketing" value="{{old('Marketing')}}" placeholder="Enter Target Market and Marketing Channels">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Socio-Economic Benefits:</label>
                                    <input class="form-control" type="text"  name="Socio_Economic"value="{{old('Socio_Economic')}}" placeholder="Enter Socio-Economic Benefits">
                                </div>
                              </div>
                            </div>
							
							<div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Data Justification :</label>
                                    <input class="form-control" type="text"  name="data_justification"value="{{old('data_justification')}}" placeholder="Enter Data Justification">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">* Department/ Agency:</label>
                                    <input class="form-control" type="text" name="Department_Agency"value="{{old('Department_Agency')}}" placeholder="Enter Department/ Agency">
                                </div>
                              </div>
                            </div>
							<div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Any Other Components of Concept Ready Project:</label>
                                    <input class="form-control" type="text" name="Components" value="{{old('Components')}}"placeholder="Enter Any Other Components of Concept Ready Project">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">*Reference any relevant National visions / strategies / policies / master plans:</label>
                                    <input class="form-control" type="text" name="Reference"value="{{old('Reference')}}" placeholder="Enter Reference any relevant National visions / strategies / policies / master plans">
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
							
							  </form>
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

@endsection


@section('footer')
   @include('member.seller.layouts.footer') 
@endsection

