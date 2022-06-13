@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner">
            <div class="container">
                <h2>Small Business Development</h2>
            </div>
        </div>
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center">What We Do</h2>
                <div class="row">
				
                  <div class="contentTeam text-white">
				
                 <h2  style="color:#fff;">The Small Business Development Centre Belize (SBDCBelize) </h2>
                 <p>provides one-on-one confidential and needs based business consulting, and free or low-cost training in proven management fundamentals to help micro, small, and medium sized businesses and potential entrepreneurs make sound decisions for the successful operation of their business.</p>				 
               
			   <h2>TRAINING:-</h2>
			   <ul style="list-style-type:disclosure-closed">
				<li>Establishing a Business in Belize</li>
				<li>Accounting Series</li>
				<li>Marketing and Sales</li>
				<li>Intro to Exporting</li>
				<li>Intellectual Property Rights</li>
				<li>Entrepreneurial Development </li>
				<li>Costing and Pricing </li>
				<li>Other trainings as needed (grant proposal writing, contract negotiation, customer service, social media, etc.) </li>
				
				</ul><br>
			  
			  
			    <h2>ADVISORY:-</h2>
				 <ul style="list-style-type:disclosure-closed">
			    <li>Establishing a Business</li>
				<li>Marketing</li>
				<li>Accounting</li>
				<li>Business Planning</li>
				<li>Product Development</li>
				<li>Human Resource Management</li>
				<li>Financing</li>
			    </ul>
				<br>
				
				
				<h3 style="color:#fff;">SBDCBelize’s role is to enhance competitiveness of local businesses by: </h3>
				<ul style="list-style-type:disclosure-closed">
				<li>Offering focused capacity building   </li>
				<li>Supporting entrepreneurship  </li>
				<li>Offering specialized business development services & mentoring</li>
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
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center mb-4">Other Resources</h2>
                <div class="row rowResources">
                    <div class="col-md-6">
                      <a  href="{{ url('request_assistance?TypeId='.base64_encode(4)) }}" class="btn btnResources">Request Assistance </a>
                    </div>
					 <div class="col-md-6">
                        <a href="#" class="btn btnResources" >Test Resources</a>
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

