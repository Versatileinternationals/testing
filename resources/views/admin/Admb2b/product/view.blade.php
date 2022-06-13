@extends('admin.layouts.light.master')
@section('title', 'Product Detail')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName .' Number : #'.$product->product_number}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
  <div>
  
    <div class="row product-page-main p-0">
      <div class="col-xl-4 xl-cs-65 box-col-12">
        <div class="card">
          <div class="card-body">
            @if($product->main_image == "")
            <div class="product-slider owl-carousel owl-theme" id="sync1">
              <div class="item"><img src="{{url('assets/images/noimage.png')}}" height="400" width="100%" alt=""></div>
            </div>
            @else 
              <div class="product-slider owl-carousel owl-theme" id="sync1">
                @foreach (array_filter(explode(',',$product->main_image)) as $value )
                <div class="item"><img src="{{url('assets/images/upload/'.$value)}}" alt=""></div>
                @endforeach
              </div>
              <div class="product-bottom-slider owl-carousel owl-theme" id="sync2">
                @foreach (array_filter(explode(',',$product->main_image)) as $value )
                <div class="item"><img src="{{url('assets/images/upload/'.$value)}}" alt=""></div>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col-xl-5 xl-100 box-col-6">
        <div class="card">
          <div class="card-body">
            <div class="product-page-details">
              <h3>{{$product->name}}</h3>
            </div>
            <div class="product-price">{{$product->sale_price}}.00 USD
              <del>{{$product->regular_price}}.00 USD</del>
            </div>
            {{-- <ul class="product-color">
              <li class="bg-primary"></li>
              <li class="bg-secondary"></li>
              <li class="bg-success"></li>
              <li class="bg-info"></li>
              <li class="bg-warning"></li>
            </ul> --}}
           
            <!--<span class="badge {{$product->allow_return == 1 ? 'badge-success': 'badge-danger'}}">{{$product->allow_return==0?'Return Not Allow': 'Return Allowed'}}</span>-->
            <br>
             <!--<p>{{$product->short_description}}</p>-->
            <hr>
            <div>
              <table class="product-page-width">
                <tbody>
                  <tr>
                    <td> Stock &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td class="txt-success">{{$product->stock}}</td>
                  </tr>
                  <!--<tr>
                    <td>Minimum Stock &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td class="txt-success">{{$product->minimum_stock}}</td>
                  </tr>
                  <tr>
                    <td>Maximum Order Quantity &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td class="txt-success">{{$product->max_order_qty}}</td>
                  </tr> -->
                  <tr>
                    <td> Weight &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$product->weight == ""?'-' : $product->weight.'kg'}}</td>
                  </tr>
                  <tr>
                    <td> Height &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$product->height == ""?'-' : $product->height}}</td>
                  </tr>
                  <tr>
                    <td> Length &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$product->length == ""?'-' : $product->length}}</td>
                  </tr>
                  <tr>
                    <td>Width &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$product->width == ""?'-' : $product->width .'cm.'}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div class="row">
              
			  
            </div>
            
            <div class="row">
              <div class="col-md-4">
               <!-- <h6 class="product-title">Page Title</h6>-->
              </div>
              <div class="col-md-8">
                <!-- <div class="product-icon">
                  <ul class="product-social">
                    <li class="d-inline-block">{{$product->page_title =="" ?  "-" : $product->page_title}}</li>                   
                  </ul>                
                </div> -->
				
              </div>
            </div>
            <hr>
            <div class="row">
            <!--  <div class="col-md-4">
                <h6 class="product-title">Page Keyword</h6>
              </div>-->
              <div class="col-md-8">
                
              </div>
            </div>
          
            <div class="row">
             <!-- <div class="col-md-4">
                <h6 class="product-title">Page Description</h6>
              </div>
              <div class="col-md-8">
                <div class="product-icon">
                  <ul class="product-social">
                    <li class="d-inline-block">{{$product->page_description =="" ?  "-" : $product->page_description}}</li>                   
                  </ul>                
                </div>
              </div> -->
			  
            </div>
          
          </div>
        </div>
      </div>
      <div class="col-xl-3 xl-cs-35 box-col-6">
        <div class="card">
          <div class="card-body">
            <!-- side-bar colleps block stat-->
            <div class="filter-block">
              <h5>Category</h5>
              <p>{{$product->category->name}}</p>
              <h5>Sub Category</h5>
             <p>{{$product->subcategory->name}}</p>
             <!-- <h5>Brand</h5>
            
            </div>
          </div>
        </div>
      <!--  <div class="card">
          <div class="card-body">
            <div class="collection-filter-block">
              <ul class="pro-services">
                <li>
                  <div class="media"><i data-feather="truck"></i>
                    <div class="media-body">
                      <h5> Shipping Class </h5>
                      <p>{{$product->shipping_class}}</p>
                    </div>
                  </div>
                </li>            
                <li>
                  <div class="media"><i data-feather="gift"></i>
                    <div class="media-body">
                      <h5>Sales Duration  </h5>
                      <p>{{ date('d,M Y',strtotime($product->sale_start_date)).' to '. date('d,M Y',strtotime($product->sale_end_date))}}</p>
                    </div>
                  </div>
                </li>
              
              </ul>
            </div>
          </div>
         
        </div>-->
		
		
      </div>
    </div>
  </div>
  <div class="card">
    <div class="row product-page-main">
      <div class="col-sm-12">
          <h5>Product Description</h5>
          <p>
            {!! $product->description !!}
          </p>
      </div>
    </div>
  </div>
  @if(count($product->related_products)>0)
   <!-- <div class="card">
      <div class="row product-page-main">
        <div class="col-sm-12">
            <h5>Related Products</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          @foreach ($product->related_products as $item)
            <div class="col-xl-4 col-md-6">
              <div class="prooduct-details-box">                                 
                <div class="media"><img class="align-self-center img-fluid img-60 mr-3 ml-3" src="{{url('assets/images/upload/'.$item->main_image)}}" alt="#">
                  <div class="media-body ms-3">
                    <div class="product-name">
                      <h6><a href="#">{{$product->name}}</a></h6>
                    </div>
                    {{-- <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div> --}}
                    <div class="price d-flex"> 
                      <div class="text-muted me-2">Price</div>: <span class="text-danger"><strike>{{$item->regular_price}}</strike></span>{{$item->sale_price}}KD
                    </div>
                    <div class="avaiabilty">
                      <div class="text-success">Stock: {{$item->stock}}</div>
                      {{-- <div class="text-success">Brand: {{$item->brandData->name}}</div> --}}
                    </div><a class="btn btn-primary btn-xs" href="{{url('productDetail/'.encrypt($item->id))}}">View</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div> -->






    </div>
	
  @endif
</div>
@endsection

@section('script')
<script>

jQuery(document).ready(function() {
  

});


</script>
@endsection