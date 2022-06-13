@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <!-- Content Code Start -->
    <article>
        <div>
            @if ($message = Session::get('error'))
                <script>alert('Choosen User is not allowed!!!')</script>
                
                @endif
        </div>
        <div class="homeSectionTop"> 
            <div class="img_homeBanner">
                <img src="assets/images/img_homebanner.jpg" alt="" title=""/>
                <div class="contentHomeBanner">
                    <div class="container">
                        <h2>
                            <span>BELTRAIDE'S </span>
                           VIRTUAL KNOWLEDGE CENTRE
                        </h2>
                    </div>
                </div>
            </div>
            <div class="imgRight">
                <img src="assets/images/image-animation.png" alt="" title=""/>
            </div>
        </div>
        
        <div class="sectionAbout text-white">
            <div class="imgCloud"><img src="assets/images/bg_cloud.png" alt="" title=""/></div>
            <div class="container">
                <h2 class="text-center">ABOUT</h2>
                <p>The Belize Trade and Investment Development Service (BELTRAIDE) is a statutory body of the Government of Belize. BELTRAIDE, a national economic development agency, operates within the portfolio of the Ministry of Finance,
                    Economic Development and Investment.</p>
                <div class="row rowAboutContent">
                    <div class="col-md-12">
                      <div class="boxVideoFree text-center">
                    <span class="iconPlay"><i class="far fa-play-circle"></i></span>
                    <h2 class="mb-2">Check Our Intro Video</h2>
                    <p class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                    <p><a href="#" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#videoModal">Our Training Videos</a> </p>
                </div>
                    </div>
					
					
                </div> 
				
            </div>   
        </div>

        <div class="sectionEvent text-white">
            <div class="container">
                <h2 class="text-center mb-1">Upcoming Events</h2>
                <p class="text-center mb-4"><strong>Choose your most popular leaning mentors, it will help you to achieve your professional goals.</strong></p>
                <div class="sliderEvents">
                    @foreach($EventLists as $EventList)
                    
                    <div>
                        <div class="boxEvent">
                            <a href="{{url('events-detail/'.base64_encode($EventList->id))}}">
                                <div class="imgEvent">
                                    <img src="{{url('assets/images/event/'.$EventList->EventImage)}}" alt="" title=""/>
                                </div>
                                <h6>{{$EventList->EventName}}</h6>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <!--div>
                        <div class="boxEvent">
                            <a href="#">
                                <div class="imgEvent">
                                    <img src="assets/images/service_image2.png" alt="" title=""/>
                                </div>
                                <h6>Sales & Marketing Coaching</h6>
                            </a>
                        </div>
                    </div-->
                </div>
            </div>
        </div>

        <div class="sectionTraning text-white">
            <div class="container">
                <h2 class="text-center mb-1">Top Free Trainings</h2>
                <p class="text-center mb-4"><strong>Are you looking to join online institutions? Now it's very simple, Sign up with mentoring </strong></p>
                <div class="boxVideoFree text-center">
                    <span class="iconPlay"><i class="far fa-play-circle"></i></span>
                    <h2 class="mb-2">Check Our Intro Video</h2>
                    <p class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                    <p><a href="#" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#videoModal">Our Training Videos</a> </p>
                </div>
            </div>
        </div>

        <div class="sectionTopTraining">
            <div class="container">
                <h2 class="text-center mb-4 text-white">TOP PAID TRAININGS</h2>
                <div class="row">
                    @foreach($TraininginLists as $TraininginList)
					
					@if(date("d-m-Y", strtotime($TraininginList->TrainingStartDate)) >= date('d-m-Y'))
						
                    <div class="col-md-6">
                        <div class="boxPaidTrainings">

                            <div class="imgTrainings">
                                
                                <img src="{{url('assets/images/img_homebanner.jpg')}}" alt="" title=""/>
                                
                            </div>
                            <div class="contentPaidTrainings">
                                <h3>{{$TraininginList->TrainingName}} ({{$TraininginList->CourseName}})</h3>
								<span class="Events_left">
                                    <i class="fa-solid fa-calendar-days"></i><h4> {{ date("d-m-Y", strtotime($TraininginList->TrainingStartDate))}}</h4>
                            </span>
								 <span class="Events_right">
                                    <h4><i class="fa-solid fa-timer"></i> {{$TraininginList->TrainingDuration}}</h4>
                                </span><br/><br>
                                <p>{!!html_entity_decode($TraininginList->TrainingDescription)!!}</p>
								
								
                                <span class="event_readmore"><a href="{{url('training-detail/'.base64_encode($TraininginList->id))}}" class="linkReadMore"> <i class="fas fa-long-arrow-alt-right"></i> Read More </a> </span>
								
								@if(Session::has('member_id'))
								<span class="event_register"><a href="{{url('training-registration/'.base64_encode($TraininginList->id))}}" class="btn btn-secondary">  Join Here </a> </span>
								@else
							   <span class="event_register"><a href="{{url('/user/login')}}" class="btn btn-secondary">  Join Here </a> </span>
							   @endif
								
								@if($TraininginList->trainingFees)
								<span class="training-fees"><b> {{$TraininginList->trainingFees}} BZ$ </b></span>
								@endif
                            </div>
                        </div>
                    </div>
					@endif
                    @endforeach
                    <!--div class="col-md-6">
                        <div class="boxPaidTrainings">
                            <div class="imgTrainings">
                                <img src="assets/images/img_homebanner.jpg" alt="" title=""/>
                            </div>
                            <div class="contentPaidTrainings">
                                <h3>Export Related Trainings</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                <p><a href="#" class="linkReadMore"> <i class="fas fa-long-arrow-alt-right"></i> Read More </a> </p>
                            </div>
                        </div>
                    </div-->
                </div>
            </div>
        </div>

        <div class="sectionServices text-white">
            <div class="container">
                <h2 class="text-center">Featured Products </h2>
                <div class="sliderServices darkbg">
                    @foreach($ProductLists as $ProductList)
                    <div>
                        <div class="boxEvent boxServices">
                            <a href="#">
                                <div class="imgEvent">
                                    <img src="{{url('assets/images/upload/'.$ProductList->main_image)}}" alt="" title=""/>
                                    
                                </div>
                                <h3><a href="{{url('seller-profile/'.base64_encode($ProductList->m_id))}}">{{$ProductList->name}}<a></h3>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="sectionTestimonials text-white">
            <div class="container">
                <h2 class="text-center mb-2">BELTRAIDE Client Testimonials</h2>
                <h3 class="text-center">Don't only hear us, But also check our client feedback</h3>
                <div class="sliderTestimonials">
                    
                    @foreach($ClientTestimonialLists as $ClientTestimonialList)
                    <div>
                        <div class="contentTestimonials">
                            <p>{{$ClientTestimonialList->description}}</p>
                            <div class="userDetail">
                                <div class="userImage">
                                    <img src="assets/images/img-user.png" alt="" title=""/>
                                </div>
                                <div class="userName">
                                    <h4>{{$ClientTestimonialList->name}}</h4>
                                    <h6>( {{$ClientTestimonialList->designation}} )</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="sectionCompanies text-white">
            <h2 class="text-center">Featured Export Ready Companies </h2>
            <div class="boxLogos">
                <div class="container">
                    <div class="row rowLogos align-items-center text-center company_slider">
                        
                        @foreach($BrandLists as $BrandList)
                        <div class="col">
                            <img src="{{url('assets/images/upload/'.$BrandList->image)}}" alt="" title=""/>
                        </div>
                        @endforeach
                    </div>
                </div>  
            </div>
             
        </div>


    </article>
    <!-- Content Code End -->

    

    <!-- Video Modal Code Start -->

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Free Trainings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video width="100%" controls>
                    <source src="assets/video/dummy_video.mp4" type="video/mp4">
                    Your browser does not support HTML video.
                  </video>                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Video Modal Code End-->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
