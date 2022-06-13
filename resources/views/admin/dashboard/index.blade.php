@extends('admin.layouts.light.master')
@section('title', 'DashBoard')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pages</li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

{{-- <div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-12">
                     <h5>Dashboard</h5>
                  </div>
               </div>               
               
            </div>
            <div class="card-body">
               <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
         </div>
      </div>
   </div>
</div> --}}


<div class="container-fluid">
 
   <div class="row second-chart-list third-news-update">
     <!--<div class="col-lg-4 morning-sec box-col-12">-->
     <!--  <div class="card o-hidden profile-greeting">-->
     <!--    <div class="card-body">-->
     <!--      <div class="media">-->
     <!--        <div class="badge-groups w-100">-->
     <!--          <div class="badge f-12"><i class="me-1" data-feather="clock"></i><span id="txt"></span></div>-->
     <!--          <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>-->
     <!--        </div>-->
     <!--      </div>-->
     <!--      <div class="greeting-user text-center">-->
     <!--        <div class="profile-vector"><img class="img-fluid" src="../assets/images/dashboard/welcome.png" alt=""></div>-->
     <!--        <h4 class="f-w-600"><span id="greeting">Good Morning</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>-->
     <!--        <p><span> Today's earrning is Belize Dollar 05 & your sales increase rate is 3.7 over the last 24 hours</span></p>-->
     <!--        <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a></div>-->
     <!--        <div class="left-icon"><i class="fa fa-bell"> </i></div>-->
     <!--      </div>-->
     <!--    </div>-->
     <!--  </div>-->
     <!--</div>-->
     <div class="col-lg-12 dashboard-sec box-col-12">
       <div class="card earning-card">
         <div class="card-body p-0">
           <div class="row m-0">
             <div class="col-lg-3 earning-content p-0">
               <div class="row m-0 chart-left">
                 <div class="col-lg-12 p-0 left_side_earning">
                   <h5>Dashboard</h5>
                   <p class="font-roboto"></p>
                 </div>
                 <div class="col-lg-12 p-0 left_side_earning">
                   <h5>{{  $users}} </h5>
                   <p class="font-roboto">Total Users</p>
                 </div>
                 <div class="col-lg-12 p-0 left_side_earning">
                   <h5>{{  $Online_Users}} </h5>
                   <p class="font-roboto">Logged-In Users </p>
                 </div>
                 <div class="col-lg-12 p-0 left_side_earning">
                   <h5>100</h5>
                   <p class="font-roboto">Inquiries This Month</p></p>
                 </div>
                 <div class="col-lg-12 p-0 left-btn"><a class="btn btn-gradient">Summary</a></div>
               </div>
             </div>
             <div class="col-lg-9 p-0">
               <div class="chart-right">
                 <div class="row m-0 p-tb">
                   <div class="col-lg-8 col-md-8 col-sm-8 col-12 p-0">
                     <div class="inner-top-left">
                       <ul class="d-flex list-unstyled">                         
                         <li class="active">Weekly</li>
                         <li>Monthly</li>
                         <li>Yearly</li>
                       </ul>
                     </div>
                   </div>
                   {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                     <div class="inner-top-right">
                       <ul class="d-flex list-unstyled justify-content-end">
                         <li>Online</li>
                         <li>Store</li>
                       </ul>
                     </div>
                   </div> --}}
                 </div>
                 <div class="row">
                   <div class="col-lg-12">
                     <div class="card-body p-0">
                       <div class="current-sale-container">
                         <div id="chart-currently"></div>
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
	 
	 <!---- Count -->
     <div class="col-lg-12 chart_data_left box-col-12">
       <div class="card">
         <div class="card-body p-0">
           <div class="row m-0 chart-main">
             {{-- <div class="col-lg-3 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>1001</h4><span>purchase </span>
                   </div>
                 </div>
               </div>
             </div> --}}
             <div class="col-lg-3 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart1 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $pending_account }}</h4><span>Pending Accounts</span>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart2 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $all_product }}</h4><span> Proudct Listing</span>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media border-none align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart3 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $active_jobs }}</h4><span>Active Jobs</span>
                   </div>
                 </div>
               </div>
             </div>
			 
			 
			 <div class="col-lg-3 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media border-none align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart3 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $active_jobs }}</h4><span>Trainee Accounts</span>
                   </div>
                 </div>
               </div>
             </div>
			 
           </div>
         </div>
       </div>
     </div>
	 
	 <!---- Count -->
	 
	 <div class="col-lg-9 chart_data_left box-col-12">
       <div class="card">
         <div class="card-body p-0">
           <div class="row m-0 chart-main">
             
             <div class="col-lg-4 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart1 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $pending_account }}</h4><span>Buyer Accounts</span>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart2 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $all_product }}</h4><span> Seller Listing</span>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 col-md-6 col-sm-6 p-0 box-col-6">
               <div class="media border-none align-items-center">
                 <div class="hospital-small-chart">
                   <div class="small-bar">
                     <div class="small-chart3 flot-chart-container"></div>
                   </div>
                 </div>
                 <div class="media-body">
                   <div class="right-chart-content">
                     <h4>{{ $active_jobs }}</h4><span>Investor Accounts</span>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
	 
	 
     <div class="col-lg-3 chart_data_right box-col-12">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center">
            <div class="media-body right-chart-content">
              <h4>900<span class="new-box">Hot</span></h4><span>Buyers Order </span>
            </div>
            <div class="knob-block text-center">
              <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#3d1abf" data-bgcolor="#ece9fc" value="60">
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
   <div class="row">
    <div class="col-lg-12  box-col-12">
      <div class="card">
        <div class="card-header card-no-border">
          <h5>Current Logged-In</h5>       
        </div>
        <div class="card-body pt-0">
          <div class="our-product">
            <div class="table-responsive">
              <table class="table table-bordernone">
                <tbody class="f-w-500">
				
				@foreach($Online_Users_display as $active_member)
				
                  <tr>
				
					 
                    <td>
                      <div class="media"><img width="40px" class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/noimage.png')}}" alt="">
                        <div class="media-body"><span style="float:left">{{ $active_member->name}} {{ $active_member->last_name}}</span></div>
                         </div>  
                        
                     
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
    <div class="col-lg-8 xl-50 box-col-12">
      <div class="card">
        <div class="card-body">
          <div class="best-seller-table responsive-tbl">
            <div class="item">
              <div class="table-responsive product-list">
                <table class="table table-bordernone">
                  <thead>
                    <tr>
                      <th class="f-22">Pending Proudcts</th>
                      <th>Date</th>
                      <th>Product</th>                      
                      <th>Total</th>
                      <th class="text-end">Status</th>
                    </tr>
                  </thead>
                  <tbody>                   
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle"><img class="img-40 m-r-15 rounded-circle align-top" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                          <div class="status-circle bg-primary"></div>
                          <div class="d-inline-block"><span>Herry Venter</span>
                            <p class="font-roboto">2020</p>
                          </div>
                        </div>
                      </td>
                      <td>21 March</td>
                      <td>Branded Shoes</td>                      
                      <td> <span class="label">BD59,105</span></td>
                      <td class="text-end">Pending</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle"><img class="img-40 m-r-15 rounded-circle align-top" src="{{asset('assets/images/user/5.jpg')}}" alt="">
                          <div class="status-circle bg-primary"></div>
                          <div class="d-inline-block"><span>loain deo</span>
                            <p class="font-roboto">2020</p>
                          </div>
                        </div>
                      </td>
                      <td>09 March</td>
                      <td>Headphone</td>                      
                      <td> <span class="label">BD10,155</span></td>
                      <td class="text-end">Success</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle"><img class="img-40 m-r-15 rounded-circle align-top" src="{{asset('assets/images/user/3.png')}}" alt="">
                          <div class="status-circle bg-primary"></div>
                          <div class="d-inline-block"><span>Horen Hors</span>
                            <p class="font-roboto">2020</p>
                          </div>
                        </div>
                      </td>
                      <td>14 February</td>
                      <td>Cell Phone</td>                      
                      <td> <span class="label">BD90,568</span></td>
                      <td class="text-end">In process</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle"><img class="img-40 m-r-15 rounded-circle align-top" src="{{asset('assets/images/user/2.png')}}" alt="">
                          <div class="status-circle bg-primary"></div>
                          <div class="d-inline-block"><span>fenter Jessy</span>
                            <p class="font-roboto">2021</p>
                          </div>
                        </div>
                      </td>
                      <td>12 January</td>
                      <td>Earings</td>                      
                      <td> <span class="label">BD10,652</span></td>
                      <td class="text-end">Pending</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
   
   
</div>
@endsection

@section('script')

<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>

<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>

<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
@endsection