@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Events</h2>
            </div>
        </div>

        <div class="sectionGray sectionEventsListing">
            <div class="container">
                <h2 class="text-center text-white">Event Listing</h2>
                <p class="subheading text-center mb-4 text-white">Contrary to popular belief, Lorem Ipsum is not simply
                    random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000
                    years old </p>
                <div class="row rowEventListing">
                    @foreach($EventLists as $EventList)
                    <div class="col-md-4">
                        <div class="boxEventsList">
                            <div class="imgEventList">
                                <img src="{{url('assets/images/event/'.$EventList->EventImage)}}" alt="" title="" />
                            </div>

                            <div class="contentEventsList">
                               <!-- <div class="imgEventThumb">
                                    <img src="{{url('assets/images/event/'.$EventList->EventImage)}}" alt="" title="" />
                                </div>-->
                                <div class="headingEvents">
        <a href="{{url('events-detail/'.base64_encode($EventList->id))}}" title="{{$EventList->EventName}}">{{ substr_replace($EventList->EventName, "...", 60)}}</a>
                                </div>
								
								 
                            </div>
							<span class="Events_left">
                                    <h4>
									<?php   $timestamp = strtotime($EventList->StartDate);
									       $new_date=date("d-M-Y", $timestamp); ?>
									 
									 {{  $new_date }}</h4>
                            </span>
								 <span class="Events_right">
                                    <h4>{{$EventList->EventAddress}}</h4>
                                </span><br/>
							
                            <span class="text-left event-desc" style=" display: block;
                         
                          max-width: 100%;
                          height: 113px;
                          margin: 0 auto;
                          font-size: 14px;
                          line-height: 1;
                          -webkit-line-clamp: 3;
                          -webkit-box-orient: vertical;
                          overflow: hidden;
                          text-overflow: ellipsis;
                          width: 400px;">
							{!!html_entity_decode($EventList->Description)!!}
							</span>
							
                           @if(Session::get('member_id'))
							  
						<span class="text-center1 mb-4 event_register"><a href="{{url('events-register/'.base64_encode($EventList->id))}}" class="btn btn-secondary">Register</a> </span>	
							
						     @else
							<span class="text-center1 mb-4 event_register"><a href="{{url('events-register-guest/'.base64_encode($EventList->id))}}" class="btn btn-secondary"> Register</a> </span>
						   @endif
							 <span class="mb-0 event_readmore"><a href="{{url('events-detail/'.base64_encode($EventList->id))}}" class="btn btn-secondary">READ MORE</a> </span>
							
                        </div>
                        
                    </div>
                    @endforeach
                </div>
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary btn-white">View All <i class="fas fa-sort-down"></i></a>
                </p>
            </div>
        </div>
        </div>

       



    </article>
   
    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

