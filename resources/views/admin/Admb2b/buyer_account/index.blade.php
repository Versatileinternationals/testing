@extends('admin.layouts.light.master')
@section('title', 'Buyer Account')

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
                   <a href="{{url('buyer_account/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
                     @endpermission
                  </div>
               </div>             
           </div>
           <div class="card-body">
		    @if (Session::has('success'))
		   <div class="alert alert-success" role="alert">
			   {{Session::get('success')}}
		   </div>
		  @elseif (Session::has('error'))
			   <div class="alert alert-danger" role="alert">
				   {{Session::get('error')}}
			   </div>
		  @endif
             <div class="table-responsive">
               <table class="table data-tables" >
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>                         
                        <th>Status</th>                            
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($BuyerAccounts as $buyers)
                     <tr>
                        <td>{{ $buyers->id }}</td>
                       <td>{{ $buyers->name }}</td>
                       <td>{{ $buyers->email }}</td>
                       <td>{{ $buyers->phone }}</td>
                       <td><span class="badge {{$buyers->status == 1 ? 'badge-success': 'badge-danger'}}">{{$buyers->status==0?'InActive': 'Active'}}</span></td>
                       <td>
                            
                      <a href='{{url('buyer_account/'.encrypt($buyers->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
						  <a href='{{url('buyer_view/'.$buyers->id)}}' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>
						   @if($buyers->status==1)
							<a onclick='if(confirm("Are you sure want to Account Deactivate?")){return true;} else {return false;}' href='{{url('buyer_account/deacivate_account/'.encrypt($buyers->id))}}' class='btn btn-danger btn-sm'> Deactive</a>
							
							   
						   
						   @else
						    <a onclick='if(confirm("Are you sure want to Account Activate?")){return true;} else {return false;}' href='{{url('buyer_account/acivate_account/'.encrypt($buyers->id))}}' class='btn btn-success btn-sm'> Active</a>
						  @endif
                           
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