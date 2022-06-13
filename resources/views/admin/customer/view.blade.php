@extends('admin.layouts.light.master')
@section('title', 'Customer Detail')

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
      <div class="col-md-6 col-lg-6 col-xl-4 box-col-6">
        <div class="card custom-card">
          <div class="card-header"><img class="img-fluid" src="{{url('assets/images/cover.jpg')}}" alt=""></div>
          <div class="card-profile"><img class="rounded-circle" src="{{url('assets/images/upload/'.$user->image)}}" alt=""></div>
       
          <div class="text-center profile-details">
            <h4>{{$user->name}}</h4>
            <h6 class="mb-0">{{$user->email}}</h6>
            <h6>{{'+'.$user->phone_code.$user->phone}}</h6>
          </div>
          <div class="card-footer row">
            <div class="col-6 col-sm-6">
              <h6>Completed Orders</h6>
              <h3 class="counter">30</h3>
            </div>
            <div class="col-6 col-sm-6">
              <h6>Pending Orders</h6>
              <h3>23</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-8 box-col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Orders</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="icon-pending-tab" data-bs-toggle="tab" href="#icon-pending" role="tab" aria-controls="icon-pending" aria-selected="true"><i class="icofont icofont-hour-glass"></i>Pending</a></li>
                    <li class="nav-item"><a class="nav-link" id="complete-icon-tab" data-bs-toggle="tab" href="#complete-icon" role="tab" aria-controls="complete-icon" aria-selected="false"><i class="icofont icofont-check-circled"></i>Completed</a></li>
                </ul>
                <div class="tab-content" id="icon-tabContent">
                    <div class="tab-pane fade show active" id="icon-pending" role="tabpanel" aria-labelledby="icon-pending-tab">
                      <div class="row mt-2">
                        <div class="col-xl-12 notification box-col-12">
                          <div class="card">
                              <div class=" media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2020 <span>10:10</span><span class="badge badge-warning">Waiting</span></p>
                                  <h6 class="text-dark mt-1">Updated Product</h6>
                                  <span>Quisque a consequat ante sit amet magna...</span>
                                </div>
                              </div>
                              <hr>
                              <div class="media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2020<span class="ps-1">Today</span><span class="badge badge-success">Paid</span>  </p>
                                  <h6 class="text-dark mt-1">Tello just like your product</h6>
                                  <span>Quisque a consequat ante sit amet magna... </span>
                                </div>
                              </div>
                              <hr>
                              <div class=" media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2020 <span>10:10</span><span class="badge badge-warning">Waiting</span></p>
                                  <h6 class="text-dark mt-1">Updated Product</h6>
                                  <span>Quisque a consequat ante sit amet magna...</span>
                                </div>
                              </div>
                          </div>     
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="complete-icon" role="tabpanel" aria-labelledby="complete-icon-tab">
                      <div class="row mt-2">
                        <div class="col-xl-12 notification box-col-12">
                          <div class="card">
                              <div class=" media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2021 <span>10:10</span><span class="badge badge-success">Paid</span></p>
                                  <h6 class="text-dark mt-1">Updated Product</h6>
                                  <span>Quisque a consequat ante sit amet magna...</span>
                                </div>
                              </div>
                              <hr>
                              <div class="media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2021<span class="ps-1">Today</span><span class="badge badge-success">Paid</span>  </p>
                                  <h6 class="text-dark mt-1">Tello just like your product</h6>
                                  <span>Quisque a consequat ante sit amet magna... </span>
                                </div>
                              </div>
                              <hr>
                              <div class=" media mb-1">
                                <div class="media-body">
                                  <p class="mb-0">20-04-2021 <span>10:10</span><span class="badge badge-success">Paid</span></p>
                                  <h6 class="text-dark mt-1">Updated Product</h6>
                                  <span>Quisque a consequat ante sit amet magna...</span>
                                </div>
                              </div>
                          </div>    
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h6 class="card-title">Address</h6>
        </div>
        <div class="card-body row">
            @foreach ($user->useraddress as $value)
              <div class="col-3">
                <h6>{{$value->name}}</h6>
                <p class="mb-0">{{$value->street.', '.$value->city}}</p>
                <p class="mb-0">{{$value->state.' '.$value->zipcode}}</p>
                <p class="mb-0">{{$value->country}}</p>
              </div>
              <div class="col-3">
                <h6>{{$value->name}}</h6>
                <p class="mb-0">{{$value->street.', '.$value->city}}</p>
                <p class="mb-0">{{$value->state.' '.$value->zipcode}}</p>
                <p class="mb-0">{{$value->country}}</p>
              </div>
              <div class="col-3">
                <h6>{{$value->name}}</h6>
                <p class="mb-0">{{$value->street.', '.$value->city}}</p>
                <p class="mb-0">{{$value->state.' '.$value->zipcode}}</p>
                <p class="mb-0">{{$value->country}}</p>
              </div>
              <div class="col-3">
                <h6>{{$value->name}}</h6>
                <p class="mb-0">{{$value->street.', '.$value->city}}</p>
                <p class="mb-0">{{$value->state.' '.$value->zipcode}}</p>
                <p class="mb-0">{{$value->country}}</p>
              </div>
            @endforeach
           
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('script')

<script>    
  
 
</script>
@endsection