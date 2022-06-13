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
                     <!--<a href="{{url('blzinvst_online_application/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>-->
                     @endpermission
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
               <table class="table data-tables" >
                  <thead class="table-light">
                     <tr>
                       <tr>

                                        <th>Name</th>
                                        <th>Paid Amount</th>
                                        <th>Upload Reciept </th>
                                        <th>Payment Date </th>
                                       
                                    </tr>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($TrainingLists as $value)
                                    
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->paid_amount}}</td>
                                        <td><a href="/assets/images/payment/{{$value->Upload_Reciept}}">{{$value->Upload_Reciept}}</a></td>
                                        <td>{{$value->created_at}}</td>

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