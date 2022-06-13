 <!-- Header Code Start -->


 <header class="siteHeader">
     <nav class="navbar navbar-expand-md p-0">
         <div class="container">
             <a class="navbar-brand" href="{{  route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""
                     title="" /></a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                 aria-expanded="false" aria-label="Toggle navigation">
                 <i class="fas fa-bars"></i>
             </button>
             <div class="collapse navbar-collapse" id="main_nav">
                 <ul class="navbar-nav">
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Learn </a>
                         <ul class="dropdown-menu manuLeval1">
                             <li>
                                 <a class="dropdown-item bg-green" href="#"> E-Learning </a>
                                 <ul class="submenu dropdown-menu manuLeval2">
                                     <li><a class="dropdown-item bg-green" href="#">Trainings</a>
                                         <ul class="submenu dropdown-menu manuLeval3">
                                             <li><a class="dropdown-items bg-green"
                                                     href="{{  url('self-paced') }}">Self-paced</a></li>
                                             <li><a class="dropdown-items bg-green"
                                                     href="{{  url('active-training') }}">Instructor Led Training</a>
                                             </li>
                                         </ul>
                                     </li>
                                     <li><a class="dropdown-item bg-green"
                                             href="{{  route('trainning_calender') }}">Training Calendar</a>
                                         <ul class="submenu dropdown-menu manuLeval3">
                                             <li><a class="dropdown-items bg-green" href="#">Upcoming trainings</a></li>
                                         </ul>
                                     </li>
                                 </ul>
                             </li>

                             <li>
                                 <a class="dropdown-item bg-green" href="{{  url('support-services') }}"> Support
                                     Services </a>
                                 <ul class="submenu dropdown-menu manuLeval2">
                                     <li><a class="dropdown-items bg-green" href="{{  url('export_belize') }}">EXPORT
                                             Development and Promotion</a>

                                     </li>
                                     <li><a class="dropdown-items bg-green" href="{{  url('sdbc-services') }}">Small
                                             Business Development</a>

                                     </li>
                                     <li><a class="dropdown-items bg-green" href="{{  url('btec-services') }}">Job
                                             Preparedness </a>

                                     </li>
                                     <li><a class="dropdown-items bg-green"
                                             href="{{  url('belizeinvest-services') }}">Investment Generation and After
                                             Care</a>

                                     </li>
                                     <li>
                                         <a class="dropdown-items bg-green" href="{{ url('faq') }}">FAQ</a>
                                     </li>
                                 </ul>
                             </li>
                             <li>
                                 <a class="dropdown-items bg-green" href="#" data-bs-toggle="dropdown">Business Guide
                                 </a>

                             </li>
                         </ul>
                     </li>

                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Opportunity </a>
                         <ul class="dropdown-menu manuLeval1 dropdown-menu-right">
                             <li>
                                 <a class="dropdown-items bg-green" href="{{ url('events-listing') }}"> Events </a>

                             </li>

                             <li>
                                 <a class="dropdown-items bg-green" href="{{ url('jobs') }}"> Career Opportunities </a>

                             </li>

                             <li>
                                 <a class="dropdown-items bg-green" href="{{ url('finance-access') }}"> Access to
                                     Financing </a>

                             </li>
                         </ul>
                     </li>

                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Connect </a>
                         <ul class="dropdown-menu manuLeval1">
                             <li>
                                 <a class="dropdown-items bg-green" target="_blank"
                                     href="https://femaleentrepreneurs.bz/"> Female Entrepreneurs in Belize </a>
                             </li>
                             <li>
                                 <a class="dropdown-items bg-green" href="{{ url('business-directory-beltraide') }}">
                                     Business Hub</a>

                             </li>
                             <li>
                                 <a class="dropdown-item bg-green" href="#" data-bs-toggle="dropdown"> Made in Belize
                                     (Export Ready)</a>
                                 <ul class="submenu dropdown-menu manuLeval2">
                                     <li>
                                         <a class="dropdown-items bg-green" href="business-directory-beltraide">Company
                                             Profiles</a>

                                     </li>
                                     <li>
                                         <a class="dropdown-items bg-green"
                                             href="{{ url('product-category') }}">Sectors</a>

                                     </li>
                                     <li>
                                         <a class="dropdown-items bg-green" href="{{ url('products') }}">Products</a>

                                     </li>
                                     <li>
                                         <a class="dropdown-item bg-green" href="{{ url('services')}}">Services</a>
                                         <ul class="submenu dropdown-menu manuLeval3">
                                             <li>
                                                 <a class="dropdown-items bg-green"
                                                     href="{{ url('seller-services') }}">Business Processing
                                                     Outsourcing</a>

                                             </li>
                                             <li>
                                                 <a class="dropdown-items bg-green"
                                                     href="{{ url('seller-services') }}">Information Technology
                                                     Outsourcing</a>

                                             </li>
                                             <li>
                                                 <a class="dropdown-items bg-green"
                                                     href="{{ url('seller-services') }}">Knowledge Processing
                                                     Outsourcing</a>

                                             </li>
                                             <li>
                                                 <a class="dropdown-items bg-green"
                                                     href="{{ url('seller-services') }}">Music</a>

                                             </li>
                                         </ul>
                                     </li>
                                     <li>
                                         <a class="dropdown-items bg-green" href="{{ url('seller_faq') }}">FAQ</a>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                     </li>

                    @if(isset($user_session))
					
                     @foreach($user_session as $userdata)
                     @if($userdata->user_type == 'seller')
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Welcome ,
                             {{$userdata->name}} </a>
                         <ul class="dropdown-menu manuLeval1 dropdown-menu-right">
                             <li><a class="dropdown-items bg-green" href="{{ url('seller') }}">My Account </a></li>
                             <li><a class="dropdown-items bg-green" href="{{ url('seller/logout') }}"> Logout </a> </li>
                         </ul>
                     </li>
                     <?php //echo $member_id=Session::get('member_id'); ?>
                     @elseif($userdata->user_type == 'buyer')
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Welcome ,
                             {{$userdata->name}} </a>
                         <ul class="dropdown-menu manuLeval1 dropdown-menu-right">
                             <li><a class="dropdown-items bg-green" href="{{ url('buyer') }}">My Account </a></li>
                             <li><a class="dropdown-items bg-green" href="{{ url('buyer/logout') }}"> Logout </a> </li>
                         </ul>
                     </li>
                     <?php //echo $member_id=Session::get('member_id'); ?>
                     @elseif($userdata->user_type == 'trainee')
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Welcome ,
                             {{$userdata->name}} </a>
                         <ul class="dropdown-menu manuLeval1 dropdown-menu-right">
                             <li><a class="dropdown-items bg-green" href="{{ url('trainee') }}">My Account </a></li>
                             <li><a class="dropdown-items bg-green" href="{{ url('trainee/logout') }}"> Logout </a>
                             </li>
                         </ul>
                     </li>
                     <?php //echo $member_id=Session::get('member_id'); ?>
                     @elseif($userdata->user_type == 'investor')
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Welcome ,
                             {{$userdata->name}} </a>
                         <ul class="dropdown-menu manuLeval1 dropdown-menu-right">
                             <li><a class="dropdown-items bg-green" href="{{ url('investor') }}">My Account </a></li>
                             <li><a class="dropdown-items bg-green" href="{{ url('investor/logout') }}"> Logout </a>
                             </li>
                         </ul>
                     </li>
                     <?php //echo $member_id=Session::get('member_id'); ?>
                     @else
                     @endif
                     @endforeach
                     @endif
                 </ul>

             </div>
             @if(!Session::get("member_id"))
             <div class="boxLoginBtn">
                 <a href="tel:554545455" class="iconcall"><img src="assets/img/icon-phone.png" alt="" title="" /></a>
                 <a class="btnLogin" href="{{  route('user-login') }}">Login </a>

             </div>
             @endif
         </div>
     </nav>
 </header>
 <!-- Header Code End -->