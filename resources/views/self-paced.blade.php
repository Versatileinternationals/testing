@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionInvestment">
            <div class="container">
                <div class="row rowInvestmentContent align-items-center">
                    <div class="col-md-8">
                        <h2>Self Paced Training</h2>
                    </div>
                    <div class="col-md-4">
                        <div class="boxSelectCource">
                            <h2>Select Course </h2>
                            <form action="{{url('self-paced')}}" method="POST">
                                @csrf
							     <div class="input-area">
                                    <select class="form-select" name="StreamName" onchange="getCourse(this.value)">
									    <option value="">Select Categories</option>
									    @foreach($Stream as $course_cat)
                                        
										<option value="{{ $course_cat->id }}">{{ $course_cat->name }}</option>
									    @endforeach
                                    </select>
                                </div>
                                <div class="input-area">
                                    <select class="form-select" name="CourseName" id="CourseId">
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
								
                                <div class="input-area">
                                    <select class="form-select" name="CourseType">
                                        <option value="">Select Course Type</option>
									    <option value="0">Free</option>
									    <option value="1">Paid</option>
                                    </select>
                                </div>
								<button type="submit" class="btn btn-primary me-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
		
        <div class="sectionELearning text-center">
            <div class="container">
                <h2 class="mb-2">E-Learning</h2>
                <p class="subheading">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
            </div>
        </div>

        <div class="sectionTraning text-white">
            <div class="container-fluid">
                <h2 class="text-center mb-1">Self-paced</h2>
                <p class="text-center mb-4"><strong>Are you looking to join online institutions? Now it's very simple, Sign up with mentoring </strong></p>
                <div class="align-items-center text-center self_video">
                        
                    <div class="col">
                        <iframe  src="https://www.youtube.com/embed/ptmUMgpkrEQ" allowfullscreen></iframe>
                    </div>
                    <div class="col">
                        <iframe  src="https://www.youtube.com/embed/Yhp8R94Z54o" allowfullscreen></iframe>
                    </div>
					
					<div class="col">
                       <iframe  src="https://www.youtube.com/embed/ptmUMgpkrEQ" allowfullscreen></iframe>
                    </div>
					<div class="col">
                       <iframe  src="https://www.youtube.com/embed/Yhp8R94Z54o" allowfullscreen></iframe>
                    </div>
					<div class="col">
                        <iframe  src="https://www.youtube.com/embed/ptmUMgpkrEQ" allowfullscreen></iframe>
                    </div>
                </div>
				
			</div>
        </div>
            

        <div class="sectionTopTraining">
            <div class="container">
                <h2 class="text-center mb-4 text-white">Self Paced Training Upcoming </h2>
                <div class="row">
                    @foreach($SelfPacedLists as $SelfPacedList)
					
                    <div class="col-md-6">
                        <div class="boxPaidTrainings">
                            <div class="imgTrainings">
                                <img src="assets/images/img_homebanner.jpg" alt="" title=""/>
                            </div>
                            <div class="contentPaidTrainings">
                                <h3>{{$SelfPacedList->TrainingName}}</h3>
								<span class="Events_left">
                                    <i class="fa-solid fa-calendar-days"></i>
									<h4>
									<?php   $timestamp = strtotime($SelfPacedList->TrainingStartDate);
											$Start_Date=date("d-M-Y", $timestamp);
									?>
									{{ $Start_Date}}
									</h4>
                            </span>
								 <span class="Events_right">
                                    <h4><i class="fa-solid fa-timer"></i> {{$SelfPacedList->TrainingDuration}}</h4>
                                </span><br/><br>
                                <p>{!!html_entity_decode($SelfPacedList->VideoDescription)!!}</p>
                        
                                <span class="event_readmore"><a href="{{url('training-detail/'.base64_encode($SelfPacedList->id))}}" class="linkReadMore"> <i class="fas fa-long-arrow-alt-right"></i> Read More </a> </span>
							   @if(Session::has('member_id'))
								<span class="event_register"><a href="{{url('training-registration/'.base64_encode($SelfPacedList->id))}}" class="btn btn-secondary">  Join Here </a> </span>
							   @else
							   <span class="event_register"><a href="{{url('/user/login')}}" class="btn btn-secondary">  Join Here </a> </span>
							   @endif
							    	@if($SelfPacedList->trainingFees)
								<span class="training-fees"><b> {{$SelfPacedList->trainingFees}} BZ$ </b></span>
								@endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary">View All <i class="fas fa-sort-down"></i></a>
                </p>
            </div>
        </div>
       <!-- <div class="boxCalendar text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 headingCalander">
                        <h2><span>Training</span> Calendar 2022 </h2>
                        <h3>Browse the calendar to see a list of upcoming training:-</h3>
                    </div>
                    <div class="col-md-6">
                        <img src="assets/images/image-calander.png" alt="" title=""/>
                    </div>
                </div>
            </div>
        </div> -->
		

       <!-- <div class="boxListServices">
            <div class="container">
                <h2 class="text-center mb-1">Services</h2>
                <p class="text-center mb-4 subheading">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                <div class="listServicesInner">
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image4.png" alt="" title="" /></a> 
                        </div>
                        <h2>Export Belize Development And Promotion </h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                        <p><a href="#" class="link">Other Material </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image5.png" alt="" title="" /></a>
                        </div>
                        <h2>Small Business Development</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                        <p><a href="#" class="link">Other Material </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image6.png" alt="" title="" /></a>
                        </div>
                        <h2>Training and Employent</h2>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>
                        <p><a href="#" class="link">Other Material </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image7.png" alt="" title="" /></a>
                        </div>
                        <h2>Investment Generation & Promotion </h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <p><a href="#" class="link">Other Material </a> </p>
                    </div>
                </div>
            </div>
        </div>-->



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

<script>

function getCourse(stream_id){
   
    if (stream_id != '') {
       
        $("#CourseId").val('').trigger('change').prop('disabled', true);
        $.ajax({
            
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    
            url:"{{ url('get_trainning_course') }}",
            type:'POST',
            dataType:'json',
            data:{
              stream_id:stream_id
            },
            success: function(res){
                $("#CourseId").val('').trigger('change');
                $("#CourseId").html('<option value="">Select Course</option>');
                $.each(res,function(key,value) {
                $("#CourseId").append('<option value="'+key+'">'+value+'</option>');
                });
                $("#CourseId").prop('disabled', false);
            }
        });
    } else {
        $('#CourseId').val('').trigger('change').html('<option value="">Select Course</option>');
        $("#CourseId").prop('disabled', false);
    }
}
</script>

@section('footer')
    @include('layouts.footer')
@endsection

