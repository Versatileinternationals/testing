@extends('admin.layouts.light.master')
@section('title', 'Trainning Calender')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">{{$moduleName}}</li>
@endsection

@section('content')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
		        <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card box-shadow-title">
                  <div class="card-header">
                    <h5>{{$moduleName}}</h5>
                  </div>
                  <div class="d-flex event-calendar">
                     <div id="calendar"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="formData" method="post" enctype="multipart/form-data" action="/blzinvst_events">
            <input type="hidden" name="_token" value="34uacYqCiC8LrwXCeP4Kss6X6EzYa0YoD0bM3m8T">        <div class="row">
         <div class="col-md-6">
             Event Name
          <input type="text" class="form-control" id="EventName" name='EventName' placeholder='event name'>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Event Start Date
          <input type="date" class="form-control" id="StartDate" name='StartDate' palaceholder='event start date'>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Event End Date
          <input type="date" class="form-control" id="EndDate" name='EndDate' palaceholder='event end date'>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Event Start Time
          <input type="time" class="form-control" id="EventTime" name='EventTime' palaceholder='event start time'>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
             Select Event Type
          <select class=" col-sm-12 form-select" name="EventType" id="EventType">
              <option>Please Select Event Type</option>
              <option value='0'>Fee</option>
              <option value='1'>Paid</option>
          </select>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Event Address
          <input type="text" class="form-control" id="EventAddress" name='EventAddress' palaceholder='event address'>
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Image
          <input type="file" class="form-control" id="EventImage" name='EventImage' >
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            Description
          <textarea class="form-control" id="Description" name='Description' ></textarea>
          <span id="titleError" class="text-danger"></span>
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="saveBtn" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>    
   @if (Session::has('status'))
      $.notify({ message:'{!! session("status") !!}'},{
         type:'success',
         allow_dismiss:false,  
         icon: 'fa fa-check',                                          
         timer:500,
         delay:500 ,      
         placement:{
            from:'top',
            align:'center'
         },                                      
      });   
   @endif
 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var booking = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                 eventRender: function(event, element) {
                     $(element).tooltip({title: event.title});
                 }
            });

        });
    </script>
@endsection