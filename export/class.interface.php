<?php 
// The UI class manages the different layouts for the application
class Ui {

	//echo '<pre style="margin-top: 150px;">';
	//print_r($data);
	//echo '</pre>';
    private $title = '';
    private $pages = [];   
    
    function __construct(){
       $this->title = 'Belize Export';
       $this->pages = array(
            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'dashboard"><i class="fa fa-tachometer fa-lg"></i> &nbsp; Dashboard</a>
		</i>

            ', 'userAcess' => array('admin', 'su', 'company', 'buyer')
	     , 'companyTypeId' => array(1, 2, 3)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'my-profile"><i class="fa fa-user fa-lg"></i> &nbsp; My Profile</a>
		</i>

            ', 'userAcess' => array('admin', 'su', 'company', 'buyer')
	     , 'companyTypeId' => array(1, 2, 3)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'company/account-requests"><i class="fa fa-list fa-lg"></i> &nbsp; Account Requests</a>
		</i>

            ', 'userAcess' => array('admin', 'su')
	    ],

            ['page'=>'

		<li class="nav-item dropdown d-custom-1">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false">
				<i class="fas fa-hand-holding-box fa-lg d-inline"></i> &nbsp;Service Category
			</a>
			<div class="dropdown-menu d-custom-1">
				<a class="dropdown-item d-custom-1" href="'.BASE_URL.'service-category-list"><i class="fas fa-chevron-right fa-lg d-inline"></i> &nbsp;Main Category</a>
				<a class="dropdown-item d-custom-1" href="'.BASE_URL.'sub-service-category-list"><i class="fas fa-chevron-right fa-lg d-inline"></i> &nbsp; Sub Category</a>
			</div>
		</li>


            ', 'userAcess' => array('su')],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'export-market-list"><i class="fa fa-truck fa-lg"></i> &nbsp; Export Markets</a>
		</i>

            ', 'userAcess' => array('admin', 'su')
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'my-music"> <i class="fas fa-music fa-lg"></i> &nbsp; My Music</a>
		</i>

            ', 'userAcess' => array('company')
	     , 'companyTypeId' => array(1)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'my-products"> <i class="fa fa-shopping-cart fa-lg"></i> &nbsp; My Products</a>
		</i>

            ', 'userAcess' => array('company')
	     , 'companyTypeId' => array(2)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'my-services"> <i class="fas fa-hand-holding-box fa-lg"></i> &nbsp; My Services</a>
		</i>

            ', 'userAcess' => array('company')
	     , 'companyTypeId' => array(3)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'sectors"><i class="fa fa-pie-chart fa-lg"></i> &nbsp; Sectors</a>
		</i>

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'company-profiles"><i class="fa fa-building fa-lg"></i> &nbsp; Companies</a>
		</i>

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'products"><i class="fa fa-shopping-cart fa-lg"></i> &nbsp; Products</a>
		</i>
		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'services"><i class="fas fa-hand-holding-box fa-lg"></i> &nbsp; Services</a>
		</i>
		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'music"><i class="fa fa-music fa-lg"></i> &nbsp; Music</a>
		</i>
            ', 'userAcess' => array('buyer')
	    ],

            ['page'=>'

		<li class="nav-item dropdown d-custom-1">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false">
				<i class="fa fa-list fa-lg d-inline"></i> &nbsp;Company Items
			</a>
			<div class="dropdown-menu d-custom-1">
				<a class="dropdown-item d-custom-1" href="'.BASE_URL.'product-list"><i class="fa fa-shopping-cart fa-lg d-inline"></i> &nbsp;Products</a>
				<a class="dropdown-item d-custom-1" href="'.BASE_URL.'service-list"><i class="far fa-hand-holding-box fa-lg d-inline"></i> &nbsp; Services</a>
				<a class="dropdown-item d-custom-1" href="'.BASE_URL.'music-list"><i class="fas fa-music fa-lg d-inline"></i> &nbsp; Music</a>
			</div>
		</li>


            ', 'userAcess' => array('admin', 'su')],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'hs-code-list"><i class="fa fa-tag fa-lg"></i> &nbsp; HS Codes</a>
		</i>

            ', 'userAcess' => array('admin', 'su')
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'sector-list"><i class="fa fa-pie-chart fa-lg"></i> &nbsp; Sectors</a>
		</i>

            ', 'userAcess' => array('admin', 'su')
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'user-list"><i class="fa fa-users fa-lg"></i> &nbsp; Users</a>
		</li>

            ', 'userAcess' => array('admin', 'su')],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'faq"><i class="fad fa-comments fa-lg"></i> &nbsp; Faq</a>
		</li>

            ', 'userAcess' => array('buyer', 'company')
	     , 'companyTypeId' => array(1, 2, 3)
	    ],

            ['page'=>'

		<li class="nav-item">
		    <a class="nav-link" href="'.BASE_URL.'faq-list"><i class="fa fa-list fa-lg"></i> &nbsp; Faqs</a>
		</li>

            ', 'userAcess' => array('admin', 'su')],

        ); 
    }
    // returns the starting header of html page structure
    public function header(){
        $html = '
                <!DOCTYPE html>
                <html lang="zxx">
                
                <head>
                <meta charset="utf-8">
                <title>'.$this->title.'</title>
                
                <!-- mobile responsive meta -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                
                    
                    <!-- ** Plugins Needed for the Project ** -->
                    <!-- Bootstrap -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/bootstrap/bootstrap.min.css">
                    

                    <!-- FontAwesome -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/fontawesome/font-awesome.min.css">
                    
                    <!-- FontAwesome - free -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

                    <!-- FontAwesome CDN -->
                    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

                    <!-- datatables -->
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
                    <!--<link rel="stylesheet" href="'.BASE_URL.'plugins/datatables/dataTables.bootstrap4.min.css">-->

                    <!-- Animation -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/animate.css">

                    <!-- Prettyphoto -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/prettyPhoto.css">
                    
                    <!-- Owl Carousel -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/owl/owl.carousel.css">
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/owl/owl.theme.css">

                    <!-- Flexslider -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/flex-slider/flexslider.css">
                    <!-- Flexslider -->
                    <link rel="stylesheet" href="'.BASE_URL.'plugins/cd-hero/cd-hero.css">

                    <!-- Style Swicther -->
                    <link id="style-switch" href="'.BASE_URL.'css/presets/preset3.css" media="screen" rel="stylesheet" type="text/css">
                    

                    <!-- File Input Master Plugin css file -->
                    <link  href="'.BASE_URL.'plugins/bootstrap-fileinput-master/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">

                    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
                    <!--[if lt IE 9]>
                    <script src="'.BASE_URL.'plugins/html5shiv.js"></script>
                    <script src="'.BASE_URL.'plugins/respond.min.js"></script>
                    <![endif]-->
                
                    <!-- Main Stylesheet -->
                    <link href="'.BASE_URL.'css/style.css" rel="stylesheet">
                    <link href="'.BASE_URL.'css/customStyles.css" rel="stylesheet">
                
                    <!--Favicon-->
                    <!--<link rel="icon" href="img/favicon/favicon-32x32.png" type="image/x-icon" />-->
                    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/favicon-144x144.png">
                    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/favicon-72x72.png">
                    <link rel="apple-touch-icon-precomposed" href="img/favicon/favicon-54x54.png">
                    
                    
                    <!-- custom javascript set and getfunction for global javascript variables that will be needed-->
                    <script src="'.BASE_URL.'js/globals.js"></script>
                    
                
                </head>
                <body>
                <div class="body-inner">
                
                ';
        return $html;
    }
    //returns the top tool bar
    public function topbar(){

        $moreOptions = '';
        $profileDropDown = '';
	$nav = '';


        if (!empty($_SESSION) && !empty($_SESSION['USERDATA'])){

	    foreach ($this->pages as $key => $page){
		    
		//getting all the pages for the logged in user
	    	if (in_array($_SESSION['USERDATA']['user_type'], $page['userAcess'])){
		
			if ($_SESSION['USERDATA']['user_type'] == 'company'){

				//adding pages for company type 
				if (in_array($_SESSION['COMPANYDATA'][0]['company_type_id'], $page['companyTypeId'])){
					$moreOptions .= $page['page'];
				}
			}else{

				$moreOptions .= $page['page'];

			}

	    	}
	    
	    }

		$nav = '
                    <nav class="navbar navbar-light px-4 py-2" >
                        <a class="navbar-brand" href="'.BASE_URL.'"><img class="img-fluid" src="'.BASE_URL.'images/export-belize-logo-2.png" alt="logo"></a>
			<button class="navbar-toggler ml-auto border-0 rounded-0 text-dark" type="button" data-toggle="collapse"
			    data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="fa fa-bars"></span>
			</button>

			<div class="collapse navbar-collapse text-center" id="navigation">
			    <ul class="navbar-nav ml-auto" id="login-menu">
				'.$moreOptions.'
                                <li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#"> <i class="fa fa-sign-out-alt fa-lg"></i> &nbsp; Logout</a>
                                </li>
			    </ul>
			</div>
		     </nav>
		';

        }else{
		$nav = '

                    <nav class="navbar navbar-expand-lg navbar-light px-4 py-2">
                        <a class="navbar-brand" href="'.BASE_URL.'"><img class="img-fluid" src="'.BASE_URL.'images/export-belize-logo-2.png" alt="logo"></a>
                        <button class="navbar-toggler ml-auto border-0 rounded-0 text-dark" type="button" data-toggle="collapse"
                            data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fa fa-bars"></span>
                        </button>
            
                        <div class="collapse navbar-collapse text-center" id="navigation">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="'.BASE_URL.'">Home</a></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="'.BASE_URL.'sectors">Sectors</a></a>
                                </li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						Company
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="'.BASE_URL.'company-profiles">Profiles</a>
						<a class="dropdown-item" href="'.BASE_URL.'products">Products</a>
						<a class="dropdown-item" href="'.BASE_URL.'services">Services</a>
						<a class="dropdown-item" href="'.BASE_URL.'music">Music</a>
						<a class="dropdown-item" href="'.BASE_URL.'faqs">Faq</a>
					</div>
				</li>
                                <li class="nav-item">
                                    <a class="nav-link " href="'.BASE_URL.'aboutUs">About Us</a></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="'.BASE_URL.'contact">Contact</a></a>
                                </li>
				<li class="nav-item pl-md-4 pt-md-2">
				    <a href="'.BASE_URL.'signIn" class="nav-item btn btn-primary">Sign In</a>
				</li>
                                
                            </ul>
                        </div>
                    </nav>

		';
            /*$profileDropDown = '
                <li class="nav-item pl-md-4 pt-md-2">
                    <a href="'.BASE_URL.'signIn" class="nav-item btn btn-primary">Sign In</a>
                </li>
            ';
	    */
        }

        $html = '
            <!-- Header start -->
            <header id="header" class="fixed-top header4" role="banner">
                <div class="container">
			'.$nav.'
                </div>
            </header>
            <!--/ Header end -->

        ';
        return $html;
    }   
    // return the home page
    public function home($data = []){

        $featuredProducts = '';
        $featuredSectors = '';
        $featuredCompanies = ''; 
        $productImages = '';
	$cName = '';

	//echo '<pre style="margin-top: 100px;">';
	//print_r($data);
	//echo '</pre>';

        //getting featured companies for display
        foreach($data['companys'] as $key => $company){
            if ($company['is_featured'] == 1 && isset($company['logo_img']) ){

		$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );

                $featuredCompanies .= '
                    <figure class="m-0 item">
                        <a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($company['company_id']).'" class="mr-0">
                            <img src="'.BASE_URL.$company['logo_img'].'" alt="'.$company['company_name'].' Logo">
                        </a>
                    </figure>
                ';
            }
        }

	$featuredCompanySection = '';
	if ($featuredCompanies != ''){
	
		//building featured company section
		$featuredCompanySection = '
		    <!-- Featured companies -->
		    <section id="teams" class="teams">
			<div class="container">
			    <div class="row">
				<div class="col-md-12 heading">
				    <span class="title-icon float-left"><i class="fa fa-building"></i></span>
				    <h2 class="title">Featured Companies<span class="title-desc">
					Our clients are ready to provide the products or services you\'re looking for.
				    </span></h2>
				</div>
			    </div><!-- Title row end -->
			    <div class="row wow fadeInLeft">
				<div id="client-carousel" class="col-12 owl-carousel owl-theme client-carousel text-center" >
				'.$featuredCompanies.'	
				</div><!-- Owl carousel end -->
			    </div><!-- Main row end -->
			</div>
		    </section>
		';

	}

