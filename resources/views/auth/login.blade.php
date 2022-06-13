@extends('admin.layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="container-fluid" >
   <div class="row">
      <div class="col-12">
         <div class="login-card" style="background-image: url(assets/images/1657858.jpg);">
            <div>
               <div><a class="logo" href="#"><img class="img-fluid for-light" src="{{asset('assets/images/beltraide-logo-full-color-no-slogan.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form needs-validation" novalidate="" method="post" action="{{url('login')}}">
                    @csrf
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" name="email" type="email" value="{{old('email')}}" required placeholder="Enter Email">
                        <div class="invalid-feedback text-danger">Please enter proper email.</div>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required placeholder="Enter Password">
                        <div class="invalid-feedback text-danger">Please enter password.</div>
                        @if(Session::has('error_msg'))                            
                            <div class="text-danger show"><strong>{{Session::get('error_msg')}}</strong></div>
                        @endif
                        <div class="show-hide"><span class="show"> </span></div>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="remember" type="checkbox" name="remember">
                           <label class="text-muted" for="remember">Remember password</label>
                        </div>
                        {{-- <a class="link" href="{{ route('password.request') }}">Forgot password?</a> --}}
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                     </div>                   
                     {{-- <p class="mt-4 mb-0">Don't have account?<a class="ml-2" href="{{  route('register') }}">Create Account</a></p> --}}
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
  <script>
   (function() {
     'use strict';
     window.addEventListener('load', function() {
       // Fetch all the forms we want to apply custom Bootstrap validation styles to
       var forms = document.getElementsByClassName('needs-validation');
       // Loop over them and prevent submission
       var validation = Array.prototype.filter.call(forms, function(form) {
	 form.addEventListener('submit', function(event) {
	   if (form.checkValidity() === false) {
	     event.preventDefault();
	     event.stopPropagation();
	   }
	   form.classList.add('was-validated');
	 }, false);
       });
     }, false);
   })();
   
  </script>
@endsection
