@extends('admin.layouts.light.master')
@section('title', 'Roles')

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
                    @permission('create.role')
                    <a href="{{url('role/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
                        <th>Slug</th>   
                        @permission('edit.role')                                          
                        <th>Action</th>
                        @endpermission
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($role as $value)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$value->name}}</td>
                           <td>{{$value->slug}}</td>
                           @permission('edit.role')
                           <td>
                              <a href='{{url('role/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                              @if($value->id != 1 )
                              <a href='{{url('module/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-sliders"></i></a>
                              @endif
                           </td>
                           @endpermission
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
   $(document).ready(function() {   
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
   });
</script>
@endsection