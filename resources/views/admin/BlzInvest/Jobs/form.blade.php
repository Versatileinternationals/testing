@extends('admin.layouts.light.master')
@section('title', 'Add Job')

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
              <form method="post" action="{{url('blzinvst_jobs')}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Job Title</label>
                        <input class="form-control" type="text" value="{{old('JobName')}}" name="JobName" placeholder="Job Title">
                        @error('JobName')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Type</label>
					   <select class="js-example-basic-single select2 col-sm-12 form-select" name="JobType" id="JobType">  
                       <option value="" >Select Job Type</option>					   
                        <option value="Part-Time" {{old('JobType') =="Part-Time"? 'selected' : ''}}>Part-Time</option>
                        <option value="Full-Time" {{old('JobType') =="Full-Time"? 'selected' : ''}}>Full-Time</option>
                      </select>  
                     
                      @error('JobType')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
				
			
				<div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Company Name</label>
                        <input class="form-control" type="text"  name="company_name" placeholder="Company Name">
                        @error('company_name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  
				  <div class="col-6">
				  <div class="form-group mb-3">
                      <label class="col-form-label">Job Exp</label>
                      <input class="form-control" type="text" value="{{old('experience')}}" name="experience" placeholder="Enter Experience">                      
                      @error('experience')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>	    
				  </div>    
                </div>
				
				
				
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Salary Range</label>
                      <input class="form-control" type="text" value="{{old('Salary')}}" name="Salary" placeholder="Enter Salary">                      
                      @error('Salary')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Skills</label>
                      <input class="form-control" type="text"  name="job_skills" placeholder="Job Skills">                      
                      @error('job_skills')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
				
				<div class="row">
                  
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Description</label>
                      <textarea class="form-control"  id="description"  name="description" placeholder="Description">  </textarea>                   
                      
                    </div>
                  </div>
                </div> 
				
				
				<div class="row">
                  
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Image</label>
                      <input class="form-control" type="file"  name="JobImage" >                     
                      @error('JobImage')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>   
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Address</label>
                      <input class="form-control" type="text" value="{{old('JobAddress')}}" name="JobAddress" placeholder="Job Address">                     
                      @error('JobAddress')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Status') =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status') =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
					
                  </div>                 
                </div> 
                <div class="row">      
                  <div class="col-6">
                    
					
					
                  </div>              
                  
				  
                </div> 
                
                
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('blzinvst_jobs')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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