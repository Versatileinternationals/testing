@extends('layouts.app')

@section('header')
     @include('layouts.header')
@endsection

@section('content')


<style>
   .loginArea .col-md-5 {
    float: left;
    margin-right: 30px;
}
.loginArea .input-area {
    margin-bottom: 10px;
    float: left;
    width: 90%;
}
.form-control:disabled, .form-control:read-only {
    background-color: #ffffff;
    opacity: 1;
}
.input-group-text {
    background-color: #ffffff;
}
ul.list_radio {
    margin-top: 10px;
    float: left;
    margin-bottom: 10px;
}
    
</style>



    <!-- Content Code Start -->

   <article>
        <div class="container">
            <div class="boxLogin boxSignup">
                <div class="row g-0 align-items-center">
                    <div class="col-md-6 loginContent">
                        
                    </div>
                    <div class="col-md-6 loginArea">
                        <h2>Create Account </h2>
                        <!--error msg -->
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
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
                        <form action="{{ url('memberregister') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="col-md-5">
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control2" placeholder="First Name" required/>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control form-control2" placeholder="Last Name" required/>
                            </div>
                            <div class="input-area">
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control form-control2" placeholder="Email" required/>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{ old('phone') }}" name="phone" class="form-control form-control2" placeholder="Mob. No" required/>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{ old('age') }}" name="age" class="form-control form-control2" placeholder="Age" required/>
                            </div>
                            <div class="input-area">
                                <input type="text" value="{{ old('address') }}" name="address" class="form-control form-control2" placeholder="Address" required/>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{ old('city') }}" name="city" class="form-control form-control2" placeholder="City" required/>
                            </div>
                            <div class="col-md-5">
                                <select name="gender" class="form-control form-control2" required>
                                    <option>Select Gender *</option>
                                    <option value="Male"> Male</option>
                                    <option value="Female"> Female</option>
                                    <option value="Other"> Other</option>
                                </select>
                               
                            </div>
                            
                            <div class="col-md-5">
                                <input type="password" value="{{ old('password') }}" id="password" name="password" class="form-control form-control2" placeholder="Password" required/>
								<span class="input-group-text"><i class="far fa-eye-slash" id="togglePassword"></i></span>
                            </div>
		
                            <div class="col-md-5">
                                <input type="password" value="{{ old('cpassword') }}" id="cpassword" name="cpassword" class="form-control form-control2" placeholder="Verify Password" required/>
								<span class="input-group-text"><i class="far fa-eye-slash" id="togglecPassword"></i></span>
                            </div>
                            <ul class="list_radio">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="seller" id="option1" >
                                        <label class="form-check-label" for="option1">As Seller</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="buyer" id="option2">
                                        <label class="form-check-label" for="option2">As Buyer</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="trainee" id="option3">
                                        <label class="form-check-label" for="option3">As Trainee</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="investor" id="option4">
                                        <label class="form-check-label" for="option4">As Investor </label>
                                    </div>
                                </li>
                            </ul>

                            <p class="text-center pt-3 mb-4">
                                <button type="submit" class="btn btn-long" id="checkBtn">Register</button>
                            </p>
                        </form>
                        <p>Already Have account? <a href="{{  route('user-login') }}"> Click to Login</a> </p>
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

<style>
form i {
   
    cursor: pointer;
}
</style>
