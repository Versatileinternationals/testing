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
                     <!--@permission('create.users')-->
                     <!--<a href="{{url('blzinvst_online_application/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>-->
                     <!--@endpermission-->
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
               <table class="table" id="mytable" style="width:100%;">
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                         <th> Name</th>
                        <th>Email</th>
                        <th>Mobile</th> 
                        <th>Address</th>                         
                        <th>City</th>                            
                                                
                        <!--<th>Action</th>-->
                     </tr>
                  </thead>
                  <tbody>
                    @foreach ($BlzApp as $app)
                     <tr>
					    <td>{{ $app->id  }} </td>
					
                        <td>{{ $app->name  }} {{$app->last_name}}</td>
		                <td>{{$app->email}}</td>
                       <td>{{$app->phone}}</td>
                       <td>{{$app->address}}</td>
                       <td>{{$app->city}}</td>
                        
         <!--               <td>-->
         <!--                  @permission('edit.users')-->
         <!--                  <a href='' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>-->
						   <!-- <a href='view_details/{{ $app->id  }}' class='btn btn-primary btn-sm'> <i class="fa fa-eye"></i></a>-->
						   <!--<a href='{{url('blzinvst_online_application/delete/'.($app->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>-->
         <!--                  @endpermission-->
         <!--               </td>-->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script>

$(document).ready(function() {
   $('#mytable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'colvis',
        'excel',
        'print'
    ]
});
});
</script>

@endsection