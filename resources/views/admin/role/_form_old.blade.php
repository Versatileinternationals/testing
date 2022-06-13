@extends('admin.layouts.light.master')
@section('title', 'Edit Role')

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
              <form method="post" action="{{url('role/'.$role->id)}}" class="form theme-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label class="col-form-label">Name</label>
                  <input class="form-control" type="text" value="{{old('name',$role->name)}}" name="name" placeholder="Enter Name">
                  @error('name')
                  <div class="text-danger show"><strong>{{$message}}</strong></div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label class="col-form-label">Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter Description">{{old('description',$role->description)}}</textarea>
                  @error('description')
                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                  @enderror
                </div>                    
               
                <div class="form-group">
                  <label class="col-form-label" for="name">Permissions :</label>
                    <div class="col-lg-12 permission-card">
                      @php $cnt = 1;$cn = 1; @endphp
                      @foreach($permissions as $k=>$permission)
                        @if($cnt%3 == 1)
                          <div class="row">
                        @endif
                          <div class="col-lg-4 permission-listing">
                            <div class="permission-card-header">{{ $k }} 
                              {{-- <a class="pull-right permission-card-title selectDeselect" value="deselect">Deselect</a> 
                              <a class="pull-right permission-card-title selectDeselect" value="select">Select</a> --}}
                            </div>
                              
                              @foreach($permission as $key=>$val)                            
                              <div class="form-check checkbox checkbox-primary mb-0">
                                <input class="form-check-input permission" id="customCheckbox{{$cn}}" type="checkbox"  name="permission[]" @if(in_array($val->id,$existPermissions)) checked @endif value="{{ $val->id }}">
                                <label class="custom-control-label permision-label" for="customCheckbox{{$cn}}">{{ $val->name }}</label>
                              </div>
                              @php $cn++; @endphp
                              @endforeach
                          </div>
                        @if($cnt%3 == 0)
                          </div>
                          <hr class="form-part">
                        @endif
                        @php $cnt++; @endphp
                      @endforeach
                    </div>
                  </div>
                                            
                  <div class="row">
                    <div class="col-12">
                      <div>
                        <button type="submit" class="btn btn-primary me-3">Save</button>
                        <a href="{{url('role')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                      </div>
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