	$featuredServiceSection = '';
	if (!empty($data['services'])){

		$count = 0;
		$delay = 0.5; //initial delay
		$featuredServices = '';

		while ($count <= 3){

			if ($data['services'][$count]['is_featured'] == 1){

				$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['services'][$count]['service_name'])) );
				$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['services'][$count]['company_name'])) );

				$featuredServices .= '
					<div class="col-12 col-md-6 col-lg-3 wow fadeInDown" data-wow-delay="'.$delay.'s">
						<div class="service-content text-center">
							<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($data['services'][$count]['id']).'" class="text-dark">
								<span class="service-icon icon-pentagon"><i class="'.$data['services'][$count]['sub_service_category_icon'].'"></i></span>
							</a>
							<h3>
								<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($data['services'][$count]['id']).'" class="text-dark">
									'.$data['services'][$count]['service_name'].'
								</a>
							</h3>
							<h5>
								<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['services'][$count]['company_id']).'">
									'.$data['services'][$count]['company_name'].'
								</a> -
								<span data-toggle="tooltip" data-placement="top" title="'.ucfirst($data['services'][$count]['service_category_name']).'">
								'.$data['services'][$count]['service_category_acronym'].'</span>
							</h5>
							<p>
								'.(trim(substr($data['services'][$count]['description'], 0, 100))).'...
							</p>	
						</div>
					</div>
				';
				$delay += 0.3;
			}

			$count++;

		}
		
		$featuredServiceSection = '
			<!-- Service box start -->
			<section id="service" class="service">
				<div class="container">
					<div class="row">
						<div class="col-md-12 heading">
							<span class="title-icon float-left"><i class="far fa-hand-holding-box"></i></span>
							<h2 class="title">Featured Services <span class="title-desc">Check out these Featured Services! </span></h2>
						</div>
					</div><!-- Title row end -->

					<div class="row">
						'.$featuredServices.'

					</div><!-- Content row end -->
				</div>
				<!--/ Container end -->
			</section>
			<!--/ Service box end -->

		';

	}

        //getting featured sectors for display
        foreach ($data['sectors'] as $key => $sector){

	    $sName = '';

            if ($sector['is_featured'] == 1){

		$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector['name'])) );

                    $featuredSectors .='
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 isotope-item">
                            <div class="grid">
                                <figure class="m-0 effect-oscar">
                                    <img src="'.BASE_URL.$sector['sector_img'].'" alt="'.$sector['name'].'" style="height:350px;object-fit: cover;">
                                    <figcaption>
					
                                        <h3>'.$sector['name'].'</h3>
                                        <a class="link icon-pentagon" href="'.BASE_URL.'sector/'.urlencode($sName).'/'.encrypt($sector['id']).'"><i class="fa fa-link"></i></a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div><!-- Isotope item end -->
                    ';

            }
        }
	

	$featuredSectorSection = '';
	if ($featuredSectors != ''){

		$featuredSectorSection = '

		    <!-- Featured Categories -->
		    <section id="portfolio">
			<div class="container">
			    <div class="row">
				<div class="col-md-12 heading">
				    <span class="title-icon classic float-left"><i class="fa fa-pie-chart"></i></span>
				    <h2 class="title">Featured Sectors<span class="title-desc">Check out these sectors!</span></h2>
				</div>
			    </div> <!-- Title row end -->
			</div>
			<div class="container-fuild">
			    <div class="row" id="isotope">
				'.$featuredSectors.'
			    </div><!-- Content row end -->
			</div>
		    </section><!-- Portfolio end -->

		';

	}

	
	$count = 0;
        //getting featured products for display
        foreach ($data['products'] as $key => $product){

	    $pName = '';
            
            if (isset($product['productImages'][0]['path']) && ($product['is_featured'] == 1 && $count < 3) ){

		$pName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );

                $featuredProducts .= '
                    <div class="col-12 col-md-6 col-lg-4 isotope-item">
                        <div class="grid">
                            <figure class="m-0 effect-oscar">
                                <img src="'.BASE_URL.$product['productImages'][0]['path'].'" alt="" class="prod-img-style-1">
                                <figcaption class="pt-0 mt-0">
                                    <h3 class="">'.$product['product_name'].'</h3>
                                    <a class="link icon-pentagon" href="'.BASE_URL.'products/'.$pName.'/'.encrypt($product['product_id']).'"><i class="fa fa-link"></i></a>
                                </figcaption>
                            </figure>
                        </div>
                    </div><!-- Isotope item end -->
                ';
		$count++;
            }

        }

	$featuredProductSection = '';
        if ($featuredProducts != ''){
            //wraping featured products in a flex box 
	    $featuredProductSection = '

            <!-- Portfolio start / is now featured Products -->
            <section id="portfolio" class="portfolio">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 heading">
                            <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
                            <h2 class="title">Featured Products<span class="title-desc">Check out these featured products!</span></h2>
                        </div>
                    </div> <!-- Title row end -->

                </div><!-- Container end -->
		<div>
			<div class="container-fluid">
			    <div class="row" id="isotope">
				'.$featuredProducts.'
			    </div><!-- Content row end -->
			</div><!-- Container end -->
                </div><!-- Container end -->
            </section><!-- Portfolio end -->

	    ';

        }
        
        $html = '
            <!-- Slider start -->
            <section id="home" class="pt-md-0 pt-3*2 pb-0">
                <div id="main-slide" class="carousel slide" data-ride="carousel">
                    <div class="overlay"></div>
                    <ol class="carousel-indicators">
                        <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                        <li data-target="#main-slide" data-slide-to="1"></li>
                        <li data-target="#main-slide" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="img-fluid" src="'.BASE_URL.'images/slider2/bg1.jpg" alt="slider">
                            <div class="slider-content">
                                <div class="col-md-12 text-center">
                                    <h2 class="animated2">
                                        Need To Invent The Future!
                                    </h2>
                                    <h3 class="animated3">
                                        We Making Difference To Great Things Possible
                                    </h3>
                                    <p class="animated4"><a href="#" class="slider btn btn-primary white">Check Now</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="'.BASE_URL.'images/slider2/bg2.jpg" alt="slider">
                            <div class="slider-content">
                                <div class="col-md-12 text-center">
                                    <h2 class="animated4">
                                        How Big Can You Dream?
                                    </h2>
                                    <h3 class="animated5">
                                        We are here to make it happen
                                    </h3>
                                    <p class="animated6"><a href="#" class="slider btn btn-primary white">Buy Now</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="'.BASE_URL.'images/slider2/bg3.jpg" alt="slider">
                            <div class="slider-content">
                                <div class="col-md-12 text-center">
                                    <h2 class="animated7">
                                        Your Challenge is Our Progress
                                    </h2>
                                    <h3 class="animated8">
                                        So, You Don\'t Need to Go Anywhere Today
                                    </h3>
                                    <div>
                                        <a class="animated4 slider btn btn-primary btn-min-block white" href="#">Get Now</a>
                                        <a class="animated4 slider btn btn-primary btn-min-block solid" href="#">Live Demo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control carousel-control-prev" href="#main-slide" data-slide="prev">
                        <span><i class="fa fa-angle-left"></i></span>
                    </a>
                    <a class="right carousel-control carousel-control-next" href="#main-slide" data-slide="next">
                        <span><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </section>

            <!--/ Slider end -->
            <section class="call-to-action dark">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center pl-0 pr-0">
                            <h3 class="mb-2">Get started by registering as a belizean business or buyer</h3>
			    <div class="d-block">
				    <a href="'.BASE_URL.'registration/buyer" class="btn btn-primary solid float-right">Buyer</a>
				    <a href="'.BASE_URL.'registration/company" class="btn btn-primary white float-right">Business</a>
			    </span>
                        </div>
                    </div>
                </div>
            </section>
            
        	'.$featuredProductSection.'
		
            <!-- Counter Strat / displays some basic stat info-->
            <section class="ts_counter p-0">
                <div class="container-fluid">
                    <div class="row facts-wrapper wow fadeInLeft text-center">
            
                        <div class="facts one col-md-3 col-sm-6">
                            <span class="facts-icon"><i class="fa fa-shopping-cart"></i></span>
                            <div class="facts-num">
                                <span class="counter">'.(count($data['products'])).'</span>
                            </div>
                            <h3>Products</h3>
                        </div>
                        <div class="facts two col-md-3 col-sm-6">
                            <span class="facts-icon"><i class="fa fa-pie-chart"></i></span>
                            <div class="facts-num">
                                <span class="counter">'.(count($data['sectors'])).'</span>
                            </div>
                            <h3>Different Sectors</h3>
                        </div>
                        <div class="facts three col-md-3 col-sm-6">
                            <span class="facts-icon"><i class="fa fa-building"></i></span>
                            <div class="facts-num">
                                <span class="counter">'.(count($data['companys'])).'</span>
                            </div>
                            <h3>Registered Companies</h3>
                        </div>
            
                        <div class="facts four col-md-3 col-sm-6">
                            <span class="facts-icon"><i class="fa fa-user"></i></span>
                            <div class="facts-num">
                                <span class="counter">'.$data['buyerCount'].'</span>
                            </div>
                            <h3>Registered Buyers</h3>
                        </div>

            
            
                    </div>
                </div>
                <!--/ Container end -->
            </section>
            <!--/ Counter end -->



	    '.$featuredServiceSection.'
	    '.$featuredSectorSection.'
	    '.$featuredCompanySection.'
        ';
        return $html;
    }
    // return html struture for a banner
    public function banner($title = null, $breadCrumbs = null){
	
	$home = (empty($_SESSION['USERDATA']))? 
	'
	    <li class="breadcrumb-item"><a href="'.BASE_URL.'">Home</a></li>
	' : 
	'
	    <li class="breadcrumb-item"><a href="'.BASE_URL.'dashboard">Dashboard</a></li>
	';

        $html = '
        <div id="banner-area" class="pt-4">
            <img src="'.BASE_URL.'images/banner/banner1.jpg" alt="" />
            <div class="parallax-overlay"></div>
            <!-- Subpage title start -->
            <div class="banner-title-content">
                <div class="text-center">
                    <h2 style="font-size:32px;">'.($title ?? '').'</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
			    
                            '.$home.($breadCrumbs ?? '').'
                        </ol>
                    </nav>
                </div>
            </div><!-- Subpage title end -->
        </div><!-- Banner area end -->
        ';
        return $html;
    }
    //returns a search bar
    public function searchBar(
	      $data = [], 
	      $enableHsCodeFilter = 1, 
	      $action = 'productSearch', 
	      $example = 'Habanero Sauce', 
	      $search = 'Product', 
	      $md = 6, 
	      $lg = 3,
	      $filterOption = 1
	){
        
        $hsCode        = $data['hsCode'] ?? '';
        $name 	       = $data['name'] ?? '';

	$filterBtn = '';
	if($filterOption == 1){

		$filterBtn = '
			<span class="col-12 d-flex flex-column pt-2 d-block d-md-none">
				<a href="#" id="filter-btn" class="align-self-end"><i class="fa fa-caret-down"></i> Filter Options</a>
			</span>
		';

	}

	$hsCodeFilter = '';
	if ($enableHsCodeFilter == 1){
	
   	    $hsCodeFilter = '
		<div class="col-12 col-md-'.$md.' col-lg-'.$lg.' pt-1 filter-option d-none d-md-block">
		    <label for="search"><h4 class="d-inline">HS Code</h4></label>
			    <input type="number" name="hsCode" class="form-control" placeholder="eg. 100630..." aria-label="" value="'.$hsCode.'">
		</div>  
	    ';
	    

	}


	$exportMarketFilter = '';
	//getting the different sectors available
	if (!empty($data['exportMarkets'])){

		$exportOptions = '';

		foreach ($data['exportMarkets'] as $exportMarket){

		    if (isset($data['exportMarketId']) && $data['exportMarketId'] == $exportMarket['id']){
			$exportOptions .= '
			    <option value="'.encrypt($exportMarket['id']).'" selected>'.$exportMarket['name'].'</option>
			';
		    }else{
			$exportOptions .= '
			    <option value="'.encrypt($exportMarket['id']).'">'.$exportMarket['name'].'</option>
			';
		    }
		}
		    $exportMarketFilter = '
			<div class="col-12 col-md-'.$md.' col-lg-'.$lg.' pt-1 filter-option d-none d-md-block">
			    <label for="inputEmail3"><h4 class="d-inline">Export Market</h4></label>
			    <div class="input-group">
				<select name="exportMarketId" class="form-control">
				    <option value="'.encrypt(0).'">None</option>
				    '.$exportOptions.' 
				</select>
			    </div>
			</div>
		    ';
        }

	$sectorFilter = '';
	//getting the different export markets available
	if (!empty($data['sectors'])){

	    	$sectorOptions = '';

		foreach ($data['sectors'] as $sector){

		    if (isset($data['sectorId']) && $data['sectorId'] == $sector['id']){
			$sectorOptions .= '
			    <option value="'.encrypt($sector['id']).'" selected>'.$sector['name'].'</option>
			';
		    }else{
			$sectorOptions .= '
			    <option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
			';
		    }

		}

	        $sectorFilter = '

			<div class="col-md col-md-'.$md.' col-lg-'.$lg.' pt-1 filter-option d-none d-md-block">
			    <label for="inputEmail3"><h4 class="d-inline">Sector</h4></label>
			    <div class="input-group">
				<select name="sectorId" class="form-control">
				    <option value="'.encrypt(0).'">None</option>
				    '.$sectorOptions.' 
				</select>
			    </div>
			</div>

	        ';
	}

	$sscId = $data['sscId'] ?? 0;
	$subSerCatFilter = '';
	if (!empty($data['subServiceCat'])){

	    	$subSerCatOptions = '';

		foreach ($data['subServiceCat'] as $subServiceCat){

		    if (isset($data['subServiceCat']) && $sscId  == $subServiceCat['id']){
			$subSerCatOptions .= '
			    <option value="'.encrypt($subServiceCat['id']).'" selected>'.$subServiceCat['sub_service_category_name'].'</option>
			';
		    }else{
			$subSerCatOptions .= '
			    <option value="'.encrypt($subServiceCat['id']).'">'.$subServiceCat['sub_service_category_name'].'</option>
			';
		    }

		}

	        $subSerCatFilter = '

			<div class="col-12 col-md-'.$md.' col-lg-'.$lg.' pt-1 mb-2 filter-option d-none d-md-block">
			    <label for="inputEmail3"><h4 class="d-inline">SubCategory</h4></label>
			    <div class="input-group">
				<select name="sscId" class="form-control">
				    <option value="'.encrypt(-1).'">None</option>
				    '.$subSerCatOptions.' 
				</select>
			    </div>
			</div>

	        ';
	}

	$scId = $data['scId'] ?? 0;
	$serCatFilter = '';
	if (!empty($data['serviceCat'])){

	    	$serCatOptions = '';

		foreach ($data['serviceCat'] as $serviceCat){

		    if (isset($data['serviceCat']) && $scId == $serviceCat['id']){
			$serCatOptions .= '
			    <option value="'.encrypt($serviceCat['id']).'" selected>'.$serviceCat['name'].'</option>
			';
		    }else{
			$serCatOptions .= '
			    <option value="'.encrypt($serviceCat['id']).'">'.$serviceCat['name'].'</option>
			';
		    }

		}

	        $serCatFilter = '

			<div class="col-12 col-md-'.$md.' col-lg-'.$lg.' pt-1 mb-2 filter-option d-none d-md-block">
			    <label for="inputEmail3"><h4 class="d-inline">Category</h4></label>
			    <div class="input-group">
				<select name="scId" class="form-control">
				    <option value="'.encrypt(-1).'">None</option>
				    '.$serCatOptions.' 
				</select>
			    </div>
			</div>

	        ';
	}
        $html = '
            <div class="container pt-3">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card shadow" >
                            <div class="card-body">
                                <h3 class="card-title">Search For '.$search.' By... </h3>
                                <form id="productSearch" action="'.BASE_URL.'" method="post">
                                    <input type="hidden" name="action" value="'.$action.'">
                                    <div class="row">
                                        <div class="col-12 col-md-'.$md.' col-lg-'.$lg.' pt-1 mb-2">
                                            <label for="search"><h4 class="d-inline">Name</h4></label>
                                            <input type="text" class="form-control" name="name" placeholder="eg. '.$example.'..." aria-label="" value="'.$name.'" aria-describedby="basic-addon2">
                                        </div>  

                                        '.$hsCodeFilter.$sectorFilter.$exportMarketFilter.$serCatFilter.$subSerCatFilter.'
					

					'.$filterBtn.'
                                        </div>  
					<div class="row d-flex flex-column">
						<div class="col-12 col-md-6 col-lg-4 align-self-center">
							<button class="btn btn-primary square solid blank mt-4 btn-block" type="submit">
								<i class="fa fa-search" style="font-size:20px;vertical-align:middle;"></i> 
								<span style="vertical-align: middle;"> Find '.$search.' </span>
							</button>
						</div>
					</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
        return $html;
    }
    public function viewCompanies($data = []){

	$pName = '';
	$cName = '';
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $companysFound = '';
        $pageContent = '';                      //contains all the pages and pagination elements
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination


        if (!empty($data['companys'])){
            foreach( $data['companys'] as $key => $company){
                
		$website = isset($company['website_link'])? '<a href="'.$company['website_link'].'"><i class="fa fa-globe fa-lg"></i></a>': '';
		$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );
		$socialLinks = '';



		if ( isset($company['logo_img'])){

			if (!empty($company['socialContactList'])){

				foreach ($company['socialContactList'] as $key => $socialContact){

					if (isset($socialContact['link'])){

						$socialLinks .= '<a href="'.$socialContact['link'].'" class="mr-3"><i class="'.$socialContact['icon'].' fa-lg"></i></a>';	
				
					}

				}

			}

			$bookmarkBtn = '';
			if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

				$icon = 'far fa-bookmark';
				if (!empty($data['cBookmarks'])){
	
					$companiesToBookmark = array_column($data['cBookmarks'], 'company_id');

					if (in_array($company['company_id'], $companiesToBookmark)){

						$icon = 'fad fa-bookmark';
					
					}

				}
				$bookmarkBtn = '
					<span class="float-right">
						<i class="'.$icon.' fa-lg bookmark-company text-dark" data-cid="'.encrypt($company['company_id']).'"
						data-toggle="tooltip" data-placement="top" title="Bookmark"></i>
					</span>
				';

			}
			$companysFound .= '
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 portfolio-static-item">
					<div class="grid">
						<figure class="m-0 effect-oscar">
							<img src="'.BASE_URL.($company['logo_img'] ?? '').'" alt="'.$company['company_name'].' Image" class="img-responsive" style="height:235px;">
							<figcaption>
							    <a class="link icon-pentagon" href="'.BASE_URL.'company/'.$cName.'/'.encrypt($company['company_id']).'"><i class="fa fa-link"></i></a>
							</figcaption>
						</figure>
						<div class="portfolio-static-desc">
							'.$bookmarkBtn.'
							<h3>
								<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($company['company_id']).'">'.$company['company_name'].'</a>

							</h3>
							<span>
								<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($company['company_id']).'">

								</a>
								<p>
								'.(strlen($company['description']) > 100 ? trim(substr($company['description'], 0, 100)).'...' : $company['description']).'
								</p>	
								<div class="text-center">
   								'.$socialLinks.$website.'
								</div>
								
							</span>

							
						</div>
					</div>
					<!--/ grid end -->
				</div>
			';


			if ($count == ($possibleCardTotal-1)){
			    //creating page because we reached out maximum cards per page
			    $pageCount++;
			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row">
					    '.$companysFound.'
				     </div><!-- Content row end -->
				</div>
			    ';
			    $companysFound  = '';
			    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added

			}

			$count++;


		}

            }

	    // Creating a page for the remaining Course Cards
	    if ( $count < $maxCardPerPage ){

                    $pageCount++;
                    $pages = '
                        <div id="page-'.$pageCount.'">
			    <div class="row">
				    '.$companysFound.'
			     </div><!-- Content row end -->
                        </div>
                    ';

	    }else{
		    if ($count <= $possibleCardTotal){

			if ($count != ($possibleCardTotal - $maxCardPerPage)){
			    //if we have more cards than the maximum amount we will add another page
			    $pageCount++;
			}
			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row">
					    '.$companysFound.'
				     </div><!-- Content row end -->
				</div>
			    ';

		    }
	    }

            // creating pagination
            $pageContent = '
                <div id="pagination-content">
                      '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn">
                        </div>
                    </div>
                </div>
            ';


            $resultTitle = 'Companies Found...';

        }else{

            $resultTitle = 'No Companies Found...';
        }



        $html = $this->banner('Companies', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Companies</li>'
		 ).$this->searchBar($data['searchBy'], 0, 'companySearch', 'BELTRAIDE', 'Company', 6, 4).'

		 <!-- Portfolio start --> 
		 <section id="main-container" class="portfolio-static">
		     <div class="container">
			 <div class="row">
			     <div class="col-md-12 heading">
				 <span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
				 <h2 class="title classic">'.$resultTitle.'</h2>
			     </div>
			 </div>
			     '.$pageContent.'
		     </div><!-- Container end  -->
		 </section><!-- Portfolio end -->
	    <script>
                setPaginationTotalCount('.$pageCount.');
            </script>

        ';
        return $html;

    }

    public function viewFaq($data = []){

	$pageTitle = '';
	$faqContent = '';

	if (empty($data['faqs'])){

		$pageTitle = '
			<div class="row">
				<div class="col-md-12 heading">
					<span class="title-icon classic float-left"><i class="fa fa-comments"></i></span>
					<h2 class="title classic">No Question have been added as yet...</h2>
				</div>
			</div>

		';
		
	
	}else{
		//creating faqs
		$pageTitle = '
			<div class="row">
				<div class="col-md-12 heading">
					<span class="title-icon classic float-left"><i class="fa fa-comments"></i></span>
					<h2 class="title classic">Questions Answered At a Galance</h2>
				</div>
			</div>

		';
		$faqs = '';
		foreach ($data['faqs'] as $key => $faq){
			
			$question = (substr(trim($faq['question']), -1) != '?')? $faq['question'].'?' : $faq['question'];
			$faqs .= '
					<div class="col-md-6 col-sm-6">
						<div class="faq-box">
							<h4>Q. '.$question.'</h4>
							<p>'.$faq['answer'].'</p>
						</div>
					</div>


			';


		}
		$faqContent = '
			<div class="row">
				'.$faqs.'
			</div>
		';
	}	



        $html = '
       
            '.$this->banner('Faqs', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Faq</li>'
            ).'   
		<!-- Main container start -->
		<section id="main-container">
			<div class="container">
				<!-- Services -->
				'.$pageTitle.'
				'.$faqContent.'
			</div>
			<!--/ container end -->
		</section>
		<!--/ Main container end -->      

        
        ';
        return $html;
    }
    public function viewMusic($data = []){

        $found = '';
	$mName = '';
	$cName = '';
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if (!empty($data['musics'])){
            foreach( $data['musics'] as $key => $music){
                
		$mName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music['name'])) );
		$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music['company_name'])) );

		//adding interest icon to service if user is logged in as buyer
		$interestBtn = '';
		if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

			$icon = 'far fa-star';
			if (!empty($data['music_interests'])){

				$interestedMusic = array_column($data['music_interests'], 'music_id');

				if (in_array($music['id'], $interestedMusic)){

					$icon = 'fas fa-star';
				
				}

			}
			$interestBtn = '
				<span class="float-right">
					<i class="'.$icon.' fa-lg interested-music text-warning" data-mid="'.encrypt($music['id']).'"
					data-toggle="tooltip" data-placement="top" title="Interested"></i>
				</span>
			';

		}

		$found .= '
				<div class="col-12 col-md-6 col-lg-4">
					<div class="service-content">
						<span class="service-icon icon-pentagon"><i class="fas fa-play play-audio">
							<audio class="audio-preview" preload="metadata" hidden>
							    <source src="'.$music['audio_path'].'" class="audio-preview-src" />
							    Your browser does not support audio elements, please use chrome or firefox to be able to listen to the audio
							</audio>
							</i>
						</span>
						<h3>
							<a href="'.BASE_URL.'music/'.$mName.'/'.encrypt($music['id']).'" class="text-dark">
								'.$music['name'].'
							</a>
						</h3>
						<h5 class="ml-4">
							'.$interestBtn.'
							<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($music['company_id']).'">
								'.$music['company_name'].'
							</a>
						</h5>
						<p>
							'.(strlen($music['description']) > 100 ? trim(substr($music['description'], 0, 100)).'...' : $music['description']).'
						</p>	
					</div>
				</div>

		';

		if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'">
			    <div class="row text-center">
				    '.$found.'
			     </div><!-- Content row end -->
                        </div>
                    ';
                    $found = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added

		}

		$count++;
            }

	    // Creating a page for the remaining Course Cards
	    if ( $count < $maxCardPerPage ){

                    $pageCount++;
                    $pages = '
                        <div id="page-'.$pageCount.'">
			    <div class="row text-center">
				    '.$found.'
			     </div><!-- Content row end -->
                        </div>
                    ';

	    }else{
		    if ($count <= $possibleCardTotal){

			if ($count != ($possibleCardTotal - $maxCardPerPage)){
			    //if we have more cards than the maximum amount we will add another page
			    $pageCount++;
			}

			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row text-center">
					    '.$found.'
				     </div><!-- Content row end -->
				</div>
			    ';

		    }
	    }

            // creating pagination
            $pageContent = '
                <div id="pagination-content">
                      '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn">
                        </div>
                    </div>
                </div>
            ';


            $resultTitle = 'Music Found...';

        }else{

            $resultTitle = 'No Music Found...';
        }



        $html = $this->banner('Music', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Music</li>'
		 ).$this->searchBar($data['searchBy'] ?? [], 0, 'musicSearch','Enter music name...','Music' , 12, '6 mx-auto', 0).'

		 <!-- Portfolio start --> 
		 <section id="main-container" class="portfolio-static">
		     <div class="container">
			 <div class="row">
			     <div class="col-md-12 heading">
				 <span class="title-icon classic float-left"><i class="fa fa-music"></i></span>
				 <h2 class="title classic">'.$resultTitle.'</h2>
			     </div>
			 </div>
			     '.$pageContent.'
		     </div><!-- Container end  -->
		 </section><!-- Portfolio end -->
	    <script>
                setPaginationTotalCount('.$pageCount.');
            </script>

        ';
        return $html;

    }

    public function viewServices($data = []){

        $servicesFound = '';
	$sName = '';
	$cName = '';
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if (!empty($data['services'])){
            foreach( $data['services'] as $key => $service ){
                
		$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['service_name'])) );
		$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['company_name'])) );

		//adding interest icon to service if user is logged in as buyer
		$interestBtn = '';
		if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

			$icon = 'far fa-star';
			if (!empty($data['service_interests'])){

				$interestedServices = array_column($data['service_interests'], 'service_id');

				if (in_array($service['id'], $interestedServices)){

					$icon = 'fas fa-star';
				
				}

			}
			$interestBtn = '
				<span class="float-right">
					<i class="'.$icon.' fa-lg interested-service text-warning" data-sid="'.encrypt($service['id']).'"
					data-toggle="tooltip" data-placement="top" title="Interested"></i>
				</span>
			';

		}

		$servicesFound .= '
				<div class="col-12 col-md-6 col-lg-4">
					<div class="service-content">
						<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($service['id']).'" class="text-dark">
							<span class="service-icon icon-pentagon"><i class="'.$service['sub_service_category_icon'].'"></i></span>
						</a>
						<h3>
							<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($service['id']).'" class="text-dark">
								'.$service['service_name'].'
							</a>
						</h3>
						<h5>
						</h5>
						<h5 class="ml-4">
							<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($service['company_id']).'">
								'.$service['company_name'].'
							</a> -
							<span data-toggle="tooltip" data-placement="top" title="'.ucfirst($service['service_category_name']).'">
							'.$service['service_category_acronym'].'</span>
							'.$interestBtn.'
						</h5>
						<p>
							'.(strlen($service['description']) > 100 ? trim(substr($service['description'], 0, 100)).'...' : $service['description']).'
						</p>	
					</div>
				</div>

		';

		if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'">
			    <div class="row text-center">
				    '.$servicesFound.'
			     </div><!-- Content row end -->
                        </div>
                    ';
                    $servicesFound  = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added

		}

		$count++;
            }

	    // Creating a page for the remaining Course Cards
	    if ( $count < $maxCardPerPage ){

                    $pageCount++;
                    $pages = '
                        <div id="page-'.$pageCount.'">
			    <div class="row text-center">
				    '.$servicesFound.'
			     </div><!-- Content row end -->
                        </div>
                    ';

	    }else{
		    if ($count <= $possibleCardTotal){

			if ($count != ($possibleCardTotal - $maxCardPerPage)){
			    //if we have more cards than the maximum amount we will add another page
			    $pageCount++;
			}

			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row text-center">
					    '.$servicesFound.'
				     </div><!-- Content row end -->
				</div>
			    ';

			/*$pages .= '
			<div id="pagination-content">
			      '.$pages.'
			</div>
			';*/

		    }
	    }

            // creating pagination
            $pageContent = '
                <div id="pagination-content">
                      '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn">
                        </div>
                    </div>
                </div>
            ';


            $resultTitle = 'Services Found...';

        }else{

            $resultTitle = 'No Service Found...';
        }



        $html = $this->banner('Services', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Services</li>'
		 ).$this->searchBar($data['searchBy'], 0, 'serviceSearch','Web Development...','Service' , 6, 4).'

		 <!-- Portfolio start --> 
		 <section id="main-container" class="portfolio-static">
		     <div class="container">
			 <div class="row">
			     <div class="col-md-12 heading">
				 <span class="title-icon classic float-left"><i class="fa fa-hand-holding-box"></i></span>
				 <h2 class="title classic">'.$resultTitle.'</h2>
			     </div>
			 </div>
			     '.$pageContent.'
		     </div><!-- Container end  -->
		 </section><!-- Portfolio end -->
	    <script>
                setPaginationTotalCount('.$pageCount.');
            </script>

        ';
        return $html;

    }
    public function viewSectors($data = []){

        $found = '';
	$pName = '';
	$cName = '';
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if (!empty($data['sectors'])){
            foreach( $data['sectors'] as $key => $sector){
		$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector['name'])) );

		if ( isset($sector['sector_img']) ){

			$found .= '
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 portfolio-static-item">
					<div class="grid">
						<figure class="m-0 effect-oscar">
							<img src="'.BASE_URL.($sector['sector_img'] ?? '').'" alt="'.$sector['name'].' Image" class="img-responsive" style="height:235px;">
							<figcaption>
							    <a class="link icon-pentagon" href="'.BASE_URL.'sector/'.$sName.'/'.encrypt($sector['id']).'"><i class="fa fa-link"></i></a>
							</figcaption>
						</figure>
						<div class="portfolio-static-desc">
							<h3>
								<a href="'.BASE_URL.'sector/'.$sName.'/'.encrypt($sector['id']).'">'.$sector['name'].'</a>
							</h3>
								<p>
							'.(strlen($sector['description']) > 100 ? trim(substr($sector['description'], 0, 100)).'...' : $sector['description']).'
								</p>	
						</div>
					</div>
					<!--/ grid end -->
				</div>
			';
		}

		if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'">
			    <div class="row">
				    '.$found.'
			     </div><!-- Content row end -->
                        </div>
                    ';
                    $found  = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added

		}

		$count++;
            }

	    // Creating a page for the remaining Course Cards
	    if ( $count < $maxCardPerPage ){

                    $pageCount++;
                    $pages = '
                        <div id="page-'.$pageCount.'">
			    <div class="row">
				    '.$found.'
			     </div><!-- Content row end -->
                        </div>
                    ';

	    }else{
		    if ($count <= $possibleCardTotal){

			if ($count != ($possibleCardTotal - $maxCardPerPage)){
			    //if we have more cards than the maximum amount we will add another page
			    $pageCount++;
			}
			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row">
					    '.$found.'
				     </div><!-- Content row end -->
				</div>
			    ';

		    }
	    }

            // creating pagination
            $pageContent = '
                <div id="pagination-content">
                      '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn">
                        </div>
                    </div>
                </div>
            ';


            $resultTitle = 'Sectors Found...';

        }else{

            $resultTitle = 'No Sectors Found...';
        }



        $html = $this->banner('Sectors', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Sectors</li>'
		 ).$this->searchBar($data['searchBy'] ?? [], 0, 'sectorSearch','Agriculture','Sector' , 12, '6 mx-auto', 0).'

		 <!-- Portfolio start --> 
		 <section id="main-container" class="portfolio-static">
		     <div class="container">
			 <div class="row">
			     <div class="col-md-12 heading">
				 <span class="title-icon classic float-left"><i class="fa fa-pie-chart"></i></span>
				 <h2 class="title classic">'.$resultTitle.'</h2>
			     </div>
			 </div>
			     '.$pageContent.'
		     </div><!-- Container end  -->
		 </section><!-- Portfolio end -->
	    <script>
                setPaginationTotalCount('.$pageCount.');
            </script>

        ';
        return $html;

    }
    //Displays the productsCat for users
    public function viewProducts($data = []){

        $productsFound = '';
	$pName = '';
	$cName = '';
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if (!empty($data['products'])){
            foreach( $data['products'] as $key => $product){
                
		$pName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );
		$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['company_name'])) );


		if ( isset($product['productImages'][0]['path'])){


			// adding star icon only if user is logged in as buyer
			$interestBtn = '';
			if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

				$icon = 'far fa-star';
				if (!empty($data['prod_interests'])){
	
					$interestedProducts = array_column($data['prod_interests'], 'product_id');

					if (in_array($product['product_id'], $interestedProducts)){

						$icon = 'fas fa-star';
					
					}

				}
				$interestBtn = '
					<span class="float-right">
						<i class="'.$icon.' fa-lg interested-product text-warning" data-pid="'.encrypt($product['product_id']).'"
						data-toggle="tooltip" data-placement="top" title="Interested"></i>
					</span>
				';

			}

			$productsFound .= '
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 portfolio-static-item">
					<div class="grid">
						<figure class="m-0 effect-oscar">
							<img src="'.BASE_URL.($product['productImages'][0]['path'] ?? '').'" alt="'.$product['product_name'].' Image" class="img-responsive" style="height:235px;">
							<figcaption>
							    <a class="link icon-pentagon" href="'.BASE_URL.'products/'.$pName.'/'.encrypt($product['product_id']).'"><i class="fa fa-link"></i></a>
							</figcaption>
						</figure>
						<div class="portfolio-static-desc">
							'.$interestBtn.'
							<h3>
								<a href="'.BASE_URL.'products/'.$pName.'/'.encrypt($product['product_id']).'">'.$product['product_name'].'</a>
							</h3>
							<span><a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($product['company_id']).'">'.ucwords($product['company_name']).'</a></span>
								<p>
							'.(strlen($product['product_description']) > 100 ? trim(substr($product['product_description'], 0, 100)).'...' : $product['product_description']).'
								</p>	
						</div>
					</div>
					<!--/ grid end -->
				</div>
			';
		}

		if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'">
			    <div class="row">
				    '.$productsFound.'
			     </div><!-- Content row end -->
                        </div>
                    ';
                    $productsFound  = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added

		}

		$count++;
            }

	    // Creating a page for the remaining Course Cards
	    if ( $count < $maxCardPerPage ){

                    $pageCount++;
                    $pages = '
                        <div id="page-'.$pageCount.'">
			    <div class="row">
				    '.$productsFound.'
			     </div><!-- Content row end -->
                        </div>
                    ';

	    }else{
		    if ($count <= $possibleCardTotal){

			if ($count != ($possibleCardTotal - $maxCardPerPage)){
			    //if we have more cards than the maximum amount we will add another page
			    $pageCount++;
			}
			    $pages .= '
				<div id="page-'.$pageCount.'">
				    <div class="row">
					    '.$productsFound.'
				     </div><!-- Content row end -->
				</div>
			    ';

		    }
	    }

            // creating pagination
            $pageContent = '
                <div id="pagination-content">
                      '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn">
                        </div>
                    </div>
                </div>
            ';


            $resultTitle = 'Products Found...';

        }else{

            $resultTitle = 'No Products Found...';
        }



        $html = $this->banner('Products', 
		 '<li class="breadcrumb-item text-white" aria-current="page">Products</li>'
		 ).$this->searchBar($data['searchBy']).'

		 <!-- Portfolio start --> 
		 <section id="main-container" class="portfolio-static">
		     <div class="container">
			 <div class="row">
			     <div class="col-md-12 heading">
				 <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
				 <h2 class="title classic">'.$resultTitle.'</h2>
			     </div>
			 </div>
			     '.$pageContent.'
		     </div><!-- Container end  -->
		 </section><!-- Portfolio end -->
	    <script>
                setPaginationTotalCount('.$pageCount.');
            </script>

        ';
        return $html;

    }
    public function editFaq($data = []){
        
        $html = $this->banner('edit Faq',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'faq-list">Faq List</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Edit Faq</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit Faq</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="updateFaq">
                                                <input type="hidden" name="fId" value="'.encrypt($data['faqInfo'][0]['id']).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 col-lg-8">
                                                                    <div class="form-group">
                                                                        <label for="question" class="">Question</label>
                                                                        <input type="text" class="form-control" name="question" placeholder="Please enter a question..." value="'.$data['faqInfo'][0]['question'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="">Sector</label>
                                                                        <select name="displayTo" class="form-control" requried>
										<optgroup label="General Users" class="mb-5">
											<option value="all" '.(($data['faqInfo'][0]['display_to'] == 'all')? 'selected' : '').'>Everyone</option>
											<option value="company" '.(($data['faqInfo'][0]['display_to'] == 'company')? 'selected' : '').'>Company</option>
											<option value="buyer" '.(($data['faqInfo'][0]['display_to'] == 'buyer')? 'selected' : '').'>Buyer</option>
											<option value="guest" '.(($data['faqInfo'][0]['display_to'] == 'guest')? 'selected' : '').'>Guest</option>
										</optgroup>
										<optgroup label="Company Types" class="mb-5">
											<option value="product" '.(($data['faqInfo'][0]['display_to'] == 'product')? 'selected' : '').'>Product</option>
											<option value="service" '.(($data['faqInfo'][0]['display_to'] == 'service')? 'selected' : '').'>Service</option>
											<option value="music" '.(($data['faqInfo'][0]['display_to'] == 'music')? 'selected' : '').'>Music </option>
										</optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Answer</label>
                                                                        <textarea class="form-control" name="answer" placeholder="Enter the answer to the question stated above..." rows="6">'.($data['faqInfo'][0]['answer'] ?? '').'</textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //hs code edit view
    public function editHsCode($data = null){
        
        $sectorOptions = '';

        foreach ($data['sectors'] as $sector){
		
            if ( $data['hsInfo'][0]['sector_id'] == $sector['id']){

		    $sectorOptions .= '
			<option value="'.encrypt($sector['id']).'" selected>'.$sector['name'].'</option>
		    ';

	    }else{

		    $sectorOptions .= '
			<option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
		    ';


	    }
        }

        $html = $this->banner('Edit HS Code',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'hs-code-list">HS Codes</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Edit HS Code</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit HS Code</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="updateHsCode">
                                                <input type="hidden" name="hsc" value="'.encrypt($data['hsInfo'][0]['hs_code']).'">
                                                <input type="hidden" name="hsId" value="'.encrypt($data['hsInfo'][0]['id']).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							HS Code Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">HS Name</label>
                                                                        <input type="text" class="form-control" name="hsName" id="" placeholder="eg. Rice" value="'.$data['hsInfo'][0]['hs_code_name'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">HS Code</label>
                                                                        <input type="number" class="form-control" name="hsCode" id="" placeholder="eg. 100630" value="'.$data['hsInfo'][0]['hs_code'].'" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Sector</label>
                                                                        <select name="sId" class="form-control">
                                                                            '.$sectorOptions.'
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function addUser($data = []){
        
	$buyerTab = '';
	$companyTab = '';
	$adminTab = '';
	$suTab = '';

        $options = '';

	$count = 1;
	if (!empty($data['companyTypes'])){

		foreach ($data['companyTypes'] as $type){
		    $checked = ($count == 1)? 'checked' : '';
		    $color = ($count == 1)? 'text-primary' : '';
			 	
		    $options .= '
			<div class="form-check form-check-inline">
			  <input class="form-check-input c-type-radio" type="radio" name="companyInfo[type]" id="c-'.$type['type'].'" value="'.encrypt($type['id']).'" '.$checked.'>
			  <label class="form-check-label h1 mr-2 mr-md-4 c-type-label" for="c-'.$type['type'].'" data-toggle="tooltip" data-placement="top" title="'.$type['display_name'].'">
				<i class="'.$type['icon'].' '.$color.'"></i>
			  </label>
			</div>
		    ';
	    	    $count++;
		}
	}

	$tabLinks = '
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#company" role="tab" aria-controls="pills-company" aria-selected="true">Company</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-buyer-tab" data-toggle="pill" href="#buyer" role="tab" aria-controls="pills-buyer" aria-selected="false">Buyer</a>
		  </li>
	';

	$companyTab = '
		<div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="pills-company-tab">
                                    <form action="'.BASE_URL.'index.php" method="POST">
                                        <h3 class="card-title mb-0">Point of Contact</h3>
				        <hr class="mt-0 pt-0">
					<input type="hidden" name="action" value="addUser">
					<input type="hidden" name="user" value="company">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
						    <label for="validationDefault01">First Name</label>
						    <input type="text" class="form-control" name="pointOfContact[fname]"  maxlength="150" placeholder="Enter their first name..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4  mb-3">
						    <label for="validationDefault02">Last Name</label>
						    <input type="text" class="form-control" name="pointOfContact[lname]"  maxlength="150" placeholder="Enter their last name..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
						    <label for="validationDefault02">Phone #</label>
						    <input type="tel" class="form-control" name="pointOfContact[phone] maxlength="15" placeholder="Enter their phone number..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 mb-3">
						    <label for="validationDefault02">Position</label>
						    <input type="text" class="form-control" name="pointOfContact[position]" maxlength="200" placeholder="Enter their job position..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
						    <label for="validationDefault01">Email</label>
						    <input type="email" class="form-control" name="pointOfContact[email]"  maxlength="200" placeholder="Enter their contact email..." value="" required>
                                            </div>
                                        </div>


                                        <h3 class="card-title mb-0">Company Profile</h3>
				        <hr class="mt-0 pt-0">


                                        <div class="form-row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[name]" maxlength="150" placeholder="Enter company\'s name..." required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="email">Email 
							<i class="fa fa-info-circle" data-toggle="tooltip" 
							data-placement="top" title="
								This Email below will be used as the company\'s main contact email and to gain access to the EXPORTBelize Platform once account has been added.
							">
							</i></label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" id="company-email" name="companyInfo[email]" maxlength="200" placeholder="Enter a valid email..."  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">City/Town/Village</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[ctv]" placeholder="Enter company location..." maxlength="150" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">Address</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[address]" maxlength="200" placeholder="Enter company\'s address..."  required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">District</label>
                                                <select class="form-control" name="companyInfo[district]">
                                                    <option vlaue="Corozal" selected>Corozal</option>
                                                    <option value="Orange Walk">Orange Walk</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Cayo">Cayo</option>
                                                    <option value="Stann Creek">Stann Creek</option>
                                                    <option value="Toledo">Toledo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                             <div class="col-12 col-md-6 mb-3">
                                                <label for="type" class="d-block">Choose the Company\'s main area of focus...</label>
						<span class="d-block text-center">	
							'.$options.'
						</span>
					     </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="supply-type">Company\'s main trade is...</label>
                                                <select id="supply-type" class="form-control" name="companyInfo[tradeArea]">
                                                    <option value="export">Other Countries</option>
                                                    <option value="local">Belize</option>
                                                    <option value="both">Belize and Other Countries</option>
                                                </select>
                                            </div>

					</div>




                                        <h5 class="card-title mb-0">Additional Info</h5>
				        <hr class="mt-0 pt-0">


                                        <div class="row" id="add-comp-fields" hidden>

						    <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                        <label for="email">Seat Capacity<sub>(Current)</sub></i></label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control service-field" name="companyInfo[currentSeatCapacity]" placeholder="Current seat capacity...">
                                                        </div>
					  	    </div>
						    <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                        <label for="email">Seat Capacity<sub>(Expansion Potential)</sub></i></label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control service-field" name="companyInfo[expanPotential]" maxlength="200" placeholder="Seat Expansion Potential..." >
                                                        </div>
                                                    </div>

					</div>

                                        <div class="form-row">
                                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                <label for="email">Website<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[website]" maxlength="200" placeholder="Enter company\'s website...">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                                <label for="phone">Phone #<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" name="companyInfo[phone]" maxlength="15" placeholder="Enter company\'s contact #...">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                                <label for="phone">Year Established<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="companyInfo[establishedOn]" max="'.date('Y').'" placeholder="Year company was established...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
					    <div class="col-12 mb-3">
						<label for="email">Tell us something about the company...<sub>(Optional)</sub></label>
						<textarea class="form-control" id="comp-desc" maxlength="350" name="companyInfo[description]" rows="6" placeholder="The following description will be displayed publicly..."></textarea>
						<span class="text-muted" id="comp-desc-count"></span>
					    </div>
				        </div>

					    <div class="row pt-4">
						<div class="col-12">
						    <span class="float-right"><button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Done</button> </span>
						</div>
					    </div>
                            
                                    </form>
		</div>
	';

	$buyerTab = '
		<div class="tab-pane fade" id="buyer" role="tabpanel" aria-labelledby="pills-buyer-tab">
		    <form action="'.BASE_URL.'" method="POST">
			<h3 class="card-title mb-0">Profile</h3>
			<hr class="mt-0 pt-0">
				<input type="hidden" name="action" value="addUser">
				<input type="hidden" name="user" value="buyer">
			<div class="form-row">
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="firstName" class="">First Name</label>
					<input type="text" class="form-control" name="fName" placeholder="eg. John..." value="" required>
				    </div>
				</div>
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="fullName" class="">Last Name</label>
					<input type="text" class="form-control" name="lName" placeholder="eg. Doe..." value="" required>
				    </div>
				</div>
				    <div class="col-12 col-md-6 col-lg-6 mb-3">
					    <div class="form-group">
						<label for="lastName" class="">Email</label>
						<input type="email" class="form-control" name="email" id="" placeholder="Will be used for login..." value="" required>
					    </div>
					</div>
				    <div class="col-12 col-md-6 col-lg-6 mb-3">
					<label for="email">Business Name <sub>(Optional)</sub></label>
					<div class="input-group">
					    <input type="text" name="companyName" class="form-control" minlength="3" maxlenght="255" placeholder="eg. John\'s It Solutions..." aria-describedby="inputGroupPrepend2">
					</div>
				    </div>
			
			</div>
			    <div class="row pt-4">
				<div class="col-12">
				    <span class="float-right"><button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Done</button></span>
				</div>
			    </div>
		    </form>
		</div>
	';
	
	if ($_SESSION['USERDATA']['user_type'] == 'su'){

		//super user has additional features
		$tabLinks .= '
		  <li class="nav-item">
		    <a class="nav-link" id="pills-admin-tab" data-toggle="pill" href="#admin" role="tab" aria-controls="pills-admin" aria-selected="false">Admin</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-su-tab" data-toggle="pill" href="#su" role="tab" aria-controls="pills-su" aria-selected="false">Super User</a>
		  </li>

		';
		$adminTab = '
		  <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="pills-admin-tab">
		    <form action="'.BASE_URL.'" method="POST">
			<h3 class="card-title mb-0">Profile</h3>
			<hr class="mt-0 pt-0">
				<input type="hidden" name="action" value="addUser">
				<input type="hidden" name="user" value="admin">
			<div class="form-row">
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="firstName" class="">First Name</label>
					<input type="text" class="form-control" name="fName" placeholder="eg. John..." value="" required>
				    </div>
				</div>
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="fullName" class="">Last Name</label>
					<input type="text" class="form-control" name="lName" placeholder="eg. Doe..." value="" required>
				    </div>
				</div>
			        <div class="col-12 mb-3">
				    <div class="form-group">
					<label for="lastName" class="">Email</label>
					<input type="email" class="form-control" name="email" id="" placeholder="Will be used for login..." value="" required>
				    </div>
				</div>
			
			</div>
			    <div class="row pt-4">
				<div class="col-12">
				    <span class="float-right"><button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Done</button></span>
				</div>
			    </div>
		    </form>

		  </div>
		';

		$suTab = '
		  <div class="tab-pane fade" id="su" role="tabpanel" aria-labelledby="pills-su-tab">
		    <form action="'.BASE_URL.'" method="POST">
			<h3 class="card-title mb-0">Profile</h3>
			<hr class="mt-0 pt-0">
				<input type="hidden" name="action" value="addUser">
				<input type="hidden" name="user" value="su">
			<div class="form-row">
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="firstName" class="">First Name</label>
					<input type="text" class="form-control" name="fName" placeholder="eg. John..." value="" required>
				    </div>
				</div>
				<div class="col-12 col-md-6 col-lg-6 mb-3">
				    <div class="form-group">
					<label for="fullName" class="">Last Name</label>
					<input type="text" class="form-control" name="lName" placeholder="eg. Doe..." value="" required>
				    </div>
				</div>
			        <div class="col-12 mb-3">
				    <div class="form-group">
					<label for="lastName" class="">Email</label>
					<input type="email" class="form-control" name="email" id="" placeholder="Will be used for login..." value="" required>
				    </div>
				</div>
			
			</div>
			    <div class="row pt-4">
				<div class="col-12">
				    <span class="float-right"><button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Done</button></span>
				</div>
			    </div>
		    </form>

		  </div>
		';

	}



        $html = $this->banner('Add User',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add User</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add User</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
								    <div class="col-12">
									<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								    		'.$tabLinks.'
									</ul>
									<div class="tab-content" id="pills-tabContent">
										'.$companyTab.$buyerTab.$adminTab.$suTab.'

									</div>
								    </div>
							    </div>
                                                    </div>
                                            
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function addSubServiceCategory($data = []){
        
        $options = '';
	foreach ($data['serviceCategories'] as $category){
		
		$options .= '
			<option value="'.encrypt($category['id']).'">'.$category['name'].'</option>
		';

	}

        $html = $this->banner('Add Sub Service Category',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'sub-service-category-list">Sub Service Categories</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add Sub Service Category</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Sub Service Category</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="addSubServiceCategory">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Add Category
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" maxlenght="200" id="" placeholder="eg. Software" value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Icon<sub>
									(<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2">
									Font Awesome
									</a>)</sub></label>
                                                                        <input type="text" maxlength="50" class="form-control" name="icon" placeholder="eg. fas fa-laptop" value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="">Service Category</label>
                                                                        <select name="scId" class="form-control" required>
                                                                            '.$options.'
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Description<sub>(Optional)</sub></label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the Sub Service Category..." rows="6"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function addServiceCategory($data = []){
        
        $sectorOptions = '';

        $html = $this->banner('Add Service Category',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'service-category-list">Service Categories</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add Service Category</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Service Category</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="addServiceCategory">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Add Category
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" maxlenght="200" id="" placeholder="eg. Information Technology Outsourcing" value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Acronym</label>
                                                                        <input type="text" class="form-control" name="acronym" maxlenght="15" id="" placeholder="eg. ITO..." value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Icon<sub>
									(<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2">
									Font Awesome
									</a>)</sub></label>
                                                                        <input type="text" maxlength="50" class="form-control" name="icon" placeholder="eg. fas fa-laptop" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Description<sub>(Optional)</sub></label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the Service Category..." rows="6"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function addMusic($data = null){
        
	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$inputFields = '';
	$breadCrumbs = '';

	if ($userType == 'admin' || $userType == 'su'){
		// all elements available to a admin can be created here
		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'music-list">Music</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Music</li>
		';

		$options = '';
		if (empty($data['companys'])){

		    $options .= '
			<option value="'.encrypt(0).'" selected>No music company profiles found</option>
		    ';

		}else{

			foreach ($data['companys'] as $company){
			    $options .= '
				<option value="'.encrypt($company['company_id']).'">'.$company['company_name'].'</option>
			    ';
			}

		}

		$inputFields = '
			<div class="col-12 col-md-12 col-lg-6">
			    <div class="form-group">
				<label for="">Company</label>
				<select name="cId" class="form-control" placeholder="Select a company" required>
				    '.$options.'
				</select>
			    </div>
			</div>';



	}else{
		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'my-music">Music</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Music</li>
		';

		$inputFields = '
			<input type="hidden" name="cId" value="'.encrypt($_SESSION['COMPANYDATA'][0]['company_id'] ?? 0).'">
		';

	}

        $html = $this->banner('Add Music', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Music</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="addMusic">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-12 col-md-12 text-center">
									<audio id="audio-preview" controls preload="metadata">
									    <source src="" id="audio-preview-src" />
										<div class="alert alert-warning" role="alert">
											Your browser does not support audio elements, please use chrome or firefox to be able to listen to the audio
										</div>
									</audio>
								        <input class="form-control-file audio-upload d-inline pb-0 mb-0" name="audio" type="file" accept=".mp3" style="opacity:0;" required/>

									<div class="audio pt-0 mb-0">
									    <a class="btn btn-link" href="javascript:void(0)" id="browse-audio">
									    <i class="fa fa-folder-open"></i> Browse
									    </a>
									    <a href="javascript:void(0)" id="remove-audio" class="btn btn-link text-danger" style="'.((isset($data['sectorInfo'][0]['sector_img']))? '': 'display: none' ) .'" >
									    <i class="fa fa-trash"></i> Remove
									    </a>
									</div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">

                                                                <div class="col-12 col-md-12 '.($userType == 'company'? '': 'col-lg-6').'">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" id="" placeholder="eg. Name of the music..." value="" required>
                                                                    </div>
                                                                </div>
									'.$inputFields.'
								    <div class="col-12 mb-3">
									<label for="email">Tell us something about the music...<sub>(Optional)</sub></label>
									<textarea class="form-control" id="comp-desc" maxlength="350" name="description" rows="6" placeholder="The following description will be displayed publicly..."></textarea>
									<span class="text-muted" id="comp-desc-count"></span>
								    </div>

                                                            </div>

                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function addFaq($data = []){
        
        $html = $this->banner('Add Faq',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'faq-list">Faq List</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add Faq</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Faq</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="addFaq">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 col-lg-8">
                                                                    <div class="form-group">
                                                                        <label for="question" class="">Question</label>
                                                                        <input type="text" class="form-control" name="question" placeholder="Please enter a question..." value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="">Display to</label>
                                                                        <select name="displayTo" class="form-control" requried>
										<optgroup label="General Users" class="mb-5">
											<option value="all" selected>Everyone</option>
											<option value="company">Company</option>
											<option value="buyer">Buyer</option>
											<option value="guest">Guest</option>
										</optgroup>
										<optgroup label="Company Types" class="mb-5">
											<option value="product">Product</option>
											<option value="service">Service</option>
											<option value="music">Music </option>
										</optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Answer</label>
                                                                        <textarea class="form-control" name="answer" placeholder="Enter the answer to the question stated above..." rows="6"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function addHsCode($data = null){
        
        $sectorOptions = '';

        foreach ($data['sectors'] as $sector){
            $sectorOptions .= '
                <option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
            ';
        }

        $html = $this->banner('Add HS Code',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'hs-code-list">HS Codes</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add HS Code</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add HS Code</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="addHsCode">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							HS Code Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">HS Name</label>
                                                                        <input type="text" class="form-control" name="hsName" id="" placeholder="eg. Rice" value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">HS Code</label>
                                                                        <input type="number" class="form-control" name="hsCode" id="" placeholder="eg. 100630" value="" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Sector</label>
                                                                        <select name="sId" class="form-control">
                                                                            '.$sectorOptions.'
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function editMusic($data = null){
        
	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$breadCrumbs = '';
	$inputFields = '';

	if ($userType == 'admin' || $userType == 'su'){
		// all elements available to a admin can be created here

		$options = '';
		if (empty($data['companys'])){
		    $options .= '
			<option value="'.encrypt(0).'" selected>No music company profiles found</option>
		    ';

		}else{

			foreach ($data['companys'] as $company){
			    $selected = ($data['musicInfo'][0]['company_id'] == $company['company_id'])? 'selected': '' ;
			    $options .= '
				<option value="'.encrypt($company['company_id']).'" '.$selected.'>'.$company['company_name'].'</option>
			    ';
			}

		}

		$inputFields = '
			<div class="col-12 col-md-12 col-lg-6">
			    <div class="form-group">
				<label for="">Company</label>
				<select name="cId" class="form-control" placeholder="Select a company" required>
				    '.$options.'
				</select>
			    </div>
			</div>';

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'music-list">Music</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Edit Music</li>
		';


	}else{

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'my-music">my-music</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Edit Music</li>
		';
		$inputFields = '
			<input type="hidden" name="cId" value="'.encrypt($_SESSION['COMPANYDATA'][0]['company_id'] ?? 0).'">
		';

	}

        $html = $this->banner('Edit Music', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit Music</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="updateMusic">
                                                <input type="hidden" name="mId" value="'.encrypt($data['musicInfo'][0]['id'] ?? 0).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-12 col-md-12 text-center">
									<audio id="audio-preview" controls preload="metadata">
									    <source src="'.BASE_URL.$data['musicInfo'][0]['audio_path'].'" id="audio-preview-src" />
										<div class="alert alert-warning" role="alert">
											Your browser does not support audio elements, please use chrome or firefox to be able to listen to the audio
										</div>
									</audio>
								        <input class="form-control-file audio-upload d-inline pb-0 mb-0" name="audio" type="file" accept=".mp3" style="opacity:0;"/>

									<div class="audio pt-0 mb-0">
									    <a class="btn btn-link" href="javascript:void(0)" id="browse-audio">
									    <i class="fa fa-folder-open"></i> Browse
									    </a>
									    <a href="javascript:void(0)" id="remove-audio" class="btn btn-link text-danger" style="'.((isset($data['sectorInfo'][0]['sector_img']))? '': 'display: none' ) .'" >
									    <i class="fa fa-trash"></i> Remove
									    </a>
									</div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">

                                                                <div class="col-12 col-md-12 '.($userType == 'company'? '': 'col-lg-6').'">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" value="'.$data['musicInfo'][0]['name'].'" required>
                                                                    </div>
                                                                </div>
									'.$inputFields.'
								    <div class="col-12 mb-3">
									<label for="email">Tell us something about the music...<sub>(Optional)</sub></label>
									<textarea class="form-control" id="comp-desc" maxlength="350" name="description" rows="6" placeholder="The following description will be displayed publicly..." >'.$data['musicInfo'][0]['description'].'</textarea>
									<span class="text-muted" id="comp-desc-count"></span>
								    </div>

                                                            </div>

                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //display edit  sector view
    public function editSector($data = null){

        $html = $this->banner('Edit Sector',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'sector-list">Sectors</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Edit Sector</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit Sector</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="updateSector">
                                                <input type="hidden" name="sId" value="'.encrypt($data['sectorInfo'][0]['id']).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Sector Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 my-auto text-center">

									<img id="display-img" src="'.BASE_URL.($data['sectorInfo'][0]['sector_img'] ?? 'images/question.png') .'" class="avatar img-fluid img-thumbnail shadow-lg" style="height:225px;width:auto;">
									<div class="p-image mt-3">
									    <a class="btn btn-link" href="javascript:void(0)" id="upload-img">
									    <i class="fa fa-folder-open"></i> Browse
									    </a>
									    <a href="javascript:void(0)" id="remove-img" class="btn btn-link text-danger" style="'.((isset($data['sectorInfo'][0]['sector_img']))? '': 'display: none' ) .'" >
									    <i class="fa fa-trash"></i> Remove
									    </a>
									    <input class="file-upload" name="files" type="file" accept=".jpg, .jpeg, .png" style="display: none;"/>
									</div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" id="" placeholder="eg. Agriculture" value="'.($data['sectorInfo'][0]['name']).'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="descriptioin" class="">Description</label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the sector..." rows="6" required>'.($data['sectorInfo'][0]['description'] ?? '').'</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
								    <span class="form-check d-inline">
								        <input id="featured-sector-checkbox" class="form-check-input" type="checkbox" name="isFeatured" value="1" '.( ($data['sectorInfo'][0]['is_featured'] == 1)? 'checked' : '' ).'>
								        <label for="checkbox">Feature Sector</label>
								    </span>

                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->
        ';

        return $html;

    }
    public function editSubServiceCategory($data = []){
        
        $options = '';
	foreach ($data['serviceCategories'] as $category){
		
		$selected = ($data['subServiceCatInfo'][0]['service_category_id'] == $category['id'] )? 'selected' : '';
		$options .= '
			<option value="'.encrypt($category['id']).'" '.$selected.'>'.$category['name'].'</option>
		';

	}

        $html = $this->banner('Edit Sub Service Category',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'service-category-list">Sub Service Categories</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">edit Sub Service Cat.</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit Sub Service Cat.</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="updateSubServiceCategory">
                                                <input type="hidden" name="sscId" value="'.encrypt($data['subServiceCatInfo'][0]['id']).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Sub Service Cat. Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName">Name</label>
                                                                        <input type="text" class="form-control" name="name" maxlenght="200" id="" placeholder="eg. Information Technology Outsourcing" value="'.$data['subServiceCatInfo'][0]['sub_service_category_name'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Icon<sub>
									(<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2">
									Font Awesome
									</a>)</sub></label>
                                                                        <input type="text" maxlength="50" class="form-control" name="icon" placeholder="eg. fas fa-laptop" value="'.$data['subServiceCatInfo'][0]['sub_service_category_icon'].'">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="">Service Category</label>
                                                                        <select name="scId" class="form-control" required>
                                                                            '.$options.'
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Description<sub>(Optional)</sub></label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the Service Category..." rows="6">'.$data['subServiceCatInfo'][0]['description'].'</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function editServiceCategory($data = []){
        

        $html = $this->banner('Edit Service Category',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'service-category-list">Service Categories</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">edit Service Cat.</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit Service Cat.</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="updateServiceCategory">
                                                <input type="hidden" name="scId" value="'.encrypt($data['serviceCatInfo'][0]['id']).'">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Service Cat. Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName">Name</label>
                                                                        <input type="text" class="form-control" name="name" maxlenght="200" id="" placeholder="eg. Information Technology Outsourcing" value="'.$data['serviceCatInfo'][0]['name'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Acronym</label>
                                                                        <input type="text" class="form-control" name="acronym" maxlenght="15" id="" placeholder="eg. ITO..." value="'.$data['serviceCatInfo'][0]['acronym'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Icon<sub>
									(<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2">
									Font Awesome
									</a>)</sub></label>
                                                                        <input type="text" maxlength="50" class="form-control" name="icon" placeholder="eg. fas fa-laptop" value="'.$data['serviceCatInfo'][0]['icon'].'">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Description<sub>(Optional)</sub></label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the Service Category..." rows="6">'.$data['serviceCatInfo'][0]['description'].'</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //display edit service view
    public function editService($data = []){

	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$inputFields = '';
	$breadCrumbs = '';
	//loading all admin views
	if ($userType == 'admin' || $userType == 'su'){
		// all elements available to a admin can be created here

		$options = '';
		if (!empty($data['companys'])){

			foreach ($data['companys'] as $company){
			    $selected = ($data['serviceInfo'][0]['company_id'] == $company['company_id'])? 'selected': '' ;
			    $options .= '
				<option value="'.encrypt($company['company_id']).'" '.$selected.'>'.$company['company_name'].'</option>
			    ';
			}

		}

		$inputFields = '
			<div class="col-12 col-md-6 col-lg-6">
			    <div class="form-group">
				<label for="">Company</label>
				<select name="cId" class="form-control" placeholder="Select a company" required>
				    '.$options.'
				</select>
			    </div>
			</div>';
		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'service-list">Services</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Edit Service</li>
		';


	}else{

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'my-services">Services</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Edit Service</li>
		';
		$inputFields = '
			<input type="hidden" name="cId" value="'.encrypt($_SESSION['COMPANYDATA'][0]['company_id'] ?? 0).'">
		';

	}

        $sectorOptions = '';
        foreach ($data['sectors'] as $sector){
		
	    //curently only offering outsourcing services
	    if ($sector['id'] == 13){
		    $sectorOptions = '
			<option value="'.encrypt($sector['id']).'" selected>'.$sector['name'].'</option>
		    ';
	    }
        }

        $sCatOptions = '';
	if (empty($data['subServiceCategories'])){

            $sCatOptions = '
                <option value="'.encrypt(0).'" disabled>No categories found</option>
            ';

	}else{

		foreach ($data['subServiceCategories'] as $type){
		    $selected = ($data['serviceInfo'][0]['sub_service_category_id'] == $type['id'])? 'selected': '' ;
		    $sCatOptions .= '
			<option value="'.encrypt($type['id']).'" '.$selected.'>'.$type['sub_service_category_name'].'</option>
		    ';
		}

	}


        $html = $this->banner('Edit Service', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">edit Service</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Service Info
                                                    </span>
                                                </div>
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="updateService">
                                                <input type="hidden" name="serId" value="'.encrypt($data['serviceInfo'][0]['id']).'">
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="Enter Service name..." value="'.$data['serviceInfo'][0]['service_name'].'" required>
                                                                    </div>
                                                                </div>
								'.$inputFields.'
							    <div class="col-12 col-md-6 col-lg-6 mb-3">
								<label for="business-type">Category</label>
								<select class="form-control service-field" name="sscId" required>
									'.$sCatOptions.'
								</select>
							    </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Sector</label>
                                                                        <select name="sId" class="form-control" required>
                                                                            '.$sectorOptions.'
                                                                        </select>
                                                                    </div>
                                                                </div>
							    <div class="col-12 mb-3">
								<label for="email">Tell us something about the service...</label>
								<textarea class="form-control" id="comp-desc" maxlength="350" name="description" rows="6" placeholder="The following description will be displayed publicly..." required>'.$data['serviceInfo'][0]['description'].'</textarea>
								<span class="text-muted" id="comp-desc-count"></span>
							    </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ card end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //display add service view
    public function addService($data = []){

	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$inputFields = '';
	$breadCrumbs = '';
	//loading all admin views
	if ($userType == 'admin' || $userType == 'su'){
		// all elements available to a admin can be created here

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'service-list">Services</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Service</li>
		';

		$options = '';
		if (!empty($data['companys'])){

			foreach ($data['companys'] as $company){
			    $options .= '
				<option value="'.encrypt($company['company_id']).'">'.$company['company_name'].'</option>
			    ';
			}

		}

		$inputFields = '
			<div class="col-12 col-md-6 col-lg-6">
			    <div class="form-group">
				<label for="">Company</label>
				<select name="cId" class="form-control" placeholder="Select a company" required>
				    '.$options.'
				</select>
			    </div>
			</div>';



	}else{

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'my-services">Services</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Service</li>
		';
		$inputFields = '
			<input type="hidden" name="cId" value="'.encrypt($_SESSION['COMPANYDATA'][0]['company_id'] ?? 0).'">
		';

	}

        $sectorOptions = '';
        foreach ($data['sectors'] as $sector){
		
	    //curently only offering outsourcing services
	    if ($sector['id'] == 13){
		    $sectorOptions = '
			<option value="'.encrypt($sector['id']).'" selected>'.$sector['name'].'</option>
		    ';
	    }
        }

        $sCatOptions = '';
	if (empty($data['serviceCategories'])){

            $sCatOptions = '
                <option value="'.encrypt(0).'" disabled>No business types found</option>
            ';

	}else{

		foreach ($data['serviceCategories'] as $type){
		    $sCatOptions .= '
			<option value="'.encrypt($type['id']).'">'.$type['sub_service_category_name'].'</option>
		    ';
		}

	}


        $html = $this->banner('Add Service', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Service</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Service Info
                                                    </span>
                                                </div>
                                            <form action="'.BASE_URL.'" method="POST">
                                                <input type="hidden" name="action" value="addService">
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="Enter Service name..." value="" required>
                                                                    </div>
                                                                </div>
								'.$inputFields.'
							    <div class="col-12 col-md-6 col-lg-6 mb-3">
								<label for="business-type">Category</label>
								<select class="form-control service-field" name="sscId" required>
									'.$sCatOptions.'
								</select>
							    </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Sector</label>
                                                                        <select name="sId" class="form-control" required>
                                                                            '.$sectorOptions.'
                                                                        </select>
                                                                    </div>
                                                                </div>
							    <div class="col-12 mb-3">
								<label for="email">Tell us something about the service...</label>
								<textarea class="form-control" id="comp-desc" maxlength="350" name="description" rows="6" placeholder="The following description will be displayed publicly..." required></textarea>
								<span class="text-muted" id="comp-desc-count"></span>
							    </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ card end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //display add sector view
    public function addSector($data = null){

        $html = $this->banner('Add Sector',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'sector-list">Sectors</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Add Sector</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-plus"></i></span>
                                    <h2 class="title classic">Add Sector</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                            <form action="'.BASE_URL.'" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="addSector">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <span class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-3 text-dark">
							Sector Info
                                                    </span>
                                                </div>
                                                    <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 text-center">

									<img id="display-img" src="'.BASE_URL.'images/question.png" class="avatar img-fluid img-thumbnail shadow-lg" style="height:225px;width:auto;">
								        <input class="form-control-file file-upload d-inline pb-0 mb-0" name="files" type="file" accept=".jpg, .jpeg, .png" style="opacity:0;" required/>
									<div class="p-image">
									    <a class="btn btn-link" href="javascript:void(0)" id="upload-img">
									    <i class="fa fa-folder-open"></i> Browse
									    </a>
									    <a href="javascript:void(0)" id="remove-img" class="btn btn-link text-danger" style="'.((isset($data['sectorInfo'][0]['sector_img']))? '': 'display: none' ) .'" >
									    <i class="fa fa-trash"></i> Remove
									    </a>
									</div>
                                                                </div>
                                                            </div>
 							    <br>
                                                            <div class="row">
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name" class="">Name</label>
                                                                        <input type="text" class="form-control" name="name" id="" placeholder="eg. Agriculture" value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description" class="">Description</label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter something about the sector..." rows="6"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
								    	
								    <span class="form-check d-inline">
								        <input id="featured-sector-checkbox" class="form-check-input" type="checkbox" name="isFeatured" value="1">
								        <label for="checkbox">Feature Sector</label>
								    </span>

                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                            </form>
                                        </div>
                                        <!--/ card end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function exportMarketList($data = null){

        $rowData = '';
        $count = 1;
	$addBtn = '';

	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#add-market-modal"><i class="fa fa-plus"></i> Add Export Market</a>
	    </span>
	';


        foreach ($data['exportMarkets'] as $market){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$market['name'].'</td>
                    <td>'.$market['company_count'].'</td>
                    <td>'.$market['product_count'].'</td>
                    <td>'.($market['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($market['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">
				    <a class="dropdown-item text-danger delete-market" href="javascript:void(0)" data-emname="'.$market['name'].'" data-link="'.BASE_URL.'delete/export-market/'.encrypt($market['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('Export Markets', '
		    <li class="breadcrumb-item text-white" aria-current="page">Export Markets</li> 
		    ').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-truck"></i></span>
                                    <h2 class="title classic">Export Markets</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Export Markets
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Companies</th>
                                                    <th>Product</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Companies</th>
                                                    <th>Products</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    // displays all sectors
    public function sectorList($data = null){

        $rowData = '';
        $count = 1;
	$addBtn = '';

	$pageTitle = $data['pageTitle'] ?? 'Sectors';
	$breadCrumbTitle = $data['breadCrumbTitle'] ?? 'Sector List';
	$breadCrumbs = $data['breadCrumbs'] ?? '<li class="breadcrumb-item text-white" aria-current="page">Sectors</li>';
		
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-sector"><i class="fa fa-plus"></i> Add Sector</a>
	    </span>
	';


        foreach ($data['sectors'] as $sector){
            
	    if ($sector['is_featured'] == 1){

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="1" data-sid="'.encrypt($sector['id']).'"><i class="fas fa-check text-success fa-lg"></i></a>
		';

	    }else{

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="0" data-sid="'.encrypt($sector['id']).'"><i class="fas fa-check text-secondary fa-lg"></i></a>
		';

	    }		

		//DELETE only for super user
		$moreActions = '';
		if ($_SESSION['USERDATA']['user_type'] == 'su'){
			// only su should delete sector since 1 sector is hard coded
			$moreActions = '
					    <a class="dropdown-item text-danger delete-sector" href="javascript:void(0)" data-sname="'.$sector['name'].'" data-link="'.BASE_URL.'delete/sector/'.encrypt($sector['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
			';
		}
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$sector['name'].'</td>
                    <td>'.$featuredStatus.'</td>
                    <td>'.($sector['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($sector['update_on'] ?? 'N/a').'</td>
                    <td>'.($sector['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($sector['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/sector/'.encrypt($sector['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    '.$moreActions.'
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner($breadCrumbTitle, $breadCrumbs).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-pie-chart"></i></span>
                                    <h2 class="title classic">'.$pageTitle.'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Sectors
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th class="no-sort">Featured</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sector-data">
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Featured</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function musicList($data = []){

        $rowData = '';
        $count = 1;
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-music"><i class="fa fa-plus"></i> Add Music</a>
	    </span>
	';


	$bannerTitle = $data['bannerTitle'] ?? 'Music List';
	$breadCrumbs = $data['breadCrumb'] ?? '<li class="breadcrumb-item text-white" aria-current="page">Music</li>';
	$pageTitle = $data['pageTitle'] ?? 'music';
	
        foreach ($data['musics'] as $info){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$info['name'].'</td>
                    <td><audio controls style="height:30px;width:250px;"><source src="'.BASE_URL.$info['audio_path'].'"/></audio></td>
                    <td>'.($info['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/music/'.encrypt($info['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-music" href="javascript:void(0)" data-name="'.$info['name'].'" data-link="'.BASE_URL.'delete/music/'.encrypt($info['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner($bannerTitle, $breadCrumbs).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fas fa-music"></i></span>
                                    <h2 class="title classic">'.$pageTitle.'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Music
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th class="no-sort">Audio</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Audio</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function subServiceCategoryList($data = []){

        $rowData = '';
        $count = 1;
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-sub-service-category"><i class="fa fa-plus"></i> Add Sub Category</a>
	    </span>
	';


        foreach ($data['serviceCategories'] as $info){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$info['sub_service_category_name'].'</td>
                    <td><span data-toggle="tooltip" data-placement="top" title="'.$info['service_category_name'].'">'.$info['service_category_acronym'].'</span></td>
                    <td><i class="'.($info['sub_service_category_icon'] ?? 'fa fa-minus').' fa-lg text-primary"></i></td>
                    <td>'.($info['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['update_on'] ?? 'N/a').'</td>
                    <td>'.($info['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/sub-service-category/'.encrypt($info['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-sub-service-cat" href="javascript:void(0)" data-name="'.$info['sub_service_category_name'].'" data-link="'.BASE_URL.'delete/sub-service-category/'.encrypt($info['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('Sub Service Category List', '
		    <li class="breadcrumb-item text-white" aria-current="page">Sub Service Category</li> 
		    ').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fas fa-hand-holding-box"></i></span>
                                    <h2 class="title classic">Sub Service Category</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Sub Service Categories
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip" width="100%" class="display" id="dataTable" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Main Cat.</th>
                                                    <th>Icon</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Acronym</th>
                                                    <th>Icon</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function serviceCategoryList($data = []){

        $rowData = '';
        $count = 1;
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-service-category"><i class="fa fa-plus"></i> Add Category</a>
	    </span>
	';


        foreach ($data['serviceCategories'] as $info){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$info['name'].'</td>
                    <td>'.$info['acronym'].'</td>
                    <td><i class="'.($info['icon'] ?? 'fa fa-minus').' fa-lg text-primary"></i></td>
                    <td>'.$info['sub_cat_count'].'</td>
                    <td>'.($info['company_distinct_count'] ?? 'N/a').'</td>
                    <td>'.($info['service_count'] ?? 0).'</td>
                    <td>'.($info['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_by_name'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/service-category/'.encrypt($info['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-service-cat" href="javascript:void(0)" data-name="'.$info['name'].'" data-link="'.BASE_URL.'delete/service-category/'.encrypt($info['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('Service Category List', '
		    <li class="breadcrumb-item text-white" aria-current="page">Service Category</li> 
		    ').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fas fa-hand-holding-box"></i></span>
                                    <h2 class="title classic">Service Category</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Service Categories
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip" width="100%" class="display" id="dataTable" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Acronym</th>
                                                    <th>Icon</th>
                                                    <th>Sub Cat.</th>
                                                    <th>Company</th>
                                                    <th>Service</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Acronym</th>
                                                    <th>Icon</th>
                                                    <th>Sub Cat.</th>
                                                    <th>Company</th>
                                                    <th>Service</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function faqList($data = []){

        $rowData = '';
        $count = 1;
	
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-faq"><i class="fa fa-plus"></i> Add Faq</a>
	    </span>
	';

        foreach ($data['faqs'] as $faq){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.($faq['question'] ?? 'N/a').'</td>
                    <td>'.(($faq['display_to'] == 'all')? 'Everyone' : ucfirst($faq['display_to'])).'</td>
                    <td>'.($faq['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($faq['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($faq['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/faq/'.encrypt($faq['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-faq" href="javascript:void(0)" data-name="'.$faq['question'].'" data-link="'.BASE_URL.'delete/faq/'.encrypt($faq['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('Faqs', '
		    <li class="breadcrumb-item text-white" aria-current="page">Faqs</li> 
		    ').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fad fa-comments"></i></span>
                                    <h2 class="title classic">Faqs</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	list
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question</th>
                                                    <th>Seen By</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question</th>
                                                    <th>Seen By</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function hsCodeList($data = null){

        $rowData = '';
        $count = 1;
	
	$addBtn = '';

	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-hs-code"><i class="fa fa-plus"></i> Add HS Code</a>
	    </span>
	';


        foreach ($data['codes'] as $code){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$code['hs_code_name'].'</td>
                    <td>'.$code['hs_code'].'</td>
                    <td>'.$code['sector_name'].'</td>
                    <td>'.($code['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($code['update_on'] ?? 'N/a').'</td>
                    <td>'.($code['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($code['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/hs-code/'.encrypt($code['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-hs-code" href="javascript:void(0)" data-hsname="'.$code['hs_code_name'].'" data-link="'.BASE_URL.'delete/hs-code/'.encrypt($code['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('Hs Codes', '
		    <li class="breadcrumb-item text-white" aria-current="page">HS Codes</li> 
		    ').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-tag"></i></span>
                                    <h2 class="title classic">HS Codes</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	HS CODE LIST
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>HS Code</th>
                                                    <th>Sector</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>HS Code</th>
                                                    <th>Sector</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function myServices($data = []){

        $rowData = '';
        $count = 1;

        foreach ($data['services'] as $service){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$service['service_name'].'</td>
                    <td>'.$service['service_category_acronym'].'</td>
                    <td>'.$service['sub_service_category_name'].'</td>
                    <td>'.$service['created_by_name'].'</td>
                    <td>'.$service['created_on'].'</td>
                    <td>

				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/service/'.encrypt($service['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-service" href="javascript:void(0)" data-sname="'.$service['service_name'].'" data-link="'.BASE_URL.'delete/service/'.encrypt($service['id']).'/'.encrypt($service['company_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>

				  </div>
				</div>

                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('My Services', '<li class="breadcrumb-item text-white" aria-current="page">Services</li>').'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fas fa-hand-holding-box"></i></span>
                                    <h2 class="title classic">My Services</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    Service List
                                    </h4>
				    <span class="float-right">
					<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-service"><i class="fa fa-plus"></i> Add Service</a>
				    </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="service-list">
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function myMusic($data = []){

        $rowData = '';
        $count = 1;
	$addBtn = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-music"><i class="fa fa-plus"></i> Add Music</a>
	    </span>
	';


	$bannerTitle = $data['bannerTitle'] ?? 'My Music';
	$breadCrumb = $data['breadCrumb'] ?? '<li class="breadcrumb-item text-white" aria-current="page">Music</li>';
	$pageTitle = $data['pageTitle'] ?? 'music';
	
        foreach ($data['musics'] as $info){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$info['name'].'</td>
                    <td><audio controls style="height:30px;width:250px;"><source src="'.BASE_URL.$info['audio_path'].'"/></audio></td>
                    <td>'.($info['update_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_by_name'] ?? 'N/a').'</td>
                    <td>'.($info['created_on'] ?? 'N/a').'</td>
                    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/music/'.encrypt($info['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-music" href="javascript:void(0)" data-name="'.$info['name'].'" data-link="'.BASE_URL.'delete/music/'.encrypt($info['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner($bannerTitle, $breadCrumb).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fas fa-music"></i></span>
                                    <h2 class="title classic">'.$pageTitle.'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    	Music List
                                    </h4>
					'.$addBtn.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th class="no-sort">Audio</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Audio</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    // View for a company to see their products
    public function myProducts($data = null){

        $rowData = '';
        $count = 1;
	
	$addProduct = '';

	$addProduct = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-product"><i class="fa fa-plus"></i> Add Product</a>
	    </span>
	';

        foreach ($data['products'] as $product){
            
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$product['hs_code'].'</td>
                    <td>'.$product['product_name'].'</td>
                    <td>'.$product['company_name'].'</td>
                    <td>'.$product['sector_name'].'</td>
                    <td>

				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/my-product/'.encrypt($product['product_id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-product" href="javascript:void(0)" data-pname="'.$product['product_name'].'" data-link="'.BASE_URL.'delete/product/'.encrypt($product['product_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>

				  </div>
				</div>

                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner('My Products', 
			'<li class="breadcrumb-item text-white" aria-current="page">My Products</li>'
			).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
                                    <h2 class="title classic">My Products</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    PRODUCTS
                                    </h4>
					'.$addProduct.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>HS Code</th>
                                                    <th>Product</th>
                                                    <th>Company</th>
                                                    <th>Sector</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>HS Code</th>
                                                    <th>Product</th>
                                                    <th>Company</th>
                                                    <th>Sector</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function serviceList($data = []){

        $rowData = '';
        $count = 1;
        $pageTitle = $data['pageTitle'] ?? 'Service List';
        $bannerTitle = $data['bannerTitle'] ?? 'Service List';
        $breadCrumbs = $data['breadCrumb'] ?? '<li class="breadcrumb-item text-white" aria-current="page">Services</li>';

        foreach ($data['services'] as $service){
            
	    if ($service['is_featured'] == 1){

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="1" data-serid="'.encrypt($service['id']).'"><i class="fas fa-check text-success fa-lg"></i></a>
		';

	    }else{

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="0" data-serid="'.encrypt($service['id']).'"><i class="fas fa-check text-secondary fa-lg"></i></a>
		';

	    }		
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$service['service_name'].'</td>
                    <td>'.$service['company_name'].'</td>
                    <td>'.$service['service_category_acronym'].'</td>
                    <td>'.$featuredStatus.'</td>
                    <td>'.$service['created_on'].'</td>
                    <td>

				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'view/service/'.encrypt($service['id']).'"><i class="fa fa-eye d-inline"></i> View</a>

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/service/'.encrypt($service['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-service" href="javascript:void(0)" data-sname="'.$service['service_name'].'" data-link="'.BASE_URL.'delete/service/'.encrypt($service['id']).'/'.encrypt($service['company_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>

				  </div>
				</div>

                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner($bannerTitle, $breadCrumbs).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="far fa-hand-holding-box"></i></span>
                                    <h2 class="title classic">'.$pageTitle.'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    Services
                                    </h4>
				    <span class="float-right">
					<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-service"><i class="fa fa-plus"></i> Add Service</a>
				    </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Company</th>
                                                    <th>Category</th>
                                                    <th class="no-sort">Featured</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="service-list">
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Company</th>
                                                    <th>Category</th>
                                                    <th>Featured</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function productList($data = []){

        $rowData = '';
        $count = 1;
        $pageTitle = $data['pageTitle'] ?? 'Product List';
        $bannerTitle = $data['bannerTitle'] ?? 'Product List';
        $breadCrumbs = $data['breadCrumb'] ?? '<li class="breadcrumb-item text-white" aria-current="page">Products</li>';
	$addProduct = '';

	

	$addProduct = '
	    <span class="float-right">
		<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-product"><i class="fa fa-plus"></i> Add Product</a>
	    </span>
	';


        foreach ($data['products'] as $product){
		
	    $featuredStatus = '';

            //getting features status
	    if ($product['is_featured'] == 1){

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="1" data-pid="'.encrypt($product['product_id']).'"><i class="fas fa-check text-success fa-lg"></i></a>
		';

	    }else{

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="0" data-pid="'.encrypt($product['product_id']).'"><i class="fas fa-check text-secondary fa-lg"></i></a>
		';

	    }		
            $rowData .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$product['hs_code'].'</td>
                    <td>'.$product['product_name'].'</td>
                    <td>'.$product['company_name'].'</td>
                    <td>'.$product['sector_name'].'</td>
                    <td>'.$featuredStatus.'</td>
                    <td>

				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'view/product/'.encrypt($product['product_id']).'"><i class="fa fa-eye d-inline"></i> View</a>

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/product/'.encrypt($product['product_id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-product" href="javascript:void(0)" data-pname="'.$product['product_name'].'" data-link="'.BASE_URL.'delete/product/'.encrypt($product['product_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>

				  </div>
				</div>

                    </td>
                </tr>
            ';
            $count++;
        }

        $html = $this->banner($bannerTitle, $breadCrumbs).'
                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
                                    <h2 class="title classic">'.$pageTitle.'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    PRODUCTS
                                    </h4>
					'.$addProduct.'
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>HS Code</th>
                                                    <th>Product</th>
                                                    <th>Company</th>
                                                    <th>Sector</th>
                                                    <th class="no-sort">Featured</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product-data">
                                                '.($rowData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>HS Code</th>
                                                    <th>Product Name</th>
                                                    <th>Company Name</th>
                                                    <th>Sector</th>
                                                    <th>Featured</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function accountRequestList($data = []){

        $trData = '';
        $rowData = '';
        $count = 1;

	if (!empty($data['companies'])){
		foreach ($data['companies'] as $company){
		    
		    $trData .= '
			<tr>
			    <td>'.$count.'</td>
			    <td>'.($company['company_name'] ?? 'N/a').'</td>
			    <td>'.($company['company_email'] ?? 'N/a').'</td>
			    <td>'.($company['phone'] ?? 'N/a').'</td>
			    <td>'.($company['district'] ?? 'N/a').'</td>
			    <td>'.($company['ctv'] ?? 'N/a').'</td>
			    <td>'.($company['address'] ?? 'N/a').'</td>
			    <td>'.($company['registration_start_date'] ?? 'N/a').'</td>
			    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <!-- Dropdown menu links -->

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'view/company/pending-approval/'.encrypt($company['company_id']).'"><i class="fa fa-eye d-inline"></i> View</a>
				    <a class="dropdown-item text-success" href="'.BASE_URL.'account-request/approve/'.encrypt($company['company_id']).'"><i class="fa fa-check d-inline"></i> Approve</a>

				    <a class="dropdown-item text-danger reject-account" data-toggle="modal" data-target="#rejectCompanyModal" href="javascript:void(0)" data-link="'.BASE_URL.'account-request/reject/'.encrypt($company['company_id']).'"><i class="fa fa-times d-inline"></i> Reject</a>
				  </div>
				</div>
			    </td>
			</tr>
		    ';
		    $count++;
		}
	}

        $html = $this->banner('Account Requests', 
                              '<li class="breadcrumb-item text-white" aria-current="page">Account Requests</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-envelope"></i></span>
                                    <h2 class="title classic">Account Requests</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                 	requests
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-strip data-table" width="100%" class="display" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone #</th>
                                                    <th>District</th>
                                                    <th>C/T/V</th>
                                                    <th>Street</th>
                                                    <th>Reg. Date</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($trData ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone #</th>
                                                    <th>District</th>
                                                    <th>C/T/V</th>
                                                    <th>Street</th>
                                                    <th>Reg. Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    //displays users
    public function userList($data = []){

	$companyList = '';
	$buyerList = '';
        $rowData = '';
	$mibStatus = '';
	$featuredStatus = '';

        $count = 1;
        foreach ($data['companies'] as $company){

            
	    if ($company['is_featured'] == 1){

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="1" data-cid="'.encrypt($company['company_id']).'"><i class="fas fa-check text-success fa-lg"></i></a>
		';

	    }else{

		$featuredStatus = '
			<a href="javascript:void(0)" class="is-featured text-center d-block" data-status="0" data-cid="'.encrypt($company['company_id']).'"><i class="fas fa-check text-secondary fa-lg"></i></a>
		';

	    }		
	    
	    $cTypeId = $company['company_type_id'];
	    $itemLink = '';
	    if ($cTypeId == 1){
		//music
		$itemLink = BASE_URL.'music-list/company/'.encrypt($company['company_id']);

	    }else if ($cTypeId == 2){
		//products
		$itemLink = BASE_URL.'product-list/company/'.encrypt($company['company_id']);

	    }else if ($cTypeId == 3){
		//services
		$itemLink = BASE_URL.'service-list/company/'.encrypt($company['company_id']);

	    }else{

		$itemLink = '#';
	    }

            $companyList .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$company['company_name'].'</td>
                    <td>'.$company['company_email'].'</td>
                    <td><a href="'.$itemLink.'">'.('<i class="'.$company['company_type_icon'].'"></i>' ?? $company['company_type_icon'] ??  'N/a').'</a></td>
                    <td>'.(($company['trade_type'] == 'both')? 'Local & Export' : ucfirst($company['trade_type']) ).'</td>
                    <td>'.$featuredStatus.'</td>
                    <td>
			<!-- Default dropleft button -->
			<div class="dropdown dropleft">

			  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-ellipsis-h fa-lg d-block"></i>
			  </button>

			  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'view/company/'.encrypt($company['company_id']).'"><i class="fa fa-eye d-inline"></i> View</a>
			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/company/'.encrypt($company['company_id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

			    <a class="dropdown-item text-danger delete-company" href="javascript:void(0)" data-cname="'.$company['company_name'].'" data-link="'.BASE_URL.'delete/company/'.encrypt($company['company_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
			  </div>
			</div>
                    </td>
                </tr>
            ';
            $count++;
        }

        $count = 1;
        foreach ($data['buyers'] as $buyer){
            
            $buyerList .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$buyer['full_name'].'</td>
                    <td>'.($buyer['business_name'] ?? 'N/a').'</td>
                    <td>'.$buyer['buyer_email'].'</td>
                    <td>'.($buyer['date_joined'] ?? 'N/a').'</td>
                    <td>
			<!-- Default dropleft button -->
			<div class="dropdown dropleft">

			  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-ellipsis-h fa-lg d-block"></i>
			  </button>

			  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'view/buyer/'.encrypt($buyer['user_id']).'"><i class="fa fa-eye d-inline"></i> View</a>
			    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/buyer/'.encrypt($buyer['user_id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

			    <a class="dropdown-item text-danger delete-buyer" href="javascript:void(0)" data-bname="'.$buyer['full_name'].'" data-link="'.BASE_URL.'delete/buyer/'.encrypt($buyer['user_id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
			  </div>
			</div>
                    </td>
                </tr>
            ';
            $count++;
        }

	$adminList = '';
	$adminLink = '';
	$adminTab = '';
	$addAdminBtn = '';

	$suList = '';
	$suLink = '';
	$suTab = '';
	
	if ($_SESSION['USERDATA']['user_type'] == 'su'){

		// getting admin tab
		$adminLink = '
			  <li class="nav-item">
			    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="profile" aria-selected="false">Admins</a>
			  </li>
		';

		$count = 1;
		foreach ($data['admins'] as $admin){
		    
		    $adminList .= '
			<tr>
			    <td>'.$count.'</td>
			    <td>'.$admin['full_name'].'</td>
			    <td>'.$admin['email'].'</td>
			    <td>'.($admin['update_by_name'] ?? 'N/a').'</td>
			    <td>'.($admin['created_by_name'] ?? 'N/a').'</td>
			    <td>'.($admin['created_on'] ?? 'N/a').'</td>
			    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/admin/'.encrypt($admin['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-admin" href="javascript:void(0)" data-name="'.$admin['full_name'].'" data-link="'.BASE_URL.'delete/admin/'.encrypt($admin['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
			    </td>
			</tr>
		    ';
		    $count++;
		}

		$adminTab = '
				  <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="buyer-tab">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-strip data-table" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($adminList ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Update By</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
				  </div>


		';

		// creating super user tab

		// getting admin tab
		$suLink = '
			  <li class="nav-item">
			    <a class="nav-link" id="su-tab" data-toggle="tab" href="#su" role="tab" aria-controls="profile" aria-selected="false">Super User</a>
			  </li>
		';

		$count = 1;
		foreach ($data['superUsers'] as $su){
		    
		    $suList .= '
			<tr>
			    <td>'.$count.'</td>
			    <td>'.$su['full_name'].'</td>
			    <td>'.$su['email'].'</td>
			    <td>'.($su['update_by_name'] ?? 'N/a').'</td>
			    <td>'.($su['update_on'] ?? 'N/a').'</td>
			    <td>'.($su['created_by_name'] ?? 'N/a').'</td>
			    <td>'.($su['created_on'] ?? 'N/a').'</td>
			    <td>
				<!-- Default dropleft button -->
				<div class="dropdown dropleft">

				  <button class="btn btn-link nav-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-ellipsis-h fa-lg d-block"></i>
				  </button>

				  <div class="dropdown-menu shadow-lg rounded" style="border: 1px solid #d3d3d3;">

				    <a class="dropdown-item text-secondary" href="'.BASE_URL.'edit/super-user/'.encrypt($su['id']).'"><i class="fa fa-edit d-inline"></i> Edit</a>

				    <a class="dropdown-item text-danger delete-su" href="javascript:void(0)" data-name="'.$su['full_name'].'" data-link="'.BASE_URL.'delete/super-user/'.encrypt($su['id']).'"><i class="fa fa-trash d-inline"></i> Delete</a>
				  </div>
				</div>
			    </td>
			</tr>
		    ';
		    $count++;
		}

		$suTab = '
				  <div class="tab-pane fade" id="su" role="tabpanel" aria-labelledby="buyer-tab">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-strip data-table" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($suList ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Update By</th>
                                                    <th>Update On</th>
                                                    <th>Created By</th>
                                                    <th>Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
				  </div>


		';

	}



        $html = $this->banner('User List', 
                              '<li class="breadcrumb-item text-white" aria-current="page">User List</li>'
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-users"></i></span>
                                    <h2 class="title classic">User List</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    Users
                                    </h4>
                                    <span class="float-right">
					<a class="btn bs-btn-primary btn-sm" href="'.BASE_URL.'add-user"><i class="fa fa-plus"></i> Add User</a>
                                    </span>
                                </div>
                                <div class="card-body">


				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="company-tab" data-toggle="tab" href="#company" role="tab" aria-controls="home" aria-selected="true">Companies</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="buyer-tab" data-toggle="tab" href="#buyer" role="tab" aria-controls="profile" aria-selected="false">Buyers</a>
				  </li>
					'.$adminLink.'
					'.$suLink.'
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="home-tab">


                                    <div class="table-responsive mt-3">
                                        <table class="table table-strip data-table" width="100%"  cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Trade</th>
                                                    <th class="no-sort">Featured</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="company-data">
                                                '.($companyList ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Trade</th>
                                                    <th>Featured</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

				  </div>

				  <div class="tab-pane fade" id="buyer" role="tabpanel" aria-labelledby="buyer-tab">

                                    <div class="table-responsive mt-3">
                                        <table class="table table-strip data-table" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Business Name</th>
                                                    <th>Email</th>
                                                    <th>Date Joined</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.($buyerList ?? '').'
                                            </tbody>
                                            <tfoot class="bg-light-grey">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Business</th>
                                                    <th>Email</th>
                                                    <th>Date Joined</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
				  </div>
					'.$adminTab.'
					'.$suTab.'
				</div>

                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function serviceInfo($data = null){

	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$breadCrumbs = '';

	if ( $userType == 'admin' || $userType == 'su'){
	
		$breadCrumbs = '
			<li class="breadcrumb-item"><a href="'.BASE_URL.'service-list">Service List</a></li>
			<li class="breadcrumb-item text-white" aria-current="page">Service Info</li>
		';


	}else{
		//company view
		$breadCrumbs = '
			<li class="breadcrumb-item"><a href="'.BASE_URL.'my-services">Services</a></li>
			<li class="breadcrumb-item text-white" aria-current="page">Service Info</li>
		';

	}
	
        $html = $this->banner('Service Info', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="'.$data['serviceInfo'][0]['sub_service_category_icon'].'"></i></span>
                                    <h2 class="title classic">'.ucwords($data['serviceInfo'][0]['service_name']).'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                     Info
                                    </h4>
                                </div>
                                <div class="card-body">
					<div class="row m-1">
						<div class="col-12 col-md-12 col-lg-12">

							<div class="row">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fas fa-hand-holding-box text-primary"></i> 
								Service</span></h4>

								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Name:</label>
									 <span>'.($data['serviceInfo'][0]['service_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Company:</label>
									 <span>'.($data['serviceInfo'][0]['company_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Sector:</label>
									 <span>'.($data['serviceInfo'][0]['sector_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Main Category:</label>
									 <span>'.($data['serviceInfo'][0]['service_category_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Sub Category:</label>
									 <span>'.($data['serviceInfo'][0]['sub_service_category_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Featured:</label>
									 <span>'.(($data['serviceInfo'][0]['is_featured'] == 1)? '<span class="text-success">Yes</span>': '<span class="text-danger">No</span>').'</span>
								</div>
								<div class="col-12">
									 <label class="d-block font-weight-bold text-dark"> Description:</label>
									 <span>'.($data['serviceInfo'][0]['description'] ?? 'N/a').'</span>
								</div>
							</div>

							'.$interests.'

							<div class="row mt-3">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-info-circle text-primary"></i> 
								Extra</span></h4>
								<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created By:</label>
									 <span>'.($data['serviceInfo'][0]['created_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created On:</label>
									 <span>'.($data['serviceInfo'][0]['created_on'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Updated By:</label>
									 <span>'.($data['serviceInfo'][0]['update_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-1">
									 <label class="d-block font-weight-bold text-dark">Updated On:</label>
									 <span>'.($data['serviceInfo'][0]['update_on'] ?? 'N/a').'</span>
								</div>
							</div>
						</div>


					</div>


                                </div>


                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    public function buyerInfo($data = null){

	$interests = '';

	if (!empty($data['interests'])){

		foreach ($data['interests'] as $key => $interest){

			$interests .= '
				<div class="col-12 col-md-6 col-lg-4 mb-1">
					<span class="badge badge-pill badge-light mt-2 h5">'.$interest['name'].'</span>
				</div>
			';	
		}
		
		$interests = '
			<div class="row mt-3">
				<h4 class="mt-2 text-dark line-breaker">
					<span>
						<i class="fa fa-star text-primary"></i> 
						Interests
						(<b class="text-primary">'.(count($data['interests']??0)).'</b>)
					</span> 
				</h4>
				'.$interests.'
			</div>
		';

		

	}
	
        $html = $this->banner('Buyer Info', 
                              '
				<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>
				<li class="breadcrumb-item text-white" aria-current="page">Buyer Info</li>
			      '
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-user"></i></span>
                                    <h2 class="title classic">'.ucwords($data['buyerInfo'][0]['full_name']).'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                     Info
                                    </h4>
                                </div>
                                <div class="card-body">
					<div class="row m-1">
						<div class="col-12 col-md-12 col-lg-12">

							<div class="row">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-user text-primary"></i> 
								Personal</span></h4>

								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Full Name:</label>
									 <span>'.($data['buyerInfo'][0]['full_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Email:</label>
									 <span>'.($data['buyerInfo'][0]['buyer_email'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Business Name:</label>
									 <span>'.($data['buyerInfo'][0]['business_name'] ?? 'N/a').'</span>
								</div>
							</div>

							'.$interests.'

							<div class="row mt-3">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-info-circle text-primary"></i> 
								Extra</span></h4>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created By:</label>
									 <span>'.($data['buyerInfo'][0]['created_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created On:</label>
									 <span>'.($data['buyerInfo'][0]['created_on'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Updated By:</label>
									 <span>'.($data['buyerInfo'][0]['update_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Updated On:</label>
									 <span>'.($data['buyerInfo'][0]['update_on'] ?? 'N/a').'</span>
								</div>
							</div>
						</div>


					</div>


                                </div>


                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }

    // Admin product info view
    public function productInfo($data = []){

        $count = 1;
	$exportMarkets = '';
	$productImages = '';

        foreach ($data['productInfo'][0]['productImages'] as $key => $productImage){
            $productImages .= '
                <li><img class="d-inline rounded shadow-lg img-style-1" src="'.BASE_URL.$productImage['path'].'" alt="'.$productImage['file_name'].'" ></li>
            ';
        }



	if (!empty($data['exportMarketList'])){

		foreach ($data['exportMarketList'] as $key => $exportMarket){

			$exportMarkets .= '
				<li><a href="javascript:void(0)" class="">'.$exportMarket['name'].'</a></li>
			';	

		}
		
		$exportMarkets = '
				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="fa fa-truck text-primary"></i> 
							Ex. Markets
							(<b class="text-primary">'.(count($data['exportMarketList']??0)).'</b>)
						</span> 
					</h4>
				    <div class="col-12">
					<!-- tags start -->
					<div class="widget widget-tags">
						<ul class="unstyled clearfix">
							'.$exportMarkets.'
						</ul>
					</div><!-- tags end -->
				     </div>
				</div>
		';

		

	}


	$hsCode = $data['productInfo'][0]['hs_code'].' - '.$data['productInfo'][0]['hs_code_name'];

        $html = $this->banner('Product Info', 
                              '
				<li class="breadcrumb-item"><a href="'.BASE_URL.'product-list">Product List</a></li>
				<li class="breadcrumb-item text-white" aria-current="page">Product Info</li>
			      '
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
                                    <h2 class="title classic">'.ucwords($data['productInfo'][0]['product_name']).'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    Info
                                    </h4>
                                </div>
                                <div class="card-body">
					<div class="row m-1 text-center">
						<div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
						    <div class="portfolio-slider">
							<div class="flexportfolio flexslider">
							    <ul class="slides" style="height:max-content;">
								'.$productImages.'
							    </ul>
							</div>
						    </div>
							<h3 class="mt-4">'.($data['productInfo'][0]['product_name'] ?? 'N/a').'
							'.(($data['productInfo'][0]['is_featured'] == 1)? 
								'<sub class="text-success"><i class="fas fa-check"></i></sub>': 
								'').'

							'.(($data['productInfo'][0]['mib_catalogue_status'] == 1)? 
								'<sub class="text-warning"><i class="fas fa-certificate"></i></sub>': 
								'').'
							</h3>
							<p class="font-italic">'.($data['productInfo'][0]['product_description'] ?? '').'</p>
					        </div>
				        </div>
					<div class="row m-1">
						<div class="col-12 col-md-12 col-lg-12">

							<div class="row">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-shopping-cart text-primary"></i> 
								Product Info</span></h4>

								<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Company:</label>
									 <span>'.($data['companyInfo'][0]['company_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Email:</label>
									 <span>'.($data['companyInfo'][0]['company_email'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">HS Code:</label>
									 <span>'.$hsCode.'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Sector:</label>
									 <span>'.($data['productInfo'][0]['sector_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Trade:</label>
									 <span>'.(($data['companyInfo'][0]['trade_type'] == 'both')? 'Local & Export': ucfirst($data['companyInfo'][0]['trade_type']??'N/a')).'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Type:</label>
									 <span>'.($data['companyInfo'][0]['company_type_name'] ?? 'N/a').'</span>
								</div>
							</div>

							'.$exportMarkets.'

							<div class="row mt-3">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-info-circle text-primary"></i> 
								Extra</span></h4>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Images:</label>
									 <span>'.count($data['productInfo'][0]['productImages'] ?? 0).'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Featured:</label>
									 <span>'.(($data['productInfo'][0]['is_featured'] == 1)? '<span class="text-success">Yes</span>': '<span class="text-danger">No</span>').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created By:</label>
									 <span>'.($data['productInfo'][0]['created_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created On:</label>
									 <span>'.($data['productInfo'][0]['created_on'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Updated By:</label>
									 <span>'.($data['productInfo'][0]['update_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Updated On:</label>
									 <span>'.($data['productInfo'][0]['update_on'] ?? 'N/a').'</span>
								</div>
							</div>
						</div>


					</div>


                                </div>


                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    
    public function companyInfo($data = null){

        $trData = '';
        $rowData = '';
        $count = 1;
	$exportMarkets = '';

	$socialLinks = '';
	$website = isset($data['companyInfo'][0]['website_link'])? '<a href="'.$data['companyInfo'][0]['website_link'].'"><i class="fa fa-globe fa-lg"></i></a>': '';

	$link = '';
	$items = '';
	$moreCompanyInfo = '';
	$cTypeId = $data['companyInfo'][0]['company_type_id'] ?? 0;
	$cTypeName = $data['companyInfo'][0]['company_type_name'] ?? 'N/a';

	if ( $cTypeId == 1){
	//music company

		$link = '<a href="'.BASE_URL.'music-list">'.$cTypeName.'</a>';

		if (!empty($data['musics'])){

			$musics = '';
			foreach ($data['musics'] as $key => $music){

				$musics .= '
					<li><a href="'.BASE_URL.'edit/music/'.encrypt($music['id']).'">'.$music['name'].'</a></li>
				';	

			}
			
			$items = '

				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="fa fa-music text-primary"></i> 
							Products
							(<b class="text-primary">'.(count($data['musics']??0)).'</b>)
						</span> 
					</h4>
				    <div class="col-12">
					<!-- tags start -->
					<div class="widget widget-tags">
						<ul class="unstyled clearfix">
							'.$musics.'
						</ul>
					</div><!-- tags end -->
				     </div>
				</div>
			';


		}

	}else if( $cTypeId == 2 ){
	//Product company

		$link = '<a href="'.BASE_URL.'product-list">'.$cTypeName.'</a>';

		if (!empty($data['products'])){

			$products = '';
			foreach ($data['products'] as $key => $product){

				$products .= '
					<li><a href="'.BASE_URL.'view/product/'.encrypt($product['product_id']).'">'.$product['product_name'].'</a></li>
				';	

			}
			
			$items = '

				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="fa fa-shopping-cart text-primary"></i> 
							Products
							(<b class="text-primary">'.(count($data['products']??0)).'</b>)
						</span> 
					</h4>
				    <div class="col-12">
					<!-- tags start -->
					<div class="widget widget-tags">
						<ul class="unstyled clearfix">
							'.$products.'
						</ul>
					</div><!-- tags end -->
				     </div>
				</div>
			';


		}
		
		



	}else if( $cTypeId == 3){
	//service company
	
		$link = '<a href="'.BASE_URL.'service-list">'.$cTypeName.'</a>';

		if (!empty($data['services'])){
			
			$services = '';
			foreach ($data['services'] as $key => $service){

				$services .= '
							<li><a href="'.BASE_URL.'/view/service/'.encrypt($service['id']).'">'.$service['service_name'].'</a></li>
				';	

			}
			
			$items = '

				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="far fa-hand-holding-box text-primary"></i> 
							Services
							(<b class="text-primary">'.(count($data['services']??0)).'</b>)
						</span> 
					</h4>
				    <div class="col-12">
					<!-- tags start -->
					<div class="widget widget-tags">
						<ul class="unstyled clearfix">
							'.$services.'
						</ul>
					</div><!-- tags end -->
				     </div>
				</div>
			';


		}else{

			$items = '
				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="far fa-hand-holding-box text-primary"></i> 
							Services
						</span> 
					</h4>
					<div class="col-12 mb-1">
						 <span>'.($data['companyInfo'][0]['service_offered']??'N/a').'</span>
					</div>
				</div>
			';

	
		}

		$moreCompanyInfo = '
			<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
				 <label class="d-block font-weight-bold text-dark">Expansion Potential:</label>
				 <span>'.($data['companyInfo'][0]['expansion_potential']??'N/a').'</span>
			</div>
			<div class="col-12">
				 <label class="d-block font-weight-bold text-dark">Industries Serviced:</label>
				 <span>'.($data['companyInfo'][0]['industry_serviced']??'N/a').'</span>
			</div>

		';

	}else{

		$link = 'N/a';

	}

	if (!empty($data['socialContactList'])){

		foreach ($data['socialContactList'] as $key => $socialContact){

			if (isset($socialContact['link'])){

				$socialLinks .= '<a href="'.$socialContact['link'].'" class="mr-3"><i class="'.$socialContact['icon'].' fa-lg"></i></a>';	
		
			}

		}

	}
	
	if (!empty($data['exportMarketList'])){

		foreach ($data['exportMarketList'] as $key => $exportMarket){

			$exportMarkets .= '
				<li><a href="javascript:void(0)" class="">'.$exportMarket['name'].'</a></li>
			';	

		}
		
		$exportMarkets = '
				<div class="row mt-3">
					<h4 class="mt-2 text-dark line-breaker">
						<span>
							<i class="fa fa-truck text-primary"></i> 
							Ex. Markets
							(<b class="text-primary">'.(count($data['exportMarketList']??0)).'</b>)
						</span> 
					</h4>
				    <div class="col-12">
					<!-- tags start -->
					<div class="widget widget-tags">
						<ul class="unstyled clearfix">
							'.$exportMarkets.'
						</ul>
					</div><!-- tags end -->
				     </div>
				</div>
		';

		

	}




        $html = $this->banner('Company Info', 
                              '
				<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>
				<li class="breadcrumb-item text-white" aria-current="page">Company Info</li>
			      '
                              ).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
                                    <h2 class="title classic">'.ucwords($data['companyInfo'][0]['company_name']).'</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-light-grey pb-2">
                                    <h4 class="text-dark d-inline">
                                    Info
                                    </h4>
                                </div>
                                <div class="card-body">
					<div class="row m-1">
						<div class="col-12 col-md-12 col-lg-4 text-center">

							<img id="display-img" src="'.BASE_URL.($data['companyInfo'][0]['logo_img'] ?? 'images/business_icon.png') .'" class="avatar img-fluid img-thumbnail shadow-lg" style="height:225px;width:auto;">
							<span class="d-block mb-4"></span>

							'.$socialLinks.$website.'

							<h3 class="mt-4">'.($data['companyInfo'][0]['company_name'] ?? 'N/a').'
							'.(($data['companyInfo'][0]['is_featured'] == 1)? 
								'<sub class="text-success"><i class="fas fa-check"></i></sub>': 
								'').'

							</h3>


							<p class="font-italic">'.($data['companyInfo'][0]['description'] ?? '').'</p>
						</div>
						<div class="col-12 col-md-12 col-lg-8">

							<div class="row">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-user text-primary"></i> 
								Point of Contact</span></h4>

								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> First Name:</label>
									 <span>'.($data['pointOfContact'][0]['first_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Last Name:</label>
									 <span>'.($data['pointOfContact'][0]['last_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Position:</label>
									 <span>'.($data['pointOfContact'][0]['position'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Phone #:</label>
									 <span>'.($data['pointOfContact'][0]['phone'] ?? 'N/a').'</span>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Email:</label>
									 <span>'.($data['pointOfContact'][0]['email'] ?? 'N/a').'</span>
								</div>
							</div>
							<div class="row mt-3">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-building text-primary"></i> 
								Company Profile</span></h4>

								<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Email:</label>
									 <span>'.($data['companyInfo'][0]['company_email'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Phone #:</label>
									 <span>'.($data['companyInfo'][0]['phone'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Address:</label>
									 <span>'.($data['companyInfo'][0]['address'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark" data-toggle="tooltip" data-placement="top" title="City/Town/Village">CTV:</label>
									 <span>'.($data['companyInfo'][0]['ctv'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">District:</label>
									 <span>'.($data['companyInfo'][0]['district'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Established:</label>
									 <span>'.($data['companyInfo'][0]['established_on'] ?? 'N/a').'</span>
								</div>
								'.$moreCompanyInfo.'
							</div>

							'.$items.'
							'.$exportMarkets.'

							<div class="row mt-3">
								<h4 class="mt-2 text-dark line-breaker"><span>
								<i class="fa fa-info-circle text-primary"></i> 
								Extra</span></h4>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Type:</label>
									 <span>'.$link.'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Trade:</label>
									 <span>'.(($data['companyInfo'][0]['trade_type'] == 'both')? 'Local & Export': ucfirst($data['companyInfo'][0]['trade_type']??'N/a')).'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Featured:</label>
									 <span>'.(($data['companyInfo'][0]['is_featured'] == 1)? '<span class="text-success">Yes</span>': '<span class="text-danger">No</span>').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Approved By:</label>
									 <span>'.($data['companyInfo'][0]['approved_by'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Updated By:</label>
									 <span>'.($data['companyInfo'][0]['update_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark">Updated On:</label>
									 <span>'.($data['companyInfo'][0]['update_on'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created By:</label>
									 <span>'.($data['companyInfo'][0]['created_by_name'] ?? 'N/a').'</span>
								</div>
								<div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-1">
									 <label class="d-block font-weight-bold text-dark"> Created On:</label>
									 <span>'.($data['companyInfo'][0]['created_on'] ?? 'N/a').'</span>
								</div>
							</div>
						</div>


					</div>


                                </div>


                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function editProduct($data = null){
        
        $hsCodeOptions = '';

	//echo '<pre style="margin-top: 150px;">';
	//print_r($data);
	//echo '</pre>';
	if (empty($data['hsCodes'])){
		
		$hsCodeOptions = '
			<option value="0" disabled>Not HS Codes Available</option>
		';
	}else{

		foreach ($data['hsCodes'] as $hsCode){

		    $isSelected = '';
		    if ($data['product'][0]['hs_code_id'] == $hsCode['id']){

			$isSelected = 'selected';

		    }

		    $hsCodeOptions .= '
			<option value="'.encrypt($hsCode['id']).'" '.$isSelected.'>'.$hsCode['hs_code'].' - '.$hsCode['hs_code_name'].'</option>
		    ';
		}

	}
        if ($_SESSION['USERDATA']['user_type'] == 'admin'){
            $breadCrumbs = '<li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=productList">Product List</a></li>'.
                           '<li class="breadcrumb-item text-white" aria-current="page">Edit Product</li>';

        }else{
            $breadCrumbs = '<li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=myProducts">My Products</a></li>'.
                           '<li class="breadcrumb-item text-white" aria-current="page">Edit Product</li>';

        }
        $html = $this->banner('Edit Product', $breadCrumbs ).'
                    <script>    
                        setInitialPreview('.json_encode($data['initialPrev']).');
                        setInitialPreviewConfig('.json_encode($data['initialPrevConfig']).');
                        setUploadExtraData('.json_encode($data['uploadExtraData']).');
                    </script>

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-edit"></i></span>
                                    <h2 class="title classic">Edit My Product</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <a class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-5 text-dark" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">Product Info
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
						        <form id="my-product-1" action="'.BASE_URL.'" method="POST">
							    <input type="hidden" name="action" value="saveProductDetails">
							    <input type="hidden" name="pId" value="'.encrypt($data['product'][0]['product_id']).'">
							    <input type="hidden" name="cId" value="'.encrypt($data['product'][0]['company_id']).'">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Product Name</label>
                                                                        <input type="text" class="form-control" name="prodName" id="" placeholder="Enter a product name..." value="'.$data['product'][0]['product_name'].'" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">HS Code</label>
                                                                        <select name="hsId" class="form-control" placeholder="Select a HS Code" required>
                                                                            '.$hsCodeOptions.'
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="prodDescription" class="">Tell us something about the product...</label>
                                                                        <textarea class="form-control" name="prodDescription" maxlength="350" id="comp-desc" placeholder="Enter something about the product..." rows="4">'.$data['product'][0]['product_description'].'</textarea>
									<span class="text-muted" id="comp-desc-count"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success"><i class="fa fa-save"></i> Save</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->

                                        <div class="card border rounded mb-2">
                                            <div class="card-header p-0 bg-light-grey">
                                                <a class="h4 collapsed mb-0 font-weight-bold text-uppercase d-block p-2 pl-5 text-dark" data-toggle="collapse" data-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                    Product Images
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <form id="product-img" action="'.BASE_URL.'" method="POST">
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <div class="file-loading">
                                                                    <input id="edit-product-images" name="files[]" type="file" data-classButton="btn btn-secondary" accept=".jpg,.png,.jpeg" multiple>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Panel 2 end-->

                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->

        ';
        return $html;

    }
    public function addProduct($data = null){
        
        $hsCodeOptions = '';
	$breadCrumbs = '';
	$minWidthSize  = 500;
	$maxWidthSize  = 1080;
	$minHeightSize = 500;
	$maxHeightSize = 900;

	//getting all available hs codes
	if (empty($data['hsCodes'])){
		
		$hsCodeOptions = '
			<option value="0" disabled>Not HS Codes Available</option>
		';
	}else{

		foreach ($data['hsCodes'] as $hsCode){
		    $hsCodeOptions .= '
			<option value="'.encrypt($hsCode['id']).'">'.$hsCode['hs_code'].' - '.$hsCode['hs_code_name'].'</option>
		    ';
		}

	}
	
	$userType = $_SESSION['USERDATA']['user_type'] ?? '';
	$inputFields = '';
	//loading all admin views
	if ($userType == 'admin' || $userType == 'su'){
		// all elements available to a admin can be created here
		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'product-list">Product List</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Product</li>
		';
		$options = '';
		if (!empty($data['companys'])){

			foreach ($data['companys'] as $company){
			    $options .= '
				<option value="'.encrypt($company['company_id']).'">'.$company['company_name'].'</option>
			    ';
			}

		}

		$inputFields = '
			<div class="col-12 col-md-4 col-lg-4">
			    <div class="form-group">
				<label for="prodName" class="">Product Name</label>
				<input type="text" class="form-control" name="prodName" id="product-name" placeholder="Enter a product name..." value="" required>
			    </div>
			</div>
			<div class="col-12 col-md-4 col-lg-4">
			    <div class="form-group">
				<label for="">Company</label>
				<select name="cId" class="form-control" placeholder="Select a company" required>
				    '.$options.'
				</select>
			    </div>
			</div>
			<div class="col-12 col-md-4 col-lg-4">
			    <div class="form-group">
				<label for="">HS Code</label>
				<select name="hsId" class="form-control" placeholder="Select a HS Code" required>
				    '.$hsCodeOptions.'
				</select>
			    </div>
			</div>
		';

	}else{
		//loading company view

		$breadCrumbs = '
                              <li class="breadcrumb-item"><a href="'.BASE_URL.'my-products">My Products</a></li>
                              <li class="breadcrumb-item text-white" aria-current="page">Add Product</li>
		';

		$inputFields = '

			<div class="col-12 col-md-6">
			    <div class="form-group">
				<label for="prodName" class="">Product Name</label>
				<input type="text" class="form-control" name="prodName" id="product-name" placeholder="Enter a product name..." value="" required>
			    </div>
			</div>
			<div class="col-12 col-md-6">
			    <div class="form-group">
				<label for="">HS Code</label>
				<select name="hsId" class="form-control" placeholder="Select a HS Code" required>
					<option value="0" selected disabled hidden>Select a HS Code</option>
				    '.$hsCodeOptions.'
				</select>
			    </div>
			</div>
		';

	}


        $html = $this->banner('Add Product', $breadCrumbs).'

                    <!-- Portfolio start -->
                    <section id="main-container" class="portfolio-static pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 heading">
                                    <span class="title-icon classic float-left"><i class="fa fa-shopping-cart"></i></span>
                                    <h2 class="title classic">Add Product</h2>
                                </div>
                                <div class="col-12">
                                    '.($data['message'] ?? '').'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordion">
                                        <div class="card border rounded mb-2">
                                                <div class="card-header p-0 bg-light-grey">
                                                    <a class="h4 mb-0 font-weight-bold text-uppercase d-block p-2 pl-5 text-dark" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">Product Info
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
							 <form action="'.BASE_URL.'" method="POST" enctype="multipart/form-data">
							    <input type="hidden" name="action" value="addProduct">
                                                            <div class="row">
								'.$inputFields.'
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="prodName" class="">Tell us something about the product...</label>
                                                                        <textarea class="form-control" name="productDescription" maxlength="350" id="comp-desc" placeholder="Enter something about the product..." rows="4"></textarea>
									<span class="text-muted" id="comp-desc-count"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
								    <div class="col-12">
									<div class="alert alert-info">
									  <strong class="font-weight-bold">Notice!</strong><br> 	
										Please ensure the image dimesions are within the following range: 
										<strong>Width: '.$minWidthSize.' - '.$maxWidthSize.' px</strong> and
										<strong>Height: '.$minHeightSize.' - '.$maxHeightSize.' px</strong>
									</div>
								    </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="file-loading">
                                                                        <input id="add-product-images" name="files[]" type="file" data-classButton="btn btn-secondary" accept=".jpg,.png,.jpeg" multiple required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row pt-4">
                                                                <div class="col-12">
                                                                    <span class="float-right"><button class="btn btn-success" id="add-product-btn"><i class="fa fa-check"></i> Done</button> </span>
                                                                </div>
                                                            </div>
                                                        </form> 
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--/ Panel 1 end-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Container end -->
                    </section><!-- Portfolio end -->
        ';

        return $html;

    }

    public function musicDetails($data = []){

        $productImages = '';
        $exportList = '';
	$exportInfo = '';
	$localInfo = '';

	$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['companyDetails'][0]['company_name']) ) );

	if ($data['companyDetails'][0]['trade_type'] != 'export'){
		//company supplies locally
	    $localInfo = '
		    <h3 class="widget-title text-success">Provided Locally</h3>
	    ';

	}

	$contactSection = '
	    <section id="main-container" >
		<div class="container">
		    <div class="row">
			<div class="col-md-8 mx-auto">
			    <div class="card shadow" >
				<div class="card-body">
				    <h3 class="card-title">Connect With Us!</h3>

				    <form id="contact-form" action="'.BASE_URL.'" method="post" role="form">

					<input name="action" type="hidden" value="contactCompany">
					<input name="cId" type="hidden" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
					<input name="mId" type="hidden" value="'.encrypt($data['musicDetails'][0]['id']).'">

					<div class="row">
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Name</label>
						    <input class="form-control" name="name" value="'.($_SESSION['USERDATA']['full_name'] ?? '').'" id="name" placeholder="What\'s your name?" type="text" required>
						</div>
					    </div>
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Email</label>
						    <input class="form-control" name="email" id="email" placeholder="Enter your email" value="'.($_SESSION['USERDATA']['email'] ?? '').'" type="email" required>
						</div>
					    </div>
					    <div class="col-12">
						<div class="form-group">
						    <label>Subject</label>
						    <input class="form-control" name="subject" id="subject" placeholder="" 
value="Hello, I\'m interested in your music, '.$data['musicDetails'][0]['name'].'" required>
						</div>
					    </div>
					</div>
					<div class="form-group">
					    <label>Message</label>
					    <textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
					</div>
					    <div class="mt-3">
						<div class="g-recaptcha d-inline" data-sitekey="'.RECAPTCHA_SITE_KEY.'" required></div>
						<button class="btn btn-primary solid blank float-right mt-3" type="submit">Send Message</button>
					    </div>
				    </form>
				</div>
			    </div>
			</div>
			
		    </div>
		</div>
	    </section>

	';


        //checking if buyer has this added this product to their interest
	$interestBtn = '';
	if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

		$icon = 'far fa-star';
		if ($data['musicDetails'][0]['is_interested'] == 1){

			$icon = 'fas fa-star';
		
		}

		$interestBtn = '
			<span class="float-right">
				<i class="'.$icon.' fa-lg interested-music text-warning" data-mid="'.encrypt($data['musicDetails'][0]['id']).'"
				data-toggle="tooltip" data-placement="top" title="Interested"></i>
			</span>
		';

	}


        $html = '
            '.$this->banner($data['musicDetails'][0]['name'], 
            '<li class="breadcrumb-item" aria-current="page"><a href="'.BASE_URL.'music">Music</a></li>'.
            '<li class="breadcrumb-item text-white" aria-current="page">Music Details</li>'
            ).'   

            <!-- Portfolio item start -->
            <section id="portfolio-item">
                <div class="container">
                    <!-- Portfolio item row start -->
                    <div class="row">
                        <!-- Portfolio item slider start -->
                        <div class="col-12 col-md-6 col-lg-6 my-md-auto text-center mb-3">
				<audio controls >
					<source src="'.BASE_URL.$data['musicDetails'][0]['audio_path'].'"/>
					Audio element not supported by browser please use chrome or firefox.
				</audio>
                        </div>
                        <!-- Portfolio item slider end -->
                        <!-- sidebar start -->
                        <div class="col-12 col-md-6 col-lg-6 pt-3 pt-md-0 about-message">
                            <div class="sidebar pr-3 pt-3">
                                <div class="portfolio-desc">
				    '.$interestBtn.'
                                    <h3 class="widget-title mb-2">'.$data['musicDetails'][0]['name'].'</h3>
                                    <p class="mb-4">
                                    '.($data['musicDetails'][0]['description'] ?? 'No Description available...').'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- sidebar end -->
                    </div><!-- Portfolio item row end -->
                </div><!-- Container end -->
            </section><!-- Portfolio item end -->

	    <section class="mt-0 pt-0">            
		    <div class="row about-wrapper-bottom">
			<div class="col-md-6 ts-padding about-img d-flex" style="height:300px;">
			    <img src="'.BASE_URL.$data['companyDetails'][0]['logo_img'].'" class="mx-auto my-auto img-fluid shadow-lg rounded" alt="client">
			</div>
			<!--/ About image end -->
			<div class="col-md-6 ts-padding about-message">
			
			    <div class="heading pb-4">
				<span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
				<h2 class="title">'.$data['companyDetails'][0]['company_name'].'<span class="title-desc">
				<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'">
					<i class="fa fa-link"></i> 
						Check out our profile!
				</a>
				</span>
				</h2>
			    </div>

			    <p>
			    '.$data['companyDetails'][0]['description'].'
			    </p>
			    <ul class="unstyled arrow">
				'.( (isset($data['companyDetails'][0]['website_link']))? '<li><a href="'.$data['companyDetails'][0]['website_link'].'"><i class="fa fa-globe info"></i> '.$data['companyDetails'][0]['website_link'].'</a></li>' : '' ).'
				<li><a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'#company-music"><i class="fa fa-music info"></i> See all music</a></li>
				<li><a href="#main-container"><i class="fa fa-envelope info"></i> Contact</a></li>
			    
			    </ul>
			</div>
			<!--/ About message end -->
		    </div>
	     </section>
		'.$contactSection.'
        ';
        return $html;
    }
    //Displays info about a product along with the company that makes it
    public function productDetails($data = []){

        $productImages = '';
        $exportList = '';
	$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['productDetails'][0]['sector_name'])) );
	$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['companyDetails'][0]['company_name']) ) );

	$exportInfo = '';
        if ($data['companyDetails'][0]['trade_type'] != 'local' && (!empty($data['exportMarketList']) && !empty($data['exportMarkets'])) ){

            //getting all business selected export markets
            foreach($data['exportMarketList'] as $exportMarketList){

                foreach($data['exportMarkets'] as $exportMarket){

		    $emName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($exportMarket['name'])) );

                    if ($exportMarketList['export_market_id'] == $exportMarket['id']){
                        $exportList .= '
				<li><a href="'.BASE_URL.'products/export-market/'.$emName.'/'.encrypt($exportMarket['id']).'" class="h4">
					<i class="fa fa-truck"></i> '.$exportMarket['name'].'
				</a></li>
                        ';
                    }
                }
            }

	    $exportInfo = '
		<!-- tags start -->
		<div class="widget widget-tags mb-0 mt-2">
			<h3 class="widget-title mb-0">Export To</h3>
			<ul class="unstyled clearfix">
				'.$exportList.'
			</ul>
		</div><!-- tags end -->

	    ';

        }            
	$localInfo = '';
	if ($data['companyDetails'][0]['trade_type'] != 'export'){
		//company supplies locally
	    $localInfo = '
		    <h4 class="widget-title text-success">Supplies Locally Too</h4>
	    ';

	}

        foreach ($data['productDetails'][0]['productImages'] as $key => $productImage){
            $productImages .= '
                <li><img class="mx-auto d-block slider-product-img" src="'.BASE_URL.$productImage['path'].'" alt="'.$productImage['file_name'].'" ></li>
            ';
        }

	$contactSection = '
	    <section id="main-container">
		<div class="container">
		    <div class="row">
			<div class="col-md-8 mx-auto">
			    <div class="card shadow" >
				<div class="card-body">
				    <h3 class="card-title">Connect With Us!</h3>

				    <form id="contact-form" action="'.BASE_URL.'" method="post" role="form">

					<input name="action" type="hidden" value="contactCompany">
					<input name="cId" type="hidden" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
					<input name="pId" type="hidden" value="'.encrypt($data['productDetails'][0]['product_id']).'">

					<div class="row">
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Name</label>
						    <input class="form-control" name="name" value="'.($_SESSION['USERDATA']['full_name'] ?? '').'" id="name" placeholder="What\'s your name?" type="text" required>
						</div>
					    </div>
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Email</label>
						    <input class="form-control" name="email" id="email" placeholder="Enter your email..." type="email" value="'.($_SESSION['USERDATA']['email'] ?? '').'" required>
						</div>
					    </div>
					    <div class="col-12">
						<div class="form-group">
						    <label>Subject</label>
						    <input class="form-control" name="subject" id="subject" placeholder="Enter a subject here..." 
						    value="Hello, I\'m interested in your product, '.$data['productDetails'][0]['product_name'].'" required>
						</div>
					    </div>
					</div>
					<div class="form-group">
					    <label>Message</label>
					    <textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
					</div>
				        <div class="mt-3">
						<div class="g-recaptcha d-inline" data-sitekey="'.RECAPTCHA_SITE_KEY.'" required></div>
						<button class="btn btn-primary solid blank float-right mt-3" type="submit">Send Message</button>
				        </div>
				    </form>
				</div>
			    </div>
			</div>
			
		    </div>
		</div>
	    </section>
	';

        //checking if buyer has this added this product to their interest
	$interestBtn = '';
	if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

		$icon = 'far fa-star';
		if ($data['productDetails'][0]['is_interested'] == 1){

			$icon = 'fas fa-star';
		
		}

		$interestBtn = '
			<span class="float-right">
				<i class="'.$icon.' fa-lg interested-product text-warning" data-pid="'.encrypt($data['productDetails'][0]['product_id']).'"
				data-toggle="tooltip" data-placement="top" title="Interested"></i>
			</span>
		';

	}


        $html = '
            '.$this->banner($data['productDetails'][0]['product_name'], 
            '<li class="breadcrumb-item"><a href="'.BASE_URL.'products">Products</a></li>'.
            '<li class="breadcrumb-item text-white" aria-current="page">Product Details</li>'
            ).'   

            <!-- Portfolio item start -->
            <section id="portfolio-item">
                <div class="container">
                    <!-- Portfolio item row start -->
                    <div class="row">
                        <!-- Portfolio item slider start -->
                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 my-auto">
                            <div class="portfolio-slider">
                                <div class="flexportfolio flexslider">
                                    <ul class="slides">
                                        '.$productImages.'
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio item slider end -->
                        <!-- sidebar start -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 pt-3 pt-md-0 mt-3 mt-md-0 about-message">
                            <div class="sidebar pr-3 pt-3">
                                <div class="portfolio-desc">
				    '.$interestBtn.'
                                    <h3 class="widget-title">'.$data['productDetails'][0]['product_name'].'</h3>
                                    <p>
                                    '.($data['productDetails'][0]['product_description'] ?? 'No Description available.').'
                                    </p>
                                    <h3 class="widget-title">HS Code:<span class="text-primary">
					<a href="'.BASE_URL.'products/hs-code/'.$data['productDetails'][0]['hs_code'].'">'.$data['productDetails'][0]['hs_code'].'</a>
				    </span> - '.$data['productDetails'][0]['hs_code_name'].'</h3>
                                    <h3 class="widget-title mb-3">Sector</h3>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <a href="'.BASE_URL.'products/sector/'.$sName.'/'.encrypt($data['productDetails'][0]['sector_id']).'" class="badge badge badge-secondary">
                                                    <label class="d-inline h6"><i class="fas fa-tag"></i> '.$data['productDetails'][0]['sector_name'].'</label>
                                                </a>
                                            </div>
                                        </div>
                                    <br>
					'.$exportInfo.'
					'.$localInfo.'
					
                                </div>
                            </div>
                        </div>
                        <!-- sidebar end -->
                    </div><!-- Portfolio item row end -->
                </div><!-- Container end -->
            </section><!-- Portfolio item end -->
            
	    <section class="mt-0 pt-0">            
		    <div class="row about-wrapper-bottom">
			<div class="col-md-6 ts-padding about-img d-flex" style="height:300px;">
			    <img src="'.BASE_URL.$data['companyDetails'][0]['logo_img'].'" class="mx-auto my-auto img-fluid shadow-lg rounded" alt="client">
			</div>
			<!--/ About image end -->
			<div class="col-md-6 ts-padding about-message">
			
			    <div class="heading pb-4">
				<span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
				<h2 class="title">'.$data['companyDetails'][0]['company_name'].'<span class="title-desc">
				<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'">
					<i class="fa fa-link"></i> 
						Check out our profile!
				</a>
				</span>
				</h2>
			    </div>

			    <p>
			    '.$data['companyDetails'][0]['description'].'
			    </p>
			    <ul class="unstyled arrow">
				'.( (isset($data['companyDetails'][0]['website_link']))? '<li><a href="'.$data['companyDetails'][0]['website_link'].'"><i class="fa fa-globe info"></i> '.$data['companyDetails'][0]['website_link'].'</a></li>' : '' ).'
				<li><a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'#company-products"><i class="fa fa-shopping-cart info"></i> See Products</a></li>
				<li><a href="#main-container"><i class="fa fa-envelope info"></i> Contact</a></li>
			    
			    </ul>
			</div>
			<!--/ About message end -->
		    </div>
		</section>
		'.$contactSection.'

        ';
        return $html;
    }

    public function sectorDetails($data = []){



	$hsCodes = '';
	if (!empty($data['hsCodes'])){

		$tags = '';
		foreach ($data['hsCodes'] as $key => $hscode){

			//$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector['name'])) );
			$tags .= '

				<li><a href="'.BASE_URL.'products/hs-code/'.$hscode['hs_code'].'">'.$hscode['hs_code'].'-'.$hscode['hs_code_name'].'</a></li>

			';

		}

		$hsCodes = '

			<!-- tags start -->
			<div class="widget widget-tags">
				<h3 class="widget-title">HS Codes</h3>
				<ul class="unstyled clearfix">
					'.$tags.'
				</ul>
			</div><!-- tags end -->

		';

	}

	$moreSectors = '';
	if (!empty($data['sectors'])){

		$tags = '';
		foreach ($data['sectors'] as $key => $sector){

			if($sector['id'] != $data['sectorDetails'][0]['id']){

				$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector['name'])) );
				$tags .= '

					<li><a href="'.BASE_URL.'sector/'.$sName.'/'.encrypt($sector['id']).'">'.$sector['name'].'</a></li>

				';

			}

		}

		$moreSectors = '

			<!-- tags start -->
			<div class="widget widget-tags">
				<h3 class="widget-title">More Sectors</h3>
				<ul class="unstyled clearfix">
					'.$tags.'
				</ul>
			</div><!-- tags end -->

		';

	}

	$serviceCategory = '';
	if (!empty($data['categories'])){
		//displaying service categories

		$tags = '';
		foreach ($data['categories'] as $key => $category){


			$scName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($category['acronym'])) );
			$tags .= '
				<li><a href="'.BASE_URL.'services/category/'.$scName.'/'.encrypt($category['id']).'">'.$category['name'].'<span class="posts-count"> ('.($category['service_count'] ?? 0).')</span></a></li>

			';


		}


		$serviceCategory = '
			<!-- category start -->
			<div class="widget widget-categories">
				<h3 class="widget-title">Categories</h3>
				<ul class="category-list clearfix">
					'.$tags.'
				</ul>
			</div><!-- category end -->
		';
	}

	$subServiceCategory = '';
	if (!empty($data['subCategories'])){
		//displaying sub service categories

		$tags = '';
		foreach ($data['subCategories'] as $key => $subCat){

			$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($subCat['sub_service_category_name'])) );
			$tags .= '

				<li><a href="'.BASE_URL.'services/sub-category/'.$sName.'/'.encrypt($subCat['id']).'">'.$subCat['sub_service_category_name'].'</a></li>

			';


		}

		$subServiceCategory = '
			<!-- tags start -->
			<div class="widget widget-tags">
				<h3 class="widget-title">Sub Categories</h3>
				<ul class="unstyled clearfix">
					'.$tags.'
				</ul>
			</div><!-- tags end -->
		';
	}


        $html = '
            '.$this->banner($data['sectorDetails'][0]['name'], 
            '<li class="breadcrumb-item text-white" aria-current="page"><a href="'.BASE_URL.'sectors">Sectors</a></li>'.
            '<li class="breadcrumb-item text-white" aria-current="page">Sector Details</li>'
            ).'   

		<!-- Main container start -->
		<section id="main-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="post-content">
							<div class="post-image-wrapper text-center">
								<img src="'.BASE_URL.$data['sectorDetails'][0]['sector_img'].'" class="img-fluid" alt="Sector Image" />
							</div><!-- post image end -->
							<p>
								'.($data['sectorDetails'][0]['description'] ?? '.....').'
							</p>

						</div>
						<!--/ post content end -->
					</div>
					<!--/ Content col end -->

					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="sidebar sidebar-right">
							
							'.$serviceCategory.$subServiceCategory.$moreSectors.$hsCodes.'
						</div>
						<!--/ Sidebar end -->
					</div>
					<!--/ Sidebar col end -->
				</div>
				<!--/ row end -->
			</div>
			<!--/ container end -->
		</section>
		<!--/ Main container end -->
		
        ';
        return $html;
    }
    //Displays info about a product along with the company that makes it
    public function serviceDetails($data = []){

        $productImages = '';
        $exportList = '';
	$exportInfo = '';
	$localInfo = '';

	$serCat = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['serviceDetails'][0]['service_category_acronym'])) );
	$subSerCat = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['serviceDetails'][0]['sub_service_category_name'])) );
	$sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['serviceDetails'][0]['service_name'])) );
	$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['companyDetails'][0]['company_name']) ) );



	if ($data['companyDetails'][0]['trade_type'] != 'export'){
		//company supplies locally
	    $localInfo = '
		    <h3 class="widget-title text-success">Provided Locally</h3>
	    ';

	}

	$contactSection = '

	    <section id="main-container" class="mt-0 pt-0">
		<div class="container">
		    <div class="row">
			<div class="col-md-8 mx-auto">
			    <div class="card shadow" >
				<div class="card-body">
				    <h3 class="card-title">Connect With Us!</h3>

				    <form id="contact-form" action="'.BASE_URL.'" method="post" role="form">

					<input name="action" type="hidden" value="contactCompany">
					<input name="cId" type="hidden" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
					<input name="sId" type="hidden" value="'.encrypt($data['serviceDetails'][0]['id']).'">
					<div class="row">
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Name</label>
						    <input class="form-control" name="name" value="'.($_SESSION['USERDATA']['full_name'] ?? '').'" id="name" placeholder="What\'s your name?" type="text" required>
						</div>
					    </div>
					    <div class="col-12 col-md-6">
						<div class="form-group">
						    <label>Email</label>
						    <input class="form-control" name="email" value="'.($_SESSION['USERDATA']['email'] ?? '').'" id="email" placeholder="Enter your email" type="email" required>
						</div>
					    </div>
					    <div class="col-12">
						<div class="form-group">
						    <label>Subject</label>
						    <input class="form-control" name="subject" id="subject" placeholder="" 
value="Hello, I\'m interested in your service, '.$data['serviceDetails'][0]['service_name'].'" required>
						</div>
					    </div>
					</div>
					<div class="form-group">
					    <label>Message</label>
					    <textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
					</div>
                                    <div class="mt-3">
					<div class="g-recaptcha d-inline" data-sitekey="'.RECAPTCHA_SITE_KEY.'" required></div>
                                        <button class="btn btn-primary solid blank float-right mt-3" type="submit">Send Message</button>
                                    </div>
				    </form>
				</div>
			    </div>
			</div>
			
		    </div>
		</div>
	    </section>

	';

	$sectorName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['serviceDetails'][0]['sector_name'])) );

        //checking if buyer has this added this product to their interest
	$interestBtn = '';
	if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

		$icon = 'far fa-star';
		if ($data['serviceDetails'][0]['is_interested'] == 1){

			$icon = 'fas fa-star';
		
		}

		$interestBtn = '
			<span class="float-right">
				<i class="'.$icon.' fa-lg interested-service text-warning" data-sid="'.encrypt($data['serviceDetails'][0]['id']).'"
				data-toggle="tooltip" data-placement="top" title="Interested"></i>
			</span>
		';

	}



        $html = '
            '.$this->banner($data['serviceDetails'][0]['service_name'], 
            '<li class="breadcrumb-item" aria-current="page"><a href="'.BASE_URL.'services">Services</a></li>'.
            '<li class="breadcrumb-item text-white" aria-current="page">Service Details</li>'
            ).'   

            <!-- Portfolio item start -->
            <section id="portfolio-item">
                <div class="container">
                    <!-- Portfolio item row start -->
                    <div class="row">
                        <!-- Portfolio item slider start -->
                        <div class="col-12 col-md-6 col-lg-6 my-auto text-center">
				<div class="service-content">
					<span class="service-icon icon-pentagon" >
						<i class="'.$data['serviceDetails'][0]['sub_service_category_icon'].'"></i>
					</span>
				</div>
                        </div>
                        <!-- Portfolio item slider end -->
                        <!-- sidebar start -->
                        <div class="col-12 col-md-6 col-lg-6 pt-3 pt-md-0 about-message">
                            <div class="sidebar pr-3 pt-3">
                                <div class="portfolio-desc">
				    '.$interestBtn.'
                                    <h3 class="widget-title mb-2">'.$data['serviceDetails'][0]['service_name'].'</h3>
                                    <p class="mb-4">
                                    '.($data['serviceDetails'][0]['description'] ?? 'No Description available...').'
                                    </p>

                                    <h3 class="widget-title mb-2">Category</h3>
                                    <p class="mb-4">
					<a href="'.BASE_URL.'services/category/'.$serCat.'/'.encrypt($data['serviceDetails'][0]['service_category_id']).'">
					    '.$data['serviceDetails'][0]['service_category_name'].'
					</a>
                                    </p>

                                    <h3 class="widget-title mb-2">Sub Category</h3>
                                    <p class="mb-4">
					<a href="'.BASE_URL.'services/sub-category/'.$subSerCat.'/'.encrypt($data['serviceDetails'][0]['sub_service_category_id']).'">
					    '.$data['serviceDetails'][0]['sub_service_category_name'].'
					</a>
                                    </p>

					<!-- tags start -->
					<div class="widget widget-tags mt-2 mb-0">
						<h3 class="widget-title mb-0">Sector</h3>
						<ul class="unstyled clearfix">
							<li>
								<a href="'.BASE_URL.'sector/'.$sectorName.'/'.encrypt($data['serviceDetails'][0]['sector_id']).'" class="h4">
									<i class="fas fa-tag"></i> '.$data['serviceDetails'][0]['sector_name'].'
								</a>
							</li>
						</ul>
					</div><!-- tags end -->

                                </div>
                            </div>
                        </div>
                        <!-- sidebar end -->
                    </div><!-- Portfolio item row end -->
                </div><!-- Container end -->
            </section><!-- Portfolio item end -->
            
	    <section class="mt-0 pt-0">            
		    <div class="row about-wrapper-bottom">
			<div class="col-md-6 ts-padding about-img d-flex" style="height:300px;">
			    <img src="'.BASE_URL.$data['companyDetails'][0]['logo_img'].'" class="mx-auto my-auto img-fluid shadow-lg rounded" alt="client">
			</div>
			<!--/ About image end -->
			<div class="col-md-6 ts-padding about-message">
			
			    <div class="heading pb-4">
				<span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
				<h2 class="title">'.$data['companyDetails'][0]['company_name'].'<span class="title-desc">
				<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'">
					<i class="fa fa-link"></i> 
						Check out our profile!
				</a>
				</span>
				</h2>
			    </div>

			    <p>
			    '.$data['companyDetails'][0]['description'].'
			    </p>
			    <ul class="unstyled arrow">
				'.( (isset($data['companyDetails'][0]['website_link']))? '<li><a href="'.$data['companyDetails'][0]['website_link'].'"><i class="fa fa-globe info"></i> '.$data['companyDetails'][0]['website_link'].'</a></li>' : '' ).'
				<li><a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($data['companyDetails'][0]['company_id']).'#company-services"><i class="fa fa-hand-holding-box info"></i> See Services</a></li>
				<li><a href="#main-container"><i class="fa fa-envelope info"></i> Contact</a></li>
			    
			    </ul>
			</div>
			<!--/ About message end -->
		    </div>
		</section>
		'.$contactSection.'
        ';
        return $html;
    }
    //Displays info about a company
    public function companyDetails($data = array()){
        
        $socialOptions = '';
	$socialMediaInfo = '';
	$productLink = '';
        $exportList = '';
	$localInfo = '';
	$exportInfo = '';
        $sectorInfo = '';
	
	$items = '';
	$moreCompanyInfo = '';
	if ($data['companyDetails'][0]['company_type_id'] == 1){
		//music 

		if (!empty($data['musics'])){

			foreach($data['musics'] as $music){

				$mName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music['name'])) );

				$allMusic .= '
					<li><a href="'.BASE_URL.'music/'.$mName.'/'.encrypt($music['id']).'" class="h4">
						<i class="fa fa-music"></i> '.$music['name'].'
					</a></li>
				';
			}

			$moreCompanyInfo = '
				<!-- tags start -->
				<div class="widget widget-tags mb-0 mt-2" id="company-music">
					<h3 class="widget-title mb-0">Music</h3>
					<ul class="unstyled clearfix">
						'.$allMusic.'
					</ul>
				</div><!-- tags end -->
			';

		}

	}else if($data['companyDetails'][0]['company_type_id'] == 2){
		//products 

		$sectors = [];
		$sectorOptions = '';
		$products = '';
		$sectorTags = '';

		$industryServicedInfo = '';


		if (!empty($data['products']) ){

		    foreach ($data['products'] as $key => $product){

			$sectorClass = explode(' ', $product['sector_name']);
			$pName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );

			if(!in_array($product['sector_id'], $sectors)){
			    
			    $sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['sector_name'])) );

			    $sectorTags .='
				<span class="pr-2 pb-5">
				    <a href="'.BASE_URL.'sector/'.$sName.'/'.encrypt($product['sector_id']).'" class="badge badge badge-secondary mb-2">
					<label class="d-inline h6"><i class="fas fa-tag"></i> '.$product['sector_name'].'</label>
				    </a>
				</span>
			    ';
			    $sectorOptions .= '
				    <li><a href="#" data-filter=".'.$sectorClass[0].'_'.str_replace('=','',encrypt($product['sector_id'])).'">
					'.$product['sector_name'].'</a></li>
			    ';

			   array_push($sectors, $product['sector_id']);
			}
			if(!empty($product['productImages']) && isset($product['productImages'][0]['path'])){
			
			    $products .= '
				<div class="col-12 col-sm-6 col-md-4 col-lg-3 joomla isotope-item '.$sectorClass[0].'_'.str_replace('=','',encrypt($product['sector_id'])).'">
					<div class="grid p-0">
						<figure class="m-0 effect-oscar">
							<img class="product-img img-responsive" src="'.BASE_URL.$product['productImages'][0]['path'].'" alt="" style="height:235px;">
							<figcaption>
								<h3 class="pt-0 mt-2" >'.$product['product_name'].'</h3>
								<a class="link icon-pentagon" href="'.BASE_URL.'products/'.$pName.'/'.encrypt($product['product_id']).'"><i class="fa fa-link"></i></a>
							</figcaption>
						</figure>
					</div>
				</div>
			    ';
			    
			}
		    }
			$items = '
			    <!-- Company Products start -->
			    <section id="company-products" class="portfolio portfolio-box">
				<div class="container">
				    <div class="row">
					<div class="col-md-12 heading text-center">
					    <span class="icon-pentagon wow bounceIn"><i class="fa fa-shopping-cart"></i></span>
					    <h2 class="title2">Company Products
						<span class="title-desc">Check out the different products made by '.$data['companyDetails'][0]['company_name'].'</span>
					    </h2>
					</div>
				    </div> <!-- Title row end -->

				    <!--Isotope filter start -->
				    <div class="row text-center" >
					<div class="col-12">
					    <div class="isotope-nav" data-isotope-nav="isotope">
						<ul>
						    <li><a href="#" class="active" data-filter="*">All</a></li>
						    '.$sectorOptions.'
						</ul>
					    </div>
					</div>
				    </div><!-- Isotope filter end -->

				    <div id="isotope" class="row isotope">
					'.$products.'
				    </div><!-- Content row end -->
				</div><!-- Container end -->
			    </section><!-- Portfolio end -->

			';

			$sectorInfo = '
			    <h3 class="widget-title mb-1">Sectors</h3>
				<div class="pb-2">
				    '.$sectorTags.'
				</div>

			';

			$productLink = '
				<li><a href="#company-products"><i class="fa fa-shopping-cart"></i> See Products</a></li>
			';
		}
		if ($data['companyDetails'][0]['trade_type'] != 'export'){
			//company supplies locally
		    $localInfo = '
			    <h4 class="widget-title text-success">Supplies Products Locally Too</h4>
		    ';

		}

	}else if ($data['companyDetails'][0]['company_type_id'] == 3){
		//services
	
		$serviceCat = [];
		$sectors = [];
		$serviceCatOptions = '';
		$services = '';
		$secviceCatTags = '';

		if (!empty($data['services'])){

			$productLink = '
				<li><a href="#company-services"><i class="fa fa-hand-holding-box"></i> See all services</a></li>
			';

		    foreach ($data['services'] as $key => $service){

		        $sName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['service_name'])) );

			$serviceClass = explode(' ', $service['service_category_acronym']);

			//getting sectors 
			if(!in_array($service['sector_id'], $sectors)){
			    
			        $sectorName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['sector_name'])) );
				$sectorTags ='
					<span class="pr-2 pb-5">
					    <a href="'.BASE_URL.'sector/'.$sectorName.'/'.encrypt($service['sector_id']).'" class="badge badge badge-secondary mb-2">
						<label class="d-inline h6"><i class="fas fa-tag"></i> '.$service['sector_name'].'</label>
					    </a>
					</span>
				';
				
			    array_push($sectors , $service['sector_id']);
			}

			if(!in_array($service['service_category_id'], $serviceCat)){
			    
			    $serviceCatOptions .= '
				    <li><a href="#" data-filter=".'.$serviceClass[0].'_'.str_replace('=','',encrypt($service['service_category_id'])).'">
					'.$service['service_category_acronym'].'</a></li>
			    ';

			    array_push($serviceCat, $service['service_category_id']);
			}
			    $services .= '

					<div class="col-12 col-md-6 col-lg-3 isotope-item '.$serviceClass[0].'_'.str_replace('=','',encrypt($service['service_category_id'])).' text-center">
						<div class="service-content text-center">
							<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($service['id']).'" class="text-dark">
								<span class="service-icon icon-pentagon"><i class="'.$service['sub_service_category_icon'].'"></i></span>
							</a>
							<h3>
								<a href="'.BASE_URL.'services/'.$sName.'/'.encrypt($service['id']).'" class="text-dark">
									'.$service['service_name'].'
								</a>
							</h3>
							<h5>
									'.$service['sub_service_category_name'].'
							</h5>
						</div>
					</div>

			    ';

		    }

			$items = '
			    <!-- Company Products start -->
			    <section id="company-services" class="portfolio portfolio-box">
				<div class="container">
				    <div class="row">
					<div class="col-md-12 heading text-center">
					    <span class="icon-pentagon wow bounceIn"><i class="fa fa-hand-holding-box"></i></span>
					    <h2 class="title2">Company Services
						<span class="title-desc">Check out the different services provided by '.$data['companyDetails'][0]['company_name'].'</span>
					    </h2>
					</div>
				    </div> <!-- Title row end -->

				    <!--Isotope filter start -->
				    <div class="row text-center" >
					<div class="col-12">
					    <div class="isotope-nav" data-isotope-nav="isotope">
						<ul>
						    <li><a href="#" class="active" data-filter="*">All</a></li>
						    '.$serviceCatOptions.'
						</ul>
					    </div>
					</div>
				    </div><!-- Isotope filter end -->

				    <div id="isotope" class="row isotope">
					'.$services.'
				    </div><!-- Content row end -->
				</div><!-- Container end -->
			    </section><!-- Portfolio end -->

			';

			$industryServicedInfo = '
			    <h3 class="widget-title mb-1">Industries Serviced</h3>
				<div class="pb-2">
				    '.($data['companyDetails'][0]['industry_serviced'] ?? 'N/a').'
				</div>

			';
			$sectorInfo = '
			    <h3 class="widget-title mb-1">Sector</h3>
				<div class="pb-2">
				    '.$sectorTags.'
				</div>

			';


		}


		if ($data['companyDetails'][0]['trade_type'] != 'export'){
			//company supplies locally
		    $localInfo = '
			    <h4 class="widget-title text-success">Provides Service Locally Too</h4>
		    ';

		}

	}else{
		//company type doest exist
		$items = '';
		
	}



        if ($data['companyDetails'][0]['trade_type'] != 'local' && (!empty($data['exportMarketList']) && !empty($data['exportMarkets'])) ){

            //getting all business selected export markets
            foreach($data['exportMarketList'] as $exportMarketList){

                foreach($data['exportMarkets'] as $exportMarket){

		    $emName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($exportMarket['name'])) );

                    if ($exportMarketList['export_market_id'] == $exportMarket['id']){
                        $exportList .= '
				<li><a href="'.BASE_URL.'products/export-market/'.$emName.'/'.encrypt($exportMarket['id']).'" class="h4">
					<i class="fa fa-truck"></i> '.$exportMarket['name'].'
				</a></li>
                        ';
                    }
                }
            }

	    $exportInfo = '
					<!-- tags start -->
					<div class="widget widget-tags mb-0 mt-2">
						<h3 class="widget-title mb-0">Export To</h3>
						<ul class="unstyled clearfix">
							'.$exportList.'
						</ul>
					</div><!-- tags end -->

	    ';

        }            

        if (!empty($data['socialContactList'])){
                
	    foreach($data['socialContactList'] as $socialContact){
                    if(isset($socialContact['link']) && trim($socialContact['link']) != '' ){
                        $socialOptions .= '
                            <a title="'.$socialContact['social_contact_name'].'" href="'.$socialContact['link'].'" data-toggle="tooltip" data-placement="top">
                                <span class="icon-pentagon wow bounceIn"><i class="'.$socialContact['icon'].'"></i></span>
                            </a>
                        ';
                    }
            }
		$socialMediaInfo = '
                    <h4 class="text-dark">Social Media</h4>
                        <div class="d-flex justify-content-start pb-3">
                            <ul class="dark unstyled text-center">
                                <li>
                            '.$socialOptions.'
                                </li>
                            </ul>
                        </div>
		     <br>

		';
        }

	//the contact form for a company
	$contactForm = '
		<div class="col-md-7">
		    <div class="card shadow" >
			<div class="card-body">
			    <h3 class="card-title">Connect With Us!</h3>
			    <form id="contact-form" action="'.BASE_URL.'" method="post" role="form">

				<input name="action" type="hidden" value="contactCompany">
				<input name="cId" type="hidden" value="'.encrypt($data['companyDetails'][0]['company_id']).'">

				<div class="row">
				    <div class="col-12 col-md-6">
					<div class="form-group">
					    <label>Name</label>
					    <input class="form-control" name="name" value="'.($_SESSION['USERDATA']['full_name'] ?? '').'" id="name" placeholder="What\'s your name?" type="text" required>
					</div>
				    </div>
				    <div class="col-12 col-md-6">
					<div class="form-group">
					    <label>Email</label>
					    <input class="form-control" name="email" id="email" value="'.($_SESSION['USERDATA']['email'] ?? '').'" placeholder="Enter your email" type="email" required>
					</div>
				    </div>
				    <div class="col-12">
					<div class="form-group">
					    <label>Subject</label>
					    <input class="form-control" name="subject" id="subject" placeholder="Enter a subject here..." required>
					</div>
				    </div>
				</div>
				<div class="form-group">
				    <label>Message</label>
				    <textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
				</div>
                                <div class="mt-3">
					<div class="g-recaptcha d-inline" data-sitekey="'.RECAPTCHA_SITE_KEY.'" required></div>
                                        <button class="btn btn-primary solid blank float-right mt-3" type="submit">Send Message</button>
                                </div>
			    </form>
			</div>
		    </div>
		</div>

	';

        //checking bookmark if user is looked in as buyer
	$bookmarkBtn = '';
	if (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer'){

		$icon = 'far fa-bookmark';
		if ($data['companyDetails'][0]['is_bookmarked'] == 1){

			$icon = 'fad fa-bookmark';
		
		}

		$bookmarkBtn = '
			<span class="float-right">
				<i class="'.$icon.' fa-lg bookmark-company text-dark" data-cid="'.encrypt($data['companyDetails'][0]['company_id']).'"
				data-toggle="tooltip" data-placement="top" title="Bookmark"></i>
			</span>
		';

	}
        $html = '
            '.$this->banner($data['companyDetails'][0]['company_name'], 
            '<li class="breadcrumb-item"><a href="'.BASE_URL.'company-profiles">Companies</a></li>'.
	    '<li class="breadcrumb-item text-white" aria-current="page">Company Details</li>').'   
            
	    <section class="mt-0 pt-0">            
		    <div class="row about-wrapper-bottom">
			<div class="col-12 col-md-6 ts-padding about-img d-flex">
			    <img src="'.BASE_URL.$data['companyDetails'][0]['logo_img'].'" class="mx-auto my-auto img-fluid shadow-lg rounded" style="max-width:100%;width:auto;"  alt="logo">
			</div>
			<!--/ About image end -->
			<div class="col-12 col-md-6 ts-padding about-message">
			<div class="heading pb-4">
			    '.$bookmarkBtn.'
			    <span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
			    <h2 class="title">'.$data['companyDetails'][0]['company_name'].'<span class="title-desc">Thanks for Check out our profile!</span></h2>
			</div>
			    <p>
			    '.$data['companyDetails'][0]['description'].'
			    </p>
			    <ul class="unstyled arrow pb-3">
				'.( (isset($data['companyDetails'][0]['website_link']))? '<li><a href="'.$data['companyDetails'][0]['website_link'].'"><i class="fa fa-globe info"></i> '.$data['companyDetails'][0]['website_link'].'</a></li>' : '' ).'
				'.$productLink.'
				<li><a href="#main-container-2"><i class="fa fa-envelope"></i> Contact</a></li>
			    
			    </ul>
			      '.$moreCompanyInfo.'
			      '.$industryServicedInfo.'
			      '.$sectorInfo.'
			      '.$exportInfo.'
			      '.$socialMediaInfo.'
			      '.$localInfo.'
			</div>
			<!--/ About message end -->
		    </div>
	    </section>
		'.$items.'

            <section id="main-container-2">
                <div class="container" ">
                    <div class="row">
			'.$contactForm.'
                        <div class="col-md-5">
                            <div class="contact-info">
                                <h3>Point of Contact</h3>
                                <p>Feel free to contact the company if you need any more information.</p>
                                <br>
                                '.(isset($data['pointOfContact'][0]['first_name'])? '<p><i class="fas fa-user-tie info"></i> '.ucfirst($data['pointOfContact'][0]['first_name']??'N/a').' '.ucfirst($data['pointOfContact'][0]['last_name']??'N/a').', '.ucfirst($data['pointOfContact'][0]['position'] ?? 'N/a').' </p>' : '' ).'

                                '.(isset($data['pointOfContact'][0]['email'])? '<p><i class="fa fa-envelope info"></i> <a href="mailto:'.($data['pointOfContact'][0]['email'] ?? '#').'">'.($data['pointOfContact'][0]['email'] ?? 'N/a').'</a></p>' : '' ).'
                                '.(isset($data['pointOfContact'][0]['phone'])? '<p><i class="fa fa-phone info"></i> +(501) '.$data['pointOfContact'][0]['phone'].'</p>' : '' ).'

                                '.(isset($data['companyDetails'][0]['phone'])? '<p><i class="fas fa-phone-office info"></i> +(501) '.$data['companyDetails'][0]['phone'].'</p>' : '' ).'

                                '.(isset($data['companyDetails'][0]['address'])? '<p><i class="fa fa-home info"></i> '.$data['companyDetails'][0]['address'].', '.$data['companyDetails'][0]['ctv'].', '.$data['companyDetails'][0]['district'].' </p>' : '' ).'
                                
                                '.(isset($data['companyDetails'][0]['website_link'])? ' <p><i class="fa fa-globe info"></i> <a href="'.$data['companyDetails'][0]['website_link'].'">'.$data['companyDetails'][0]['website_link'].'</a></p>' : '' ).'
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        ';
        return $html;
    }
    //Displays info about EXPORTBelize as static information   
    public function aboutUs(){
        $html = '
            '.$this->banner('About Us',
            '<li class="breadcrumb-item text-white" aria-current="page">About Us</li>'
            ).'
            
            <!-- Main container start -->
            <section id="main-container">
                <div class="container">
            
                    <!-- Company Profile -->
                    <div class="row">
                        <div class="col-md-12 heading">
                            <span class="title-icon classic float-left"><i class="fa fa-building"></i></span>
                            <h2 class="title classic">ExportBelize</h2>
                        </div>
                    </div><!-- Title row end -->
            
                    <div class="row landing-tab">
                        <div class="col-md-3 col-sm-5">
                            <div class="nav flex-column nav-pills border-right" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="animated fadeIn nav-link py-4 active d-flex align-items-center" data-toggle="pill" href="#tab_1"
                                    role="tab" aria-selected="true">
                                    <i class="fa fa-info-circle mr-4"></i>
                                    <span class="h4 mb-0 font-weight-bold">Who Are We</span>
                                </a>
                                <a class="animated fadeIn nav-link py-4 d-flex align-items-center" data-toggle="pill" href="#tab_3" role="tab"
                                    aria-selected="true">
                                    <i class="fa fa-eye mr-4"></i>
                                    <span class="h4 mb-0 font-weight-bold">Our Vision</span>
                                </a>
                                <a class="animated fadeIn nav-link py-4 d-flex align-items-center" data-toggle="pill" href="#tab_2" role="tab"
                                    aria-selected="true">
                                    <i class="fa fa-bullseye mr-4"></i>
                                    <span class="h4 mb-0 font-weight-bold">Our Mission</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-7">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane pl-sm-5 fade show active animated fadeInLeft" id="tab_1" role="tabpanel">
                                    <h3>We Are EXPORTBelize</h3>
                                    <p>A unit of the Belize Trade and Investment Development Service (BELTRAIDE), 
                                    which is a statutory body of the Government of Belize under the Ministry of Economic Development,
                                    Petroleum, Investment, Trade & Commerce. EXPORTBelize provides customized needs based services in
                                    the areas of export development and promotion.</p>
                                </div>
                                <div class="tab-pane pl-sm-5 fade animated fadeInLeft" id="tab_3" role="tabpanel">
                                    <h3>Our Vision is</h3>
                                    <p>Enabling a dynamic and competitive export sector that is founded on principles of quality, innovation
                                    and customer orientation.</p>
                                </div>
                                <div class="tab-pane pl-sm-5 fade animated fadeInLeft" id="tab_2" role="tabpanel">
                                    <h3>Our Mission is</h3>
                                    <p>To foster an enabling environment that promotes diversification and competitiveness of Belize’s export sector.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Content row end -->
                </div>
                <!--/ 1st container end -->
            
            
                <div class="gap-60"></div>
            
                <!-- Counter Strat -->
                <div class="ts_counter_bg parallax parallax2">
                    <div class="parallax-overlay"></div>
                    <div class="container">
                        <div class="row wow fadeInLeft text-center">
                            <div class="facts col-md-3 col-sm-6">
                                <span class="facts-icon"><i class="fa fa-user"></i></span>
                                <div class="facts-num">
                                    <span class="counter">1200</span>
                                </div>
                                <h3>Clients</h3>
                            </div>
            
                            <div class="facts col-md-3 col-sm-6">
                                <span class="facts-icon"><i class="fa fa-institution"></i></span>
                                <div class="facts-num">
                                    <span class="counter">1277</span>
                                </div>
                                <h3>Item Sold</h3>
                            </div>
            
                            <div class="facts col-md-3 col-sm-6">
                                <span class="facts-icon"><i class="fa fa-suitcase"></i></span>
                                <div class="facts-num">
                                    <span class="counter">869</span>
                                </div>
                                <h3>Projects</h3>
                            </div>
            
                            <div class="facts col-md-3 col-sm-6">
                                <span class="facts-icon"><i class="fa fa-trophy"></i></span>
                                <div class="facts-num">
                                    <span class="counter">76</span>
                                </div>
                                <h3>Awwards</h3>
                            </div>
            
                            <div class="gap-40"></div>
            
                            <!--<div class="col-12 text-center"><a href="#" class="btn btn-primary solid">See Our Portfolio</a></div>-->
            
                        </div>
                        <!--/ row end -->
                    </div>
                    <!--/ Container end -->
                </div>
                <!--/ Counter end -->
            
                <div class="gap-60"></div>
            
            
                <div class="container">
                    <!-- 2nd container start -->
            
                    <!-- Team start -->
                    <div class="team">
            
                        <div class="row">
                            <div class="col-md-12 heading">
                                <span class="title-icon classic float-left"><i class="fab fa-weixin"></i></span>
                                <h2 class="title classic">Meet with our Team</h2>
                            </div>
                        </div><!-- Title row end -->
            
                        <div class="row text-center">
                            <div class="col-md-3 col-sm-6">
                                <div class="team wow slideInLeft">
                                    <div class="img-hexagon">
                                        <img src="'.BASE_URL.'images/team/team1.jpg" alt="">
                                        <span class="img-top"></span>
                                        <span class="img-bottom"></span>
                                    </div>
                                    <div class="team-content">
                                        <h3>Full Name</h3>
                                        <p>Job Title</p>
                                        <div class="team-social">
                                            <a class="fb" href="#"><i class="fab fa-facebook"></i></a>
                                            <a class="twt" href="#"><i class="fab fa-twitter"></i></a>
                                            <a class="linkdin" href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Team 1 end -->
                            <div class="col-md-3 col-sm-6">
                                <div class="team wow slideInLeft">
                                    <div class="img-hexagon">
                                        <img src="'.BASE_URL.'images/team/team2.jpg" alt="">
                                        <span class="img-top"></span>
                                        <span class="img-bottom"></span>
                                    </div>
                                    <div class="team-content">
                                        <h3>Full Name</h3>
                                        <p>Job Title</p>
                                        <div class="team-social">
                                            <a class="fb" href="#"><i class="fab fa-facebook"></i></a>
                                            <a class="twt" href="#"><i class="fab fa-twitter"></i></a>
                                            <a class="linkdin" href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Team 2 end -->
                            <div class="col-md-3 col-sm-6">
                                <div class="team wow slideInRight">
                                    <div class="img-hexagon">
                                        <img src="'.BASE_URL.'images/team/team3.jpg" alt="">
                                        <span class="img-top"></span>
                                        <span class="img-bottom"></span>
                                    </div>
                                    <div class="team-content">
                                        <h3>Full Name</h3>
                                        <p>Job Title</p>
                                        <div class="team-social">
                                            <a class="fb" href="#"><i class="fab fa-facebook"></i></a>
                                            <a class="twt" href="#"><i class="fab fa-twitter"></i></a>
                                            <a class="linkdin" href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Team 3 end -->
                            <div class="col-md-3 col-sm-6">
                                <div class="team animate wow slideInRight">
                                    <div class="img-hexagon">
                                        <img src="'.BASE_URL.'images/team/team4.jpg" alt="">
                                        <span class="img-top"></span>
                                        <span class="img-bottom"></span>
                                    </div>
                                    <div class="team-content">
                                        <h3>Full Name</h3>
                                        <p>Job Title</p>
                                        <div class="team-social">
                                            <a class="fb" href="#"><i class="fab fa-facebook"></i></a>
                                            <a class="twt" href="#"><i class="fab fa-twitter"></i></a>
                                            <a class="linkdin" href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Team 4 end -->
                        </div>
                        <!--/ Content row end -->
            
                    </div><!-- Team end -->
            
                </div><!-- 2nd container end -->
            </section>
            <!--/ Main container end -->

            <section id="image-block" class="image-block p-0">
		<div class="container-fluid" id="company-requirements">
			<div class="row">
				<div class="col-md-6 ts-padding"
					style="height:650px;background:url(images/image-block-bg.jpg) 50% 50% / cover no-repeat;">
				</div>
				<div class="col-md-6 ts-padding img-block-right">
					<div class="img-block-head text-center">
						<h2>How to get your company approved</h2>
						<h3>Requirements</h3>
						<p>
							Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
							Proin gravida nibh vel velit auctor Aenean sollicitudin, adipisicing elit sed lorem quis bibendum auctor.
						</p>
					</div>

					<div class="gap-30"></div>

					<div class="image-block-content">
						<span class="feature-icon float-left"><i class="fas fa-map-marker-alt"></i></span>
						<div class="feature-content">
							<h3>Located in Belize</h3>
							<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut</p>
						</div>
					</div>
					<!--/ End 1st block -->

					<div class="image-block-content">
						<span class="feature-icon float-left"><i class="fa fa-diamond"></i></span>
						<div class="feature-content">
							<h3>Example #2</h3>
							<p>Proin gravida nibh vel velit auctor Aenean sollicitudin adipisicing</p>
						</div>
					</div>
					<!--/ End 1st block -->

					<div class="image-block-content">
						<span class="feature-icon float-left"><i class="fa fa-street-view"></i></span>
						<div class="feature-content">
							<h3>Example #4</h3>
							<p>Simply dummy text and typesettings industry has been the industry</p>
						</div>
					</div>
					<!--/ End 1st block -->
				</div>
			</div>
		</div>
	</section>
        ';
        return $html;
    }
    public function pageNotFound(){
        $html = '
       
            '.$this->banner('Page not Found', 
            '').'   
        
        <!-- Main container start -->
        <section id="main-container">
            <div class="container">
                <div class="error-page text-center">
                    <div class="error-code">
                        <strong>404</strong>
                    </div>
                    <div class="error-message">
                        <h3>Oops... Page Not Found!</h3>
                    </div>
                    <div class="error-body">
                        Try using the button below to go to main page of the site <br />
                        <a href="'.BASE_URL.'" class="btn btn-primary solid blank"><i class="fa fa-arrow-circle-left">&nbsp;</i> Go to
                            Home</a>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Main container end -->
        
        ';
        return $html;
    }
    // Displays a signIn section
    public function signIn($message = null){
             
        $html = '
            '.$this->banner('Sign In', 
            '<li class="breadcrumb-item text-white" aria-current="page">Sign In</li>'
            ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6 mx-auto">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class="card-title">Welcome Back!</h3>
                                    '.($message ?? '').'
                                    <form action="'.BASE_URL.'index.php" method="POST">
                                        <input type="hidden" name="action" value="signIn">
                                        <div class="row">
					    <div class="col-12 form-group">
						    <label for="inputEmail3">Email</label>
						    <input type="email" class="form-control" name="email" placeholder="Enter your account email..." required>
					    </div>
                                        </div>
                                        <div class="row">
					    <div class="col-12 form-group">
						    <label for="inputPassword3">Password</label>
						    <input type="password" name="password" class="form-control" id="pass" placeholder="**********" required>
					    </div>
                                        </div>                                      
                                        <div class="row mb-3">
                                            <div class="col-12 mb-3">
						<span class="float-right">
							<input type="checkbox" onclick="myFunction()"> Show Password
						</span>
						<span class="float-left">
					     	    <a class="card-link" href="'.BASE_URL.'forgot-password" >Forgot Password?</a>
						</span>
					    </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 mb-3">
						    <button type="submit" class="btn btn-primary btn-block solid blank square">Sign in</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
						    <div class="separator h5 mb-3">Don\'t have an account?</div>
                                                    <a href="'.BASE_URL.'registration/buyer" class="btn btn-primary btn-block square"><i class="fa fa-user"></i> Buyer Registration</a>
                                                    <a href="'.BASE_URL.'registration/company" class="btn btn-primary btn-block square"><i class="fa fa-building"></i> Company Registration</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>

        ';
        return $html;
    }
    public function editSuperUserInfo($data = []){
       
        $fullName = explode(' ',$data['suInfo'][0]['full_name']);

        $html = $this->banner('Edit Super User', 
	      '<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>'.
	      '<li class="breadcrumb-item text-white" aria-current="page">Edit Super User Info</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
				'.($data['message'] ?? '').'
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i>Super User Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="editSuInfo">
                                        <input type="hidden" name="suId" value="'.encrypt($data['suInfo'][0]['id']).'">
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" id="" name="firstName" placeholder="Enter your first name..." value="'.$fullName[0].'" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" id="" name="lastName" placeholder="Enter your last name..." value="'.$fullName[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
						    <label for="validationDefault02">Email</label>
						    <input type="Email" class="form-control" name="email" placeholder="Enter email..." value="'.$data['suInfo'][0]['email'].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }

    public function editAdminInfo($data = []){
       
        $fullName = explode(' ',$data['adminInfo'][0]['full_name']);

        $html = $this->banner('Edit Admin', 
	      '<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>'.
	      '<li class="breadcrumb-item text-white" aria-current="page">Edit Admin Info</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
				'.($data['message'] ?? '').'
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i>Admin Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="editAdminInfo">
                                        <input type="hidden" name="aId" value="'.encrypt($data['adminInfo'][0]['id']).'">
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" name="firstName" placeholder="Enter your first name..." value="'.$fullName[0].'" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" name="lastName" placeholder="Enter your last name..." value="'.$fullName[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
						    <label for="validationDefault02">Email</label>
						    <input type="Email" class="form-control" name="email" placeholder="Enter email..." value="'.$data['adminInfo'][0]['email'].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }

    public function editBuyerInfo($data = null){
       
        $fullName = explode(' ',$data['buyerInfo'][0]['full_name']);

        $html = $this->banner('Edit Buyer', 
	      '<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>'.
	      '<li class="breadcrumb-item text-white" aria-current="page">Edit Buyer Info</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
				'.($data['message'] ?? '').'
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i>Buyer Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="editBuyerInfo">
                                        <input type="hidden" name="bId" value="'.encrypt($data['buyerInfo'][0]['user_id']).'">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" id="" name="firstName" placeholder="Enter your first name..." value="'.$fullName[0].'" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" id="" name="lastName" placeholder="Enter your last name..." value="'.$fullName[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group mt-2">
                                                    <p>'.$data['buyerInfo'][0]['buyer_email'].'</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Business Name<sub>(Optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="text" name="company_name" class="form-control" value="'.$data['buyerInfo'][0]['business_name'].'" placeholder="Enter your company...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }

    public function editCompanyInfo($data = []){

	$moreCompanyInput = '';
	$cTypeId = $data['companyDetails'][0]['company_type_id'] ?? 0;

	if ($cTypeId == 1){
	//music
		$moreCompanyInput = '';

	}else if ($cTypeId == 2){
	//products
		$moreCompanyInput = '';

	}else if ($cTypeId == 3){
	// services

		$moreCompanyInput = '

		    <div class="col-md-6 col-12 mb-3">
			<label for="email">Current Seat Capacity<sub>(Optional)</sub></label>
			<div class="input-group">
			    <input type="number" min="1"  name="companyDetail[seatCapacity]" class="form-control" value="'.($data['companyDetails'][0]['current_seat_capacity'] ?? 0).'">
			</div>
		    </div>
		    <div class="col-md-6 col-12 mb-3">
			<label for="email">Expansion Potential<sub>(optional)</sub></label>
			<div class="input-group">
			    <input type="number" min="1"  name="companyDetail[expansionPotential]" class="form-control" value="'.($data['companyDetails'][0]['expansion_potential'] ?? 0).'">
			</div>
		    </div>
		';

		
	}else{
	// type doesnt exist
	
		$moreCompanyInput = '';

	}

        $options = '';
	//getting all the company types for listing as options
	if (empty($data['companyTypes'])){

            $options = '
                <option value="0" disabled>No business types found</option>
            ';

	}else{

		foreach ($data['companyTypes'] as $type){
		    $options .= '
			<option value="'.encrypt($type['id']).'" '.($cTypeId == $type['id'] ? 'selected' : '').'>'.$type['display_name'].'</option>
		    ';
		}

	}

	//generationg export market section if applicable
	$addBtn = '';
	$exportMarketSection = '';
        if ($data['companyDetails'][0]['trade_type'] != 'local' && $cTypeId == 2){
	    // export markets only available to product supplier

            $exportMarketFields = '';
            $exportMarketOptions = '';
	    $emlCount = count($data['exportMarketList'] ?? 0);
	    $emCount  = count($data['exportMarkets'] ?? 0);

	    if ($emlCount < $emCount){
			$addBtn = '
			    <button id="add-export-market" class="btn bs-btn-primary mt-3" data-cid="'.encrypt($data['companyDetails'][0]['company_id']).'">
				<i class="fa fa-plus"></i> Add Export Market
			    </button>
			';
	    }

	    $exportMarketFields = '';
            //getting all business selected export markets
            foreach($data['exportMarketList'] as $exportMarketList){
                
                $selectOption = '';
                $exportMarketListId = '';

                foreach($data['exportMarkets'] as $exportMarket){
                    if ($exportMarketList['export_market_id'] == $exportMarket['id']){

                        $exportMarketListId = encrypt($exportMarketList['id']);
                        $selectOption .= '
                            <input type="text" class="form-control" value="'.$exportMarket['name'].'" readonly/>
                        ';

                    }
                }
                $exportMarketFields .= '
                    <div class="col-12 mb-3">
			<div class="input-group">
				'.$selectOption.'
			  <div class="input-group-append">
                                <button class="remove-export-market btn btn-danger" value="'.$exportMarketListId.'"><i class="fa fa-minus"></i></button>
			  </div>
			</div>
                    </div>
                ';

            }

		$exportMarketSection = '
                            <div class="card shadow">
                                <div class="card-body">
                                    <h3 class="text-center mb-3"><i class="fa fa-truck title-icon text-primary mb-1"></i> 
					<span class="d-none d-lg-inline-block">Export Markets</span>
					<span class="d-block d-lg-none">Ex. Markets</span>
				    </h3>
					<div class="form-row" id="export-market-list">
						'.(($exportMarketFields != '')? ''.$exportMarketFields.'' :
						'
						    <div class="col-md-12 col-lg-12 col-12 mb-3">
							<label for="">No Export Markets selected!</label>
						    </div>
						').' 
					</div>
					<div id="export-market-btn-span" class="float-right">
						'.$addBtn.'
					</div>
                                </div>
                            </div>

		';
        }
        
        $socialOptions = '';
        $socialMediaList = '';
	//generating social network feilds
        if (isset($data['socialContacts'])){
            $index = 0;
            foreach($data['socialContacts'] as $socialContact){
                $id = 0;
                $val = '';
		if (!empty ($data['socialContactList'])){

			foreach($data['socialContactList'] as $key => $socialContactList){
			    if($socialContact['id'] == $socialContactList['social_contact_id']){
				$val = $socialContactList['link'];
				$id = $socialContactList['id'];
			    }
			}

		}

                $socialOptions .= '
                <div class="col-md-6 col-12 mb-3">
                    <label for="socialContact">'.$socialContact['name'].' Link <sub>(Optional)</sub></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="'.$socialContact['icon'].' fa-lg"></i></span>
                        </div>
                        <input type="hidden" name="socialContacts['.$index.'][socialContactListId]" value="'.encrypt($id).'">
                        <input type="hidden" name="socialContacts['.$index.'][socialContactId]" value="'.encrypt($socialContact['id']).'">
                        <input type="text" class="form-control" placeholder="Enter your '.$socialContact['name'].' link" name="socialContacts['.$index.'][link]" aria-label="SocialLink" aria-describedby="socialMediaLink" value="'.($val ?? '').'">
                    </div>
                </div>
                ';
                $index++;
            }
        }
     

        $html = $this->banner('Edit Company',
                              '<li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>'.
                              '<li class="breadcrumb-item text-white" aria-current="page">Edit Company Info</li>'
                              ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
		    '.($data['message'] ?? '').'
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <h3 class="mb-3 text-center text-lg-left"><i class="fa fa-building title-icon text-primary mb-1"></i> 
					<span class="d-none d-lg-inline-block">Company Profile</span>
					<span class="d-block d-lg-none">Company Info</span>
				    </h3>
                                    <form action="'.BASE_URL.'index.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="editCompanyInfo">
                                        <input type="hidden" id="c-id" name="companyDetail[companyId]" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
                                        <div class="form-row">
                                            <div class="col-12 mx-auto text-center ">
                                                
                                                <input type="hidden" name="logoPath" value="'.((isset($data['companyDetails'][0]['logo_img']))? $data['companyDetails'][0]['logo_img']: './images/business_icon.png' ) .'">
                                                <img id="business-logo" src="'.BASE_URL.((isset($data['companyDetails'][0]['logo_img']))? $data['companyDetails'][0]['logo_img']: './images/business_icon.png' ) .'" class="avatar rounded img-thumbnail" style="height:200px;width:auto;">
                                                <div class="p-image">
                                                    <a class="btn btn-link" href="#" id="upload-business-logo">
                                                    <i class="fas fa-folder-open"></i> Browse Logo
                                                    </a>
                                                    <a href="#" id="remove-company-logo" class="btn btn-link text-danger" style="'.((isset($data['companyDetails'][0]['logo_img']))? '': 'display: none' ) .'" >
                                                    <i class="fa fa-trash"></i> Remove
                                                    </a>
                                                    <input class="file-upload" name="businessLogo" type="file" accept=".jpg, .jpeg, .png" style="display: none;" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-dark pb-0">Profile</h3>
                                        <hr class="mt-0 pt-0">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationDefault01">Company Name</label>
                                                <input type="text" class="form-control" id="" name="companyDetail[name]" placeholder="Enter your company name..." value="'.($data['companyDetails'][0]['company_name'] ?? '').'" required>
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="supply-type">Company\'s main trade is...</label>
                                                <select id="supply-type" class="form-control" name="companyDetail[tradeArea]" required>
                                                    <option value="local" '.($data['companyDetails'][0]['trade_type'] == 'local'? 'selected' : '').'>Only in Belize</option>
                                                    <option value="export" '.($data['companyDetails'][0]['trade_type'] == 'export'? 'selected' : '').'>Only to other Countries</option>
                                                    <option value="both" '.($data['companyDetails'][0]['trade_type'] == 'both'? 'selected' : '').'>Belize and other Countries</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="">District</label>
                                                <select name="companyDetail[district]" class="form-control">
                                                    <option value="Corozal" '.(($data['companyDetails'][0]['district'] == 'Corozal')? 'selected' : '').'>Corozal</option>
                                                    <option value="Orange Walk" '.(($data['companyDetails'][0]['district'] == 'Orange Walk')? 'selected' : '').'>Orange Walk</option>
                                                    <option value="Belize" '.(($data['companyDetails'][0]['district'] == 'Belize')? 'selected' : '').'>Belize</option>
                                                    <option value="Cayo" '.(($data['companyDetails'][0]['district'] == 'Cayo')? 'selected' : '').' >Cayo</option>
                                                    <option value="Stann Creek" '.(($data['companyDetails'][0]['district'] == 'Stann Creek')? 'selected' : '').'>Stann Creek</option>
                                                    <option value="Toledo" '.(($data['companyDetails'][0]['district'] == 'Toldeo')? 'selected' : '').'>Toledo</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">City/Village/Town</label>
                                                <div class="input-group">
                                                    <input type="text" name="companyDetail[ctv]" class="form-control" value="'.($data['companyDetails'][0]['ctv'] ?? '').'" placeholder="Enter your company..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="address">Address</label>
                                                <div class="input-group">
                                                    <input type="text" name="companyDetail[address]" class="form-control" id="" value="'.($data['companyDetails'][0]['address'] ?? '').'" placeholder="Enter your company\'s street address..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Phone Number</label>
                                                <div class="input-group">
                                                    <input type="tel" name="companyDetail[phone]" class="form-control" value="'.($data['companyDetails'][0]['phone'] ?? '').'" placeholder="Enter your company\'s phone number..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Website Link<sub>(Optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyDetail[website]" value="'.($data['companyDetails'][0]['website_link'] ?? '').'" placeholder="Enter an company website link..." aria-describedby="inputGroupPrepend2" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Year Established<sub>(optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="number" max="'.date('Y').'"  name="companyDetail[establishedOn]" class="form-control" value="'.($data['companyDetails'][0]['established_on'] ?? 0).'"  aria-describedby="inputGroupPrepend2">
                                                </div>
                                            </div>
						'.$moreCompanyInput.'
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                                <label for="email">Tell us something about the company...<sub>Optional</sub></label>
                                                <textarea class="form-control" id="comp-desc" maxlength="350" name="companyDetail[description]" rows="6">'.($data['companyDetails'][0]['description'] ?? '').'</textarea>
						<span class="text-muted" id="comp-desc-count"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>

				    </form>

                                </div>
                            </div>

			    <!-- SOCIAL CONTACT SECTION -->
                            <div class="card shadow mb-3">
                                <div class="card-body">
				    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="updateSocialContacts">
                                        <input type="hidden" name="cId" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
					    <h3 class="text-center text-lg-left">
						<i class="fas fa-link title-icon text-primary mb-1"></i> 
						<span class="d-none d-lg-inline-block">Social Contact Links</span>
						<span class="d-inline-block d-lg-none">Social Links</span>
					    </h3>

					<div class="form-row">
						'.$socialOptions.'
					</div> 

                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>    
			<!-- end of first col -->

                        <div class="col-12 col-md-4 mb-3">
                            <div class="card shadow mb-3" >
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="POST">
					    <h3 class="text-center "><i class="fa fa-user title-icon text-primary mb-1"></i> <span class="d-none d-lg-inline-block">Point of Contact</span><span class="d-inline-block d-lg-none">PoC</span></h3>
					    <input type="hidden" name="action" value="updatePointOfContact">
                                            <input type="hidden" name="cId" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
                                            <input type="hidden" name="pocId" value="'.encrypt($data['pointOfContact'][0]['id'] ?? 0).'">
					    <div class="row">
						    <div class="col-12 mb-3">
							    <label for="validationDefault01">First name</label>
							    <input type="text" maxlength="150" class="form-control" name="fname" placeholder="Enter first name..." value="'.($data['pointOfContact'][0]['first_name'] ?? '').'" required>
					            </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Last name</label>
							    <input type="text" maxlength="150" class="form-control" name="lname" placeholder="Enter last name..." value="'.($data['pointOfContact'][0]['last_name'] ?? '').'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Position</label>
							    <input type="text" maxlength="150" class="form-control" name="position" placeholder="Enter current position..." value="'.($data['pointOfContact'][0]['position'] ?? '').'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Phone</label>
							    <input type="tel" class="form-control" name="phone" placeholder="Enter phone number..." value="'.($data['pointOfContact'][0]['phone'] ?? '').'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Email</label>
							    <input type="email" maxlength="200" class="form-control" name="email" placeholder="Enter your last name..." value="'.($data['pointOfContact'][0]['email'] ?? '').'" required>
						    </div>
					    </div>
					    <div class="col-12 text-right">
						    <button class="btn btn-success">
							<i class="fa fa-save"></i> Save
						    </button>
					    </div>
			            </form>
                                </div>
                            </div>


				'.$exportMarketSection.'

                           </div>





                    </div>
                </div>
            </section>
        ';
        return $html;
    }

    //displays user profile and company profile
    public function companyProfile($data = null){

        $marketListIds = '';
        $socialOptions = '';
        $socialMediaList = '';
	$exportMarketSection = '';
	
	$moreCompanyInput = '';
	$cTypeId = $data['companyDetails'][0]['company_type_id'] ?? 0;

	if ($cTypeId == 1){
	//music
		$moreCompanyInput = '';

	}else if ($cTypeId == 2){
	//products
		$moreCompanyInput = '';

		$exportMarketFields = '';
		$exportMarketOptions = '';
		$addBtn = '';

		if ($_SESSION['COMPANYDATA'][0]['trade_type'] != 'local'){

			$emlCount = count($data['exportMarketList'] ?? 0);
			$emCount  = count($data['exportMarkets'] ?? 0);
			
			if ($emlCount < $emCount){
			
				$addBtn = '
					    <button id="add-export-market" class="btn bs-btn-primary mt-3">
						<i class="fa fa-plus"></i> Add Export Market
					    </button>
				';
				
			}
		    //getting all business selected export markets
		    foreach($data['exportMarketList'] as $exportMarketList){
			
			$selectOption = '';
			$exportMarketListId = '';

			foreach($data['exportMarkets'] as $exportMarket){
			    if ($exportMarketList['export_market_id'] == $exportMarket['id']){

				$exportMarketListId = encrypt($exportMarketList['id']);
				$selectOption .= '
				    <input type="text" class="form-control" value="'.$exportMarket['name'].'" readonly/>
				';

			    }
			}
			$exportMarketFields .= '
			    <div class="col-12 mb-3">
				<div class="input-group">
					'.$selectOption.'
				  <div class="input-group-append">
					<button class="remove-export-market btn btn-danger" value="'.$exportMarketListId.'"><i class="fa fa-minus"></i></button>
				  </div>
				</div>
			    </div>
			';
		    }

		    $exportMarketSection = '
                            <div class="card shadow mt-3">
                                <div class="card-body">
                                    <h3 class="text-center mb-3"><i class="fa fa-truck title-icon text-primary mb-1"></i> 
					<span class="d-none d-lg-inline-block">Export Markets</span>
					<span class="d-block d-lg-none">Ex. Markets</span>
				    </h3>
					<div class="form-row" id="export-market-list">
						'.(($exportMarketFields != '')? ''.$exportMarketFields.'' :
						'
						    <div class="col-md-12 col-lg-12 col-12 mb-3">
							<label for="">No Export Markets selected!</label>
						    </div>
						').' 
					</div>
					<div id="export-market-btn-span" class="float-right">
						'.$addBtn.'
					</div>
                                </div>
                            </div>
		    ';
		}

	}else if ($cTypeId == 3){
	// services

		$moreCompanyInput = '

		    <div class="col-md-6 col-12 mb-3">
			<label for="email">Current Seat Capacity<sub>(Optional)</sub></label>
			<div class="input-group">
			    <input type="number" min="1"  name="companyDetail[seatCapacity]" class="form-control" value="'.($data['companyDetails'][0]['current_seat_capacity'] ?? 0).'">
			</div>
		    </div>
		    <div class="col-md-6 col-12 mb-3">
			<label for="email">Expansion Potential<sub>(optional)</sub></label>
			<div class="input-group">
			    <input type="number" min="1"  name="companyDetail[expansionPotential]" class="form-control" value="'.($data['companyDetails'][0]['expansion_potential'] ?? 0).'">
			</div>
		    </div>

		    <div class="col-12 mb-3">
			<label for="email">Industry Serviced</label>
			<textarea class="form-control" id="industry-serviced" maxlength="400" name="companyDetail[industryServiced]" rows="6">'.($data['companyDetails'][0]['industry_serviced'] ?? '').'</textarea>
			<span class="text-muted" id="industry-serviced-count"></span>
		    </div>

		';

		
	}else{
	// type doesnt exist
	
		$moreCompanyInput = '';

	}
        
        if (isset($data['socialContacts'])){
            $index = 0;
            foreach($data['socialContacts'] as $socialContact){
                $id = 0;
                $val = '';
		if (!empty ($data['socialContactList'])){

			foreach($data['socialContactList'] as $key => $socialContactList){
			    if($socialContact['id'] == $socialContactList['social_contact_id']){
				$val = $socialContactList['link'];
				$id = $socialContactList['id'];
			    }
			}

		}

                $socialOptions .= '
                <div class="col-md-6 col-12 mb-3">
                    <label for="socialContact">'.$socialContact['name'].' Link <sub>(Optional)</sub></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="'.$socialContact['icon'].' fa-lg"></i></span>
                        </div>
                        <input type="hidden" name="socialContacts['.$index.'][socialContactListId]" value="'.encrypt($id).'">
                        <input type="hidden" name="socialContacts['.$index.'][socialContactId]" value="'.encrypt($socialContact['id']).'">
                        <input type="text" class="form-control" placeholder="Enter your '.$socialContact['name'].' link" name="socialContacts['.$index.'][link]" aria-label="SocialLink" aria-describedby="socialMediaLink" value="'.($val ?? '').'">
                    </div>
                </div>
                ';
                $index++;
            }
        }
     
        //spliting full name
        $fullName = explode(' ',$_SESSION['USERDATA']['full_name']);

        $html = $this->banner('My Profile', 
            '<li class="breadcrumb-item text-white" aria-current="page">Profile</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
			'.($data['message'] ?? '').'
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="card shadow mb-3" >
                                <div class="card-body">
                                    <h3 class="card-title"><i class="fa fa-building fa-lg text-primary"></i> Company Profile</h3>
                                    <form action="'.BASE_URL.'index.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="editCompanyInfo">
                                        <input type="hidden" name="companyDetail[companyId]" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
                                        <div class="form-row">
                                            <div class="col-12 mx-auto text-center">
                                                
                                                <input type="hidden" name="logoPath" value="'.((isset($data['companyDetails'][0]['logo_img']))? $data['companyDetails'][0]['logo_img']: './images/business_icon.png' ) .'">
                                                <img id="business-logo" src="'.BASE_URL.((isset($data['companyDetails'][0]['logo_img']))? $data['companyDetails'][0]['logo_img']: './images/business_icon.png' ) .'" class="avatar rounded img-thumbnail" height="250px" width="200px" >
                                                <div class="p-image">
                                                    <a class="btn btn-link" href="#" id="upload-business-logo">
                                                    <i class="fa fa-folder-open"></i> Browse
                                                    </a>
                                                    <a href="#" id="remove-company-logo" class="btn btn-link text-danger" style="'.((isset($data['companyDetails'][0]['logo_img']))? '': 'display: none' ) .'" >
                                                    <i class="fa fa-trash"></i> Remove
                                                    </a>
                                                    <input class="file-upload" name="businessLogo" type="file" accept=".jpg, .jpeg, .png" style="display: none;"/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-dark pb-0">Company Info</h3>
                                        <hr>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationDefault01">Company Name</label>
                                                <input type="text" class="form-control" id="" name="companyDetail[name]" placeholder="Enter your company name..." value="'.($data['companyDetails'][0]['company_name'] ?? '').'" required>

                                            </div>

                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="address">Address</label>
                                                <div class="input-group">
                                                    <input type="text" name="companyDetail[address]" class="form-control" id="" value="'.($data['companyDetails'][0]['address'] ?? '').'" placeholder="Enter your company\'s street address..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="">District</label>
                                                <select name="companyDetail[district]" class="form-control">
                                                    <option value="Corozal" '.(($data['companyDetails'][0]['district'] == 'Corozal')? 'selected' : '').'>Corozal</option>
                                                    <option value="Orange Walk" '.(($data['companyDetails'][0]['district'] == 'Orange Walk')? 'selected' : '').'>Orange Walk</option>
                                                    <option value="Belize" '.(($data['companyDetails'][0]['district'] == 'Belize')? 'selected' : '').'>Belize</option>
                                                    <option value="Cayo" '.(($data['companyDetails'][0]['district'] == 'Cayo')? 'selected' : '').' >Cayo</option>
                                                    <option value="Stann Creek" '.(($data['companyDetails'][0]['district'] == 'Stann Creek')? 'selected' : '').'>Stann Creek</option>
                                                    <option value="Toledo" '.(($data['companyDetails'][0]['district'] == 'Toldeo')? 'selected' : '').'>Toledo</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">City/Village/Town</label>
                                                <div class="input-group">
                                                    <input type="text" name="companyDetail[ctv]" class="form-control" value="'.($data['companyDetails'][0]['ctv'] ?? '').'" placeholder="Enter your company..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Phone Number</label>
                                                <div class="input-group">
                                                    <input type="tel" name="companyDetail[phone]" class="form-control" value="'.($data['companyDetails'][0]['phone'] ?? '').'" placeholder="Enter your company\'s phone number..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Website Link<sub>(Optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyDetail[website]" value="'.($data['companyDetails'][0]['website_link'] ?? '').'" placeholder="Enter an company website link..." aria-describedby="inputGroupPrepend2" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Year Established<sub>(optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="number" max="'.date('Y').'"  name="companyDetail[establishedOn]" class="form-control" value="'.($data['companyDetails'][0]['established_on'] ?? 0).'"  aria-describedby="inputGroupPrepend2">
                                                </div>
                                            </div>
						'.$moreCompanyInput.'

                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                                <label for="email">Company Description</label>
                                                <textarea class="form-control" id="comp-desc" maxlength="350" name="companyDetail[description]" rows="6">'.($data['companyDetails'][0]['description'] ?? '').'</textarea>
						<span class="text-muted" id="comp-desc-count"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


			    <!-- SOCIAL CONTACT SECTION -->
                            <div class="card shadow mb-3">
                                <div class="card-body">
				    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="updateSocialContacts">
                                        <input type="hidden" name="cId" value="'.encrypt($data['companyDetails'][0]['company_id']).'">
					    <h3 class="text-center text-lg-left">
						<i class="fas fa-link title-icon text-primary mb-1"></i> 
						<span class="d-none d-lg-inline-block">Social Contact Links</span>
						<span class="d-inline-block d-lg-none">Social Links</span>
					    </h3>

					<div class="form-row">
						'.$socialOptions.'
					</div> 

                                        <div class="form-row">
                                            <div class="col-12 d-flex justify-content-end">
						    <button type="submit" class="btn btn-success mt-3">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>


                        </div>    


                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="card shadow mb-3" >
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="POST">
					    <h3 class="text-center "><i class="fa fa-user title-icon text-primary mb-1"></i> <span class="d-none d-lg-inline-block">Point of Contact</span><span class="d-inline-block d-lg-none">PoC</span></h3>
					    <input type="hidden" name="action" value="updatePointOfContact">
                                            <input type="hidden" name="pocId" value="'.encrypt($data['pointOfContact'][0]['id'] ?? 0).'">
					    <div class="row">
						    <div class="col-12 mb-3">
							    <label for="validationDefault01">First name</label>
							    <input type="text" maxlength="150" class="form-control" name="fname" placeholder="Enter first name..." value="'.$data['pointOfContact'][0]['first_name'].'" required>
					            </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Last name</label>
							    <input type="text" maxlength="150" class="form-control" name="lname" placeholder="Enter last name..." value="'.$data['pointOfContact'][0]['last_name'].'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Position</label>
							    <input type="text" maxlength="150" class="form-control" name="position" placeholder="Enter current position..." value="'.$data['pointOfContact'][0]['position'].'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Phone</label>
							    <input type="tel" class="form-control" name="phone" placeholder="Enter phone number..." value="'.$data['pointOfContact'][0]['phone'].'" required>
						    </div>
						    <div class="col-12 mb-3">
							    <label for="validationDefault02">Email</label>
							    <input type="email" maxlength="200" class="form-control" name="email" placeholder="Enter your last name..." value="'.$data['pointOfContact'][0]['email'].'" required>
						    </div>
					    </div>
					    <div class="col-12 text-right">
						    <button class="btn btn-success">
							<i class="fa fa-save"></i> Save
						    </button>
					    </div>
			            </form>
                                </div>
                            </div>

				'.$exportMarketSection.'



                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }
    // this dashboard is for the company
    public function buyerDashboard($data = []){
	      
	$cardSummary = '';

	$interestedSectors = '';
	if (!empty($data['interests']) && !empty($data['sectors'])){

		$interestedSectorIds = array_column($data['interests'], 'sector_id');
		$badges = '';
		foreach ($data['sectors'] as $key => $sector){

			if (in_array($sector['id'], $interestedSectorIds)){

				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector['name'])) );
				$id   = encrypt($sector['id']);

				$badges .= '
					<li>
						<a href="'.BASE_URL.'sector/'.urlencode($name).'/'.$id.'">'.$sector['name'].'</a>
					</li>
				';
			}
		}
		if ($badges != ''){

			$interestedSectors = '
				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fas fa-pie-chart text-secondary" data-toggle="tooltip" data-placement="top" title="Interested Sectors"></i> 
					Sectors</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$badges.'
					</ul>
				</div><!-- tags end -->

			';
		}
	}

	$featuredCompanySection = '';
	$cBookmarks = '';
	if (!empty($data['companys'])){

		$cardSummary .= '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'company-profiles" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-building text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Company</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['companys']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
		';

		$companiesToBookmark = [];
		if (!empty($data['cBookmarks'])){

			$companiesToBookmark = array_column($data['cBookmarks'], 'company_id');

		}

		$featuredCompanies = '';
		$cBookmarkBadges = '';
		//getting featured companies for display
		foreach($data['companys'] as $key => $company){
			
			//getting featured companies
			if ($company['is_featured'] == 1 && isset($company['logo_img']) ){

				$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );

				$featuredCompanies .= '
				    <figure class="m-0 item">
					<a href="'.BASE_URL.'company/'.$cName.'/'.encrypt($company['company_id']).'" class="mr-0">
					    <img src="'.BASE_URL.$company['logo_img'].'" alt="'.$company['company_name'].' Logo">
					</a>
				    </figure>
				';
			}

			//getting company bookmarks
			if(in_array($company['company_id'], $companiesToBookmark)){


				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );
				$cId  = encrypt($company['company_id']);

				$cBookmarkBadges .= '
					<li><a href="'.BASE_URL.'company/'.$name.'/'.$cId.'">'.ucwords($company['company_name']).'</a></li>
				';



			} 
		
		}

		if ($cBookmarkBadges != ''){

			$cBookmarks = '

				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fad fa-bookmark text-secondary"></i> 
					Company Bookmarks</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$cBookmarkBadges.'
					</ul>
				</div><!-- tags end -->

			';
		}

		if ($featuredCompanies != ''){
			//building featured company section
			$featuredCompanySection = '
			    <!-- Featured companies -->
			    <section id="teams" class="teams pt-4 mb-3">
				<div class="container">
				    <div class="row">
					<div class="col-md-12 heading">
					    <span class="title-icon float-left"><i class="fa fa-building"></i></span>
					    <h2 class="title">Featured Companies<span class="title-desc">
						Our clients are ready to provide the products or services you\'re looking for.
					    </span></h2>
					</div>
				    </div><!-- Title row end -->
				    <div class="row wow fadeInLeft">
					<div id="client-carousel" class="col-12 owl-carousel owl-theme client-carousel text-center">
					'.$featuredCompanies.'	
					</div><!-- Owl carousel end -->
				    </div><!-- Main row end -->
				</div>
			    </section>
			';

		}
	}

	if (!empty($data['products'])){

		$cardSummary .= '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'products" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['products']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

		';

		$badges = '';
		$interestedProducts = '';
		$interestedProductIds = array_column($data['prod_interests'], 'product_id');
		foreach ($data['products'] as $key => $product){

			if (in_array($product['product_id'], $interestedProductIds)){

				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );
				$id   = encrypt($product['product_id']);

				$badges .= '
					<li>
						<a href="'.BASE_URL.'products/'.urlencode($name).'/'.$id.'">'.$product['product_name'].'</a>
					</li>
				';
			}

		}

		if ($badges != ''){

			$interestedProducts = '
				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fas fa-star text-secondary" data-toggle="tooltip" data-placement="top" title="Interested Products"></i> 
					Products</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$badges.'
					</ul>
				</div><!-- tags end -->

			';
		}

	}



	if (!empty($data['services']) ){

		$cardSummary .= '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'services" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['services']) ?? 0 ).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
		';

		$badges = '';
		$interestedServices = '';
		$interestedServiceIds = array_column($data['service_interests'], 'service_id');
		foreach ($data['services'] as $key => $service){

			if (in_array($service['id'], $interestedServiceIds)){

				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['service_name'])) );
				$id   = encrypt($service['id']);

				$badges .= '
					<li>
						<a href="'.BASE_URL.'services/'.urlencode($name).'/'.$id.'">'.$service['service_name'].'</a>
					</li>
				';
			}

		}

		if ($badges != ''){

			$interestedServices = '
				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fas fa-star text-secondary" data-toggle="tooltip" data-placement="top" title="Interested Services"></i> 
					Services</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$badges.'
					</ul>
				</div><!-- tags end -->

			';
		}
	}
	if (!empty($data['musics']) ){

		$cardSummary .= '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'music" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-music text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Music</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['musics']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
		';

		$badges = '';
		$interestedMusics = '';
		$interestedMusicIds = array_column($data['music_interests'], 'music_id');
		foreach ($data['musics'] as $key => $music){

			if (in_array($music['id'], $interestedMusicIds)){

				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music['name'])) );
				$id   = encrypt($music['id']);

				$badges .= '
					<li>
						<a href="'.BASE_URL.'music/'.urlencode($name).'/'.$id.'">'.$music['name'].'</a>
					</li>
				';
			}

		}

		if ($badges != ''){

			$interestedMusics = '
				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span >
					<i class="fas fa-star text-secondary" data-toggle="tooltip" data-placement="top" title="Interested Music"></i> 
					Music</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$badges.'
					</ul>
				</div><!-- tags end -->

			';
		}


	}

        $html = ' 
            <section class="buy-pro mb-0 pb-0" style="margin-top: 50px;">
                <div class="container">
			'.($data['message'] ?? '').'

                    <div class="row mb-3">
			'.$cardSummary.'
                    </div>

		    <!-- Company Summary >
		    <div class="row mt-4">
			<div class="col-md-12 heading">
			    <span class="title-icon classic float-left"><i class="fas fa-clipboard"></i></span>
			    <h2 class="title classic">Account Summary</h2>
			    <hr class="mb-0 pb-0">
			</div>
		    </div><! Title row end -->

		    <h3 class="text-left">Welcome <a href="'.BASE_URL.'my-profile" class="h3 text-capitalize">'.$_SESSION['USERDATA']['full_name'].',</a></h3>
			'.$cBookmarks.'
			'.$interestedProducts.'
			'.$interestedServices.'
			'.$interestedMusics.'
			'.$interestedSectors.'





                </div>
            </section>
	    '.$featuredCompanySection.'


        ';
        return $html;
    }  
    // this dashboard is for the company
    public function companyDashboard($data = []){
	      
	$cardSummary = '';
	$featuredItems = '';
	$socialLinks = '';

	$website = isset($data['companyInfo'][0]['website_link'])? '<span class="pb-3"><a href="'.$data['companyInfo'][0]['website_link'].'"><i class="fa fa-globe fa-lg"></i></a></span>': '';

	if (!empty($data['socialContactList'])){

		foreach ($data['socialContactList'] as $key => $socialContact){

			if (isset($socialContact['link'])){

				$socialLinks .= '<span class="pb-3 pr-3"><a href="'.$socialContact['link'].'"><i class="'.$socialContact['icon'].' fa-lg"></i></a></span>';	
		
			}

		}

	}
	
	$exportMarketList = '';
	if (!empty($data['exportMarketList']) && $_SESSION['COMPANYDATA'][0]['trade_type'] != 'local'){

		$exportMarkets = '';
		foreach ($data['exportMarketList'] as $key => $exportMarket){

			$exportMarkets .= '
					<li><a href="'.BASE_URL.'my-profile">'.$exportMarket['name'].'</a></li>
			';	

		}
		
		$exportMarketList = '

			<!-- tags start -->
			<div class="row m-2 widget widget-tags">
				<h4 class="mt-2 text-dark line-breaker">
					<span>
						<i class="fa fa-truck text-secondary"></i> 
						Export Markets
						(<b class="text-primary">'.(count($data['exportMarketList']??0)).'</b>)
					</span> 
				</h4>
				<ul class="unstyled clearfix">
					'.$exportMarkets.'
				</ul>
			</div><!-- tags end -->
		';

		

	}

	if (!empty($data['products'])){

		$cardSummary = '


			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'my-products" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['products']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>


		';

		$productBadges = '';

		foreach ($data['products'] as $key => $product){

			if ($product['is_featured'] == 1){

				$pName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );
				$pId   = encrypt($product['product_id']);

				$productBadges .= '
					<li><a href="'.BASE_URL.'products/'.$pName.'/'.$pId.'">'.ucwords($product['product_name']).'</a></li>
				';
			}
		}


		if ($productBadges != ''){

			$featuredItems = '

				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fa fa-eye text-secondary"></i> 
					Featured Items</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$productBadges.'
					</ul>
				</div><!-- tags end -->

			';
		}

	}
	if (!empty($data['services']) ){

		$cardSummary = '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'my-services" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fas fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['services']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
		';

		$badges = '';

		foreach ($data['services'] as $key => $service){

			if ($service['is_featured'] == 1){

				$name = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service['service_name'])) );
				$id   = encrypt($service['id']);

				$badges .= '
					<li><a href="'.BASE_URL.'edit/service/'.$id.'">'.ucwords($service['service_name']).'</a></li>
				';
			}
		}


		if ($badges != ''){

			$featuredItems = '

				<!-- tags start -->
				<div class="row m-2 widget widget-tags">
					<h4 class="mt-2 text-dark line-breaker"><span>
					<i class="fa fa-eye text-secondary"></i> 
					Featured Services</span></h4>
					</h4>
					<ul class="unstyled clearfix">
					'.$badges.'
					</ul>
				</div><!-- tags end -->

			';
		}
	}
	if (!empty($data['musics']) ){

		$cardSummary = '
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'my-music" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-music text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Music</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['musics']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
		';

	}

	$accountStatus = 'N/a';

	if ($data['companyInfo'][0]['is_featured'] == 1){
		$accountStatus = '
			<span class="text-success"><i class="fa fa-check fa-lg" data-toggle="tooltip" data-placement="top" title="Currently Featured"></i></span>
		';
	}

        $html = ' 
            <section class="buy-pro" style="margin-top: 50px;">
                <div class="container">
			'.($data['message'] ?? '').'

                    <div class="row">
			'.$cardSummary.'
                    </div>

		    <!-- Company Summary -->
		    <div class="row mt-4">
			<div class="col-md-12 heading">
			    <span class="title-icon classic float-left"><i class="fas fa-clipboard"></i></span>
			    <h2 class="title classic">Account Summary</h2>
			    <hr class="mb-0 pb-0">
			</div>
		    </div><!-- Title row end -->

		    <h3 class="text-center text-md-left ">Welcome <a href="'.BASE_URL.'my-profile" class="h3 text-capitalize">'.$_SESSION['COMPANYDATA'][0]['company_name'].',</a></h3>

			<div class="row m-2">
				<h4 class="mt-2 text-dark line-breaker"><span>
				<i class="fas fa-user-tie text-secondary"></i> 
				Point of Contact</span></h4>

				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Full Name:</label>
					 <span>'.($data['pointOfContact'][0]['first_name'].' '.$data['pointOfContact'][0]['last_name']).'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Position:</label>
					 <span>'.($data['pointOfContact'][0]['position'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Email:</label>
					 <span>'.($data['pointOfContact'][0]['email'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Phone #:</label>
					 <span>'.($data['pointOfContact'][0]['phone'] ?? 'N/a').'</span>
				</div>
			</div>
			<div class="row m-2">
				<h4 class="mt-2 text-dark line-breaker"><span>
				<i class="fa fa-building text-secondary"></i> 
				Company</span></h4>

				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark"> Email:</label>
					 <span>'.($data['companyInfo'][0]['company_email'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark"> Phone #:</label>
					 <span>'.($data['companyInfo'][0]['phone'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Address:</label>
					 <span>'.($data['companyInfo'][0]['address'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">City/Town/Village:</label>
					 <span>'.($data['companyInfo'][0]['ctv'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">District:</label>
					 <span>'.($data['companyInfo'][0]['district'] ?? 'N/a').'</span>
				</div>
			</div>

			'.$exportMarketList.'
			'.$featuredItems.'

			<div class="row m-2">
				<h4 class="mt-2 text-dark line-breaker"><span>
				<i class="fa fa-info-circle text-secondary"></i> 
				Extra</span></h4>

				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Business Focus:</label>
					 <span>'.($data['companyInfo'][0]['company_type_name'] ?? 'N/a').'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Trade Area:</label>
					 <span>'.(($data['companyInfo'][0]['trade_type'] == 'both')? 'Local & Export': ucfirst($data['companyInfo'][0]['trade_type']??'N/a')).'</span>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Account Status:</label>
					 '.(($accountStatus != '')? $accountStatus : 'N/a' ).'
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-1">
					 <label class="d-block font-weight-bold text-dark">Links:</label>
					 '.$socialLinks.$website.'
				</div>
			</div>

		    
			

                </div>
            </section>
        ';
        return $html;
    }  
    public function superUserDashboard($data = []){
 
	$featuredProducts = '';
	$featuredCompanys = '';
	$featuredSectors  = '';
	$notice 	  = '';

	if (!empty($data['accountRequests'])){
		
		$totalRequest = count($data['accountRequests']);
		$word = ($totalRequest > 1)? 'are': 'is';
		$notice = '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			  <strong>Notice!</strong> There '.$word.' <strong>'.$totalRequest.'</strong> company account request pending action.
				<br><a href="'.BASE_URL.'company/account-requests" class="bs-text-primary">View Account Request<a>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		';

	}else{
		$notice = null;
	}

	$featuredServiceCount = 0;
	// getting featured companies
	if (!empty($data['services'])){
		
		foreach ($data['services'] as $key => $service){

			if ($service['is_featured'] == 1){

				$featuredServiceCount++;
			}
		}
	}

	$featuredCompanyCount = 0;
	// getting featured companies
	if (!empty($data['companys'])){
		
		foreach ($data['companys'] as $key => $company){

			if ($company['is_featured'] == 1){

				$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );
				$cId   = encrypt($company['company_id']);

				$featuredCompanys .= '
				    <li class="list-group-item">
					<a href="'.BASE_URL.'view/company/'.$cId.'" class="btn btn-link text-primary">'.ucwords($company['company_name']).'</a> 
					<a href="#" class="remove-featured-company float-right btn btn-link text-danger" data-cid="'.$cId.'"><i class="fa fa-minus fa-lg"></i></a>
				    </li>
				';
			
				$featuredCompanyCount++;
			}
		}
	}

	$featuredProductCount = 0;
	//getting featured products
	if (!empty($data['products'])){
		
		foreach ($data['products'] as $key => $product){

			if ($product['is_featured'] == 1){
				$featuredProductCount++;
			}
		}
	}

	$featuredSectorCount = 0;
	//getting featured sectors
	if (!empty($data['sectors'])){
		
		foreach ($data['sectors'] as $key => $sector){

			if ($sector['is_featured'] == 1){

				$sId = encrypt($sector['id']);

				$featuredSectors .= '
				    <li class="list-group-item">
					<a href="'.BASE_URL.'edit/sector/'.$sId.'" class="btn btn-link text-primary">'.ucwords($sector['name']).'</a> 
					<a href="#" class="remove-featured-sector float-right btn btn-link text-danger" data-sid="'.$sId.'"><i class="fa fa-minus fa-lg"></i></a>
				    </li>
				';
			
				$featuredSectorCount++;
			}
		}
	}

        $html = ' 
            <section class="buy-pro" style="margin-top: 50px;">
                <div class="container">
			'.($notice ?? '').'
			'.($data['message'] ?? '').'

                    <div class="row pt-3">


			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#su-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-user text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Super User</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['superUsers']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#admin-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-user text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Admin</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['admins']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>


			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#buyer-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-users text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Buyer</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['buyers']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>


			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#company-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-building text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Company</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['companys']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'service-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fas fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['services']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'service-category-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="far fa-hand-holding-box  text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Category</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['serviceCat']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'sub-service-category-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="far fa-hand-holding-box  text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Sub Cat.</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.count($data['subServiceCat'] ?? []).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'music-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-music  text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Music</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.count($data['musics'] ?? []).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'product-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['products']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'export-market-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-truck text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Export</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['exportMarkets']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'sector-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-pie-chart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Sector</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['sectors']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

                    </div>

                    <!-- Featured Items -->
                    <div class="row mt-3">
                        <div class="col-md-12 heading">
                            <span class="title-icon classic float-left"><i class="fa fa-eye"></i></span>
                            <h2 class="title classic">Featured Items</h2>
			    <hr class="mb-0 pb-0">
                        </div>
                    </div><!-- Title row end -->



                    <div class="row mb-2">
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'product-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredProductCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'sector-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-pie-chart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Sector</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredSectorCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list/company/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-building text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Company</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredCompanyCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'service-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fas fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredServiceCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
                    </div>



		    </div>
                </div>
            </section>
        ';
        return $html;
    }  
    // displays the dashboard for a user
    public function adminDashboard($data = []){
 
	$featuredProducts = '';
	$featuredCompanys = '';
	$featuredSectors  = '';
	$notice 	  = '';

	if (!empty($data['accountRequests'])){
		
		$totalRequest = count($data['accountRequests']);
		$word = ($totalRequest > 1)? 'are': 'is';
		$notice = '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			  <strong>Notice!</strong> There '.$word.' <strong>'.$totalRequest.'</strong> company account request pending action.
				<br><a href="'.BASE_URL.'company/account-requests" class="bs-text-primary">View Account Request<a>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		';

	}else{
		$notice = null;
	}

	$featuredServiceCount = 0;
	// getting featured companies
	if (!empty($data['services'])){
		
		foreach ($data['services'] as $key => $service){

			if ($service['is_featured'] == 1){

				$featuredServiceCount++;
			}
		}
	}

	$featuredCompanyCount = 0;
	// getting featured companies
	if (!empty($data['companys'])){
		
		foreach ($data['companys'] as $key => $company){

			if ($company['is_featured'] == 1){

				$cName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company['company_name'])) );
				$cId   = encrypt($company['company_id']);

				$featuredCompanys .= '
				    <li class="list-group-item">
					<a href="'.BASE_URL.'view/company/'.$cId.'" class="btn btn-link text-primary">'.ucwords($company['company_name']).'</a> 
					<a href="#" class="remove-featured-company float-right btn btn-link text-danger" data-cid="'.$cId.'"><i class="fa fa-minus fa-lg"></i></a>
				    </li>
				';
			
				$featuredCompanyCount++;
			}
		}
	}

	$featuredProductCount = 0;
	//getting featured products
	if (!empty($data['products'])){
		
		foreach ($data['products'] as $key => $product){

			if ($product['is_featured'] == 1){

				$pName = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product['product_name'])) );
				$pId   = encrypt($product['product_id']);

				$featuredProducts .= '
				    <li class="list-group-item">
					<a href="'.BASE_URL.'products/'.$pName.'/'.$pId.'" class="btn btn-link text-primary">'.ucwords($product['product_name']).'</span> 
					<a href="#" class="remove-featured-product float-right btn btn-link text-danger" data-pid="'.$pId.'"><i class="fa fa-minus fa-lg"></i></a>
				    </li>
				';
				$featuredProductCount++;
			}
			
		}
	}

	$featuredSectorCount = 0;
	//getting featured sectors
	if (!empty($data['sectors'])){
		
		foreach ($data['sectors'] as $key => $sector){

			if ($sector['is_featured'] == 1){

				$sId = encrypt($sector['id']);

				$featuredSectors .= '
				    <li class="list-group-item">
					<a href="'.BASE_URL.'edit/sector/'.$sId.'" class="btn btn-link text-primary">'.ucwords($sector['name']).'</a> 
					<a href="#" class="remove-featured-sector float-right btn btn-link text-danger" data-sid="'.$sId.'"><i class="fa fa-minus fa-lg"></i></a>
				    </li>
				';
			
				$featuredSectorCount++;
			}
		}
	}

        $html = ' 
            <section class="buy-pro" style="margin-top: 50px;">
                <div class="container">
			'.($notice ?? '').'
			'.($data['message'] ?? '').'

                    <!-- Featured Items -->
                    <div class="row mt-3">
                        <div class="col-md-12 heading">
                            <span class="title-icon classic float-left"><i class="fa fa-clipboard"></i></span>
                            <h2 class="title classic">Summary</h2>
			    <hr class="mb-0 pb-0">
                        </div>
                    </div><!-- Title row end -->

                    <div class="row">

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#buyer-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-users text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Buyer</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['buyers']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>


			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list#company-tab" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-building text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Company</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['companys']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'export-market-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-truck text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Export</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['exportMarkets']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'sector-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-pie-chart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Sector</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['sectors']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'service-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fas fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['services']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'product-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['products']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'music-list" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-music text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Music</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.( count($data['musics']) ?? 0).'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>
                    </div>

                    <!-- Featured Items -->
                    <div class="row mt-3">
                        <div class="col-md-12 heading">
                            <span class="title-icon classic float-left"><i class="fa fa-eye"></i></span>
                            <h2 class="title classic">Featured Items</h2>
			    <hr class="mb-0 pb-0">
                        </div>
                    </div><!-- Title row end -->



                    <div class="row mb-2">

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'product-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-shopping-cart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Product</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredProductCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'sector-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-pie-chart text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Sector</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredSectorCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'user-list/company/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fa fa-building text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Company</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredCompanyCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3">
			    <a href="'.BASE_URL.'service-list/featured" class="text-secondary">
				<div class="card shadow-lg">
				  <div class="card-body row">
				    <div class="col-6 text-center">
					<i class="fas fa-hand-holding-box text-primary" style="font-size: 35px;"></i>
					<h5 class="text-dark mt-2 mb-0 pb-0">Service</h5>
				    </div>
				    <div class="col-6 my-auto">
					<h1 class="text-dark text-center">'.$featuredServiceCount.'</h1>
				    </div>
				  </div>
				</div>
			     </a>	
			</div>

                    </div>



		    <div class="row">

                    <!-- Products Featured Items -->
			<div class="col-12 col-md-4 mb-3">
				<div class="card shadow-lg" >
				  <div class="card-header">
				    <a href="'.BASE_URL.'product-list/featured" class="h3 font-weight-bold text-dark">Product</a>
				    <span class="float-right"><a href="#" class="btn btn-link bs-text-primary" id="add-featured-product"><i class="fa fa-plus fa-lg"></i></a></span>
				  </div>
				  <ul class="list-group list-group-flush" id="featured-product-list">
					'.$featuredProducts.'
				  </ul>
				</div>
			</div>

                    <!-- Sector Featured Items -->
			<div class="col-12 col-md-4 mb-3">
				<div class="card shadow-lg" >
				  <div class="card-header">
				    <a href="'.BASE_URL.'sector-list/featured" class="h3 font-weight-bold text-dark">Sector</a>
				    <span class="float-right"><a href="#" class="btn btn-link bs-text-primary" id="add-featured-sector"><i class="fa fa-plus fa-lg"></i></a></span>
				  </div>
				  <ul class="list-group list-group-flush" id="featured-sector-list">
					'.$featuredSectors.'
				  </ul>
				</div>
			</div>

                    <!-- Company Featured Items -->
			<div class="col-12 col-md-4 mb-3">
				<div class="card shadow-lg" >
				  <div class="card-header">
				    <a href="'.BASE_URL.'user-list/company/featured" class="h3 font-weight-bold text-dark">Company</a>
				    <span class="float-right"><a href="#" class="btn btn-link bs-text-primary" id="add-featured-company"><i class="fa fa-plus fa-lg"></i></a></span>
				  </div>
				  <ul class="list-group list-group-flush" id="featured-company-list">
					'.$featuredCompanys.'
				  </ul>
				</div>
			</div>
		    </div>
                </div>
            </section>
        ';
        return $html;
    }  
   //displays buyer's profile
    public function buyerProfile($data = []){
       
        $interestSelect = '';
        $hiddenInterestIds = '';
        $sectorOptions = '';
        $fullName = explode(' ',$data['buyerInfo'][0]['full_name']);
        $num = 1;

        //building interest select with options 
        while($num <= 3){
            $sectorOptions = '';
            if (array_key_exists(($num - 1), $data['interest'])){
                
                $defaultInterest = '';
                
                foreach ($data['sectors'] as $sector){
                    
                    if($data['interest'][($num - 1)]['sector_id'] == $sector['id']){

			// selected sector 
                        $hiddenInterestIds .= '<input type="hidden" name = "interest['.($num-1).'][intId]" value="'.encrypt($data['interest'][($num-1)]['id']).'">';
                        $sectorOptions .= '
                            <option value="'.encrypt($sector['id']).'" selected>'.$sector['name'].'</option>
                        ';
                        
                    }else{  

			//sector options 
                        $sectorOptions .= '
                            <option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
                        ';
                    }
                }

            }else{
                // $defaultInterest = 'selected';
                foreach ($data['sectors'] as $sector){
                    $sectorOptions .= '
                        <option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
                    ';
                }

            }
            $interestSelect .= '
                <div class="col-12 col-md-12 col-lg-12 mb-3">
                    <label for="">Intrest <sub>#'.$num.' (Optional)</sub></label>
                    <select name="interest['.($num-1).'][sId]"  class="form-control">
                        <option value="'.encrypt(0).'">None</option>
                        '.$sectorOptions.'
                    </select>
                </div>
            ';
            $num++;
        }

        $html = $this->banner('My Profile', 
            '<li class="breadcrumb-item text-white" aria-current="page">Profile</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
		
		'.($data['message'] ?? '').'
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i> Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="saveBuyerProfile">
                                        <div class="form-row">
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" id="" name="firstName" placeholder="Enter your first name..." value="'.$fullName[0].'" required>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" id="" name="lastName" placeholder="Enter your last name..." value="'.$fullName[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                                <label for="email">Business Name<sub>(Optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="text" name="companyName" class="form-control" value="'.$data['buyerInfo'][0]['business_name'].'" placeholder="Enter your company..." aria-describedby="inputGroupPrepend2">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-6 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <p class="pt-2">'.$data['buyerInfo'][0]['buyer_email'].'</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
					    <button type="submit" class="btn btn-success" >
						<i class="fa fa-save"></i> Save 
					    </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 


                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-star fa-lg title-icon text-primary"></i> Interest</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="saveBuyerInterest">
                                        '.$hiddenInterestIds.'
                                        <div class="form-row">
                                            '.$interestSelect.'                                          
                                        </div>
                                        <div class="text-right">
					    <button type="submit" class="btn btn-success" >
						<i class="fa fa-save"></i> Save 
					    </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 



                    </div>
                </div>
            </section>
        ';
        return $html;
    }  
    public function superUserProfile($data = []){

        $fullname = explode(' ', $_SESSION['USERDATA']['full_name']);

        $html = $this->banner('My Profile', 
            '<li class="breadcrumb-item text-white" aria-current="page">Profile</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
			'.($data['message'] ?? '').'
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i>Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="saveSuProfile">
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" name="fName" placeholder="Enter your first name..." value="'.$fullname[0].'" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" name="lName" placeholder="Enter your last name..." value="'.$fullname[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <p class="mt-2">'.$_SESSION['USERDATA']['email'].'</p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-row">
                                            <div class="col-12">
						    <button class="btn btn-success float-right">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }
    // displays admin profile
    public function adminProfile($data = []){

        $fullname = explode(' ', $_SESSION['USERDATA']['full_name']);

        $html = $this->banner('My Profile', 
            '<li class="breadcrumb-item text-white" aria-current="page">Profile</li>'
        ).'
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
			'.($data['message'] ?? '').'
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class=""><i class="fa fa-user fa-lg title-icon text-primary"></i>Profile</h3>
                                    <form action="'.BASE_URL.'" method="POST">
                                        <input type="hidden" name="action" value="saveAdminProfile">
                                        <div class="form-row">
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault01">First name</label>
                                            <input type="text" class="form-control" name="fName" placeholder="Enter your first name..." value="'.$fullname[0].'" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" name="lName" placeholder="Enter your last name..." value="'.$fullname[1].'" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <p class="mt-2">'.$_SESSION['USERDATA']['email'].'</p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-row">
                                            <div class="col-12">
						    <button class="btn btn-success float-right">
							<i class="fa fa-save"></i> Save
						    </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }
    public function companyRegistrationForm($data = []){

        $options = '';

	$count = 1;
	if (!empty($data['companyTypes'])){

		foreach ($data['companyTypes'] as $type){
		    $checked = ($count == 1)? 'checked' : '';
		    $color = ($count == 1)? 'text-primary' : '';
			 	
		    $options .= '
			<div class="form-check form-check-inline">
			  <input class="form-check-input c-type-radio" type="radio" name="companyInfo[type]" id="c-'.$type['type'].'" value="'.encrypt($type['id']).'" '.$checked.'>
			  <label class="form-check-label h1 mr-2 mr-md-4 c-type-label" for="c-'.$type['type'].'" data-toggle="tooltip" data-placement="top" title="'.$type['display_name'].'">
				<i class="'.$type['icon'].' '.$color.'"></i>
			  </label>
			</div>
		    ';
	    	    $count++;
		}
	}


        $html = '
            '.$this->banner('Company Registration',
                '<li class="breadcrumb-item text-white" aria-current="page">Company Registration</li>'
             ).' 
                <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-10 mx-auto">
                            <div class="card shadow">
                                <div class="card-body">
				    '.(isset($data['message'])? $data['message'] : '' ).'
                                    <form action="'.BASE_URL.'index.php" method="POST">
                                        <h3 class="card-title mb-0">Point of Contact</h3>
				        <hr class="mt-0 pt-0">
                                        <input type="hidden" name="action" value="companyRegistration">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
						    <label for="validationDefault01">First Name</label>
						    <input type="text" class="form-control" name="pointOfContact[fname]" min="3"  maxlength="150" placeholder="Enter your first name..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
						    <label for="validationDefault02">Last Name</label>
						    <input type="text" class="form-control" name="pointOfContact[lname]" min="3"  maxlength="150" placeholder="Enter your last name..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
						    <label for="validationDefault02">Position</label>
						    <input type="text" class="form-control" name="pointOfContact[position]" min="3" maxlength="200" placeholder="Enter the job position..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
						    <label for="validationDefault02">Phone #</label>
						    <input type="tel" class="form-control" name="pointOfContact[phone] min="7" maxlength="15" placeholder="Enter your phone number..." value="" required>
                                            </div>
                                            <div class="col-12 col-md-12 mb-3">
						    <label for="validationDefault01">Email</label>
						    <input type="email" class="form-control" name="pointOfContact[email]" maxlength="200" placeholder="Enter your email..." value="" required>
                                            </div>
                                        </div>


                                        <h3 class="card-title mb-0">Company Profile</h3>
				        <hr class="mt-0 pt-0">


                                        <div class="form-row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[name]" min="3" maxlength="150" placeholder="Enter your company\'s name..." required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="email">Email 
							<i class="fa fa-info-circle" data-toggle="tooltip" 
							data-placement="top" title="
								This Email below will be used as your company\'s main contact email and to gain access to the EXPORTBelize Platform once your account has been approved.
							">
							</i></label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" id="company-email" name="companyInfo[email]" maxlength="200" placeholder="Enter a valid email..."  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">City/Town/Village</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[ctv]" placeholder="Enter your location..." maxlength="150" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">Address</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[address]" maxlength="200" placeholder="Enter your company\'s address..."  required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="email">District</label>
                                                <select class="form-control" name="companyInfo[district]">
                                                    <option vlaue="Corozal" selected>Corozal</option>
                                                    <option value="Orange Walk">Orange Walk</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Cayo">Cayo</option>
                                                    <option value="Stann Creek">Stann Creek</option>
                                                    <option value="Toledo">Toledo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                             <div class="col-12 col-md-6 mb-3">
                                                <label for="type" class="d-block">Choose your Company\'s main area of focus...</label>
						<span class="d-block text-center">	
							'.$options.'
						</span>
					     </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="supply-type">Company\'s main trade is...</label>
                                                <select id="supply-type" class="form-control" name="companyInfo[tradeArea]">
                                                    <option value="export">Other Countries</option>
                                                    <option value="local">Belize</option>
                                                    <option value="both">Belize and Other Countries</option>
                                                </select>
                                            </div>

					</div>

                                        <h5 class="card-title mb-0">Additional Info</h5>
				        <hr class="mt-0 pt-0">

                                        <div class="row" id="add-comp-fields" hidden>

						    <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                        <label for="email">Seat Capacity<sub>(Current)</sub></i></label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control service-field" name="companyInfo[currentSeatCapacity]" placeholder="Current seat capacity...">
                                                        </div>
                                                </div>
						    <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                        <label for="email">Seat Capacity<sub>(Expansion Potential)</sub></i></label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control service-field" name="companyInfo[expanPotential]" maxlength="200" placeholder="Expansion Potential...">
                                                        </div>
                                                </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="email">Services Offered 
                                                                <i class="fa fa-info-circle" data-toggle="tooltip"
                                                        data-placement="top" title="The following will be used for the approval process of your account"></i>
                                                        </label>
                                                        <textarea class="form-control service-field" name="companyInfo[servicesOffered]" rows="4" maxlength="400" placeholder="eg. Customer Service, Marketing, Data Entry..."></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="email">Industries Serviced 
                                                                <i class="fa fa-info-circle" data-toggle="tooltip"
                                                        data-placement="top" title="The following will be displayed on your company profile and help with the approval process of your account"></i>
                                                        </label>
                                                        <textarea class="form-control service-field" name="companyInfo[industriesServiced]" rows="4" maxlength="400" placeholder="eg. Healthcare, Education, Apparel..."></textarea>
                                                    </div>

					</div>

                                        <div class="form-row">
                                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                                <label for="email">Website<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="companyInfo[website]" maxlength="200" placeholder="Enter your company\'s website...">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                                <label for="phone">Phone #<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" name="companyInfo[phone]" maxlength="15" placeholder="Enter your company\'s contact #...">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                                <label for="phone">Year Established<sub>(Optional)</sub></i></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="companyInfo[establishedOn]" max="'.date('Y').'" placeholder="Year company was established...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
					    <div class="col-12 mb-3">
						<label for="email">Tell us something about your company...</label>
						<textarea class="form-control" id="comp-desc" maxlength="350" name="companyInfo[description]" rows="6" placeholder="The following description will help us validate your account for approval..." required></textarea>
						<span class="text-muted" id="comp-desc-count"></span>
					    </div>
				        </div>


                                        <h3 class="card-title mb-0">Account Credentials</h3>
				        <hr class="mt-0 pt-0">
                                        <div class="form-row">
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="company-account-email" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">New Password</label>
						    <input type="password" name="newPass" class="form-control" id="newPass" placeholder="Enter a new password" required>

						    <span id="newPassMessage"></span>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">Confirm Password</label>
						    <input type="password" class="form-control" name="confirmPass" id="conPass" placeholder="Re-enter new password..." required>
						    <span id="conPassMessage"></span>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-12">
                                                <span class="float-left">
                                                    <a href="'.BASE_URL.'index.php?page=signIn" class="float-left">I have an Account</a>
                                                </span>
                                                <span class="float-right">
                                                    <input type="checkbox" onclick="displayBothPasswords()"> Show Password
                                                </span>
                                            </div>
                                        </div>
					<br>
                                        <!--<div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                            <label class="form-check-label" for="invalidCheck2">
                                                Agree to terms and conditions
                                            </label>
                                            </div>
                                        </div>-->
                                        <button id="registrationBtn" class="btn btn-primary float-right" type="submit" disabled>Create Account</button>
                            
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }
    public function emailCard($title, $message, $moreMessage = '', $img1 = 'https://assets.codepen.io/210284/1200x800-2.png', $img2 = ''){
	

	$html = '
		<!DOCTYPE html>
		<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width,initial-scale=1">
		  <meta name="x-apple-disable-message-reformatting">
		  <title></title>
		  <!--[if mso]>
		  <style>
		    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
		    div, td {padding:0;}
		    div {margin:0 !important;}
		  </style>
		  <noscript>
		    <xml>
		      <o:OfficeDocumentSettings>
			<o:PixelsPerInch>96</o:PixelsPerInch>
		      </o:OfficeDocumentSettings>
		    </xml>
		  </noscript>
		  <![endif]-->
		  <style>
		    table, td, div, h1, p {
		      font-family: Arial, sans-serif;
		    }
		    @media screen and (max-width: 530px) {
		      .unsub {
			display: block;
			padding: 8px;
			margin-top: 14px;
			border-radius: 6px;
			background-color: #555555;
			text-decoration: none !important;
			font-weight: bold;
		      }
		      .col-lge {
			max-width: 100% !important;
		      }
		    }
		    @media screen and (min-width: 531px) {
		      .col-sml {
			max-width: 27% !important;
		      }
		      .col-lge {
			max-width: 73% !important;
		      }
		    }
		  </style>
		</head>
		<body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
		  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ffffff;">
		    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
		      <tr>
			<td align="center" style="padding:0;">
			  <!--[if mso]>
			  <table role="presentation" align="center" style="width:600px;">
			  <tr>
			  <td>
			  <![endif]-->
			  <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
			    <tr>
			      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
				<a href="'.BASE_URL.'" style="text-decoration:none;"><img src="'.BASE_URL.'images/export-belize-logo-2.png" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;background-color:#F5F5F5;">
				<h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">'.$title.'</h1>
				<p style="margin:0;">'.$message.'</p>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
				<a href="'.BASE_URL.'" style="text-decoration:none;"><img src="'.$img1.'" width="600" alt="" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;"></a>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;background-color:#ffffff;">
				<p style="margin:0;">'.$moreMessage.'</p>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
				<p style="margin:0 0 8px 0;"><a href="https://www.facebook.com/BELTRAIDE/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/facebook_1.png" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> <a href="https://twitter.com/Beltraide" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/twitter_1.png" width="40" height="40" alt="t" style="display:inline-block;color:#cccccc;"></a></p>
				<p style="margin:0;font-size:14px;line-height:20px;">&reg; BELTRAIDE '.date('Y').'</p>
			      </td>
			    </tr>
			  </table>
			  <!--[if mso]>
			  </td>
			  </tr>
			  </table>
			  <![endif]-->
			</td>
		      </tr>
		    </table>
		  </div>
		</body>
		</html>


	';

	return $html;

	// Below is the original template 
	/*
		<!DOCTYPE html>
		<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width,initial-scale=1">
		  <meta name="x-apple-disable-message-reformatting">
		  <title></title>
		  <!--[if mso]>
		  <style>
		    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
		    div, td {padding:0;}
		    div {margin:0 !important;}
		  </style>
		  <noscript>
		    <xml>
		      <o:OfficeDocumentSettings>
			<o:PixelsPerInch>96</o:PixelsPerInch>
		      </o:OfficeDocumentSettings>
		    </xml>
		  </noscript>
		  <![endif]-->
		  <style>
		    table, td, div, h1, p {
		      font-family: Arial, sans-serif;
		    }
		    @media screen and (max-width: 530px) {
		      .unsub {
			display: block;
			padding: 8px;
			margin-top: 14px;
			border-radius: 6px;
			background-color: #555555;
			text-decoration: none !important;
			font-weight: bold;
		      }
		      .col-lge {
			max-width: 100% !important;
		      }
		    }
		    @media screen and (min-width: 531px) {
		      .col-sml {
			max-width: 27% !important;
		      }
		      .col-lge {
			max-width: 73% !important;
		      }
		    }
		  </style>
		</head>
		<body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
		  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ffffff;">
		    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
		      <tr>
			<td align="center" style="padding:0;">
			  <!--[if mso]>
			  <table role="presentation" align="center" style="width:600px;">
			  <tr>
			  <td>
			  <![endif]-->
			  <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
			    <tr>
			      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
				<a href="'.BASE_URL.'" style="text-decoration:none;"><img src="'.BASE_URL.'images/export-belize-logo-2.png" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;background-color:#F5F5F5;">
				<h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">'.$title.'</h1>
				<p style="margin:0;">'.$message.'</p>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
				<a href="http://www.example.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/1200x800-2.png" width="600" alt="" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;"></a>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
				<!--[if mso]>
				<table role="presentation" width="100%">
				<tr>
				<td style="width:145px;" align="left" valign="top">
				<![endif]-->
				<div class="col-sml" style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
				  <img src="https://assets.codepen.io/210284/icon.png" width="115" alt="" style="width:80%;max-width:115px;margin-bottom:20px;">
				</div>
				<!--[if mso]>
				</td>
				<td style="width:395px;padding-bottom:20px;" valign="top">
				<![endif]-->
				<div class="col-lge" style="display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
				  <p style="margin-top:0;margin-bottom:12px;">Nullam mollis sapien vel cursus fermentum. Integer porttitor augue id ligula facilisis pharetra. In eu ex et elit ultricies ornare nec ac ex. Mauris sapien massa, placerat non venenatis et, tincidunt eget leo.</p>
				  <p style="margin-top:0;margin-bottom:18px;">Nam non ante risus. Vestibulum vitae eleifend nisl, quis vehicula justo. Integer viverra efficitur pharetra. Nullam eget erat nibh.</p>
				  <p style="margin:0;"><a href="https://example.com/" style="background: #ff3884; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0;text-underline-color:#ff3884"><!--[if mso]><i style="letter-spacing: 25px;mso-font-width:-100%;mso-text-raise:20pt">&nbsp;</i><![endif]--><span style="mso-text-raise:10pt;font-weight:bold;">Claim yours now</span><!--[if mso]><i style="letter-spacing: 25px;mso-font-width:-100%">&nbsp;</i><![endif]--></a></p>
				</div>
				<!--[if mso]>
				</td>
				</tr>
				</table>
				<![endif]-->
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;font-size:24px;line-height:28px;font-weight:bold;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
				<a href="http://www.example.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/1200x800-1.png" width="540" alt="" style="width:100%;height:auto;border:none;text-decoration:none;color:#363636;"></a>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;background-color:#ffffff;">
				<p style="margin:0;">Duis sit amet accumsan nibh, varius tincidunt lectus. Quisque commodo, nulla ac feugiat cursus, arcu orci condimentum tellus, vel placerat libero sapien et libero. Suspendisse auctor vel orci nec finibus.</p>
			      </td>
			    </tr>
			    <tr>
			      <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
				<p style="margin:0 0 8px 0;"><a href="http://www.facebook.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/facebook_1.png" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> <a href="http://www.twitter.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/twitter_1.png" width="40" height="40" alt="t" style="display:inline-block;color:#cccccc;"></a></p>
				<p style="margin:0;font-size:14px;line-height:20px;">&reg; Someone, Somewhere 2021<br><a class="unsub" href="http://www.example.com/" style="color:#cccccc;text-decoration:underline;">Unsubscribe instantly</a></p>
			      </td>
			    </tr>
			  </table>
			  <!--[if mso]>
			  </td>
			  </tr>
			  </table>
			  <![endif]-->
			</td>
		      </tr>
		    </table>
		  </div>
		</body>
		</html>



	*/

    }
    public function buyerRegistrationForm($data = []){

        $sectorOptions = '';

	if (!empty($data['sectors'])){
		foreach ($data['sectors'] as $sector){
		    $sectorOptions .= '
			<option value="'.encrypt($sector['id']).'">'.$sector['name'].'</option>
		    ';
		}
        }

        $html = '
            '.$this->banner('Buyer Registration', 
                '<li class="breadcrumb-item text-white" aria-current="page">Registration Form</li>'
            ).'  

            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="POST">
                                        '.($data['message'] ?? '').'
                                        <h3 class="card-title mb-0">Profile</h3>
				        <hr class="mt-0 pt-0">
                                        <input type="hidden" name="action" value="buyerRegistration">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" id="" name="firstName" placeholder="Enter your first name..."
					    minlength="3" maxlength="150" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                            <label for="validationDefault02">Last name</label>
                                            <input type="text" class="form-control" name="lastName" placeholder="Enter your last name..."
					    minlength="3" maxlength="150" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Business Name<sub>(Optional)</sub></label>
                                                <div class="input-group">
                                                    <input type="text" name="companyName" class="form-control" placeholder="Enter your business name..."
						    maxlength="150">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="">Intrest <sub>#1 (Optional)<sub></label>
                                                <select name="interest[][sId]"  class="form-control">
                                                    <option value="0" selected>None</option>
                                                    '.$sectorOptions.'
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="">Intrest <sub>#2 (Optional)<sub></label>
                                                <select name="interest[][sId]" class="form-control">
                                                    <option value="0" selected>None</option>
                                                    '.$sectorOptions.'
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="">Intrest <sub>#3 (Optional)<sub></label>
                                                <select name="interest[][sId]" class="form-control">
                                                    <option value="0" selected>None</option>
                                                    '.$sectorOptions.'
                                                </select>
                                            </div>
                                        </div>
                                        <h3 class="card-title mb-0 mt-3">Account Credentials</h3>
				        <hr class="mt-0 pt-0">
                                        <div class="form-row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Enter an email..." aria-describedby="inputGroupPrepend2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">New Password</label>
						    <input type="password" name="newPass" class="form-control" id="newPass" placeholder="Enter a new password" required>

						    <span id="newPassMessage"></span>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">Confirm Password</label>
						    <input type="password" class="form-control" name="confirmPass" id="conPass" placeholder="Re-enter new password..." required>
						    <span id="conPassMessage"></span>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 ">
                                                <span class="float-left">
                                                    <a href="'.BASE_URL.'index.php?page=signIn" class="float-left">I have an Account</a>
                                                </span>
                                                <span class="float-right">
                                                    <input type="checkbox" onclick="displayBothPasswords()"> Show Password
                                                </span>
                                            </div>
                                        </div>
					<button id="registrationBtn" class="btn btn-primary float-right mt-3" type="submit" disabled>Create Account</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        ';
        return $html;
    }
    public function noticeCard(
	$title = 'Thank You!',
	$message,
	$button = '
	    <a href="'.BASE_URL.'" type="submit" class="btn btn-primary"><i class="fa fa-home fa-lg"></i> Go Back Home</a>
	'
	){
        $html = '
            <section class="buy-pro" style="margin-top: 80px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow-lg" >
                                <div class="card-body">
                                    <h3 class="card-title text-center">'.$title.'</h3>
                                        <div class="form-group row">

                                            <div class="col-12">
						<p>'.$message.'</p>
                                            </div>
                                            <div class="col-sm-12 text-center">
						    '.$button.'
                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>

        ';
        return $html;

    }
    //Password reset display
    public function resetPassword($data = []){

        $html = '
            '.$this->banner('Password Reset', 
                '<li class="breadcrumb-item text-white" aria-current="page">Forgot Password</li>'
            ).'   
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class="card-title">Enter a new password</h3>
				    '.($data['message'] ?? '').'
                                    <form action="'.BASE_URL.'index.php" method="POST">
                                        <input type="hidden" name="action" value="resetPassword">
                                        <input type="hidden" name="resetCode" value="'.$data['code'].'">
                                        <div class="form-row">
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">New Password</label>
						    <input type="password" name="newPass" class="form-control" id="newPass" placeholder="Enter a new password" required>

						    <span id="newPassMessage"></span>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
						    <label for="validationDefault03">Confirm Password</label>
						    <input type="password" class="form-control" name="confirmPass" id="conPass" placeholder="Re-enter new password..." required>
						    <span id="conPassMessage"></span>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 ">
                                                <span class="float-left">
							<a class="card-link" href="'.BASE_URL.'signIn" >I remember my password</a>
                                                </span>
                                                <span class="float-right">
                                                    <input type="checkbox" onclick="displayBothPasswords()"> Show Password
                                                </span>
                                            </div>
                                        </div>
					<br>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
						<button id="registrationBtn" class="btn btn-primary float-right" type="submit" disabled>Change Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>

        ';
        return $html;

    }
    
    public function forgotPassword($data = []){
        $html = '
            '.$this->banner('Forgot Password ?', 
                '<li class="breadcrumb-item text-white" aria-current="page">Forgot Password</li>'
            ).'   
            <section class="buy-pro" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow" >
                                <div class="card-body">
                                    <h3 class="card-title">Forgot your password?</h3>
				    '.($data['message'] ?? '').'
                                    <form action="'.BASE_URL.'index.php" method="POST">
                                        <input type="hidden" name="action" value="forgotPassword">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Enter your Email..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <a class="card-link" href="'.BASE_URL.'signIn" >I remember my password</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary float-right">Request Password Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>

        ';
        return $html;

    }
    public function contact(){
        $html = '
            '.$this->banner('Contact Us', 
                '<li class="breadcrumb-item text-white" aria-current="page">Contact Us</li>'
            ).'   

        <!-- Main container start -->
        <section id="main-container">
            <div class="container">
                <!-- Map start here -->
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3810.4269941206694!2d-88.7756565847621!3d17.24656508816313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5dd56c2ef61fb5%3A0x49c5ccf58a047897!2sBELTRAIDE!5e0!3m2!1sen!2sbz!4v1615408434801!5m2!1sen!2sbz" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                <!--/ Map end here -->

                <div class="gap-40"></div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="contact-info">
                            <h3>Contact Details</h3>
                            <br>
                            <p><i class="fa fa-home info"></i> 3401 Mountain View Blvd., Suite 201, Belmopan, Cayo, Belize, Central America </p>
                            <p><i class="fa fa-phone info"></i> +(785) 238-4131 </p>
                            <p><i class="fa fa-envelope info"></i> beltraide@belizeinvest.org.bz</p>
                            <p><i class="fa fa-globe info"></i> <a href="https://www.belizeinvest.org.bz/exportbelize.html">Learn More About Us!</a></p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card shadow" >
                            <div class="card-body">
                                <h3 class="card-title">Connect With Us!</h3>

                                <form id="contact-form" action="'.BASE_URL.'" method="post" role="form">
				    <input name="action" placeholder="" type="hidden" value="contactUs" required>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" name="name" id="name" placeholder="What\'s your name?" type="text" required>
                                            </div>
                                        </div>
                                       <!-- <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Please solve the following</label>
                                                <input class="form-control" name="problem"  placeholder="6 + 1 = ?" required>
                                            </div>
                                        </div>-->
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" id="email" placeholder="Enter your email" type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input class="form-control" name="subject" id="subject" placeholder="Enter a subject here..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
                                    </div>
                                    <div class="mt-3">
					<div class="g-recaptcha d-inline" data-sitekey="'.RECAPTCHA_SITE_KEY.'" required></div>
                                        <button class="btn btn-primary solid blank float-right mt-3" type="submit">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ container end -->
        </section>
        <!--/ Main container end -->

        ';
        return $html;
    }
    public function footer(){


	$modals = '

		<div class="modal fade" id="notice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
			<div class="modal-header bg-light-grey">
			<h4 class="modal-title text-dark" id="notice-modal-title">Notice!</h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			</button>
			</div>
			<div class="modal-body" id="notice-modal-body"></div>
			<div class="modal-footer border-0">
			<button class="btn bs-btn-primary" type="button" data-dismiss="modal">Okay</button>
			</div>
		    </div>
		    </div>
		</div>

		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
			<div class="modal-header bg-light-grey">
			<h4 class="modal-title text-dark" id="exampleModalLabel">Ready to Leave?</h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer border-0">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			<a class="btn btn-danger" href="'.BASE_URL.'logout">Logout</a>
			</div>
		    </div>
		    </div>
		</div>

		<!-- Delete default Modal-->
		<div class="modal fade" id="deleteDefaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
			<div class="modal-header bg-light-grey">
			<h4 class="modal-title text-dark" id="deleteDefaultTitle"></h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			</button>
			</div>
			<div class="modal-body" id="deleteDefaultBody"></div>
			<div class="modal-footer border-0">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			<a id="deleteDefaultHref" class="btn btn-danger" href="">Delete</a>
			</div>
		    </div>
		    </div>
		</div>


	';

	if (!empty($_SESSION['USERDATA'])){

		switch ($_SESSION['USERDATA']['user_type']){
			
			case 'su':
			case 'admin':

				$modals .= '

					<!-- Modal adding export market-->
					<div class="modal fade" id="add-export-market-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="exampleModalLongTitle">Select an Export Market</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="post" id="add-export-market-form">
							<input type="hidden" id="export-c-id" value="" name="cId">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="SelectCompany" class="text-dark font-weight-bold">Available Export Markets</label>
									    <select class="form-control" id="available-export-markets" name="emId">
									    </select>
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="add-export-market-modal-btn" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>

					<!-- Modal adding a new export market to the system-->
					<div class="modal fade" id="add-market-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="exampleModalLongTitle">Add Export Market</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="POST" id="add-market-form">
							<input type="hidden" name="action" value="addExportMarket">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="SelectCompany" class="text-dark font-weight-bold">Name</label>
									    <input type="text" class="form-control" name="name" placeholder="eg. South korea">
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" form="add-market-form" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>


					<!-- Modal adding featured sector-->
					<div class="modal fade" id="add-featured-sector-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="add-featured-sector-title">Select a Sector to feature</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="post" id="featured-sector-form">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="available-sectors">Select a Sector</label>
									    <select class="form-control" id="available-sectors" name="sId">
									    </select>
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="add-featured-sector-btn" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>


					<!-- Modal adding featured products-->
					<div class="modal fade" id="add-featured-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="add-featured-product-title">Select a Product to feature</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="post" id="featured-product-form">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="available-products">Select a Product</label>
									    <select class="form-control" id="available-products" name="pId">
									    </select>
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="add-featured-product-btn" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>




					<!-- Modal adding featured company-->
					<div class="modal fade" id="add-featured-company-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="exampleModalLongTitle">Select a company to feature</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="post" id="featured-company-form">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="SelectCompany">Select a Company</label>
									    <select class="form-control" id="available-companies" name="cId">
									    </select>
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="add-featured-company-btn" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>


					<!-- Reject company profile Modal-->
					<div class="modal fade" id="rejectCompanyModal" tabindex="-1" role="dialog" aria-hidden="true">
					    <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
						<div class="modal-header bg-light-grey">
						<h4 class="modal-title text-dark">Reject Account Request?</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">×</span>
						</button>
						</div>
						<div class="modal-body">Confirm by clicking the "<b>Reject</b>" button below if you are sure you want to reject the account request.</div>
						<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a id="confirmRejection" class="btn btn-danger" href="">Reject</a>
						</div>
					    </div>
					    </div>
					</div>




				';
				break;

			case 'company':

				$modals .= '
					<!-- Modal adding export market-->
					<div class="modal fade" id="add-export-market-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
						<h4 class="modal-title" id="exampleModalLongTitle">Select an Export Market</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					      </div>
					      <div class="modal-body">
						<form action="'.BASE_URL.'" method="post" id="add-export-market-form">
							<div class="row">
								<div class="col-12" >
									<div class="form-group">
									    <label for="SelectCompany" class="text-dark font-weight-bold">Available Export Markets</label>
									    <select class="form-control" id="available-export-markets" name="emId">
									    </select>
									</div>
								</div>
							</div>
						</form>
					      </div>
					      <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="add-export-market-modal-btn" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
					      </div>
					    </div>
					  </div>
					</div>

				';
				break;

			case 'buyer':

				$modals .= '


				';
				break;
		}

	}


        $html = '
        <!-- Footer start -->
        <section id="footer" class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="footer-logo">
                            <a href="https://www.belizeinvest.org.bz/" ><img src="'.BASE_URL.'images/beltraide-logo-full-color_1.png" alt="logo"></a>
                        </div>
                        <div class="gap-20"></div>
                        <ul class="dark unstyled">
                            <li>
                                <a title="Facebook" href="https://www.facebook.com/BELTRAIDE/">
                                    <span class="icon-pentagon wow bounceIn"><i class="fab fa-facebook-f fa-lg"></i></span>
                                </a>
                                <a title="Twitter" href="https://twitter.com/Beltraide">
                                    <span class="icon-pentagon wow bounceIn"><i class="fab fa-twitter"></i></span>
                                </a>
                                <a title="Google+" href="https://instagram.com/beltraide/">
                                    <span class="icon-pentagon wow bounceIn"><i class="fab fa-instagram fa-lg"></i></span>
                                </a>
                                <a title="Linkedin" href="https://www.linkedin.com/company/beltraide/">
                                    <span class="icon-pentagon wow bounceIn"><i class="fab fa-linkedin-in fa-lg"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ Row end -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="copyright-info">
                            &copy; Copyright '.date('Y').' BELTRAIDE </span>
                        </div>
                    </div>
                </div>
                <!--/ Row end -->
                <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix position-fixed">
                    <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-double-up"></i></button>
                </div>
            </div>
            <!--/ Container end -->
        </section>
	<span id="preloader-container">
		<div id="preloader"></div>
	</span>

        <!--/ Footer end -->
        
        <!----START OF BOOTSTRAP MODALS ---->
        <!-- Logout Modal-->

		'.$modals.'

        <!-- END OF BOOSTRAP MODALS-->
    
        </div><!-- Body inner end -->
        <script> 
            //Global Variables for JS
            var BASE_URL = "'.BASE_URL.'";
        
        </script>
        <!-- jQuery -->
        <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
        <script src="'.BASE_URL.'plugins/jQuery/jquery.min.js"></script>
        
        
        <!-- File Input Master Scripts -->
        <script src="'.BASE_URL.'plugins/bootstrap-fileinput-master/js/plugins/piexif.min.js"></script>
        <script src="'.BASE_URL.'plugins/bootstrap-fileinput-master/js/plugins/sortable.min.js"></script>
        <script src="'.BASE_URL.'plugins/bootstrap-fileinput-master/js/plugins/purify.min.js"></script>
        
        <!-- Popper.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="'.BASE_URL.'plugins/bootstrap/bootstrap.min.js"></script>

        <!-- Style Switcher -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/style-switcher.js"></script>
       
        <!-- Owl Carousel -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/owl/owl.carousel.js"></script>
        
        <!-- PrettyPhoto -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/jquery.prettyPhoto.js"></script>
        
        <!-- Bxslider -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/flex-slider/jquery.flexslider.js"></script>
       
        <!-- CD Hero slider -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/cd-hero/cd-hero.js"></script>
        
        <!-- Isotope -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/isotope.js"></script>
        <script type="text/javascript" src="'.BASE_URL.'plugins/ini.isotope.js"></script>
        
        <!-- Wow Animation -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/wow.min.js"></script>
        
        <!-- Eeasing -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/jquery.easing.1.3.js"></script>
        
        <!-- Counter -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/jquery.counterup.min.js"></script>
        
        <!-- Waypoints -->
        <script type="text/javascript" src="'.BASE_URL.'plugins/waypoints.min.js"></script>
        
        <!-- google map > 
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9WLQjzbo03fgPhylsHoUsDmULil8FVLQ&libraries=places"></script>
        <script src="'.BASE_URL.'plugins/google-map/gmap.js"></script>
	-->
	<!-- GOOGLE RECAPTCHA V2-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<!-- bootpag pagination plugin-->
        <script src="'.BASE_URL.'js/jquery.bootpag.min.js"></script>

	<!-- Custome jQuery for User interaction with the UI-->
        <script src="'.BASE_URL.'js/pagination.js"></script>

        <!-- Datatables JS -->
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

        <!--<script src="'.BASE_URL.'plugins/datatables/jQuery.dataTables.min.js"></script>-->
        <!--<script src="'.BASE_URL.'plugins/datatables/dataTables.bootstrap4.min.js"></script>-->
        

        <!--<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
        
        <!-- File Input Master Script -->
        <script src="'.BASE_URL.'plugins/bootstrap-fileinput-master/js/fileinput.min.js"></script>
        <script src="'.BASE_URL.'plugins/bootstrap-fileinput-master/themes/fas/theme.js"></script>
        <script src="'.BASE_URL.'js/jQuery-file-upload.js"></script>

        <!-- Main Script -->
        <script src="'.BASE_URL.'js/script.js"></script>
        
        <!-- Datatable custom Script -->
        <script src="'.BASE_URL.'js/datatables.js"></script>
        
        <!-- custom javascript function definition Script -->
        <script src="'.BASE_URL.'js/custom.js"></script>

        <!-- custom javascript function definition Script -->
        <script src="'.BASE_URL.'js/jqueryForUi.js"></script>
        
	<script>
		/*if ( window.history.replaceState ) {
		  window.history.replaceState( null, null, window.location.href );
		}*/
	</script>

        </body>
        
        </html>
        ';
        return $html;
    }

}
?>
