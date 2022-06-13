@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Training Detail</h2>
            </div>
        </div>
		
        <div class="sectionGreen1 sectionWhite">
            <div class="container-fluid">
                <h2 class="text-center text-black">Training Details</h2>
				<hr>
				<div class="row"> 
				<div class="col-md-3"> 
				<h3 class="text-center text-black">{{$TrainingDetails->TrainingName}}</h3>
				<ul class="eventitem-meta event-meta event-meta-date-time-container">
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <time class="event-date" datetime="2022-02-26"><b>Start Date:</b>
				  
				  <?php   $timestamp = strtotime($TrainingDetails->TrainingStartDate);
						  $Start_Date=date("d-M-Y", $timestamp);
				  ?>
				  {{$Start_Date}}
				  </time>
                </li>
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <time class="event-date" datetime="2022-02-26"><b>Facilitator’s Name:</b>{{ $TrainingDetails->FacilitatorName}}</time>
                </li>
               
			   <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                 <b >Facilitator’s Brief:</b> <p>{{$TrainingDetails->FacilitatorDescription}}</p>
                </li>
        
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <p>{{$TrainingDetails->EventAddress}}</p>
                </li>
				@if($TrainingDetails->trainingFees)
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                 <b>Training Fees: {{ $TrainingDetails->trainingFees}} BZ$</b>
                </li>
				@endif
              </ul>
			</div>
			<div class="col-md-5"> 
				<div class="imgEventList">
				 @if($TrainingDetails->TrainingImage)
                    <img src="{{url('assets/images/upload/'.$TrainingDetails->TrainingImage)}}" alt="" title="" />
				@endif
                </div>
			
				<p>{!!html_entity_decode($TrainingDetails->TrainingDescription)!!}</p>
				
				<div class="event_footer text-center">
				<a  href="{{url('training-registration/'.base64_encode($TrainingDetails->id))}}" class="btn btn-secondary text-center">Join Training</a>
				
				</div>
			</div>
			<div class="col-md-4">
			<h3 class="text-center text-white Event_Calender">Training  Calender</h3>
			<div id="calendar"></div>
			</div>	
            </div>
               <hr> 
        </div>
    </article>

    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {
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
                     $(element).tooltip({title: event.title},{description: event.description});
                 }
                });
        });
    </script>
@endsection
