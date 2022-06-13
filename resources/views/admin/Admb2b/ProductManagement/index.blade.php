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

                     <h5>{{$moduleName}}</h5>

                  </div>

                  <div class="col-6 text-right">

                     

                     <a href="{{url('product/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>

                    

                  </div>

               </div>             

           </div>

           <div class="card-body">

             <div class="table-responsive">

               <table class="table data-tables" >

                  <thead class="table-light">

                     <tr>

                        <th>#</th>

                        <th>Image</th>

                        <th>Name</th> 

                        <th>Brand</th> 

                        <th>Price</th>                                                                                                                 

                        <th>Stock</th>                                                                   

                        <th>Action</th>

                     </tr>

                  </thead>

                  <tbody>

                     @foreach ($products as $value)

                     <tr>

                        <td>{{'#'.$value->product_number}}</td>

                        <td>

                           @if($value->image == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <img src="{{url('assets/images/upload/'.explode(",",$value->image)[0])}}" class="ïmg table-img">

                           @endif

                        </td>                        

                        <td>{{$value->name}}</td>

                        <td>{{$value->brand}}</td>

                        <td><span class="text-danger"><strike>{{$value->regular_price}}</strike></span>{{$value->sale_price}}USD</td>

                        <td>{{$value->stock.'pc.'}}</td>                       

                        <td>

                            

                                <a href='{{url('product/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>

                           

                            <a href='{{url('productDetail/'.encrypt($value->id))}}' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>

                            <a href='{{url('productgallery/'.encrypt($value->id))}}' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>

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