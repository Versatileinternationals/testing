@extends('admin.layouts.light.master')
@section('title', 'Add Brand')

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
              <form method="post" action="{{url('tags/'.$Tags->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Tag Name</label>
                        <input class="form-control" type="text" value="{{old('name',$Tags->name)}}" name="name" placeholder="Tags Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                
                
                <div class="row">      
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="1" {{old('status',$Tags->status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('status',$Tags->status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>  
                             
                </div>                          
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('tags')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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