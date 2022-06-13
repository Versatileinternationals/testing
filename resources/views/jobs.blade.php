@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Career Opportunities</h2>
            </div>
        </div>


     
        <div class="sectionComman">
            <div class="container">
                <h2 class="text-center">Career Opportunities </h2>
                <p class="subheading text-primary text-center mb-5"></p>
                <div class="row rowJobListing">
                    <div class="col-md-12">
                        @foreach($JobLists as $JobList)
                        <div class="box-JobDetail">
						
                            <a href="{{ url('job_detail/'.base64_encode($JobList->id))}}" class="linkApplyNow">Read More</a>
                            <h3><a href="{{ url('job_detail/'.base64_encode($JobList->id))}}">{{$JobList->JobName}}</a></h3>
                            <h4>{{$JobList->company_name}} </h4>
                            <ul class="listDetailDesigner">
                                <li><i class="fas fa-briefcase"></i> {{$JobList->experience}}</li>
                                <li><b>BZ$ </b>{{$JobList->Salary}} </li>
                                <li><i class="far fa-file-alt"></i><p> {!!html_entity_decode($JobList->description)!!}</p></li>
                            </ul>
                            @php
                            $arr=explode(',',$JobList->job_skills);
                            @endphp
                            <ul class="listaddon">
                                @for ($j = 0; $j < count($arr); $j++)
                                <li>{{$arr[$j]}}</li>
                                @endfor
                            </ul>
                            <ul class="tagsList"> 
                                <li>
                                    <a href="#" class="jobtag"><i class="fab fa-hotjar"></i> Hot Job</a>
                                </li>
                                <li>
                                    <a href="#" class="jobtag active"><i class="fas fa-history"></i> 1 Day Ago</a>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                       
                        <p class="text-center pt-2">
                            <a href="#" class="btn btn-secondary">Load More </a>
                        </p>
						</a>
                    </div>
                   <!-- <div class="col-md-4 boxTopCompanies">
                        <h3 class="headingRound">Top Category</h3>
                        <div class="row rowCompaniesLogos">
                            <div class="col-md-12">
                                <div class="logoCompanies">
								<a href="">Category</a>
                                </div>
                            </div>
                           
                        </div>
                    </div>-->
					
					
                </div>
            </div>
			 <div class="container">
			 <div class="row rowJobListing">
                    <div class="col-md-12">
			<h2 class="text-center">External Job Links </h2>
			  </div>
            </div>
			            </div>
        </div>



    </article>

    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

