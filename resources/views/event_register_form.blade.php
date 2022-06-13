@extends('layouts.app')

@section('header')
   @include('layouts.header') 
@endsection

@section('content')
    <!-- Content Code Start -->

    <!-- Content Code Start -->

    <article>
        <div class="boxContactUs">
            <h2 class="text-center">Event Registration Form  </h2>
          
            <div class="boxGetinTouch">
                <div class="container">
                    <div class="row rowTouch">
					 @if(session()->has('message'))
    <div class="text-center alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
                        <div class="col-md-6">
						<form action="{{url('store_event_regsitration')}}" method="post">
                             @csrf    
							 <input type="hidden" name="event_id" value="{{   base64_decode(request()->segment(2))}}">
                           <div class="input-area mb-2">
                                    <label class="form-label">First Name*: </label>
                                    <input type="text" name="first_name" value="{{$event_user->name}}" class="form-control" placeholder="Name" />
									@error('first_name')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                           </div>
						   
						    <div class="input-area mb-2">
                                    <label class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{$event_user->email}}" placeholder="Email" />
									@error('email')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                            </div>
							
							
							<div class="input-area mb-2">
                                    <label class="form-label">Country:</label>
                                    <select name="country" type="text" class="form-control">
									<option value="1">Asian</option>
									<option value="2">Caucasian/White </option>
									<option value="3">Creole</option>
									<option value="4">East Indian</option>
									<option value="5">Garifuna</option>
									<option value="6">Maya</option>
									<option value="7">Mestizo/Spanish/Latino</option>
									<option value="8">Other</option>
									</select>
									
                            </div>
							
							
								 <div class="input-area mb-2">
                                    <label class="form-label">Career Opportunities Title*:</label>
                                    <input type="text" name="job_title"value="{{old('job_title')}}" value="" class="form-control" placeholder="Job Title" />
									@error('job_title')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                                </div>
								
                         </div>
                        <div class="col-md-6">
                           
                            
                                <div class="input-area mb-2">
                                    <label class="form-label">Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" value="{{$event_user->last_name}}" placeholder="Last Name" />
                                </div>
                               
                                <div class="input-area mb-2">
                                    <label class="form-label">Confirm Email Address:</label>
                                   <input type="email" name="email" class="form-control" value="{{$event_user->email}}" placeholder="Confirm Email Address"/>
                                </div>
								
								  <div class="input-area mb-2">
                                    <label class="form-label">Organization*:</label>
                                   <input type="text" name="organization" value="{{old('organization')}}"class="form-control" placeholder="Organization"/>
								   @error('organization')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                                </div>
								
								 <div class="input-area mb-2">
                                    <label class="form-label">Gender*:</label>
                                    <input {{ ($event_user->gender == 'Male') ? 'checked' : ''}} type="radio" name="gender" value="Male" placeholder="Male" />&nbsp;Male
                                    <input {{ ($event_user->gender == 'Female') ? 'checked' : ''}} type="radio" name="gender" value="Female" placeholder="Female" />&nbsp;Female
                                    <input {{ ($event_user->gender == 'Other') ? 'checked' : ''}} type="radio" name="gender" value="Other" placeholder="Other" />&nbsp;Other
									@error('gender')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                                   </div>
								
								
								
								
								
								
                                </div>
								
                                
                        </div>
						<input type="submit" class="btn btn-submit" value="Submit"/>
								
                            </form>
                    </div>
                </div>
			
			
        </div>
    </article>

    <!-- Content Code End -->
@endsection


@section('footer')
   @include('layouts.footer') 
@endsection


