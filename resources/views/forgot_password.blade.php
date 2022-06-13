@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection


@section('content')
     <!-- Content Code Start -->   
	 <article> 
	 <div class="container">   
	 <div class="boxLogin">   
	 <div class="row g-0 align-items-center">  
	 <div class="col-md-6 loginContent">    
	 <div class="loginInnerArea">       
	 <h1>Mastermind Better.<br/>Succeed Together.</h1>  
	 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
	 </div>             
	 </div>           
	 <div class="col-md-6 loginArea">      
	 <h2>Forgot Password</h2> 
	 <form>  
	 <div class="input-area">   
	 <input type="email" class="form-control form-control2" placeholder="Email"/>  
	 </div>        
	                       
	 <p class="text-center pt-3 mb-4">      
	 <button type="submit" class="btn btn-long">Send</button>      
	 </p>                      
	 </form>                      
	 
	 <p>Already Have account?  <a href="{{route('user-login')}}">Click to Login</a> </p> 
	 </div>           
     </div>          
	 </div>   
	 
	 </div>  
	 </article>    <!-- Content Code End -->
@endsection


@section('footer')
    @include('layouts.footer')
@endsection

