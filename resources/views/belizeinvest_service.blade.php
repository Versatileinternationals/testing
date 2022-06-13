@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner">
            <div class="container">
                <h2>Investment Generation & Promotion</h2>
            </div>
        </div>
        <div class="sectionGreen">
            <div class="container">
                <h2 class="text-center">What We Do</h2>
                <div class="row">
				 <div class="contentTeam text-white">
				<p  style="color:#fff;">
				BelizeINVESTis a division of BELTRAIDE that provides tailored services to local and foreign investors seeking to capitalize on investment. The key to their success depends on keeping investors satisfied and motivated via its unique business development strategies. BELTRAIDE ensures that each investor receives support from an experienced team dedicated to promote business growth in Belize’s Investment Sectors by:
                 </p>
				 
				<ul style="list-style-type:disclosure-closed">
				<li>Providing establishment compliance guidance and investment packaging support; </li>
				<li>Accessing intellectual capital that is required to make business happen;</li>
				<li>Coordinating and facilitating inbound site visits and investment missions;</li>
				<li>Promoting investment opportunities through investment forums and events; </li>
				<li>Expending recommendations to enhance the ease of doing business in Belize; </li>
				<li>Building long-term, collaborative relationships with concession holders through outreach for continued business growth via Aftercare Services. </li>
				<li>Providing facilitation and tailored services throughout the entire investment experience. </li>
				
				</ul><br> 
				<h3 style="color:#fff"> 
BelizeINVEST’s role is to foster investor confidence for further translation into prosperous establishments and propagation of socio-economic benefits in Belize; we intend to achieve this by:
</h3>

                <ul style="list-style-type:disclosure-closed">
				<li>Maximizing investment opportunities in key niche areas under the various growing priority industries in Belize;</li>
				<li>Building relationships and connecting investors with key public and private sector decision makers and business support organizations;</li>
				<li>Enhancing Belize’s competitiveness by advocating for market-driven pro-investment policies. </li>
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
                       <a  href="{{ url('request_assistance?TypeId='.base64_encode(1)) }}" class="btn btnResources">Request Assistance </a>
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

