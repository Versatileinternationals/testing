@extends('admin.layouts.light.master')
@section('title', 'Edit Advisory Requests')

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
              <form method="post" action="{{url('expblz_advisory/'.$BlzAdvisoryRequests->id)}}" class="form theme-form">
                @csrf
                 <div class="row">
                  <div class="col-6">
                  <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('Name',$BlzAdvisoryRequests->Name)}}" name="Name" placeholder="Name">
                        @error('Name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Email</label>
                      <input class="form-control" type="Email" value="{{old('Email',$BlzAdvisoryRequests->Email)}}" name="Email" placeholder="Email">
                      @error('Email')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
				
				<div class="row">
                  <div class="col-6">
                  <div class="form-group">
                        <label class="col-form-label">Mobile</label>
                        <input class="form-control" type="text" value="{{old('Mobile',$BlzAdvisoryRequests->Mobile)}}" name="Mobile" placeholder="Mobile">
                        @error('Mobile')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Purpose</label>
                        <input class="form-control" type="text" value="{{old('Purpose',$BlzAdvisoryRequests->Purpose)}}" name="Purpose" placeholder="Purpose">
                        @error('Purpose')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
				<div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Message</label>
                        <textarea class="form-control"  value="{{old('Message')}}" name="Message" placeholder="Enter Message">{{old('Message',$BlzAdvisoryRequests->Message)}}</textarea>
                        @error('Message')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  
                </div>
				
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('expblz_advisory')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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