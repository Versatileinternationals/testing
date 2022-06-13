@extends('admin.layouts.light.master')
@section('title', 'Edit Self Paced Learning')

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
              <form method="post" action="{{url('blzinvst_self_paced/'.$selfpaced->id)}}" class="form theme-form"  enctype="multipart/form-data">
                @csrf
               <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label"> Title</label>
                        <input class="form-control" type="text" value="{{old('Title',$selfpaced->Title)}}" name="Title" placeholder="Title">
                        @error('Title')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Category</label>
                      <input type="text" class="form-control"  value="{{old('Title',$selfpaced->VideoCategory)}}" name="VideoCategory"/>
                      @error('VideoCategory')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Video</label>
                      <input type="file" class="form-control"  value="{{old('Video')}}" name="Video"/>
                      @error('Video')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                   <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Video',$selfpaced->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Video',$selfpaced->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div> 
                </div>
				
				<div class="row">
                    <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Video Description</label>
                      <textarea  class="form-control"   name="VideoDescription">{{old('VideoDescription',$selfpaced->VideoDescription)}}</textarea>
                    
                    </div>
                  </div>
                 
                </div>
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('blzinvst_self_paced')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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