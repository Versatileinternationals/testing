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
                <h2>Events Detail</h2>
            </div>
        </div>

        <div class="sectionGreen1 sectionWhite">
            <div class="container-fluid">
                <h2 class="text-center text-black">Event Details</h2>
				<hr>
				<div class="row"> 
				<div class="col-md-3"> 
				<h3 class="text-center text-black">{{$eventDetail->EventName}}</h3>
				<ul class="eventitem-meta event-meta event-meta-date-time-container text-center">

        

                 <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <time class="event-date" datetime="2022-02-26"><b>Event Start:</b>
				  <?php   $timestamp = strtotime($eventDetail->StartDate);
			              $Start_Date=date("d-M-Y", $timestamp); ?>
							{{  $Start_Date }}</time>		 
				</li>				
				  
				  
               
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                 <time class="event-date" datetime="2022-02-26"><b>Event End:</b>
				   <?php   $timestamp = strtotime($eventDetail->EndDate);
			              $End_Date=date("d-M-Y", $timestamp); ?>
				            {{  $End_Date }}
				          
				  </time>
                </li>
                
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <p>{{$eventDetail->EventAddress}}</p>
                </li>
        
              </ul>
			</div>
			<div class="col-md-5"> 
				<div class="imgEventList">
				  @if($eventDetail->EventImage)
                    <img src="{{url('assets/images/event/'.$eventDetail->EventImage)}}" alt="" title="" />
				@endif
                </div>
			
				<p>{!!html_entity_decode($eventDetail->Description)!!}</p>
			
			
				<div class="text-center" style="margin-top:20px">
				<a  href="{{url('events-register/'.base64_encode($eventDetail->id))}}" class="btn btn-secondary text-center">Join Event</a>
				</div>
			</div>
				
				
			<div class="col-md-4">
			<h3 class="text-center text-white Event_Calender">Event  Calender</h3>
			
  <div id='calendar'></div>
		
			<div class="Event_Category">
			<h3 class="text-center text-white">Event  Category</h3>
			<ul class="category_archive_list">
			<li class="text-center archive-group">
			<a href="/toronto/events?category=Networking" class="archive-group-name-link">Networking
			<span class="archive-group-count">(10)</span>
            </a>
		   </li>
      
			</ul>
			</div>
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
            var eventDetails = @json($EventDetails);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: eventDetails,
                selectable: true,
                selectHelper: true,
                
            });
        });
    </script>
@endsection
