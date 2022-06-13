<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
	<!--begin::Aside toolbar-->
	
	<!--end::Aside toolbar-->
	<!--begin::Aside menu-->
	<div class="aside-menu flex-column-fluid">
		<!--begin::Aside Menu-->
		<div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-offset="0">
			<!--begin::Menu-->
			<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
				<div class="menu-item">
					<a class="menu-link" href="{{ url('/seller') }}">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Dashboard</span>
					</a>
				</div>
				
				<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Manage Products / Services </span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{ url('/seller/add-product') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Add Product</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link" href="{{ url('/seller/product-details') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Product List</span>
							</a>
						</div>
							<div class="menu-item">
							<a class="menu-link" href="{{ url('/') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Add Services</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link" href="{{ url('/') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Services List</span>
							</a>
						</div>
						
					</div>
				</div>
				
				<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Product Category / SubCategory </span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{ url('/seller/category') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Category</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link" href="{{ url('/seller/subcategory') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Sub Category</span>
							</a>
						</div>
						
						
					</div>
				</div>
				
				
				<div class="menu-item">
					<a class="menu-link" href="{{ url('seller/testimonials') }}">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title"> Testimonials</span>
					</a>
				</div>
				
				<div class="menu-item">
					<a class="menu-link" href="{{ url($member->user_type.'/quotation-lists') }}">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Quotation Lists</span>
					</a>
				</div>
				
				<div class="menu-item">
					<div class="menu-content">
						<div class="separator separator-dashed mx-n10"></div>
					</div>
				</div>
				
				
				
				
				
				
				<div class="menu-item">
					<a class="menu-link" href="{{ url($member->user_type.'/settings') }}">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Profile</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ url($member->user_type.'/logout') }}">
						<span class="menu-icon">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
							<span class="svg-icon svg-icon-5">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
									<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-title">Logout</span>
					</a>
				</div>
				
				
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Aside Menu-->
	</div>
	<!--end::Aside menu-->

</div>