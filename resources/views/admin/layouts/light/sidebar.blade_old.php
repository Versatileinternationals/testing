<div class="sidebar-wrapper">
   <div class="logo-wrapper">
      <a href="{{route('index')}}"><img class="img-fluid for-light" src="{{asset('assets/images/beltraide-logo-full-color-no-slogan.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      {{-- <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div> --}}
   </div>
   <div class="logo-icon-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
   <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
         <ul class="sidebar-links custom-scrollbar">
            <li class="back-btn">
               <a href="{{route('index')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
               <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
            {{-- <li class="sidebar-list">
               <label class="badge badge-success">2</label>
               <a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='index' ? 'active' : '' }}" style="cursor: pointer;">
                  <i data-feather="home"></i>
                  <span class="lan-3"> @lang('lang.Dashboard') </span>
                  <div class="according-menu"><i class="fa fa-angle-{{ Route::currentRouteName()=='index' ? 'down' : 'right' }}"></i></div>
               </a>
               <ul class="sidebar-submenu" style="display: {{ Route::currentRouteName()=='index' ? 'block;' : 'none;' }}">
                  <li><a class="lan-4 {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}">Default</a></li>
               </ul>
            </li> --}}
   
            <li class="sidebar-list">
               <a href="{{url('dashboard')}}" class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }}" >
                  <i data-feather="home"></i>
                  <span>Dashboard</span>
               </a>
            </li>
            {{-- @lang('lang.Dashboard') --}}
            @permission('view.role')
            <li class="sidebar-list">
               <a href="{{url('role')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='role' ? 'active' : '' }}">
                  <i data-feather="check-square"> </i><span>Role</span>
               </a>
            </li>
            @endpermission
            @permission('view.users')
            <li class="sidebar-list">
               <a href="{{url('users')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='users' ? 'active' : '' }}">
                  <i data-feather="users"> </i><span>Users</span>
               </a>
            </li>
            @endpermission
           
            <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">Belize Invest </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('training')}}">Add New Training</a></li>
                          <li><a class="lan-5" href="{{url('training')}}">Add Training Content</a></li>
						   <li><a class="lan-5" href="{{url('trainee')}}">Add Trainees</a></li>
						  <li><a class="lan-5" href="{{url('trainning_calender')}}"> Training calendar</a></li>
						  <li><a class="lan-5" href="{{url('training')}}">Online Application Form Listing</a></li>
						  <li><a class="lan-5" href="{{url('self_paced')}}">Self-paced learning</a></li>
                          <li><a class="lan-5" href="{{url('online_quiz')}}">Online quiz/assessment</a></li>
						  
                        </ul>
                  </li>
                 
                 <li><a class="lan-5" href="{{url('videoupload')}}">Videos Uploading</a></li>
				
				 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('events')}}">Event Listing</a></li>
                          <li><a class="lan-5" href="{{url('event_calender')}}">Event Calender</a></li>
						   
						  
                        </ul>
                  </li>
				
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
                          <li><a class="lan-5" href="{{url('jobs')}}">Job Listing</a></li>
                          <li><a class="lan-5" href="{{url('JobsPreparedness')}}">Jobs Preparedness</a></li>
                          <li><a class="lan-5" href="{{url('ExternalJobs')}}">External Jobs </a></li>
                        </ul>
                </li>
                 <li><a class="lan-5" href="{{url('advisory')}}">Advisory Requests</a></li>
                 <li><a class="lan-5" href="{{url('businesstmpl')}}">Business Templates</a></li>
                 <li><a class="lan-5" href="{{url('business_resources')}}">Business Resource Guide</a></li>
                 <li><a class="lan-5" href="{{url('online_application')}}">Online Application Forms</a></li>
				 <li><a class="lan-5" href="{{url('QueryList')}}">Query Listing</a></li>
				 <li><a class="lan-5" href="{{url('faq')}}">FAQ</a></li>
				 
               </ul>
            </li>
          
           
            
            <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">SDBC Admin </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('self_paced')}}">Add New Training</a></li>
                          <li><a class="lan-5" href="{{url('training')}}">Add Training Content</a></li>
						   <li><a class="lan-5" href="{{url('training')}}">Add Trainees</a></li>
						  <li><a class="lan-5" href="{{url('training')}}"> Training calendar</a></li>
						  <li><a class="lan-5" href="{{url('training')}}">Online Application Form Listing</a></li>
						  <li><a class="lan-5" href="{{url('self_paced')}}">Self-paced learning</a></li>
                          <li><a class="lan-5" href="{{url('training')}}">Online quiz/assessment</a></li>
						  
                        </ul>
                  </li>
                 <li><a class="lan-5" href="{{url('sdbc_video')}}">Videos Uploading</a></li>
                 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('sdbc_event')}}">Event Listing</a></li>
                          <li><a class="lan-5" href="{{url('event_calender')}}">Event Calender</a></li>
						   
						  
                        </ul>
                  </li>
				 
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
                          <li><a class="lan-5" href="{{url('jobs')}}">Job Listing</a></li>
                          <li><a class="lan-5" href="{{url('JobsPreparedness')}}">Jobs Preparedness</a></li>
                          <li><a class="lan-5" href="{{url('ExternalJobs')}}">External Jobs </a></li>
                        </ul>
                </li>
                 <li><a class="lan-5" href="{{url('advisory')}}">Advisory Requests</a></li>
                 <li><a class="lan-5" href="{{url('businesstmpl')}}">Business Templates</a></li>
                 <li><a class="lan-5" href="{{url('business_resources')}}">Business Resource Guide</a></li>
                 <li><a class="lan-5" href="{{url('online_application')}}">Online Application Forms</a></li>
				 <li><a class="lan-5" href="{{url('sdbc_query')}}">Query Listing</a></li>
				 <li><a class="lan-5" href="{{url('sdbc_faq')}}">FAQ</a></li>
				 
               </ul>
            </li>
          
            
           
            <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">BTEC Admin </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('btec_self_paced')}}">Add New Training</a></li>
                          <li><a class="lan-5" href="{{url('btec_training')}}">Add Training Content</a></li>
						   <li><a class="lan-5" href="{{url('btec_training')}}">Add Trainees</a></li>
						  <li><a class="lan-5" href="{{url('btec_training')}}"> Training calendar</a></li>
						  <li><a class="lan-5" href="{{url('btec_training')}}">Online Application Form Listing</a></li>
						  <li><a class="lan-5" href="{{url('btec_self_paced')}}">Self-paced learning</a></li>
                          <li><a class="lan-5" href="{{url('btec_training')}}">Online quiz/assessment</a></li>
						  
                        </ul>
                  </li>
                 <li><a class="lan-5" href="{{url('btec_video')}}">Videos Uploading</a></li>
                 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
                          <li><a class="lan-5" href="{{url('btec_event')}}">Event Listing</a></li>
                          <li><a class="lan-5" href="{{url('btec_event_calender')}}">Event Calender</a></li>
						   
						  
                        </ul>
                  </li>
				 
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
                          <li><a class="lan-5" href="{{url('btec_jobs')}}">Job Listing</a></li>
                          <li><a class="lan-5" href="{{url('btec_JobsPreparedness')}}">Jobs Preparedness</a></li>
                          <li><a class="lan-5" href="{{url('btec_ExternalJobs')}}">External Jobs </a></li>
                        </ul>
                </li>
                 <li><a class="lan-5" href="{{url('btec_advisory')}}">Advisory Requests</a></li>
                 <li><a class="lan-5" href="{{url('btec_businesstmpl')}}">Business Templates</a></li>
                 <li><a class="lan-5" href="{{url('btec_business_resources')}}">Business Resource Guide</a></li>
                 <li><a class="lan-5" href="{{url('btec_online_application')}}">Online Application Forms</a></li>
				 <li><a class="lan-5" href="{{url('btec_query')}}">Query Listing</a></li>
				 <li><a class="lan-5" href="{{url('btec_faq')}}">FAQ</a></li>
				 
               </ul>
            </li>
          
           
            <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">Export Belize</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
                          <li><a class="lan-5" href="{{url('training')}}">Add New Training</a></li>
                          <li><a class="lan-5" href="{{url('training')}}">Add Training Content</a></li>
                          
                        </ul>
                  </li>
                 <li><a class="lan-5" href="#">Videos Uploading</a></li>
                 <li><a class="lan-5" href="#">Event Listing</a></li>
                 <li><a class="lan-5" href="#">Jobs Preparedness</a></li>
                 <li><a class="lan-5" href="#">Advisory Requests</a></li>
                 <li><a class="lan-5" href="#">Business Templates</a></li>
                 <li><a class="lan-5" href="#">Business Resource Guide</a></li>
                 <li><a class="lan-5" href="#">Online Application Forms</a></li>
               </ul>
            </li>
			 
          
            
            
            @permission('view.role')
            <li class="sidebar-list">
               @permission('view.role')
            <li class="sidebar-list">
               <a href="#" class="sidebar-link sidebar-title">
                 <i data-feather="user"></i><span class="lan-3">Admin B2B</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="lan-4" href="{{url('seller_account')}}">Seller Account Verification</a></li>
                 <li><a class="lan-5" href="{{url('buyer_account')}}">Buyer Account Verification</a></li>
                 <li><a class="lan-5" href="{{url('investor_account')}}">Investor Account Verification</a></li>
				 <li><a class="lan-5" href="{{url('tags')}}">Tags</a></li>
                 <li><a class="lan-5" href="{{url('product')}}">Seller Product Management</a></li>
                 <li><a class="lan-5" href="{{url('querylist')}}">Queries List</a></li>
                 <li><a class="lan-5" href="{{url('clienttestimonials')}}">Client Testimonials</a></li>
                 <li><a class="lan-5" href="{{url('category')}}">Categories</a></li>
                 <li><a class="lan-5" href="{{url('subcategory')}}">Sub Categories</a></li>
                 <li><a class="lan-5" href="{{url('newsletter')}}">Newsletter Management</a></li>
               </ul>
            </li>
            @endpermission
            @endpermission
             @permission('view.role')
            <li class="sidebar-list">
               <a href="{{url('role')}}" class="sidebar-link sidebar-title">
                  <i data-feather="check-square"> </i><span>Manage Network & Site Features</span>
               </a>
            </li>
            @endpermission
            @permission('view.role')
            <li class="sidebar-list">
               @permission('view.role')
            <li class="sidebar-list">
               <a href="#" class="sidebar-link sidebar-title">
                 <i data-feather="user"></i><span class="lan-3">Website Users Account</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="lan-4" href="{{url('users')}}">All Users</a></li>
                 <li><a class="lan-5" href="{{url('users/buyer')}}">As Buyer</a></li>
                 <li><a class="lan-5" href="{{url('users/seller')}}">As Seller</a></li>
                 <li><a class="lan-5" href="{{url('users/trainee')}}">As Trainee</a></li>
                 <li><a class="lan-5" href="{{url('users/investor')}}">As Investor</a></li>
                 <li><a class="lan-5" href="{{url('users/guest')}}">As Guest</a></li>
                 
               </ul>
            </li>
            @endpermission
            @endpermission
            
            
            
            @permission('view.category')
            <!--<li class="sidebar-list">
               <a href="{{url('category')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='category' ? 'active' : '' }}">
                  <i data-feather="list"> </i><span>Category</span>
               </a>
            </li>-->
            @endpermission
            @permission('view.sub.category')
            <!--<li class="sidebar-list">
               <a href="{{url('subcategory')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='subcategory' ? 'active' : '' }}">
                  <i data-feather="layers"> </i><span>Sub Category</span>
               </a>
            </li>-->
            @endpermission
            @permission('view.brand')
           <!-- <li class="sidebar-list">
               <a href="{{url('brand')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='brand' ? 'active' : '' }}">
                  <i data-feather="award"> </i><span>Brand</span>
               </a>
            </li>-->
            @endpermission
            {{-- 
           <!-- <li class="sidebar-list">
               <a href="{{url('product')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='product' ? 'active' : '' }}">
                  <i data-feather="shopping-bag"> </i><span>Products</span>
               </a>
            </li>-->
             --}}
             
            @permission('view.product')
            <!--<li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="shopping-bag"></i><span class="lan-3">Products </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="lan-4" href="{{url('product')}}">Products</a></li>
                 <li><a class="lan-5" href="{{url('combo')}}">Product Combo</a></li>
                 <li><a class="lan-5" href="{{url('variation-product')}}">Variation Product</a></li>
               </ul>
            </li>-->
            @endpermission
            @permission('view.banner')
           <!-- <li class="sidebar-list">
               <a href="{{url('banner')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='banner' ? 'active' : '' }}">
                  <i data-feather="image"> </i><span>Banner</span>
               </a>
            </li>-->
            @endpermission
            @permission('view.coupon')
            <!--<li class="sidebar-list">
               <a href="{{url('coupon')}}" class="sidebar-link sidebar-title link-nav {{ Request::segment(1)=='coupon' ? 'active' : '' }}">
                  <i data-feather="gift"> </i><span>Coupon</span>
               </a>
            </li>-->
            @endpermission
         </ul>
         
      </div>
     
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
   </nav>
</div>