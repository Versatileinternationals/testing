@extends('admin.layouts.light.master')
@section('title', 'Edit Permissions')

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
              <form method="post" action="{{url('module/'.$role->id)}}" class="form theme-form">
                @csrf
                @method('PUT')     

                <div class="form-group">
                  <label class="col-form-label" for="name">Permissions : {{ $role->name}}</label>
                    <div class="col-lg-12 permission-card">
                      @php $cnt = 1;$cn = 1; @endphp
                      @foreach(array_chunk($modules->all(), 3) as $threepermission)
                        @if($cnt%3 == 1)
                          <div class="row">
                        @endif
                          <div class="col-lg-4 permission-listing">                              
                              @foreach($threepermission as $module)                            
                              <div class="form-check checkbox checkbox-primary mb-0">
                                <input class="form-check-input permission" type="checkbox"  id="customCheckbox{{$cn}}" name="permission[]" @if(in_array($module->id,$modulesId)) checked @endif value="{{ $module->id }}">
                                <label class="custom-control-label permision-label" for="customCheckbox{{$cn}}">{{ $module->view_name }}</label>
                              </div>
                              @php $cn++; @endphp
                              @endforeach
                          </div>
                        @if($cnt%3 == 0)
                          </div>
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