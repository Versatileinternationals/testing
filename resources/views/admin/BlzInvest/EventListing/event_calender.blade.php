@extends('admin.layouts.light.master')
@section('title', 'Users')

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
            @csrf
        <div class="row">
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
        <div class="col-6" id="paid">

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
                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');
                    $(document).on('submit','#saveBtn',function(e){
                     e.preventDefault();
                     let form = new FormData($('#formData')[0]);
                     $.ajax({
                            url:"/blzinvst_events",
                            type:"POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType:'json',
                            data:form,
                            success:function(result)
                            {
                                alert(result);
                            }
                    });
                   
                })
                },
               
                editable: true,
                eventDrop: function(event) {
                    var id = event.id;
                    alert(id);
                    var StartDate = moment(event.start).format('YYYY-MM-DD');
                   /// var StartDate = moment(event.end).format('YYYY-MM-DD');
                    $.ajax({
                            url:'/blzinvst_events/'+id,
                            type:"post",
                            dataType:'json',
                            data:{ StartDate  },
                            success:function(response)
                            {
                                swal("Good job!", "Event Updated!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                },
                // eventClick: function(event){
                //     var id = event.id;

                //     if(confirm('Are you sure want to remove it')){
                //         $.ajax({
                //             url:'',
                //             type:"DELETE",
                //             dataType:'json',
                //             success:function(response)
                //             {
                //                 $('#calendar').fullCalendar('removeEvents', response);
                //                 // swal("Good job!", "Event Deleted!", "success");
                //             },
                //             error:function(error)
                //             {
                //                 console.log(error)
                //             },
                //         });
                //     }

                // },
                // selectAllow: function(event)
                // {
                //     return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                // },



            });


            $("#bookingModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });

            $('.fc-event').css('font-size', '13px');
            $('.fc-event').css('width', '20px');
            $('.fc-event').css('border-radius', '50%');


        });
    </script>
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
<script>
$("#EventType").on('change', function() {
    var select = $(this).val();
    $("#paid").html('');
    if (select == 1) {
        $("#paid").append('<div class="form-group">\
                                    <label class="col-form-label">Event Fees</label>\
                                    <input type="text" name="EventFees" class="form-control" require>\
                                </div>');
                                
    }
});
</script>
@endsection