@extends('admin.layouts.light.master')
@section('title', 'Online Quiz')

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
                     
                     <a href="{{url('online_quiz/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
                    
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
                        <th>Exam Title</th>
						<th>Questions</th>
						
						<th>Exam From</th>
                        <th>Exam To</th>
                        <th>Time Duration</th>                         
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($BlzOnlineQuiz as $value)
                     <tr>
                        <td>{{$value->id}}</td>
						<td>{{$value->title}}</td>
                        <td>{{$value->questions}}</td>
						
                        <td>{{$value->exam_to}}</td>
                        <td>{{$value->exam_from}}</td>
						<td>{{$value->duration}}</td>
                        <td>{{$value->Status}}</td>
                        <td>
                           <a href='{{url('online_quiz/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                           <a href='{{url('online_quiz/delete/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
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