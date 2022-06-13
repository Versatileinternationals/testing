@extends('admin.layouts.light.master')
@section('title', 'Edit Event Listing')

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
              <form method="post" action="{{url('blzinvst_grant_section/'.$BlzGrant->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Website Url</label>
                        <input class="form-control" type="text" value="{{old('url',$BlzGrant->url)}}" name="url" placeholder="Website Url">
                        @error('url')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Grant Image</label>
                      <input class="form-control" type="file" value="{{old('image',$BlzGrant->image)}}" name="image">
                      
                    </div>
                  </div>
                </div>
				
				
               
                
				 <div class="row">
				<div class="col-12">
				
				<img  src="{{url('assets/images/GrantSection/'.$BlzGrant->image)}}" class="ïmg event-img">
				
				</div> 
				 </div> 
                <div class="row">      
                 <div class="col-6">
                    
          <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Status',$BlzGrant->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status',$BlzGrant->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
          
                  </div>              
                </div> 
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('blzinvst_events')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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