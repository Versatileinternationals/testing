@extends('admin.layouts.light.master')
@section('title', 'Edit Advisory Request')

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
              <form method="post" action="{{url('sdbc_advisory/'.$BlzAdvisoryRequests->id)}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Message</label>
                        <textarea class="form-control" name="Message" placeholder="Enter Message">{{old('Message',$BlzAdvisoryRequests->Message)}}</textarea>
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
                      <a href="{{url('sdbc_advisory')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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