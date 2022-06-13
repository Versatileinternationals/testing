<div id="kt_header" style="" class="header align-items-stretch">
	<!--begin::Brand-->
	<div class="header-brand">
		<!--begin::Logo-->
		<a href="{{ url('/seller') }}">
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
				<!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
				<!--<span class="svg-icon svg-icon-1 me-n1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
						<path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
					</svg>
				</span>-->
				<!--end::Svg Icon-->
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
			<div class="page-title d-flex flex-column">
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
					    @if($member_type->user_type == "buyer")
					    
            	        <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="seller">
            	         <button type="submit" class="btn btn-success" >Seller Profile</button>
            	         </form>&nbsp;&nbsp;&nbsp;
            	         <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="trainee">
            	         <button type="submit" class="btn btn-info" >Investor Profile</button>
            	         </form>&nbsp;&nbsp;&nbsp;
            	         <form method="post" action="/Login_switch">
            	            @csrf
            	            <input type="hidden" name="email" value="{{$member_type->email}}">
            	            <input type="hidden" name="usertype" value="trainee">
            	         <button type="submit" class="btn btn-primary" >Trainee Profile</button>
            	         </form>
            			
            	        
            	        @endif
            	    @endforeach
            	    &nbsp;&nbsp;&nbsp;
			<a style="padding:0px;;color:#000;font-size:15px; margin-right:-288px;" href="#"><span style="font-weight:bold">Hello !&nbsp;</span>{{$member->name}}<br>
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