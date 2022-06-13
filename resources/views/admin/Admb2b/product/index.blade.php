@extends('admin.layouts.light.master')

@section('title', 'Products')



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

            <div class="card-body">

            <form action="{{url('uploadProduct' )}}" method="post" enctype="multipart/form-data">

                  @csrf

               <div class="row">

                  <div class="col-lg-4">

                     <div class="form-group">

                        <input class="form-control" required type="file" value="{{old('file')}}" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >

                        @error('name')

                        <div class="text-danger show"><strong>{{$message}}</strong></div>

                        @enderror

                      </div>

                  </div>

                  <div class="col-2">

                     <button type="submit" class="btn btn-primary">Upload</button>

                  </div>

                  <div class="col-lg-6 text-right">

                     <p> <a href="{{url('assets/products/sample.xlsx')}}"><button type="button" class="btn btn-primary">Download Sample File <i data-feather="download"> </i></button></a></p>

                  </div>

                  <div class="col-lg-12">

                     @if(Session::has('error_msg'))                            

                        <div class="text-danger show"><strong>{{Session::get('error_msg')}}</strong></div>

                     @endif

                  </div>

               </div>

            </form>

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

                     

                     <a href="{{url('product/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>

                    

                  </div>

               </div>             

           </div>

            <div class="card-body">
                <select class="browser-default custom-select" name="category" id="category" style="width:22%;margin-bottom:5px;">
                    <option hidden selected>Select category</option>
                    <option value="1">Approved</option>
                    <option value="Pending">Pending</option>
                    <option value="0">Dispproved</option>
                </select>
                                    
             <div class=" col-sm-12 table-responsive">
               <table class="table data-tables"  id="table">

                  <thead class="table-light">

                     <tr>

                        <th>Date</th>

                        <th>ID</th>
                        
                        <th>Seller</th>

                        <th>Image</th>

                        <th>Name</th> 
                       
                        <th>Status</th> 

                        <th>Featured</th> 
                       
                        <th>Price</th>                                                                                                                 
                                                               
                        <th>Action</th>

                     </tr>

                  </thead>
                    
                  <tbody id="tbody" >
                      
                      <!--<a href="{{'/product'}}"   class='btn btn-success btn-sm' style="margin-right:10px;"> All </a>-->
                      
                      <!--<a href="{{'/product/approved'}}" class='btn btn-success btn-sm' style="margin-right:10px;"> Approved </a>-->
                      
                      <!--<a href="{{'/product/disapproved'}}"  class='btn btn-danger btn-sm'  style="margin-right:10px;"> Disapproved </a>-->
                      
                      <!--<a href="{{'/product/pending'}}"  class='btn btn-warning btn-sm' style="margin-right:10px;"> Pending </a>-->
                     
                        

                     @foreach ($products as $value)
					 {{ $value }}
                     <tr>

                       <td>{{$value->created_at}}</td>
                       
                        <td>{{'#'.$value->product_number}}</td>
                        
                        <td>{{$value->company_name}}</td>

                        <td>

                           @if($value->main_image == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <img src="{{url('assets/images/upload/'.explode(",",$value->main_image)[0])}}" class="ïmg table-img">

                           @endif

                        </td>                        

                        <td>{{$value->name}}</td>
                        
                        
                            @if($value->status=='1')
                            <td><span class="badge badge-success">Approved</span></td>
                            @elseif($value->status=='Pending')
                            <td><span class="badge badge-warning">Pending</span></td>
                            @elseif($value->status=='0')
                            <td><span class="badge badge-danger">Disapproved</span></td>
                            @else
                            <td><span class="badge badge-warning">Pending</span></td>
                            @endif
                        
                       
                        <td>
                            
							<input value="" type="checkbox" class="featured" name="featured">Featured

                            <!--<select class="browser-default custom-select" name="featured" id="featured">
                                <option hidden selected>Featured</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>-->
                        </td>
                        
                     

                        <td><span class="text-danger"><strike> {{$value->regular_price}} </strike></span> {{$value->sale_price}} USD</td>

                        <!--<td>{{$value->stock.'pc.'}}</td>  -->

                        <td>

                            <a href='{{url('product/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>

                            <a href='{{url('productDetail/'.encrypt($value->id))}}' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>

                            <a href='{{url('productgallery/'.encrypt($value->id))}}' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>
                            
                             @if($value->status=='Pending')
                            <a href='{{url('productapprove/'.encrypt($value->id))}}' class='btn btn-success btn-sm'> <i class="fa fa-thumbs-up" aria-hidden="true"></i> </a>
                            <a href='{{url('productdisapprove/'.encrypt($value->id))}}' class='btn btn-danger btn-sm'> <i class="fa fa-thumbs-down" aria-hidden="true"></i> </a>
                            
                            @elseif($value->status=='0')
                            <a href='{{url('productapprove/'.encrypt($value->id))}}' class='btn btn-success btn-sm'> <i class="fa fa-thumbs-up" aria-hidden="true"></i> </a>
                            
                            @else
                            <a href='{{url('productdisapprove/'.encrypt($value->id))}}' class='btn btn-danger btn-sm'> <i class="fa fa-thumbs-down" aria-hidden="true"></i> </a>
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
    //   $(document).ready(function() {
        $('.featured').on('change', function() {
          var featured=$(this).val();
		
          $.ajax({
              headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
                url:"{{ url('featured') }}",
                type:'POST',
                dataType:'json',
                data:{
                  featured:featured
                },
                success:function(res){
                    //$("#subcategory_id").val('').trigger('change');
                    alert(res)
                    
                    
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