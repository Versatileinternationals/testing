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
                     @permission('create.users')
                     <a href="{{url('clienttestimonials/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Designation</th> 
                        <th>Country</th>                          
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($ClientTestimonials as $testimonial)
                     <tr>
                        <td>{{ $testimonial->id}}</td>
                        <td>{{ $testimonial->name}}</td>
                        <td>{{ $testimonial->description}}</td>
                        <td>{{ $testimonial->designation}}</td>
                        <td>{{ $testimonial->country}}</td>
                         <td> @if($testimonial->Status == 0)
                                InActive
                           @else
                                Active
                           @endif</td>
                        <td>
                           @permission('edit.users')
                           <a href='{{url('clienttestimonials/'.($testimonial->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
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