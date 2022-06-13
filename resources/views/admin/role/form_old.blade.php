@extends('admin.layouts.light.master')
@section('title', 'Add Role')

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
              <form method="post" action="{{url('role')}}" class="form theme-form">
                @csrf
               
                <div class="form-group">
                  <label class="col-form-label">Name</label>
                  <input class="form-control" type="text" value="{{old('name')}}" name="name" placeholder="Enter Name">
                  @error('name')
                  <div class="text-danger show"><strong>{{$message}}</strong></div>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label class="col-form-label">Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter Description">{{old('description')}}</textarea>
                  @error('description')
                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                  @enderror
                </div>
                    
                {{-- <div class="form-group mb-3">
                  <label class="col-form-label ">Status</label>                                     
                  <div class="m-t-15 m-checkbox-inline animate-chk">
                      <div class="form-check form-check-inline radio radio-primary">
                        <input class="radio_animated" id="active" type="radio"  @if(old('is_active') != '') {{ (old('is_active') == 1) ? 'checked':'' }} @else checked @endif name="is_active" value="1">
                        <label class="form-check-label mb-0" for="active">Active</label>
                      </div>
                      <div class="form-check form-check-inline radio radio-primary">
                        <input class="radio_animated" id="inactive" @if(old('is_active') != '') {{ (old('is_active') == 0) ? 'checked':'' }} @endif type="radio" name="is_active" value="0">
                        <label class="form-check-label mb-0" for="inactive">In Active</label>
                      </div>                          
                  </div>                                             
                  @error('status')
                    <div class="text-danger show"><strong>{{$message}}</strong></div>
                  @enderror
                </div> --}}
                <div class="form-group">
                  <label class="col-form-label" for="name">Permissions :</label>
                    <div class="col-lg-12 permission-card">
                      @php $cnt = 1;$cn = 1; @endphp
                      @foreach($permissions as $k=>$permission)
                        @if($cnt%3 == 1)
                          <div class="row">
                        @endif
                          <div class="col-lg-4 permission-listing">
                            <div class="permission-card-header">{{ $k }}</div>
                              
                              @foreach($permission as $key=>$val)  
							  
                              <div class="form-check checkbox checkbox-primary mb-0">
                                <input class="form-check-input permission" id="customCheckbox{{$cn}}" type="checkbox"  name="permission[]"  value="{{ $val->id }}">
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
                        <button type="submit" class="btn btn-primary me-3">Add</button>
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