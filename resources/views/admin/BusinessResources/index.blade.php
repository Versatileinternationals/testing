@extends('admin.layouts.light.master')
@section('title', 'Business Resources')

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
                     <a href="{{url('business_resources/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
						<th>Resource Name</th>
                        <th>Important Links</th> 
                        <th>Document</th>
                         <th>Video</th>                          
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    
                     
                     @foreach ($BlzBusinessResources as $value)
                     <tr>
                        <td>{{$value->id}}</td>
						<td>{{$value->resource_name}}</td>
						<td width="100px">{{$value->resource_links}}</td>
						
                       
						
                        <td>
                           @if($value->document_upload == "")
                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">
                           @else
                              <img src="{{url('assets/images/upload/'.$value->document_upload)}}" class="ïmg table-img">
                           @endif
                        </td>
						 <td>
						 <video width="100" height="80" controls>
                          <source src="{{url('assets/video/'.$value->resource_video)}}" type="video/mp4">
                          <source src="{{url('assets/video/'.$value->resource_video)}}" type="video/ogg">
						 </td>
                        <td>
                          <span class="badge {{$value->Status == 1 ? 'badge-success ': 'badge-danger'}}">{{$value->Status==0?'InActive': 'Active'}}</span>
                        </td>
                          
                        
                        
                        <td>
                           <a href='{{url('business_resources/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                           <a href='{{url('business_resources/delete/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
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