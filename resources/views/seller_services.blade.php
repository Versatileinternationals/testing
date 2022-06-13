@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="boxProductDetail">
            <div class="container">
                <div class="row align-items-center rowTopProduct">
                    <div class="col-md-12">
                        <h2 class="headingABC text-center"><img src="assets/images/icon-2.png"/>  Services</h2>
                        
                    </div>  
                   
                </div>
            </div>
        </div>
       
       <!---- New Product Grid-------------->
        
        
        <div class="sectionGreen sectionBusinessHub">
		<div class="container-fluid">
                <h2 class="text-center text-white">Business Processing Outsourcing</h2>
            <div class="row rowBusinessHub">
                    @foreach($SellerLists as $SellerList)
                    <div class="col-md-4">
                        <div class="Servicebox">
                            <div class="imgService">
                                <img src="{{url('assets/images/upload/default.png')}}" alt="" title="" />
                            </div>
                            <div class="contentBusinessHub">
                                <h3></h3>
                                <div class="boxRating">
                                    
                                  
                                </div>
                                <h4></h4>
							
								{!!html_entity_decode($SellerList->description)!!}
						   </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
     <!------------------------------------------->
    </article>
    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

