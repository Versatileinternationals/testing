@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner">
            <div class="container">
                <h2>Export Belize Development And Promotion</h2>
            </div>
        </div>
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center">What We Do</h2>
                <div class="row">
				<div class="contentTeam text-white">
				
                 <p>EXPORTBelize is a unit of BELTRAIDE which offers its clients customised needs based services in the areas of export development and promotion, and our efficient and knowledgeable team assists local businesses by providing export coaching and mentoring, market facilitation, market research as well as specialised business development trainings. Their core services include:</p>  
                <ul style="list-style-type:disclosure-closed">
				<li>Developing and executing strategies and activities for increased market access for Belizean products and services;</li>
				<li>Ensuring quality and consistency is continuously met by encouraging exporters to benchmark their products and services to international standards.</li>
				<li>Assisting enterprises in acquiring expertise, know-how, finances and systems necessary to enter export markets.</li>
				<li>Analyzing Identifying export opportunities, viable export markets and potential business partners.
•	Promoting Belize products and services locally, regionally and internationally.
</li>
				<li>EXPORTBelize works actively with their clients to develop a competitive and dynamic export sector founded on quality, innovation and customer orientation.</li>
				<li>Developing and executing strategies and activities for increased market access for Belizean products and services;</li>
				</ul><br>
				<h3 style="color:#fff;">EXPORTBelize’s role is to foster competitiveness of local business and to facilitate market access by: </h3>
				<ul style="list-style-type:disclosure-closed">
				<li>Maximizing markets opportunities in unison with trade agreements;  </li>
				<li>Collaborating with exporters in the promotion of their products and services locally, regionally and internationally;  </li>
				<li>Offering specialized business development services and mentoring.</li>
				</ul>
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
       <!-- <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center mb-4">Other Resources</h2>
                <div class="row rowResources">
                    @foreach($ResourceLists as $ResourceList)
                    <div class="col-md-6">
                        <a href="{{$ResourceList->links}}" class="btn btnResources" target="_blank">{{ucfirst($ResourceList->name)}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>  -->      
     
	 
	    <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center mb-4">Other Resources</h2>
                <div class="row rowResources">
                  
                    <div class="col-md-6">
                        <center>
                        <a  href="{{ url('request_assistance?TypeId='.base64_encode(3)) }}" class="button-85" role="button">Request Assistance </a>
                        </center>
                    </div>
					 <div class="col-md-6">
					     <center>
                        <a href="#" class="button-85" role="button"> Resources</a>
                        </center>
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

