@extends('admin.layouts.light.master')
@section('title', 'Application From')

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
<?php //print_r($BlzApp);  ?>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
           <div class="card-header">          
               <div class="row">
                  <div class="col-6">
                     <h5>{{$moduleName}}</h5>
                  </div>
                  <div class="col-6 text-right">
                     @permission('create.users')
                     <a href="{{url('blzinvst_online_application/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
                     @endpermission
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
               <table class="table data-tables" >
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                         <th>Course Name</th>
                        <th>Stream Name</th>
                        <th>Name</th> 
                        <th>App Type</th>                         
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach ($BlzApp as $app)
                     <tr>
					    <td>{{ $app->id  }}</td>
						<td>{{ $app->Course_Name   }} </td>
                        <td>{{ $app->Category_Name  }}</td>
						
                        <td>{{ $app->TrainingName  }} </td>
						<td>{{$app->CourseType==1?'Paid': 'Free'}} </td>
						
                        <td><span class="badge {{$app->Status == 1 ? 'badge-success': 'badge-danger'}}">{{$app->Status==0?'InActive': 'Active'}}</span></td>
                       
                       
                        
                        <td>
                           @permission('edit.users')
                           <a href='{{url('blzinvst_online_application/'.($app->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
						    <a href='view_details/{{ $app->id  }}' class='btn btn-primary btn-sm'> <i class="fa fa-eye"></i></a>
						   <!--<a href='{{url('blzinvst_online_application/delete/'.($app->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>-->
                           @endpermission
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