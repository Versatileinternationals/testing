<div class="sidebar-wrapper">
<div>
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
            @permission('view.role')
            <li class="sidebar-list">
               @permission('view.role')
            <li class="sidebar-list">
               <a href="#" class="{{ Request::path() == '/query_list' ? 'active' : '' }} sidebar-link sidebar-title">
                 <i data-feather="user"></i><span class="lan-3">Contact Us</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="lan-4" href="{{url('query_list')}}">Query List</a></li>
               </ul>
            </li>
            @endpermission
            @endpermission
			 @permission('view.users')
        <!--- Trainnning Master ------>
		   <li class="sidebar-list">
               <a href="#" class="sidebar-link sidebar-title">
                 <i data-feather="user"></i><span class="lan-3">Training Master</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
                 <li><a class="lan-4" href="{{url('trainning_stream')}}">All Stream</a></li>
                 <li><a class="lan-5" href="{{url('trainning_course')}}">All Courses</a></li>
                
                 
               </ul>
			  
                 
                 
            </li>
			@endpermission
			 @permission('view.users')
			  <li class="sidebar-list">
               <a href="{{url('business_resources')}}" class="sidebar-link sidebar-title link-nav">
                  <i data-feather="users"> </i><span>Business Resources Guide </span>
               </a>
            </li>
			@endpermission
		<!---  Trainning  Master---->
	           @if(Auth::check())
            <!-- Belize Invest Menu--->
			@if(Auth::user()->role_id==12 || Auth::user()->role_id==1)
			<li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">Belize Invest </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			         <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                     <ul class="nav-sub-childmenu submenu-content">
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',86)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_training')}}">Manage Training</a></li>
                        @endif
                      <!--  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',86)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_training')}}">Add Training  Content</a></li>
                        @endif -->
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',99)->first() == null || Auth::user()->role_id==1)
					   	   <li><a class="lan-5" href="{{url('blzinvst_trainee')}}">Add Trainees</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',100)->first() == null || Auth::user()->role_id==1)
					   	   <li><a class="lan-5" href="{{url('blzinvst_trainning_calender')}}"> Training calendar</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',86)->first() == null || Auth::user()->role_id==1)
					   	   <li><a class="lan-5" href="{{url('blzinvst_training')}}">Online Application Form Listing</a></li>
                        @endif
                       <!-- @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',101)->first() == null || Auth::user()->role_id==1)
					   	   <li><a class="lan-5" href="{{url('blzinvst_self_paced')}}">Self-paced learning</a></li>
                        @endif-->
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',102)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_online_quiz')}}">Online quiz/assessment</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',102)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_quiz_list')}}">Quiz List</a></li>
                        @endif
                         @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',102)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_content_list')}}">Content List</a></li>
                        @endif
                         @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',102)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_assesment_list')}}">Pre-Assessment List</a></li>
                        @endif
                         @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',102)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('/blzinvst_final_assesment_lis')}}">Final Assessment Listt</a></li>
                        @endif
                     </ul>
                  </li>
                  <li><a href="all-payment-list">All Payment List</a></li>
                  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',87)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_videoupload')}}">Videos Uploading</a></li>  
                  @endif
				      <li><a class="submenu-title" href="#">Event Management<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                     <ul class="nav-sub-childmenu submenu-content">        
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',88)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_events')}}">Event Listing</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',89)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_event_calender')}}">Event Calender</a></li>               
                        @endif
                     </ul>
                  </li>               
                  <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                     <ul class="nav-sub-childmenu submenu-content">
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_jobs')}}">Job Listing</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',90)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_JobsPreparedness')}}">Jobs Preparedness</a></li>
                        @endif
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',93)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_ExternalJobs')}}">External Jobs </a></li>
                        @endif
                     </ul>
                  </li>
                  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',92)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_advisory')}}">Advisory Requests</a></li>
                  @endif
                  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',95)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_businesstmpl')}}">Manage Resources</a></li>
                  @endif
                  
                  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',96)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_online_application')}}">Online Application Forms</a></li>
                  @endif
                 <!-- @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',98)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_QueryList')}}">Query Listing</a></li>
                  @endif-->
                  @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',97)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('blzinvst_faq')}}">FAQ</a></li>			
                  @endif
				 
				  
				  
				  <li><a class="submenu-title" href="#">Investment Generation & Promotion<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="nav-sub-childmenu submenu-content">
					 
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_what_we_do')}}">What We Do</a></li>
                        @endif
						
						@if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_team_members')}}">Team Members</a></li>
                        @endif
						
						@if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_resources')}}">Other Resources</a></li>
                        @endif
                     </ul>
                    </li>
					<!-- Finance Access Start--->
					<li><a class="submenu-title" href="#">Finance Access<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="nav-sub-childmenu submenu-content">
					 
                        @if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_grant_section')}}">Grant Section</a></li>
                        @endif
						
						@if(App\Models\ModulePermission::where('role_id',12)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('blzinvst_loan_section')}}">Loan Section</a></li>
                        @endif
						
						
                     </ul>
                    </li>
					
					<!-- Finance Access End--->
				      
				  
               </ul>
            </li>
            @endif
          
            <!-- Belize Invest Menu End--->
			
			<!-- SDBC Invest Menu Start--->
			
             @if(Auth::user()->role_id==13 || Auth::user()->role_id==1)
           <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">SDBC Admin </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						 @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_self_paced')}}">Manage Training</a></li>
					     @endif
						  @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_training')}}">Add Training Content</a></li>
					      @endif
						  
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						   <li><a class="lan-5" href="{{url('sdbc_training')}}">Add Trainees</a></li>
					      @endif
						  @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('sdbc_training')}}"> Training calendar</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('sdbc_training')}}">Online Application Form Listing</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('sdbc_self_paced')}}">Self-paced learning</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_training')}}">Online quiz/assessment</a></li>
						  @endif
                        </ul>
                  </li>
                 <li><a class="lan-5" href="{{url('sdbc_video')}}">Videos Uploading</a></li>
                 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_event')}}">Event Listing</a></li>
					       @endif
						   
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_event_calender')}}">Event Calender</a></li>
						   @endif
						  
                        </ul>
                  </li>
				 
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_jobs')}}">Job Listing</a></li>
					     @endif
						   @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('sdbc_jobsPreparedness')}}">Jobs Preparedness</a></li>
					      @endif
						  @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  @endif
                           @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)					  
                          <li><a class="lan-5" href="{{url('sdbc_externaljobs')}}">External Jobs </a></li>
					      @endif
                        </ul>
                </li>
				 @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)	
                 <li><a class="lan-5" href="{{url('sdbc_advisory')}}">Advisory Requests</a></li>
			    @endif
				  @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('sdbc_businesstmpl')}}">Business Templates</a></li>
			     @endif
			     @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('sdbc_business_resources')}}">Business Resource Guide</a></li>
			    @endif
			     @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('sdbc_application')}}">Online Application Forms</a></li>
			    @endif
			     @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('sdbc_query')}}">Query Listing</a></li>
			    @endif
			      @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('sdbc_faq')}}">FAQ</a></li>
				 @endif
				 
				  <li><a class="submenu-title" href="#">Small Business Development<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="nav-sub-childmenu submenu-content">
					 
                        @if(App\Models\ModulePermission::where('role_id',13)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('sdbc_what_we_do')}}">What We Do</a></li>
                        @endif
						
						@if(App\Models\ModulePermission::where('role_id',13)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('sdbc_team_members')}}">Team Members</a></li>
                        @endif
						
						@if(App\Models\ModulePermission::where('role_id',13)->where('module_id',91)->first() == null || Auth::user()->role_id==1)
                        <li><a class="lan-5" href="{{url('sdbc_resources')}}">Other Resources</a></li>
                        @endif
                       
                    </ul>
                  </li>
               </ul>
            </li>
          
           @endif
		    <!-- SDBC  Menu End--->
             <!-- BTEC  Menu Start--->
			 
             @if(Auth::user()->role_id==14 || Auth::user()->role_id==1)
            <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">BTEC Admin </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_self_paced')}}">Manage Training</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_training')}}">Add Training Content</a></li>
					     @endif
					       @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						   <li><a class="lan-5" href="{{url('btec_training')}}">Add Trainees</a></li>
					       @endif
					       @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('btec_training')}}"> Training calendar</a></li>
					      @endif
					       @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('btec_training')}}">Online Application Form Listing</a></li>
					       @endif
					       @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('btec_self_paced')}}">Self-paced learning</a></li>
					      @endif
					       @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_training')}}">Online quiz/assessment</a></li>
						  @endif
                        </ul>
                  </li>
                 <li><a class="lan-5" href="{{url('btec_video')}}">Videos Uploading</a></li>
                 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_events')}}">Event Listing</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_event_calender')}}">Event Calender</a></li>
						  @endif
						  
                        </ul>
                  </li>
				 
				 
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_jobs')}}">Job Listing</a></li>
					       @endif
						   
						  @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_JobsPreparedness')}}">Jobs Preparedness</a></li>
					     @endif
						 @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('btec_ExternalJobs')}}">External Jobs </a></li>
					     @endif
                        </ul>
                </li>
				
				  @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('btec_advisory')}}">Advisory Requests</a></li>
			    @endif
			      @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('btec_businesstmpl')}}">Business Templates</a></li>
			     @endif
			     @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('btec_business_resources')}}">Business Resource Guide</a></li>
			    @endif
			     @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('btec_online_application')}}">Online Application Forms</a></li>
			     @endif
			     @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('btec_query')}}">Query Listing</a></li>
			    @endif
			     @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('btec_faq')}}">FAQ</a></li>
			     @endif
				 @if(App\Models\ModulePermission::where('role_id',14)->where('module_id',97)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('btec_temp')}}">Training and Employement</a></li>			
                  @endif
               </ul>
            </li>
            @endif
           <!-- BTEC  Menu End--->
		   
		     <!-- Export Belize  Menu Start--->
			 
		   @if(Auth::user()->role_id==15 || Auth::user()->role_id==1)
           <li class="sidebar-list">
               <a class="sidebar-link sidebar-title {{ Request::segment(1)=='product' ? 'active' : '' }}" href="#">
                  <i data-feather="user"></i><span class="lan-3">Export Belize </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu">
			   <li><a class="submenu-title" href="#">Trainings<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						
						  @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_training')}}">Manage Training</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_training')}}">Add Training Content</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						   <li><a class="lan-5" href="{{url('expblz_trainee')}}">Add Trainees</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('expblz_trainning_calender')}}"> Training calendar</a></li>
					      @endif
						  
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('expblz_training')}}">Online Application Form Listing</a></li>
					      @endif
						  
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
						  <li><a class="lan-5" href="{{url('expblz_self_paced')}}">Self-paced learning</a></li>
					      @endif
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_online_quiz')}}">Online quiz/assessment</a></li>
						  @endif
                        </ul>
                  </li>
                 <li><a class="lan-5" href="{{url('expblz_video')}}">Videos Uploading</a></li>
                 <li><a class="submenu-title" href="#">Event Calender<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						  @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_event')}}">Event Listing</a></li>
					      @endif
						  
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_event_calender')}}">Event Calender</a></li>
						   @endif
						  
                        </ul>
                  </li>
				 
                <li><a class="submenu-title" href="#">Jobs<div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="nav-sub-childmenu submenu-content">
						   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_jobs')}}">Job Listing</a></li>
					       @endif
						    @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_jobsPreparedness')}}">Jobs Preparedness</a></li>
					      @endif
					      @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                          <li><a class="lan-5" href="{{url('expblz_externaljobs')}}">External Jobs </a></li>
					     @endif
                        </ul>
                </li>
				 @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('expblz_advisory')}}">Advisory Requests</a></li>
			     @endif
				  @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('expblz_businesstmpl')}}">Business Templates</a></li>
			    @endif
				  @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('expblz_business_resources')}}">Business Resource Guide</a></li>
			      @endif 
				  
				   @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
                 <li><a class="lan-5" href="{{url('expblz_application')}}">Online Application Forms</a></li>
			    @endif 
			     @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('expblz_query')}}">Query Listing</a></li>
			    @endif 
			     @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',103)->first() == null || Auth::user()->role_id==1)
				 <li><a class="lan-5" href="{{url('expblz_faq')}}">FAQ</a></li>
			     @endif 
				  @if(App\Models\ModulePermission::where('role_id',15)->where('module_id',97)->first() == null || Auth::user()->role_id==1)
                  <li><a class="lan-5" href="{{url('expblz_edp')}}">Export Development and Promotion</a></li>			
                  @endif
               </ul>
            </li>
          @endif
          
		  @endif
            <!-- Export Belize  Menu End--->
          @if(Auth::user()->role_id==16 || Auth::user()->role_id==1)
            <li class="sidebar-list">
            <li class="sidebar-list">
               <a href="#" class="sidebar-link sidebar-title">
                 <i data-feather="user"></i><span class="lan-3">Admin B2B</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
               <ul class="sidebar-submenu" id="nav">
                 <li><a class="lan-4" href="{{url('seller_account')}}">Seller Account Verification</a></li>
                 <li><a class="lan-5" href="{{url('buyer_account')}}">Buyer Account Verification</a></li>
                 <li><a class="lan-5" href="{{url('investor_account')}}">Investor Account Verification</a></li>
				 <li><a class="lan-5" href="{{url('tags')}}">Tags</a></li>
				 <li class={{ Route::is('productquotation') ? 'active' : '' }}><a class="lan-5" href="{{url('productquotation')}}">Seller Product Quotation Management</a></li>
                 <li class={{ Route::is('product') ? 'active' : '' }}><a class="lan-5" href="{{url('product')}}">Seller Product Management</a></li>
				 <li><a class="lan-5" href="{{url('service_category')}}">Services Category</a></li>
				<!-- <li><a class="lan-5" href="{{url('product_services')}}">Services  Management</a></li>-->
                 <li><a class="lan-5" href="{{url('querylist')}}">Queries List</a></li>
                 <li><a class="lan-5" href="{{url('clienttestimonials')}}">Client Testimonials</a></li>
                 <li><a class="lan-5" href="{{url('category')}}">Categories</a></li>
                 <li><a class="lan-5" href="{{url('subcategory')}}">Sub Categories</a></li>
                 <li><a class="lan-5" href="{{url('newsletter')}}">Newsletter Management</a></li>
               </ul>
            </li>
           
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
               <a href="#" class="{{ Request::path() == '/users' ? 'active' : '' }} sidebar-link sidebar-title">
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
            
             @endif
            
            
            
         </ul>
         
      </div>
     
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
   </nav>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function(){
    var current = location.pathname;
    $('.sidebar-list').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})
</script>