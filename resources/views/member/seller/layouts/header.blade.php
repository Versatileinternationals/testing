<div id="kt_header" style="" class="header align-items-stretch">
	<!--begin::Brand-->
	<div class="header-brand">
		<!--begin::Logo-->
		<a href="{{ url('/') }}">
			<img alt="Logo" src="{{ url('assets/images/logo.png') }}" class="h-50px" />
		</a>

          
                @if ($message = Session::get('error'))
                <script>alert('Choosen User is not allowed!!!')</script>
                <!--<div class="alert alert-danger alert-block">-->
                <!--<strong>{{ $message }}</strong>-->
                <!--</div>-->
                @endif
                       
                        
		<!--end::Logo-->
		<!--begin::Aside action-->
		<div class="d-none d-lg-block">
			<button class="btn btn-icon btn-color-gray-500 w-auto px-0 btn-active-color-primary" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
				
			</button>
			<!--begin::Menu 3-->
			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
				<!--begin::Heading-->
				<div class="menu-item px-3">
					<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
				</div>
				<!--end::Heading-->
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<a href="#" class="menu-link px-3">Create Invoice</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<a href="#" class="menu-link flex-stack px-3">Create Payment 
					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<a href="#" class="menu-link px-3">Generate Bill</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
					<a href="#" class="menu-link px-3">
						<span class="menu-title">Subscription</span>
						<span class="menu-arrow"></span>
					</a>
					<!--begin::Menu sub-->
					<div class="menu-sub menu-sub-dropdown w-175px py-4">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">Plans</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">Billing</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">Statements</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu separator-->
						<div class="separator my-2"></div>
						<!--end::Menu separator-->
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<div class="menu-content px-3">
								<!--begin::Switch-->
								<label class="form-check form-switch form-check-custom form-check-solid">
									<!--begin::Input-->
									<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
									<!--end::Input-->
									<!--end::Label-->
									<span class="form-check-label text-muted fs-6">Recuring</span>
									<!--end::Label-->
								</label>
								<!--end::Switch-->
							</div>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu sub-->
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3 my-1">
					<a href="#" class="menu-link px-3">Settings</a>
				</div>
				<!--end::Menu item-->
			</div>
			<!--end::Menu 3-->
		</div>
		<!--end::Aside action-->
		<!--begin::Aside toggle-->
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
				<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
				<span class="svg-icon svg-icon-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
						<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
		</div>
		<!--end::Aside toggle-->
	</div>
	<!--end::Brand-->
	<!--begin::Topbar-->
	<div class="topbar">
		<!--begin::Topbar container-->
		<div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-lg-stretch justify-content-sm-between">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-5">
				<!--begin::Title-->
				<h1 class="d-flex flex-column text-dark fw-bolder fs-2 mb-0">Dashboard</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Action group-->
			<div class="d-flex" style="margin-left:-220px;">
			    
            	        @foreach($user_session as $member_type)
						
            	        @if($member_type->user_type == "seller")
            	        <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="investor">
            	         <button type="submit" class="btn btn-success" >Investor Profile</button>
            	         </form>&nbsp;&nbsp;&nbsp;
            	         <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="trainee ">
            	         <button type="submit" class="btn btn-info" >Trainee Profile</button>
            	         </form>&nbsp;&nbsp;&nbsp;
            	         <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="buyer">
            	         <button type="submit" class="btn btn-primary" >Buyer Profile</button>
            	         </form>
            	        @endif
            	    @endforeach
            	    &nbsp;&nbsp;&nbsp;
			<a style="padding:0px;;color:#000;font-size:15px; margin-right:-288px;" href="#"><span style="font-weight:bold">Hello !&nbsp;</span>{{$sellerData->company}}<br>
			                                                                                                    {{$member->email}}
			 </a>
			
			</div>
			<a style="background-color:#4fc9da; color:#fff; padding:10px;font-weight:600;font-size:16px" href="{{ url('/') }}">Go To Website  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black"></path>
								</svg> </a>
			<!--end::Action group-->
		</div>
		<!--end::Topbar container-->
	</div>
	<!--end::Topbar-->
</div>