@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection

@section('content')
<!-- Content Code Start -->

<!-- Content Code Start -->
<style>
.business{
    background:#4D907A;
}
.career{
    background:#4D907A;
}
#button{
    margin-top: 10px;
}
</style>
<article>
    <div class="boxContactUs">
        <h2 class="text-center">Training Application Form </h2>
           
        <div class="boxGetinTouch">
            <div class="container">
                <div class="row rowTouch">
                    @if(session()->has('message'))
                    <div class="text-center alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="col-md-6">
                        <form action="{{url('store_training_regsitration')}}" method="post">
                            @csrf
                            <input type="hidden" name="training_id" value="{{   base64_decode(request()->segment(2))}}">
                            <div class="input-area mb-2">
                                <label class="form-label">First Name*: </label>
                                <input type="text" value="{{$user->name}}" name="first_name" class="form-control" placeholder="First Name" />
                                @error('first_name')
                                <div class="text-danger show"><strong>{{$message}}</strong></div>
                                @enderror
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Last Name*:</label>
                            <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" placeholder="Last Name" />
                            @error('last_name')
                            <div class="text-danger show"><strong>{{$message}}</strong></div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Street Address:</label>
                            <input type="text" value="{{$user->address}}" name="street_address" class="form-control"
                                placeholder="Street Address" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Phone Number:</label>
                            <input type="text" value="{{old('phone')}}" name="phone" class="form-control" placeholder="Phone No" />

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Gender*:</label>
                            <input {{ ($user->gender == 'Male') ? 'checked' : ''}} type="radio" name="gender" value="Male" placeholder="Male" />&nbsp;Male
                            <input {{ ($user->gender == 'Female') ? 'checked' : ''}} type="radio" name="gender" value="Female" placeholder="Female" />&nbsp;Female
                            <input {{ ($user->gender == 'Other') ? 'checked' : ''}} type="radio" name="gender" value="Other" placeholder="Other" />&nbsp;Other
                            @error('gender')
                            <div class="text-danger show"><strong>{{$message}}</strong></div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Age*:</label>
                            <input type="text" value="{{$user->age}}" name="age" class="form-control" placeholder="Age" />
                            @error('age')
                            <div class="text-danger show"><strong>{{$message}}</strong></div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">City/Town/Village:</label>
                            <input type="text" value="{{$user->city}}" name="city" class="form-control" placeholder="City/Town/Village" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-area mb-2">
                            <label class="form-label">Email Address*:</label>
                            <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email Address" />
                            @error('email')
                            <div class="text-danger show"><strong>{{$message}}</strong></div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-area mb-2">
                            <label class="form-label">Why do you want to learn on Virtual Learning Center?
                                *:</label><br>
                            <input {{ (old('learn_topic') == 'For my career') ? 'checked' : ''}} type="radio" name="learn_topic" class="learn_topic" value="For my career" />&nbsp;&nbsp;Career
                            Advancement Opportunities
                            <input {{ (old('learn_topic') == 'For my business') ? 'checked' : ''}} type="radio" name="learn_topic" class="learn_topic" value="For my business" />&nbsp;&nbsp;For Business
                            Advancement Opportunities
                            @error('learn_topic')
                            <div class="text-danger show"><strong>{{$message}}</strong></div>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-md-6 business" style="display:none;">
                        <div class="input-area mb-2">
                          <label class="form-label">Business Name:</label>                            <input type="text" value="{{old('business_name')}}" name="business_name" class="form-control" placeholder="Business Name" />   

                        </div>
                    </div>
                    <div class="col-md-6 business" style="display:none;">
                        <div class="input-area mb-2">												<label class="form-label" style="color:#fff;">Business Ownership:</label>                            <select name="ownership_type" class="form-select">                                <option value="">Please Select Business Ownership</option>                                <option {{ old('ownership_type') == 1 ? 'selected' : '' }} value="1">Sole proprietorship </option>                                <option {{ old('ownership_type') == 2 ? 'selected' : '' }} value="2">Partnership </option>                                <option {{ old('ownership_type') == 3 ? 'selected' : '' }} value="3">Cooperative</option>                                <option {{ old('ownership_type') == 4 ? 'selected' : '' }} value="4">Non-profit</option>                                <option {{ old('ownership_type') == 5 ? 'selected' : '' }} value="5">Other</option>                            </select>
                            
                        </div>
                    </div>

                    <div class="col-md-6 business" style="display:none;">
                        <div class="input-area mb-2" style="color:#fff;">						<label class="form-label" style="color:#fff;">Ethnicity:</label>                            <select name="ethnicity" class="form-select">                                <option value="">Please Select Ethnicity</option>                                <option {{ old('ethnicity') == 1 ? 'selected' : '' }} value="1">Asian</option>                                <option {{ old('ethnicity') == 2 ? 'selected' : '' }} value="2">Caucasian/White </option>                                <option {{ old('ethnicity') == 3 ? 'selected' : '' }} value="3">Creole</option>                                <option {{ old('ethnicity') ==4 ? 'selected' : '' }} value="4">East Indian</option>                                <option {{ old('ethnicity') == 5 ? 'selected' : '' }} value="5">Garifuna</option>                                <option {{ old('ethnicity') == 6 ? 'selected' : '' }} value="6">Maya</option>                                <option {{ old('ethnicity') == 7 ? 'selected' : '' }} value="7">Mestizo/Spanish/Latino</option>                                <option {{ old('ethnicity') == 8 ? 'selected' : '' }}value="8">Other</option>                            </select>
                            

                        </div>
                    </div>					<div class="col-md-6 business" style="display:none;">                    <div class="input-area mb-2" style="color:#fff;">
                    <label class="form-label" style="color:#fff;">Is Your Business Registered? :</label><br>                            <input {{ (old('business_register') == 'Yes') ? 'checked' : ''}} type="radio" name="business_register" value="Yes"  />&nbsp;Yes                            <input {{ (old('business_register') == 'No') ? 'checked' : ''}} type="radio" name="business_register" value="No" />&nbsp;No
                    </div>				 </div>					
                    					<div class="col-md-12 business" id="" style="display:none;">                        <div class="input-area mb-2">                            <label class="form-label" style="color:#fff;">Year of Establishment:</label>                            <input value="{{old('establishment_year')}}" type="text" name="establishment_year" class="form-control"                                placeholder="Year of Establishment" />                        </div>                    </div>					
                    <div class="col-md-6 career" id="" style="display:none;">
                        <div class="input-area mb-2">
                            <label class="form-label" style="color:#fff;">What’s your career focus right now?:</label>
                            <select name="current_focus" class="form-select">
                                <option value="">Please Select Option</option>
                                <option {{ old('current_focus') == 1 ? 'selected' : '' }} value="1">I’m looking for a career change </option>
                                <option {{ old('current_focus') == 2 ? 'selected' : '' }} value="2">I’ m looking to build new skills for my </option>
                                <option {{ old('current_focus') == 3 ? 'selected' : '' }} value="3">Current Career</option>
                                <option  {{ old('current_focus') == 4 ? 'selected' : '' }} value="4">Job Searching </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 career" id="" style="display:none;">
                        <div class="input-area mb-2">
                            <label class="form-label" style="color:#fff;">What’s your current employment status? :</label>
                            <select name="current_employement" class="form-select">
                                <option value="">Please Select Employment Status</option>
                                <option {{ old('current_employement') == 1 ? 'selected' : '' }} value="1">Student </option>
                                <option {{ old('current_employement') == 2 ? 'selected' : '' }} value="2">Employed Full-Time </option>
                                <option {{ old('current_employement') == 3 ? 'selected' : '' }} value="3">Employed Part-Time </option>
                                <option {{ old('current_employement') == 4 ? 'selected' : '' }} value="4"> Unemployed </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 career" id="" style="display:none;">
                        <div class="input-area mb-2">
                            <label class="form-label" style="color:#fff;">What is your highest level of education? :</label>
                            <select name="higest_education" class="form-select">
                                <option value="">Please Select Education</option>
                                <option {{ old('higest_education') == 1 ? 'selected' : '' }} value="1">Primary School </option>
                                <option {{ old('higest_education') == 2 ? 'selected' : '' }} value="2">Some High School </option>
                                <option {{ old('higest_education') == 3 ? 'selected' : '' }} value="3">High School </option>
                                <option {{ old('higest_education') == 4 ? 'selected' : '' }} value="4"> Associate’s Degree </option>
                                <option {{ old('higest_education') == 5 ? 'selected' : '' }} value="5"> Bachelor’s Degree </option>
                                <option {{ old('higest_education') == 6 ? 'selected' : '' }} value="6"> Master’s Degree </option>
                                <option {{ old('higest_education') == 7 ? 'selected' : '' }} value="7"> PhD or higher </option>
                                <option {{ old('higest_education') == 8 ? 'selected' : '' }} value="8"> Trade School </option>
                                <option {{ old('higest_education') == 9 ? 'selected' : '' }} value="9"> Prefer not to answer </option>
                                <option {{ old('higest_education') == 10 ? 'selected' : '' }} value="10"> N/A </option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-submit"id="button" value="Submit" />

                </form>
            </div>
        </div>
    </div>
</article>

<!-- Content Code End -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).on('click','.learn_topic',function(){
    var id=$(this).val();
    if(id == "For my career")
    {
     $(".career").show();
     $(".business").hide();
    }
    else if(id == "For my business")
    {
        $(".business").show();
        $(".career").hide();
    }
});
</script>
@section('footer')
@include('layouts.footer')
@endsection