@extends('admin.layouts.light.master')
@section('title', 'Edit Event Listing')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit {{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('blzinvst_events/'.$BlzEvent->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Event Name</label>
                        <input class="form-control" type="text" value="{{old('EventName',$BlzEvent->EventName)}}" name="EventName" placeholder="Event Name">
                        @error('EventName')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Event Start Date</label>
                      <input class="form-control" type="Date" value="{{old('EventDate',$BlzEvent->StartDate)}}" name="StartDate" placeholder="Event Start Date">
                      @error('StartDate')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
				
				<div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Event End Date</label>
                        <input class="form-control" type="Date" value="{{old('EndDate',$BlzEvent->EndDate)}}" name="EndDate" placeholder="Event End Date">
                        @error('EndDate')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Event Start Time</label>
                      <input class="form-control" type="time" value="{{old('EventTime',$BlzEvent->EventTime)}}" name="EventTime" placeholder="Event Start Time">
                      @error('EventTime')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
				
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Event Type</label>
					  <select class="js-example-basic-single select2 col-sm-12 form-select" name="EventType" id="CourseType">   

                         <option value="" >Please Select Event Type</option>					  
                        <option value="1" {{old('EventType',$BlzEvent->EventType) =="1"? 'selected' : ''}}>Paid</option>
                        <option value="0" {{old('EventType',$BlzEvent->EventType) =="0"? 'selected' : ''}}>Free</option>
                      </select>  
                      @error('EventType')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror                     
                     
                                       
                      
                    </div>
                    
                  </div>
                <div class="col-6 paids" id="paid" >

                    </div>  
                    
                  
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Event Address</label>
                      <input class="form-control" type="text" value="{{old('EventAddress',$BlzEvent->EventAddress)}}" name="EventAddress" placeholder="Event Address">                      
                      @error('EventAddress')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
				  
                    <div class="form-group mb-3">
                      <label class="col-form-label">Event Image</label>
                      <input class="form-control" type="file"  name="EventImage" >

					 
                      
                    </div>
                  </div>              
                  <div class="col-6">
				  <img  src="{{url('assets/images/event/'.$BlzEvent->EventImage)}}" class="ïmg event-img">
				  
                  
          
                  </div>                 
                </div> 
				 <div class="row">
				<div class="col-12">
				<div class="form-group mb-3">
                      <label class="col-form-label">Description</label>
            <textarea class="form-control" id="description" name="Description" placeholder="Event Description">{{old('Description',$BlzEvent->Description)}}</textarea>
                      
                      @error('Description')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                     
                    </div>
				
				
				</div> 
				 </div> 
                <div class="row">      
                 <div class="col-6">
                    
          <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('VideoUpload',$BlzEvent->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('VideoUpload',$BlzEvent->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
          
                  </div>              
                </div> 
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('blzinvst_events')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                                    <label class="col-form-label">Event Fees</label>\
                                    <input type="text" name="Event_fees" value="{{old('Event_fees',$BlzEvent->Event_fees)}}" class="form-control events" require>\
                                </div>');
                               
    }
});
$( document ).ready(function() {
    
    var select = $("#CourseType").val();
    if (select == 1) {
         $("#paid").html('<div class="form-group mb-3">\
                                    <label class="col-form-label">Event Fees</label>\
                                    <input type="text" name="Event_fees" value="{{old('Event_fees',$BlzEvent->Event_fees)}}" class="form-control events" require>\
                                </div>');
    }         
    
});
</script>
@endsection