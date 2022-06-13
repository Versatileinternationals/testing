@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Self Paced Detail</h2>
            </div>
        </div>
		{{  $TrainingDetails }}
        <div class="sectionGreen1 sectionWhite">
            <div class="container-fluid">
                <h2 class="text-center text-black">Self Paced Training Details</h2>
				<hr>
				<div class="row"> 
				<div class="col-md-3"> 
				<h3 class="text-center text-black">{{$TrainingDetails->TrainingName}}</h3>
				<ul class="eventitem-meta event-meta event-meta-date-time-container text-center">

        

                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <time class="event-date" datetime="2022-02-26"><i class="fa-solid fa-calendar-days"></i>
				  <?php   $timestamp = strtotime($TrainingDetails->TrainingStartDate);
						  $Start_Date=date("d-M-Y", $timestamp);
				  ?>
				  {{$Start_Date}}
				  
				  </time>
                </li>
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <time class="event-date" datetime="2022-02-26">{{date('l, M d, Y',strtotime($TrainingDetails->TrainingStartDate))}}</time>
                </li>
               
        
                <li class="eventitem-meta-item eventitem-meta-date event-meta-item">
                  <p>{{$TrainingDetails->EventAddress}}</p>
                </li>
        
              </ul>
			</div>
			<div class="col-md-6"> 
				<div class="imgEventList">
                  
                </div>
			
				<p>{{$TrainingDetails->TrainingDescription}}</p>
			
				<div class="event_footer">
				
				
				</div>
				
			</div>
				
				
			<div class="col-md-3">
			<h3 class="text-center text-white Event_Calender">Event  Calender</h3>
			<p class="text-center"> Here Calender Wiil Show</p>
			
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

