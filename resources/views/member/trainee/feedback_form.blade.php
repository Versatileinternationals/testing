<?php error_reporting(0); ?>

@extends('member.trainee.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.trainee.layouts.sidebar') 
@endsection

@section('header')
   @include('member.trainee.layouts.header') 
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">

            <div class="flex-md-row-fluid ms-lg-12">

                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0"> Feedback From </h3>
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


                        <form id="kt_account_profile_details_form" class="form"
                            action="{{ url('/trainee/feedback_form_do') }}" method="POST" enctype="multipart/form-data">
                            
                            {{ csrf_field() }}
                            <div style="font-size:24px; margin-bottom:10px;" class="row text-center"><b>Feedback Form</b></div>
<input type="hidden" name="feed_id" value="{{$feedback->id}}">
                            <div class="row">
                                <strong>How did you hear about the Virtual Knowledge Center E-learning Program ?</strong>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" value="Website">    
                                    <label class="col-form-label">Website</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" value="email">    
                                    <label class="col-form-label">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" vlaue="Word of month">    
                                    <label class="col-form-label">Word of month</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" value="TV/Radio add">    
                                    <label class="col-form-label">TV/Radio add</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" vlaue="Twitter">    
                                    <label class="col-form-label">Twitter </label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" value="Facebook">    
                                    <label class="col-form-label">Facebook </label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]"  value="Linkedin">    
                                    <label class="col-form-label">Linkedin </label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-2">
                                    <input type="checkbox" name="social[]" value="Other">    
                                    <label class="col-form-label">Other </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <strong>The time and fees invested to attend was valuable to my professional development</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="professional" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="professional" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="professional" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="professional" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="professional" vlaue="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <strong>The information was presented effectively.</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="information" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="information" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="information" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="information" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="information" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <strong>The program provided a good working knowledge of the subject matter presented.</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="working" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="working" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="working" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="working" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="working" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <strong>The objectives of the training were clearly defined.</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="training" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="training" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="training" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="training" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="training" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <strong>The objectives set forth were met.</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="forth" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="forth" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="forth" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="forth" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="forth" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <strong>Effective Activities.</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Effective"  value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Effective" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Effective" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Effective" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Effective" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <strong>Practical to my needs and interests</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Practical" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Practical" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Practical" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Practical" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Practical" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <strong>Useful Visual Aids and Handouts (Supporting Materials)</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Useful" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Useful" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Useful" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Useful" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="Useful" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <strong>The program allowed me to acquire skills and knowledge to manage my business more efficiently and/or improved my employability skills</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="skills" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="skills" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="skills" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="skills" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="skills" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <strong>The program allowed me to acquire skills and knowledge to manage my business more efficiently and/or improved my employability skills</strong>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="acquire" value="Strongly disagree">    
                                    <label class="col-form-label">Strongly disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="acquire" value="Disagree">    
                                    <label class="col-form-label">Disagree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="acquire" value="Neither">    
                                    <label class="col-form-label">Neither</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="acquire" value="Agree">    
                                    <label class="col-form-label">Agree</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-2">
                                    <input type="radio" name="acquire" value="Strongly agree">    
                                    <label class="col-form-label">Strongly agree</label>
                                    </div>
                                </div>
                            </div>


                            
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <button type="submit" class="btn btn-primary me-3">Add</button>
                                    <a href="{{url('product')}}"><button type="button"
                                            class="btn btn-danger">Cancel</button></a>
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
function getSubcategory(categoryId) {
    //var categoryId = $(this).val();

    if (categoryId != '') {
        $("#subcategory_id").val('').trigger('change').prop('disabled', true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('getSubcategory') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                category_id: categoryId
            },
            success: function(res) {
                $("#subcategory_id").val('').trigger('change');
                $("#subcategory_id").html('<option value="">Select Sub Category</option>');
                $.each(res, function(key, value) {
                    $("#subcategory_id").append('<option value="' + key + '">' + value +
                        '</option>');
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

    $('body').on('click', ".add", function() {
        var $tr = $(this).closest('.specification-div');
        var $clone = $tr.clone();
        console.log('$clone', $clone)
        $clone.find('input').val('');
        $tr.after($clone);
    });

    $('body').on('click', '.minus', function(event) {
        if ($(".specification-div").length > 1) {
            $(this).closest(".specification-div").remove();
        }
    });

    $(".inputtags").tagsinput({
        // confirmKeys: [13, 188]
    });

    $('.inputtags').on('keypress', function(e) {
        alert(e.keyCode);
        if (e.keyCode == 13) {
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