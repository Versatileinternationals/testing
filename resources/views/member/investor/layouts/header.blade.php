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
				<span class="svg-icon svg-icon-1 me-n1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
						<path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
					</svg>
				</span>
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
			<div class="page-title d-flex flex-column me-5">
				<!--begin::Title-->
				<h1 class="d-flex flex-column text-dark fw-bolder fs-2 mb-0">Dashboard</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Action group-->
			<div class="d-flex align-items-center pt-3 pt-sm-0">
				
				<!--begin::Actions-->
				<div class="d-flex">
					<!--begin::Notifications-->
					<div class="d-flex align-items-center me-4">
						<!--begin::Menu- wrapper-->
						<a href="#" class="btn btn-icon btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</a>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
							<!--begin::Heading-->
							<div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('assets/media/misc/header-dropdown.png')">
								<!--begin::Title-->
								<h3 class="text-white fw-bold mb-3">Quick Links</h3>
								<!--end::Title-->
								<!--begin::Status-->
								<span class="badge bg-primary py-2 px-3">25 pending tasks</span>
								<!--end::Status-->
							</div>
							<!--end::Heading-->
							<!--begin:Nav-->
							<div class="row g-0">
								<!--begin:Item-->
								<div class="col-6">
									<a href="apps/projects/budget.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
										<!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
										<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M15.8 11.4H6C5.4 11.4 5 11 5 10.4C5 9.80002 5.4 9.40002 6 9.40002H15.8C16.4 9.40002 16.8 9.80002 16.8 10.4C16.8 11 16.3 11.4 15.8 11.4ZM15.7 13.7999C15.7 13.1999 15.3 12.7999 14.7 12.7999H6C5.4 12.7999 5 13.1999 5 13.7999C5 14.3999 5.4 14.7999 6 14.7999H14.8C15.3 14.7999 15.7 14.2999 15.7 13.7999Z" fill="black" />
												<path d="M18.8 15.5C18.9 15.7 19 15.9 19.1 16.1C19.2 16.7 18.7 17.2 18.4 17.6C17.9 18.1 17.3 18.4999 16.6 18.7999C15.9 19.0999 15 19.2999 14.1 19.2999C13.4 19.2999 12.7 19.2 12.1 19.1C11.5 19 11 18.7 10.5 18.5C10 18.2 9.60001 17.7999 9.20001 17.2999C8.80001 16.8999 8.49999 16.3999 8.29999 15.7999C8.09999 15.1999 7.80001 14.7 7.70001 14.1C7.60001 13.5 7.5 12.8 7.5 12.2C7.5 11.1 7.7 10.1 8 9.19995C8.3 8.29995 8.79999 7.60002 9.39999 6.90002C9.99999 6.30002 10.7 5.8 11.5 5.5C12.3 5.2 13.2 5 14.1 5C15.2 5 16.2 5.19995 17.1 5.69995C17.8 6.09995 18.7 6.6 18.8 7.5C18.8 7.9 18.6 8.29998 18.3 8.59998C18.2 8.69998 18.1 8.69993 18 8.79993C17.7 8.89993 17.4 8.79995 17.2 8.69995C16.7 8.49995 16.5 7.99995 16 7.69995C15.5 7.39995 14.9 7.19995 14.2 7.19995C13.1 7.19995 12.1 7.6 11.5 8.5C10.9 9.4 10.5 10.6 10.5 12.2C10.5 13.3 10.7 14.2 11 14.9C11.3 15.6 11.7 16.1 12.3 16.5C12.9 16.9 13.5 17 14.2 17C15 17 15.7 16.8 16.2 16.4C16.8 16 17.2 15.2 17.9 15.1C18 15 18.5 15.2 18.8 15.5Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<span class="fs-5 fw-bold text-gray-800 mb-0">Accounting</span>
										<span class="fs-7 text-gray-400">eCommerce</span>
									</a>
								</div>
								<!--end:Item-->
								<!--begin:Item-->
								<div class="col-6">
									<a href="apps/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
										<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
										<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
												<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<span class="fs-5 fw-bold text-gray-800 mb-0">Administration</span>
										<span class="fs-7 text-gray-400">Console</span>
									</a>
								</div>
								<!--end:Item-->
								<!--begin:Item-->
								<div class="col-6">
									<a href="apps/projects/list.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
										<!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
										<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="black" />
												<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<span class="fs-5 fw-bold text-gray-800 mb-0">Projects</span>
										<span class="fs-7 text-gray-400">Pending Tasks</span>
									</a>
								</div>
								<!--end:Item-->
								<!--begin:Item-->
								<div class="col-6">
									<a href="apps/projects/users.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
										<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
										<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
												<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<span class="fs-5 fw-bold text-gray-800 mb-0">Customers</span>
										<span class="fs-7 text-gray-400">Latest cases</span>
									</a>
								</div>
								<!--end:Item-->
							</div>
							<!--end:Nav-->
								
							
							<!--begin::View more-->
							<div class="py-2 text-center border-top">
								<a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All 
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-5">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></a>
							</div>
							<!--end::View more-->
						</div>
						<!--end::Menu-->
						<!--end::Menu wrapper-->
					</div>
					<div class="d-flex" style="margin-left:-220px;">
					@foreach($user_session as $member_type)
					   
            	        @if($member_type->user_type == "investor")
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
					<a style="padding:0px;;color:#000;font-size:15px; margin-right:26px;" href="#">
					    <span style="font-weight:bold">Hello !&nbsp;</span>{{$member->name}}<br>
			                                                             {{$member->email}}
			        </a>
			        </div>
					<!--end::Theme mode-->
					<!--begin::Quick links-->
					<a style="background-color:#4fc9da; color:#fff; padding:10px;font-weight:600;font-size:16px" href="{{ url('/') }}">Go To Website  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black"></path>
								</svg> </a>
					<!--end::Quick links-->
				</div>
				<!--end::Actions-->
			</div>
			<!--end::Action group-->
		</div>
		<!--end::Topbar container-->
	</div>
	<!--end::Topbar-->
    </div>