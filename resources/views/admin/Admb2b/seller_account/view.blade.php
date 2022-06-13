@extends('admin.layouts.light.master')
@section('title', 'Seller Detail')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName }}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
  <div>
    <div class="row product-page-main p-0">
	<div class="col-xl-6 xl-cs-40 box-col-6">
        <div class="card">
          <div class="card-body">
            <!-- side-bar colleps block stat-->
            <div class="filter-block">
			<h5>{{' UserID : #'.$UserData->user_id}}</h5>
			<p></p>
              <h5>User Name:{{$UserData->name}}</h5>
              <p></p>
              <h5>Last Name:{{$UserData->last_name}}</h5>
              <p></p>
            
            </div>
          </div>
        </div>
      
		
      </div>
      <div class="col-xl-6 xl-cs-40 box-col-12">
        <div class="card">
          <div class="card-body">
            @if($UserData->image == "")
            <div class="product-sliders owl-carousel owl-theme" id="sync1">
              <div class="item"><img src="{{url('assets/images/noimage.png')}}" height="400" width="100%" alt=""></div>
            </div>
            @else 
              <div class="product-slider owl-carousel owl-theme" id="sync1">
                 <div class="item"><img src="{{url('assets/images/upload/'.$UserData->image)}}" height="400" width="100%" alt=""></div>
              </div>
             
            @endif
          </div>
        </div>
      </div>
	  </div>
	  <div class="row">
      <div class="col-xl-5 xl-100 box-col-6">
        <div class="card">
          <div class="card-body">
            <div class="product-page-details">
              <h3>User Type:- {{$UserData->user_type}}</h3>
            </div>
            <div class="product-price">
              
            </div>
            {{-- <ul class="product-color">
              <li class="bg-primary"></li>
              <li class="bg-secondary"></li>
              <li class="bg-success"></li>
              <li class="bg-info"></li>
              <li class="bg-warning"></li>
            </ul> --}}
           
         
            <br>

            <hr>
            <div>
              <table class="product-page-width">
                <tbody>
                  <tr>
                    <td> Email &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td class="txt-success">{{$UserData->email}}</td>
                  </tr>
                 
                  <tr>
                    <td> Phone &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$UserData->phone}}</td>
                  </tr>
                  <tr>
                    <td> Gender &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td> @if($UserData->gender==0)
							Male 
						@else
						Female 
						@endif
					</td>
                  </tr>
                  <tr>
                    <td> Pincode  &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</td>
                    <td>{{$UserData->length == ""?'-' : $UserData->pincode}}</td>
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
              
				
              </div>
            </div>
            <hr>
            <div class="row">
           
              <div class="col-md-8">
                
              </div>
            </div>
          
          
          
          </div>
        </div>
      </div>
      
    </div>
  </div>
    <div class="card">
    <div class="row product-page-main">
      <div class="col-sm-12">
          <h5>Address:-</h5>
          <p>
            {{$UserData->address}}
          </p>
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