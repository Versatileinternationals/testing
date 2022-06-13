@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
     <!-- Content Code Start -->

    <article>
        <div class="sectionHeadingGray" style="background-color:#2b2b2b">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h2 class="text-white text-center"> Access to Finance</h2>
                        
                    </div>  
                   
                </div>
            </div>
        </div>
		
       
        <div class="sectionWhite text-black">
            <div class="container">
               
				<h2 class="text-center"> Grants</h2>
                <div class="row">
				 @foreach($GrantSection as $GrantList)
                    <div class="col-md-6">
                        <div class="boxEvent boxServices">
                            <a href="{{ $GrantList->url }}" target="_blank">
                                <div class="imgEvent">
								
                                    <img src="{{url('assets/images/GrantSection/'.$GrantList->image)}}" alt="" title=""/>
                                </div>
                                
                            </a>
                        </div>
                    </div>
                     @endforeach 
                    
					
                </div>
				<hr>
				<h2 class="text-center"> Loans </h2>
				
				<div class="row">
				
				
				     @foreach($LoanSection as $LoanList)
                    <div class="col-md-6">
                        <div class="boxEvent boxServices">
                            <a href="{{ $LoanList->url }}" target="_blank">
                                <div class="imgEvent">
								
                                    <img src="{{url('assets/images/LoanSection/'.$LoanList->image)}}" alt="" title=""/>
                                </div>
                                
                            </a>
                        </div>
                    </div>
                    
                     @endforeach     
					
                </div><!-- row End----->
				
                
            </div>    
        </div>
      
    </article>

    <!-- Content Code End -->

  



    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

