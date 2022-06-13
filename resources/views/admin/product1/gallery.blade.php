@extends('admin.layouts.light.master')
@section('title', 'Product Gallery')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName .' Number : #'.$product->product_number}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Gallery</li>
@endsection

@section('content')
<div class="container-fluid">
 
  <div class="card">
    <div class="card-header">
        <h5>Product Gallery</h5>
    </div>
    <div class="card-body">
        <form class="dropzone dropzone-info mb-4" id="fileTypeValidation" action="{{url('uploadProductImage/'.$product->id)}}">
            @csrf
            <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
              <h6>Drop files here or click to upload Product Gallery.</h6>              
            </div>
        </form>
        <div class="row my-gallery gallery mt-4 pt-4" id="aniimated-thumbnials" itemscope="">
            @foreach (array_filter(explode(',',$product->image)) as $value)
                <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope=""><a href="../assets/images/big-lightgallry/08.jpg" itemprop="contentUrl" data-size="1600x950">
                    <div><img src="{{url('assets/images/upload/'.$value)}}" itemprop="thumbnail" alt="Image description"></div></a>
                </figure>
            @endforeach
        </div>

      
    </div>
    
  </div>
</div>
@endsection

@section('script')
<script>

jQuery(document).ready(function() {
  

});


</script>
@endsection