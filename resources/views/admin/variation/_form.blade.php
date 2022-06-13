@extends('admin.layouts.light.master')
@section('title', 'Edit Variation Product')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3> {{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"> {{$moduleName}}</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('variation-product/'.$variation->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" value="{{old('name',$variation->name)}}" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group mb-3">
                        <label class="col-form-label">Products</label>
                        <select class="js-example-basic-single select2 col-sm-12 form-select" required multiple name="products[]" id="products" placeholder="Select Product">                                                  
                          @foreach ($product as $value)
                          <option value="{{$value->id}}" {{in_array($value->id,old('products',array_filter(explode(',',$variation->products)))) ==true? 'selected' : ''}}>{{'#'.$value->product_number.' : '.$value->name}}</option>    
                          @endforeach
                        </select>  
                        @error('products')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                      </div>
                    </div> 
                </div>
                                    
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('variation-product')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
  
  $( document ).ready(function() {
    
  });
</script>
@endsection