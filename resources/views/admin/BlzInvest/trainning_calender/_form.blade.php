@extends('admin.layouts.light.master')
@section('title', 'Edit Trainning Calender')

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
              <?php //bbprint_r($BlzTrainingin); die; ?>
              <form method="post" action="{{url('blzinvst_trainning_calender/'.$BlzTrainingin->id)}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Course Name </label>
                        <input class="form-control" type="text" value="{{old('CourseName',$BlzTrainingin->CourseName)}}" name="CourseName" placeholder="Course Name">
                        @error('CourseName')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Stream Name</label>
                      <input class="form-control" type="text" value="{{old('StreamName',$BlzTrainingin->StreamName)}}" name="StreamName" placeholder="Stream Name">
                      @error('StreamName')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Training Name</label>
                      <input class="form-control" type="text" value="{{old('TrainingName',$BlzTrainingin->TrainingName)}}" name="TrainingName" placeholder="Training Name">                      
                      @error('TrainingName')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Training Duration</label>
                      <input class="form-control" type="text" value="{{old('TrainingDuration',$BlzTrainingin->TrainingDuration)}}" name="TrainingDuration" placeholder="Training Duration">                      
                      @error('TrainingDuration')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Training Start Date</label>
                      <input class="form-control" type="Date" value="{{old('TrainingStartDate',$BlzTrainingin->TrainingStartDate)}}"  name="TrainingStartDate" placeholder="Training Start Date">                     
                      @error('TrainingStartDate')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                 <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Training Image </label>
                      <input class="form-control" type="file" name="TrainingImage">
                      
                      @error('TrainingImage')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>                 
                </div> 
                <div class="row">      
                  <div class="col-6">
                    
          
          
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Training Video</label>
                      <input class="form-control" type="file" name="TrainingVideo">  
                    </div>
                  </div>               
                </div> 
                
                <div class="row">                
                  <div class="col-12">                    
                    <div class="form-group">
                      <label class="col-form-label">Training Description</label>                   
                      <textarea class="form-control" name="TrainingDescription">{{old('TrainingDescription',$BlzTrainingin->TrainingDescription)}} </textarea>
                      @error('TrainingDescription')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror                       
                    </div>
                  </div>
                </div> 
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('blzinvst_trainning_calender')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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