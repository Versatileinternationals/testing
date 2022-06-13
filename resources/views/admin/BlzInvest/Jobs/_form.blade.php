@extends('admin.layouts.light.master')
@section('title', 'Edit Users')

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
              <form method="post" action="{{url('blzinvst_jobs/'.$BlzJobs->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Job Name</label>
                        <input class="form-control" type="text" value="{{old('JobName',$BlzJobs->JobName)}}" name="JobName" placeholder="Job Name">
                        @error('JobName')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Type</label>
                      <input class="form-control" type="text" value="{{old('JobType',$BlzJobs->JobType)}}" name="JobType" placeholder="Enter Job Type">
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
                        <input class="form-control" type="text" value="{{old('company_name',$BlzJobs->company_name)}}"  name="company_name" placeholder="Company Name">
                        @error('company_name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
				  
				   <div class="col-6">
				  
				   <div class="form-group mb-3">
                      <label class="col-form-label">Job Exp</label>
                      <input class="form-control" type="text" value="{{old('experience',$BlzJobs->experience)}}" name="experience" placeholder="Enter Experience">                      
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
                      <input class="form-control" type="text" value="{{old('Salary',$BlzJobs->Salary)}}" name="Salary" placeholder="Enter Salary">                      
                      @error('Salary')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Skills</label>
                      <input class="form-control" type="text" value="{{old('job_skills',$BlzJobs->job_skills)}}"  name="job_skills" placeholder="Job Skills">                      
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
                      <textarea class="form-control" id="description"   name="description" placeholder="Description"> {{old('description',$BlzJobs->description)}}" </textarea>                   
                      
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
               <img  src="{{url('assets/images/jobs/'.$BlzJobs->JobImage)}}" class="ïmg event-img">		  
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Address</label>
                      <input class="form-control" type="text" value="{{old('JobAddress',$BlzJobs->JobAddress)}}" name="JobAddress" placeholder="Job Address">                     
                      @error('JobAddress')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
				  
					   <div class="col-6">
					    <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Status',$BlzJobs->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status',$BlzJobs->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
					 </div>  
                  </div>                 
                </div> 
				
				
               
                
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
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