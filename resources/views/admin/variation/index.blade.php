@extends('admin.layouts.light.master')
@section('title', 'Product Variation')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3> {{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active"> {{$moduleName}}</li>
@endsection

@section('content')
<div class="container-fluid">
   
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
           <div class="card-header">          
               <div class="row">
                  <div class="col-6">
                     <h5> {{$moduleName}}</h5>
                  </div>
                  <div class="col-6 text-right">
                     @permission('create.product')
                     <a href="{{url('variation-product/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
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
                        <th>Products</th>                                                                  
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($variation as $value)
                     <tr>
                        <td>{{'#'.$value->variation_id}}</td>
                      
                        <td>{{$value->name}}</td>
                        <td>
                            <ul class="product-color">
                                @foreach (explode(',',$value->products) as $item)
                                    <?php $pro = App\Models\Product::find($item); ?>
                                    <li class="" style="background:{{$pro->colors}}"></li>
                                @endforeach                                
                            </ul>
                        </td>
                        <td>
                            @permission('edit.product')
                                <a href='{{url('variation-product/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
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