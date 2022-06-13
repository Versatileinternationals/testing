@extends('admin.layouts.light.master')
@section('title', 'Edit Tainee')

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
              <form method="post" action="{{url('blzinvst_trainee/'.$Trainees->id)}}" class="form theme-form">
                @csrf
               <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Trainee Name </label>
                        <input class="form-control" type="text" value="{{old('name',$Trainees->name)}}" name="name" placeholder="Trainee Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Score</label>
                      <input class="form-control" type="text" value="{{old('name',$Trainees->score)}}" name="score" placeholder="Score">
                      @error('score')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Courses</label>
                      <input class="form-control" type="text" value="{{old('courses',$Trainees->courses)}}" name="courses" placeholder="Courses">                      
                      @error('courses')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Cerificates</label>
                      <input class="form-control" type="text" value="{{old('cerificates',$Trainees->cerificates)}}" name="cerificates" placeholder="Cerificates">                      
                     
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Emp Status</label>
                      <input class="form-control" type="text" value="{{old('EmpStatus',$Trainees->EmpStatus)}}" name="EmpStatus" placeholder="Emp Status">                     
                     
                    </div>
                  </div>              
                                    <div class="col-6">
                   <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('status') =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('status') =="0"? 'selected' : ''}}>InActive</option>
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
                      <a href="{{url('blzinvst_training')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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