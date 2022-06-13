@extends('admin.layouts.light.master')

@section('title', 'ContactUs-QueryList')



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

                     <h5>{{$moduleName}} </h5>

                  </div>
                  
                  

               </div>             

           </div>

           <div class="card-body">

             <div class="table-responsive">

               <table class="table data-tables" >

                  <thead class="table-light">

                     <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>                         

                        <th>Message</th>                            

                        <!--<th>Role</th>-->
                                                  

                        <!--<th>Action</th>-->

                     </tr>

                  </thead>

                  <tbody>

                     @foreach ($contact as $value)
					
                     <tr>

                        <td>{{'#'.$value->Id}}</td>

                        <td>{{$value->name}}</td>

                        <td>{{$value->email}}</td>

                        <td>{{$value->mobile_no == ""?'-':'+'.$value->mobile_no}}</td>

                        <td>{{$value->message}}</td>

                        

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