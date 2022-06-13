@extends('admin.layouts.light.master')
@section('title', 'Add Investor')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('investor_account')}}" class="form theme-form">
                @csrf
				
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
					  <input type="hidden" name="user_type" value="investor">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text"  name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Email</label>
                      <input class="form-control" type="email" value="{{old('email')}}" name="email" placeholder="Enter Email">
                      @error('email')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Phone</label>
                      <input class="form-control" type="text" value="{{old('phone')}}" name="phone" placeholder="Enter Phone">                      
                      @error('phone')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Phone Code</label>
                      <input class="form-control" type="number" value="{{old('phone_code')}}" name="phone_code" placeholder="Enter Phone Code">                      
                      @error('phone_code')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Address</label>
                      <input class="form-control" type="text" value="{{old('address')}}" name="address" placeholder="Address">                     
                      @error('address')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Password</label>
                      <input class="form-control" type="password" value="{{old('password')}}" name="password" placeholder="******">
                      <div class="show-hide"><span class="show"> </span></div>
                      @error('password')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>                 
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Gender</label>                   
                      <div class="m-t-15 m-checkbox-inline animate-chk">
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="radio_animated" id="male" {{old('gender') =="0"? 'checked' : ''}} type="radio" name="gender" value="0">
                            <label class="form-check-label mb-0" for="male">Male</label>
                          </div>
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="radio_animated" id="female" type="radio" {{old('gender') !="0"? 'checked' : ''}} name="gender" value="1">
                            <label class="form-check-label mb-0" for="female">Female</label>
                          </div>                          
                      </div>                        
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="1" {{old('status') =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('status') =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>                 
                </div> 
                
                <div class="row">                
                  <div class="col-12">                    
                   
					
                  </div>
                </div> 
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('investor_account')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection