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
                        <h2>SUPPORT SERVICES</h2>
                    </div>
                    <div class="col-md-4">
                       
						
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

        
				
            </div>
        </div>

       
        <div class="boxListServices">
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
                        <p><a href="{{ url('export_belize')}}" class="link">Read More </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image5.png" alt="" title="" /></a>
                        </div>
                        <h2>Small Business Development</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                        <p><a href="{{ url('sdbc-services')}}" class="link">Read More </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image6.png" alt="" title="" /></a>
                        </div>
                        <h2>Training and Employent</h2>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>
                        <p><a href="{{ url('btec-services')}}" class="link">Read More </a> </p>
                    </div>
                    <div class="itemsServices">
                        <div class="imgServices">
                            <a href="#"><img src="assets/images/service_image7.png" alt="" title="" /></a>
                        </div>
                        <h2>Investment Generation & Promotion </h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <p><a href="{{ url('belizeinvest-services')}}" class="link">Read More </a> </p>
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

