@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Job Detail</h2>
            </div>
        </div>

        <div class="sectionGreen1 sectionWhite">
            <div class="container">
                <h2 class="text-center text-black">Job Detail</h2>
				<hr>
				<div class="row">
   <div class="col-md-12">
      <section class="jd-header">
         <div class="top">
		 
		
            <div class="jd-top-head">
               <header>
                  <h1 class="jd-header-title" title="Food &amp; Beverage Executive">{{ $JobLists->JobName }}  </h1>
               </header>
               
            </div>
	
          
            <div class="left">
			    <div class="exp">{{ $JobLists->company_name }}</div>
               <div class="exp"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;<em class="naukicon naukicon-bag"></em><span>{{ $JobLists->experience }}</span></div>
               <div class="salary"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<em class="naukicon naukicon-salary"></em><span>{{ $JobLists->Salary }}  </span></div>
               <div class="loc"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<em class="naukicon naukicon-location"></em><span class="location "><a target="_blank" href="#" title="">{{ $JobLists->JobAddress }} </a></span></div>
            </div>
           
         </div>
        
         
      </section>
     
      <section class="job-desc jd-header">
         <h3>Job description:-</h3><br>
         <div class="dang-inner-html"> <i class="far fa-file-alt"></i>  {!!html_entity_decode($JobLists->description)!!}</div>
         
         
      </section>
     
      
   </div>
</div>
			
				
				
			
                
            </div>
               <hr> 
            
        </div>
        

       



    </article>

    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

