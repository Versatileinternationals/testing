@extends('admin.layouts.light.master')
@section('title', 'Edit Users')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit {{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('users/'.$user->id)}}" class="form theme-form">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('name',$user->name)}}" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Email</label>
                      <input class="form-control" type="email" value="{{old('email',$user->email)}}" name="email" placeholder="Enter Email">
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
                      <input class="form-control" type="text" value="{{old('phone',$user->phone)}}" name="phone" placeholder="Enter Phone">                      
                      @error('phone')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Phone Code</label>
                      <input class="form-control" type="number" value="{{old('phone_code',$user->phone_code)}}" name="phone_code" placeholder="Enter Phone Code">                      
                      @error('phone_code')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Address</label>
                      <input class="form-control" type="text" value="{{old('address',$user->address)}}" name="address" placeholder="Address">                     
                      @error('address')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                                  
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Role</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="role_id" id="role_id">   
                        <option value="">Select Role</option>
                        @foreach ($role as $item)
                            <option value="{{$item->id}}" {{old('role_id',$user->role_id) == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach                                                   
                      </select>  
                      @error('role_id')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="1" {{old('status',$user->status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('status',$user->status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>                 
                </div> 
             
                <div class="row">                 
                  <div class="col-12">                    
                    <div class="form-group">
                      <label class="col-form-label">Gender</label>                   
                      <div class="m-t-15 m-checkbox-inline animate-chk">
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="radio_animated" id="male" type="radio" {{$user->gender == 0?'checked':''}} name="gender" value="0">
                            <label class="form-check-label mb-0" for="male">Male</label>
                          </div>
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="radio_animated" id="female" type="radio" {{$user->gender == 1?'checked':''}} name="gender" value="1">
                            <label class="form-check-label mb-0" for="female">Female</label>
                          </div>                          
                      </div>                        
                    </div>
                  </div>
                </div>                              
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('users')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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