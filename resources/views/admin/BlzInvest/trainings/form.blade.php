@extends('admin.layouts.light.master')
@section('title', 'Add Training')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{url('blzinvst_training')}}" class="form theme-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Course Category</label>
                                    <select name="StreamName" id="stream_dropdown"
                                        class="form-control stream_dropdown js-example-basic-single" required>
                                        <option value="">Please Select Category</option>
                                        @foreach($Training_category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="text"  name="StreamName" placeholder="Stream Name">-->
                                    @error('StreamName')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Course Name</label>
                                    <select name="CourseName" id="CourseId" class="form-control course_dropdown"
                                        required>
                                        <option value="">Select Course Name</option>
                                        <option value=""></option>
                                    </select>
                                    @error('CourseName')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="col-form-label">Training Type</label>
                                <select name="Training_Type" class="form-control" required>
                                    <option value="">Select Training Type</option>
                                    <option value="1">Self-Paced</option>
                                    <option value="2">Instructor Led Training</option>
                                </select>
                                @error('Training_Type')
                                <div class="text-danger show"><strong>{{$message}}</strong></div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Training Name</label>
                                    <input class="form-control" type="text" value="{{old('TrainingName')}}"
                                        name="TrainingName" placeholder="Training Name">
                                    @error('TrainingName')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Course Type</label>
                                    <select name="CourseType" id="CourseType" class="form-control" required>
                                        <option value="">Select Course Name</option>
                                        <option value="1">Paid</option>
                                        <option value="0">Free</option>
                                    </select>
                                    @error('CourseType')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6" id="paid">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Training Duration</label>
                                    <input class="form-control" type="text" value="{{old('TrainingDuration')}}"
                                        name="TrainingDuration" placeholder="Training Duration">
                                    @error('TrainingDuration')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Training Start Date</label>
                                    <input class="form-control" type="Date" value="{{old('TrainingStartDate')}}"
                                        name="TrainingStartDate" placeholder="Training Start Date">
                                    @error('TrainingStartDate')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Training Image </label>
                                    <input class="form-control" type="file" value="{{old('TrainingImage')}}"
                                        name="TrainingImage">

                                    @error('TrainingImage')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Training Video</label>
                                    <input class="form-control" type="file" value="{{old('TrainingVideo')}}"
                                        name="TrainingVideo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label">Training Description</label>
                                    <textarea id="description" class="form-control"
                                        name="TrainingDescription">{{old('TrainingDescription')}}</textarea>
                                    @error('TrainingDescription')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label">Facilitator Description</label>
                                    <textarea id="FacilitatorDescription" class="form-control"
                                        name="FacilitatorDescription">{{old('FacilitatorDescription')}}</textarea>
                                    @error('FacilitatorDescription')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label">Facilitator Name</label>
                                    <input class="form-control" name="FacilitatorName"
                                        value="{{old('FacilitatorName')}}">
                                    @error('FacilitatorName')
                                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <button type="submit" class="btn btn-primary me-3">Add</button>
                                    <a href="{{url('blzinvst_training')}}"><button type="button"
                                            class="btn btn-danger">Cancel</button></a>
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
$("#CourseType").on('change', function() {
    var select = $(this).val();
    $("#paid").html('');
    if (select == 1) {
        $("#paid").append('<div class="form-group mb-3">\
                                    <label class="col-form-label">Training Fees</label>\
                                    <input type="text" name="trainingFees" class="form-control" require>\
                                </div>');
    }
});
</script>

<script>
$('body').on('change', '#stream_dropdown', function(e) {
    var stream_id = $(this).val();

    if (stream_id != '') {

        $("#CourseId").val('').trigger('change').prop('disabled', true);
        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            url: "{{ url('get_trainning_course') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                stream_id: stream_id
            },
            success: function(res) {

                $("#CourseId").val('').trigger('change');
                $("#CourseId").html('<option value="">Select Course</option>');
                $.each(res, function(key, value) {
                    $("#CourseId").append('<option value="' + key + '">' + value +
                        '</option>');
                });
                $("#CourseId").prop('disabled', false);
            }
        });
    } else {
        $('#CourseId').val('').trigger('change').html('<option value="">Select Course</option>');
        $("#CourseId").prop('disabled', false);
    }
});
</script>
@endsection