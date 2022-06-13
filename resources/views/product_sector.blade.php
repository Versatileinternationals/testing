@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <article>
        <div class="boxProductDetail">
            <div class="container">
                <div class="row align-items-center rowTopProduct">
                    <div class="col-md-12">
                        <h2 class="headingABC text-center"><img src="assets/images/icon-2.png"/>  Sectors</h2>
                        
                    </div>  
                   
                </div>
            </div>
        </div>
       
       <!---- New Product Grid-------------->
        
        
       <div class="productArea text-white " id="product">
	   
            <div class="container">
               
				 
                <div class="row">
				 
				   
		           @foreach($CategoryLists as $CategoryList)
                    <div class="col-md-3">
				
                        <div class="boxProduct" style="margin-bottom:30px;">
                            <a href="{{url('products/'.base64_encode($CategoryList->id))}}">
                                <div class="imgProduct">
                                    <img src="{{url('assets/images/upload/'.$CategoryList->image)}}" alt="" title=""/>
                                </div>
                                <h4>{{$CategoryList->name}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach     
                          
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary btn-white">View All</a>
                </p>
            </div>    
        </div>
     <!------------------------------------------->
    </article>

    <!-- Content Code End -->



    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

