@extends('layouts.app')

@section('header')
   @include('layouts.header') 
@endsection



@section('content')
    <!-- Content Code Start -->

    <!-- Content Code Start -->

    <article>
        <div class="boxContactUs">
            <h2 class="text-center">Request Assistance</h2>
           
            <div class="boxGetinTouch">
                <div class="container">
                    <div class="row rowTouch">
					       @if(session()->has('message'))
    <div class="text-center alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
                        <div class="col-md-6">
						<form action="{{url('store_request_assistance')}}" method="post">
                             @csrf  
								
                           <div class="input-area mb-2">
						            <input type="hidden" name="admin_type" class="form-control" value="{{request()->get('TypeId')}}" />
                                    <label class="form-label">Name* </label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" />
									
									@error('name')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                           </div>
						   
						    <div class="input-area mb-2">
                                    <label class="form-label">Mobile No.</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Mobile No" />
									@error('phone')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                            </div>
							 <div class="input-area mb-2">
                                    <label class="form-label">Business</label>
                                    <input type="text" name="business" class="form-control" placeholder="Business" />
                            </div>
                        </div>
                        <div class="col-md-6">
                           
                            
                                <div class="input-area mb-2">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" />
									@error('email')
									<div class="text-danger show"><strong>{{$message}}</strong></div>
									@enderror
                                </div>
                               
                                <div class="input-area mb-2">
                                    <label class="form-label">Address</label>
                                   <input type="text" name="address" class="form-control" placeholder="Address"/>
                                </div>
								
								 <div class="input-area mb-2">
                                    <label class="form-label">About Assistance</label>
                                   <textarea type="text" name="description" class="form-control" placeholder="About Assistance" /></textarea>
								
                                </div>
								
                                <input type="submit" class="btn btn-submit" value="Submit"/>
								
                            </form>
                        </div>
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


