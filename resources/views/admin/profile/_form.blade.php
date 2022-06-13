@extends('admin.layouts.light.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
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
              <form method="post" action="{{url('profile/'.$profile->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('name',$profile->name)}}" name="name" placeholder="Enter Name" required>
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="text" value="{{old('email',$profile->email)}}" name="email" placeholder="Enter Email" readonly>
                        @error('email')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Phone</label>
                        <input class="form-control" type="text" value="{{old('phone',$profile->phone)}}" name="phone" placeholder="Enter Phone" required>
                        @error('phone')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Image</label>
                      <input class="form-control" type="file" name="image" >
                      <img src="{{url('assets/images/upload/'.$profile->image)}}" class="form-img">
                      @error('image')   
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Address</label>
                        <textarea class="form-control" name="address" placeholder="Enter Address" required>{{old('address',$profile->address)}}</textarea>
                        @error('address')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>                      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">City</label>
                        <input class="form-control" type="text" value="{{old('city',$profile->city)}}" name="city" placeholder="Enter City" required>
                        @error('city')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Pincode</label>
                        <input class="form-control" type="text" value="{{old('pincode',$profile->pincode)}}" name="pincode" placeholder="Enter Pincode" required>
                        @error('pincode')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('profile')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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