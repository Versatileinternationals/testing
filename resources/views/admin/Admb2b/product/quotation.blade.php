@extends('admin.layouts.light.master')

@section('title', 'Quotations')



@section('css')

@endsection



@section('style')

@endsection



@section('breadcrumb-title')

<h3>{{$moduleName}}</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item active">{{$moduleName}} </li>

@endsection



@section('content')

<div class="container-fluid">

   <div class="row">

      <div class="col-sm-12">

         <div class="card card-absolute">

            <div class="card-header bg-primary">

              <h5 class="text-white">Upload Product</h5>

            </div>

           

          </div>

      </div>             

  </div>  
  
  

   <div class="row">

      <div class="col-sm-12">

         <div class="card">

           <div class="card-header">          

               <div class="row">

                  <div class="col-6">

                     <h5>{{$moduleName ?? ''}}</h5>

                  </div>

                  <div class="col-6 text-right">

                  </div>

               </div>             

           </div>

            <div class="card-body">
             <div class=" col-sm-12 table-responsive">
               <table class="table data-tables"  id="table">

                  <thead class="table-light">

                     <tr>
                        <th>Date</th>
                        
                        <th>ID</th>

                        <th>Seller Company</th>

                        <th>Name</th> 
                       
                        <th>Phone</th> 
                       
                        <th>Email</th>                                                                                                                 

                        <th>Service</th>
                        
                        <th>Qty</th>
                        
                        <th>Status</th>

                     </tr>

                  </thead>
                    
                  <tbody id="tbody" >
                      
                    

                     @foreach ($quotations as $value)

                     <tr>

                        <td>{{$value->date}}</td>

                        <td>{{'#'.$value->id}}</td>
                        
                        <td>{{$value->company_name}}</td>
                        
                        <td>{{$value->name}}</td>

                        <td>{{$value->phone}}</td>                    

                        <td>{{$value->email}}</td>
                        
                        <td>{{$value->service}}</td>
                        
                        <td>{{$value->qty}}</td>
                        
                        @if($value->quotation_status=='0')
                        <td><span class="badge badge-warning">Pending</span></td>
                        @elseif($value->quotation_status=='1')
                        <td><span class="badge badge-success">Accepted</span></td>
                        @elseif($value->quotation_status=='2')
                        <td><span class="btn btn-primary">Closed</span></td>
                        @elseif($value->quotation_status=='3')
                        <td><span class="badge badge-danger">Cancelled</span></td>
                        @else
                        <td><span class="badge badge-warning">Pending</span></td>
                        @endif

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
    //   $(document).ready(function() {
        $('#category').on('change', function() {
          var category=$(this).val();
        //  console.log(category);
          $.ajax({
              headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
               url: "{{url('ajaxapproved')}}",
                type: "GET",
                data:{'category':category},
                 success:function(response) {
                    console.log(response);
                   $('#tbody').html(response);
                 }
          });
        });
    // });
</script>


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

<style>
    table.table.data-tables tr td:nth-child(3) {
    width: 150px;
}
table.table.data-tables tr td:nth-child(5) {
    width: 170px;
}
</style>





@endsection