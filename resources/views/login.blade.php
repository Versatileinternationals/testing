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
	 <h2>Login</h2>     
	 
	    <!--error msg -->
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
        </div>
        @endif
         @if ($message = Session::get('succ'))
                        <div class="alert alert-success alert-block">
                        <strong>{{ $message }}</strong>
                        </div>
                        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif
        <!--error msg -->
        
	 <form action="{{ url('memberDologin') }}" method="POST">         
	 {{ csrf_field() }}
	 <div class="input-area">      
	 <input type="email" class="form-control form-control2" name="email" placeholder="Email" required/>     
	 </div>         
	 <div class="input-area">    
	 <input type="password" class="form-control form-control2" name="password" placeholder="Password" required/>      
	 </div>                   
	 <p class="text-center pt-3 mb-4">  
	 <button type="submit" class="btn btn-long">Login</button>    
	 </p>                 
	 </form>                  
	 <p>Forgot <a href="">Password</a></p>     
	 <p>Don’t have an account? <a href="{{route('signup')}}">Register</a> </p>    
	 </div>        
	 </div>        
	 </div>      
	 </div>    
	 </article>    <!-- Content Code End -->
@endsection


@section('footer')
    @include('layouts.footer')
@endsection

