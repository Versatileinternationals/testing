@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner">
            <div class="container">
                <h2>Employment</h2>
            </div>
        </div>
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center">What We Do</h2>
                <div class="row">
				<div class="contentTeam text-white">
                 <p  style="color:#fff;">Belize Training and Employment Centre (BTEC) is a unit of BELTRAIDE, and is open to all interested in improving their employability skills and encourages and fosters an inclusive environment where participants, staff and the community demonstrate respect for diversity. The objectives of BTEC are: </p>
                <ul style="list-style-type:disclosure-closed">
				<li>To reduce the barriers to gainful employment</li>
				<li>To assist employers in meeting their present and future workforce needs</li>
				<li>To strengthen the partnership between public and private sector</li>
				<li>To develop strategic collaborations with the private sector to identify </li>
				<li>opportunities for growth and preparing the talent pool to access those opportunities</li>
				<li>Entrepreneurial Development </li>
				<li>Costing and Pricing </li>
				<li>Other trainings as needed (grant proposal writing, contract negotiation, customer service, social media, etc.) </li>
				
				</ul><br>
				<h3 style="color:#fff">BTEC offers a wide variety of trainings to those who require assistance.  the available trainings are as follows: </h3>
				 <ul style="list-style-type:disclosure-closed">
				<li>Job Preparedness Training</li>
				<li>Professional Development</li>
				<li>Business Processing Outsourcing </li>
				<li>Tourism Industry  </li>
				<li>Home Health Care</li>
				
				</ul><br>
				</div>
				</div>
            </div>
        </div>
        <div class="sectionGray sectionTeam text-white">
            <div class="container">
                <h2 class="text-center">Meet The Team</h2>
                <h3>Management Team</h3>
                <div class="teamRows">
                    @foreach($TeamLists as $TeamList)
                    <div class="boxteamContent">
                        <h4>{{$TeamList->name}} </h4>
                        <h5>{{$TeamList->designation}}</h5>
                        <div class="teamDetail">
                            <div class="imageTeam">
                                <img src="{{url('assets/images/team/'.$TeamList->image)}}" alt="" title=""/>
                            </div>
                            <div class="contentTeam">
                               <p>{{$TeamList->description}}</p> 
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>   
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center mb-4">Other Resources</h2>
                <div class="row rowResources">
                   <div class="col-md-6">
                       <a  href="{{ url('request_assistance?TypeId='.base64_encode(2)) }}" class="btn btnResources">Request Assistance </a>
                    </div>
					 <div class="col-md-6">
                        <a href="{{ url('jobs_employment')}}" class="btn btnResources" >Resources</a>
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

