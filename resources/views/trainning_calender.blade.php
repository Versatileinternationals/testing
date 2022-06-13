@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
 <style>
     #calendar{
         color:red;
         background:#fff;
     }
     #calendar h2{
         color:red;
     }
 </style>
 <article>
        <div class="sectionInvestment">
            <div class="container">
                <div class="row rowInvestmentContent align-items-center">
                    <div class="col-md-8">
                        <h2>THE BELIZE TRADE & INVESTMENT DEVELOPMENT SERVICE.</h2>
                    </div>
                    <div class="col-md-4">
                        
						
						
                    </div>
					
					
                </div>
            </div>
        </div>
      
		
       
       

        
       <div class="boxCalendar text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 headingCalander">
                        <h2><span>Training</span> Calendar 2022 </h2>
                        <h3>Browse the calendar to see a list of upcoming training:-</h3>
                    </div>
                    <div class="col-md-6">
                        <!--<img src="assets/images/image-calander.png" alt="" title=""/>-->
                       <div id="calendar"></div>
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
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {
            var booking = @json($EventDetails);
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

