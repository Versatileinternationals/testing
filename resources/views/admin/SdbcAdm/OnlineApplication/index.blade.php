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
                     <a href="{{url('sdbc_application/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
                        <th>App Name</th>
						<th>App Code</th>
                        <th>Date</th>
                        <th>App Type</th>                         
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach ($BlzApp as $app)
                     <tr>
					    <td>{{ $app->id  }}</td>
                        <td>{{ $app->application_name  }}</td>
						<td>{{ $app->application_code   }} </td>
                        <td>{{ $app->app_date  }} </td>
						<td>{{ $app->application_type   }} </td>
						
                        <td>@if($app->status == "0")
                                InActive
                           @else
                                Active
                           @endif</td>
                       
                       
                        
                        <td>
                           @permission('edit.users')
                           <a href='{{url('sdbc_application/'.($app->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
						   <a href='{{url('sdbc_application/delete/'.($app->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
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