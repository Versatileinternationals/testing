@extends('admin.layouts.light.master')
@section('title', 'Add Advisory Request')

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
              <form method="post" action="{{url('blzinvst_advisory')}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-6">
                  <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('Name')}}" name="Name" placeholder="Name">
                        @error('Name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Email</label>
                      <input class="form-control" type="Email" value="{{old('Email')}}" name="Email" placeholder="Email">
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
                        <input class="form-control" type="text" value="{{old('Mobile')}}" name="Mobile" placeholder="Mobile">
                        @error('Mobile')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Purpose</label>
                        <input class="form-control" type="text" value="{{old('Purpose')}}" name="Purpose" placeholder="Purpose">
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
                        <textarea class="form-control"  value="{{old('Message')}}" name="Message" placeholder="Enter Message"></textarea>
                        @error('Message')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('blzinvst_advisory')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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