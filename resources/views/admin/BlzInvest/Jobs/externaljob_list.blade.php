@extends('admin.layouts.light.master')
@section('title', 'External Jobs')

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
                     @permission('create.users')
                     <a href="{{url('blzinvst_ExternalJobs/Add_ExternalJobs')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
                        <th>External Links</th>
                      
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach ($ExternalJobsList as $value)
                     <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->external_links}}</td>
                       
                        <td><span class="badge {{$value->Status == 1 ? 'badge-success': 'badge-danger'}}">{{$value->Status==0?'InActive': 'Active'}}</span></td> 
                       
						 <td>
                           <a href='{{url('blzinvst_ExternalJobs/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                           <a href='{{url('blzinvst_ExternalJobs/delete/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
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