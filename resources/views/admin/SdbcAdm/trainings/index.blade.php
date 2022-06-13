@extends('admin.layouts.light.master')
@section('title', 'Users')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">{{$moduleName}}</li>
@endsection

@section('content')
<div class="container-fluid">
   
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
           <div class="card-header">          
               <div class="row">
                  <div class="col-6">
                     <h5>{{$moduleName}}</h5>
                  </div>
                  <div class="col-6 text-right">
                     
                     <a href="{{url('training/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
                    
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
              
              <?php //print_r($BlzTrainingin); ?>
               <table class="table data-tables" >
                  <thead class="table-light">
                     <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Stream Name</th>
                        <th>Name</th>                         
                        <th> Duration</th>                            
                        <th> Start Date</th>                            
                        <th> Image</th>                            
                        <th> Video</th>                            
                        <th> Description</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($BlzTrainingins as $value)
                     <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->CourseName}}</td>
                        <td>{{$value->StreamName}}</td>
                        <td>{{$value->TrainingName}}</td>
                        <td>{{$value->TrainingDuration}}</td>
                        <td>{{$value->TrainingStartDate}}</td>
                        <td>
                            @if($value->TrainingImage == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <img src='{{URL::asset("assets/images/upload/$value->TrainingImage")}}' class="ïmg table-img">

                           @endif
                        </td> 
                        <td>
                            @if($value->TrainingVideo == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <video width="120" height="80" controls>
                                    <source src="{{URL::asset("assets/images/upload/$value->TrainingVideo")}}" type="video/mp4">
                                  
                              </video>

                           @endif
                        </td>
                        <td>{{$value->TrainingDescription}}</td>
                        <td>
                           <a href='{{url('training/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                           <a href='{{url('training/delete/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
   </div>
</div>
@endsection

@section('script')

<script>    
   @if (Session::has('status'))
      $.notify({ message:'{!! session("status") !!}'},{
         type:'success',
         allow_dismiss:false,  
         icon: 'fa fa-check',                                          
         timer:500,
         delay:500 ,      
         placement:{
            from:'top',
            align:'center'
         },                                      
      });   
   @endif
 
</script>
@endsection