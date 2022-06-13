<?php 

    // The Index.php file is the controller of the application, which request data from the DBMS and returns the appropriate view
    require_once('./definitions.php');
    require_once('./helper.php');
    require_once('./class.interface.php');
    require_once('./class.process.php');
    require_once('./class.email.php');

    session_start();
        
    //echo '<pre style="margin-top: 300px;">';
    //print_r($slug);
    //echo '</pre>';

    $view    = new Ui();
    $process = new Process();

    $accountOptions = array();

    //$isProcessing  = 0;  //will keep track weather a form has been submitted
    $ajaxRequest   = 0;  //will determine if an ajax request is being processed
    $pageContent   = ''; //Holds the page to be displayed to the client side

    //constant variable definitions
    const MAX_FEATURED_SECTORS = 6;
    const MAX_FEATURED_PRODUCTS = 3;
    const MAX_FEATURED_COMPANIES = 10;

    //session data defined for usage
    $user_id = $_SESSION['USERDATA']['user_id'] ?? 0;
    $user_type = $_SESSION['USERDATA']['user_type'] ?? 0;
    $user_company_id = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
    $user_company_type_id = $_SESSION['COMPANYDATA'][0]['company_type_id'] ?? 0;

    if ($_GET){
	//ALL PAGE NAVIGATIONS ARE LOCATED IN THIS SECTION

	if (!empty($_SESSION['USERDATA']) && $_GET){
	   //if user is logged in these pages take priority

		if (isset($_GET['action'])){ 
			// the following get request below are actions
			
			if( ($_GET['action'] == 'approveCompanyAccount' && isset($_GET['cId'])) && ($user_type == 'admin' || $user_type == 'admin') ){

				$cId = decrypt($_GET['cId']);
				$result = $process->approve_company_account($cId, $_SESSION['USERDATA']['user_id'], 1);

				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';

				if ($result['res_code'] == 1){

					// sending out email activation code
					$email = new Email();
			
					$title = 'Account Approved';
					$message = '
						Hello '.$result['company_email'].', your company account, <span style="color:#e50d70;">'.ucfirst($result['company_name']).'</span> has been approved please <a href="'.BASE_URL.'signIn" style="color:#e50d70;text-decoration:underline;">Sign In</a> to continue setting up your company profile.
					';
					$moreInfo = 'Thank you for joining our ExbortBelize Platform! If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

					$emailCard = $view->emailCard($title, $message, $moreInfo, 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/publications/food-beverage-nutrition/nutraingredients-asia.com/article/2021/01/20/on-track-more-health-foods-expected-to-be-approved-via-registration-track-in-china-as-2020-figure-hits-new-high/12101983-1-eng-GB/On-track-More-health-foods-expected-to-be-approved-via-registration-track-in-China-as-2020-figure-hits-new-high.png');
					
					try{
						$email->set_Subject('Account Approved');
						$sent = $email->send($result['company_email'], $emailCard);

						if (!$sent){

						    $noticeTitle = 'Failed to send email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, the company was approved but we were unable to send a notice via email of their approval. Please notify them at <a href="mailto:'.$result['company_email'].'">"'.$result['company_email'].'"</a> and report this error to the IT Unit.
							    </div>
						    ';
						}else{

							$noticeTitle = 'Company Account Was Approved';
							$noticeMessage = '
								    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
									<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
								    </h2> 
								    <div class="text-center">
									The company, "'.ucfirst($result['company_name']).'" was approved and has been notified via email.
								    </div>
							';

						}

					}catch(Exception $e){
						
						    $noticeTitle = 'An error occured while sending email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, the company was approved but we were unable to send a notice via email of their approval. Please notify them at <a href="mailto:'.$result['company_email'].'">"'.$result['company_email'].'"</a> and report this error to the IT Unit.
							    </div>
						    ';

					}


				}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '

						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							'.$result['message'].'
						    </div>
					    ';

				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'company/account-requests" type="submit" class="btn btn-primary"> View Company Requests</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'rejectCompanyAccount' && isset($_GET['cId'])) && $user_type == 'admin'){

				$cId = decrypt($_GET['cId']);
				$result = $process->approve_company_account($cId, $_SESSION['USERDATA']['user_id'], 4);

				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';

				if ($result['res_code'] == 1){

					// sending out email activation code
					$email = new Email();
			
					$title = 'Account Rejected';
					$message = '
						Hello '.$result['company_email'].', your company account, <span style="color:#e50d70;">'.ucfirst($result['company_name']).'</span> did not meet the necessary requirements to join our platform so your account request has been rejected. Please feel free to <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">Contact us</a> for more information.
					';
					$moreInfo = 'If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

					$emailCard = $view->emailCard($title, $message, $moreInfo, 'https://st.depositphotos.com/1431107/2320/v/600/depositphotos_23201462-stock-illustration-sorry-smiley.jpg');
					
					try{
						$email->set_Subject('Account Rejected');
						$sent = $email->send($result['company_email'], $emailCard);

						if (!$sent){

						    $noticeTitle = 'Failed to send email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, the company was rejectedd but we were unable to send a notice via email of their rejection. Please notify them at <a href="mailto:'.$result['company_email'].'">"'.$result['company_email'].'"</a> and report this error to the IT Unit.
							    </div>
						    ';
						}else{

							$noticeTitle = 'Company Account Was Rejected';
							$noticeMessage = '
								    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
									<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
								    </h2> 
								    <div class="text-center">
									The company, "<i>'.ucfirst($result['company_name']).'</i>" was rejected and has been notified via email.
								    </div>
							';

						}

					}catch(Exception $e){
						
						    $noticeTitle = 'An error occured while sending email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, the company was rejected but we were unable to send a notice via email of their approval. Please notify them at <a href="mailto:'.$result['company_email'].'">"'.$result['company_email'].'"</a> and report this error to the IT Unit.
							    </div>
						    ';

					}


				}else{

				    $noticeTitle = 'Error!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						'.$result['message'].'
					    </div>
				    ';

				}
				
				
				$noticeBtn = '
				    <a href="'.BASE_URL.'company/account-requests" type="submit" class="btn btn-primary"> View Company Requests</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteCompany' && isset($_GET['cId'])) && ($user_type == 'admin' || $user_type == 'su') ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$cId = decrypt($_GET['cId']);
				
				//checking to see if hscode has already been removed
				$compInfo = $process->get_company_list(null,$cId);

				if (empty($compInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected was company was not found or has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteUser($cId, $compInfo[0]['user_id'], 'company', $_SESSION['USERDATA']['user_id']);
					
					if ($wasDeleted){

						$noticeTitle = 'Company Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"<span class="font-weight-bold">'.$compInfo[0]['company_name'].'</span>" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected company. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'user-list" class="btn btn-primary"> User List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteExportMarket' && isset($_GET['emId'])) && ($user_type == 'admin' || $user_type == 'su' ) ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$emId = decrypt($_GET['emId']);
				
				//checking to see if hscode has already been removed
				$marketInfo = $process->getExportMarkets($emId);

				if (empty($marketInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Export Market has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteExportMarket($emId, $_SESSION['USERDATA']['user_id']);
					
					if ($wasDeleted){

						$noticeTitle = 'Export Market Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"<strong>'.$marketInfo[0]['name'].'</strong>" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected Export Market. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'export-market-list" class="btn btn-primary"> Export Market List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteProduct' && isset($_GET['pId'])) && $_SESSION['USERDATA']['user_type'] != 'buyer'){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$pId = decrypt($_GET['pId']);
				$cId = 0;
				
				//checking to see if hscode has already been removed
				$productInfo = $process->get_products(null, null, $pId);

				$userType = $_SESSION['USERDATA']['user_type'] ?? '';

				if (empty($productInfo)){
				    // doesnt exist

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected product does not exist or has already been deleted.
					    </div>
				    ';

				}else{
					
				
					if ($userType == 'admin' || $userType == 'su'){

						$noticeBtn = '
						    <a href="'.BASE_URL.'product-list" class="btn btn-primary"> Product List</a>
						';
						$cId = $productInfo[0]['company_id'];
				
					}else if ($userType == 'company' && $_SESSION['COMPANYDATA'][0]['company_type_id'] == 2){
						//company can only edit their product
						$cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
						$noticeBtn = '
						    <a href="'.BASE_URL.'my-products" class="btn btn-primary"> My Products</a>
						';
			
					}else{
	
						$cId = 0;
					}

					if ($cId == 0){

						    $noticeTitle = 'Error!';
						    $noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, but you cannot perform that action. 
							    </div>
						    ';



					}else{

						//still exist so we will remove it
						$wasDeleted = $process->removeProduct($productInfo[0]['product_id'], $cId, $user_id);
						
						if ($wasDeleted){

							$noticeTitle = 'Product was Deleted!';
							$noticeMessage = '
								    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
									<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
								    </h2> 
								    <div class="text-center">
									"<span class="font-weight-bold font-italic">'.$productInfo[0]['product_name'].'</span>" has been deleted!
								    </div>
							';
							
						}else{

						    $noticeTitle = 'Error!';
						    $noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, an error occured while trying to delete the selected product, please try again later. 
							    </div>
						    ';

						}


					}
				}

				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else if ( ($_GET['action'] == 'deleteSu' && isset($_GET['suId'])) && $user_type == 'su' ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';

				$id = decrypt($_GET['suId']);
				
				//checking to see if hscode has already been removed
				$userInfo = $process->getUsers($id, 'su');

				if (empty($userInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Super User does not exist or has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteUser(null, $userInfo[0]['id'], 'admin', $user_id);
					
					if ($wasDeleted){

						$noticeTitle = 'Super User was Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"<span class="font-weight-bold font-italic">'.$userInfo[0]['full_name'].'</span>" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected Super User, please try again later and if the error continues please report this to the developer. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'user-list#su-tab" class="btn btn-primary"> Super Users</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteAdmin' && isset($_GET['aId'])) && $user_type == 'su' ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';

				$id = decrypt($_GET['aId']);
				
				//checking to see if hscode has already been removed
				$userInfo = $process->getUsers($id, 'admin');

				if (empty($userInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected admin does not exist or has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteUser(null, $userInfo[0]['id'], 'admin', $user_id);
					
					if ($wasDeleted){

						$noticeTitle = 'Admin was Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"<span class="font-weight-bold font-italic">'.$userInfo[0]['full_name'].'</span>" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected admin, please try again later and if the error continues please report this to the developer. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'user-list#admin-tab" class="btn btn-primary"> Admin List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteBuyer' && isset($_GET['bId'])) && ($user_type == 'admin' || $user_type == 'su')){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$bId = decrypt($_GET['bId']);
				
				//checking to see if hscode has already been removed
				$buyerInfo = $process->get_buyer_list(null, $bId);

				if (empty($buyerInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected buyer does not exist or has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteUser($buyerInfo[0]['buyer_id'], $buyerInfo[0]['user_id'], 'buyer', $user_id);
					
					if ($wasDeleted){

						$noticeTitle = 'Buyer was Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"<span class="font-weight-bold font-italic">'.$buyerInfo[0]['full_name'].'</span>" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected buyer, please try again later and if the error continues please report this to the developer. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'user-list#buyer-tab" class="btn btn-primary"> Buyer List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else if ( ($_GET['action'] == 'deleteMusic' && isset($_GET['mId'])) && $user_type != 'buyer'){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$zero = encrypt(0);
				$mId = decrypt($_GET['mId'] ?? $zero);
				$noticeBtn = ($user_type == 'company') ?'
					<a href="'.BASE_URL.'my-music" class="btn btn-primary"> My Music</a>
				': '
					<a href="'.BASE_URL.'music-list" class="btn btn-primary"> Music List</a>
				';
				
				//checking to see if hscode has already been removed
				$musicInfo = $process->getMusics($mId);

				if (empty($musicInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected music does not exist OR has been deleted.
					    </div>
				    ';

					
				    $pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

				}else if ($user_type == 'admin' || $user_type == 'su'){

					$noticeBtn = '
						<a href="'.BASE_URL.'music-list" class="btn btn-primary"> Music List</a>
					';
					$mId = decrypt($_GET['mId'] ?? $zero);

					$wasDeleted = $process->deleteMusic($mId, $user_id);
					
					if ($wasDeleted){

						$noticeTitle = 'Music Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$musicInfo[0]['name'].'" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected music. 
						    </div>
					    ';

					}

					$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

				}else if ($user_type == 'company' && $user_company_type_id == 1){
					//company music profile

					$noticeBtn = '
						<a href="'.BASE_URL.'my-music" class="btn btn-primary"> My Music</a>
					';
					if ($user_company_id != $musicInfo[0]['company_id']){
						//music does not belong to company

					    $noticeTitle = 'Access Violation!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Cannot remove the selected music.
						    </div>
					    ';

					}else{
						$wasDeleted = $process->deleteMusic($mId, $user_id);
						
						if ($wasDeleted){

							$noticeTitle = 'Music Deleted!';
							$noticeMessage = '
								    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
									<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
								    </h2> 
								    <div class="text-center">
									"'.$musicInfo[0]['name'].'" has been deleted!
								    </div>
							';
							
						}else{

						    $noticeTitle = 'Error!';
						    $noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, an error occured while trying to delete the selected music. 
							    </div>
						    ';

						}
					}
					$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);
				}else{

					$pageContent = $view->pageNotFound();
			
				}

			}else if ( ($_GET['action'] == 'deleteService' && isset($_GET['serId'])) && $user_type != 'buyer'){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$sId = decrypt($_GET['serId']);
				$noticeBtn = ($user_type == 'company')? 
					'
					<a href="'.BASE_URL.'my-services" class="btn btn-primary"> My Services</a>
					':'
					<a href="'.BASE_URL.'service-list" class="btn btn-primary"> Service List</a>
				';
				
				//checking to see if hscode has already been removed
				$serviceInfo = $process->getServices($sId ?? 0);

				if (empty($serviceInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Service does not exist of has been deleted.
					    </div>
				    ';

				    $pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

				}else if ($user_type == 'company' && $serviceInfo[0]['company_id'] != $user_company_id){
			
					$pageContent = $view->pageNotFound();

				}else{
					//still exist so we will remove it

					$id = encrypt(0);
					$cId = ($user_type == 'company')? $user_company_id : decrypt($_GET['cId'] ?? $id);

					$wasDeleted = $process->deleteService($sId, $cId);
					
					if ($wasDeleted){

						$noticeTitle = 'Service Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$serviceInfo[0]['service_name'].'" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected service. 
						    </div>
					    ';

					}
					$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

				}


			}else if ( ($_GET['action'] == 'deleteSubServiceCategory' && isset($_GET['sscId'])) && ($user_type == 'admin' || $user_type == 'su') ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$id = decrypt($_GET['sscId']);
				
				//checking to see if hscode has already been removed
				$info = $process->getSubServiceCategory($id);

				if (empty($info)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Sub Service Category has already been deleted or does not exist.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$deleted = $process->deleteSubServiceCategory($id, $user_id);
					
					if (!$deleted){
					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected sub service category. 
						    </div>
					    ';
						
					}else{
						$noticeTitle = 'Sub Service Category Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$info[0]['sub_service_category_name'].'" has been deleted!
							    </div>
						';


					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'sub-service-category-list" class="btn btn-primary"> Sub Service Cat. List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


			}else if ( ($_GET['action'] == 'deleteServiceCategory' && isset($_GET['scId'])) && ($user_type == 'admin' || $user_type == 'su') ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$id = decrypt($_GET['scId']);
				
				//checking to see if hscode has already been removed
				$info = $process->getServiceCategory($id);

				if (empty($info)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Service Category has already been deleted or does not exist.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$deleted = $process->deleteServiceCategory($id, $user_id);
					
					if (!$deleted){
					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected service category. 
						    </div>
					    ';
						
					}else{
						$noticeTitle = 'Service Category Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$info[0]['name'].'" has been deleted!
							    </div>
						';


					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'service-category-list" class="btn btn-primary"> Service Cat. List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else if ( ($_GET['action'] == 'deleteSector' && isset($_GET['sId'])) && $user_type == 'su'){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$sId = decrypt($_GET['sId']);
				
				//checking to see if hscode has already been removed
				$sectorInfo = $process->getSectors($sId);

				if (empty($sectorInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Sector has already been deleted.
					    </div>
				    ';

				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteSector($sId, $_SESSION['USERDATA']['user_id']);
					
					if ($wasDeleted){

						$noticeTitle = 'Sector Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$sectorInfo[0]['name'].'" has been deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the selected sector. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'sector-list" class="btn btn-primary"> Sector List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else if ( ($_GET['action'] == 'deleteFaq' && isset($_GET['fId'])) && ($user_type == 'admin' || $user_type == 'su') ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$id = decrypt($_GET['fId']);

				//checking to see if hscode has already been removed
				$info = $process->getFaq($id);

				if (empty($info)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Faq has already been deleted.
					    </div>
				    ';
				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteFaq($info[0]['id'], $user_id);
					
					if ($wasDeleted){

						$noticeTitle = 'Faq Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$info[0]['question'].'", has been  deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the requested Faq, please try again later. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'faq-list" class="btn btn-primary"> Faq List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else if ( ($_GET['action'] == 'deleteHsCode' && isset($_GET['hsId'])) && ($user_type == 'admin' || $user_type == 'su') ){
				
				$noticeTitle = '';
				$noticeMessage = '';
				$noticeBtn = '';
				$hsId = decrypt($_GET['hsId']);
				
				//checking to see if hscode has already been removed
				$hsInfo = $process->getHsCodes($hsId);

				if (empty($hsInfo)){
					//already deleted

				    $noticeTitle = 'Warning!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						The selected Hs Code has already been deleted.
					    </div>
				    ';
				}else{
					//still exist so we will remove it
					$wasDeleted = $process->deleteHsCode($hsId, $_SESSION['USERDATA']['user_id']);
					
					if ($wasDeleted){

						$noticeTitle = 'Hs Code Deleted!';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								"'.$hsInfo[0]['hs_code_name'].'", has been  deleted!
							    </div>
						';
						
					}else{

					    $noticeTitle = 'Error!';
					    $noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying to delete the requested Hs Code. 
						    </div>
					    ';

					}
				}

				$noticeBtn = '
				    <a href="'.BASE_URL.'hs-code-list" class="btn btn-primary"> Hs Code List</a>
				';
				$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

			}else{

				$pageContent = $view->pageNotFound();

			}


		// END OF ACTION GET //
		
		
		//// PAGES START HERE 

		}else if ( $_GET['page'] == 'logout' ){
			//ENDING USER SESSION

			$_SESSION['USERDATA'] = '';
			$_SESSION['PAGES'] = '';

			unset($_SESSION['USERDATA']);
			unset($_SESSION['PAGES']);

			session_destroy();

			$result['sectors']    = $process->getSectors();
			$result['buyerCount'] = count($process->get_buyer_list());
			$result['companys']   = $process->get_company_list();
			$result['products'] = $process->get_products();
			$result['services'] = $process->getServices(null, null, 1);

			$pageContent = $view->home($result);
			
                
		}else if ($_GET['page'] == 'accountRequestList' && ($user_type == 'admin' || $user_type == 'su') ){

			//getting accounts that need approval
			$result['companies'] = $process->get_company_list(null, null, 3, null);
			
			$pageContent = $view->accountRequestList($result);


		//Pages below are only accessable by buyers
		}else if ($_GET['page'] == 'viewCompanies' && $user_type == 'buyer'){    
		
		    $data = [];
		    $data['searchBy']['sectors'] = $process->getSectors();
		    $data['searchBy']['exportMarkets'] = $process->getExportMarkets();

		    $data['companys'] = $process->get_company_list();

		    //getting company social media links
		    foreach ($data['companys'] as $key => $company){

			$data['companys'][$key]['socialContactList'] = $process->getSocialContactList($company['company_id']);

		    }

		    //getting buyer company bookmarks
		    $data['cBookmarks'] = $process->getBuyerCompanyBookmark(null, $user_id);
		
		    $pageContent = $view->viewCompanies($data);

		}else if ($_GET['page'] == 'faqs' && ($user_type == 'company' || $user_type == 'buyer')){    
		
		    $data = [];
		    
		    $allFaq = $process->getFaq(null, 'all');
		    $companyFaq = [];
		    $companyTypeFaq = [];
		    $buyerFaq = [];

		    if ($user_type == 'company'){

			    $companyFaq = $process->getFaq(null, 'company');
			
			    if ($user_company_type_id == 1){
				    //music
				    $companyTypeFaq = $process->getFaq(null, 'music');

			    }else if($user_company_type_id == 2){
				    //product
				    $companyTypeFaq = $process->getFaq(null, 'product');

			    }else if($user_company_type_id == 3){
				    //service
				    $companyTypeFaq = $process->getFaq(null, 'service');

			    }else{
				    //unknown user type
				    $companyTypeFaq = [];

			    }

		    }else{
			//buyer 
			$buyerFaq = $process->getFaq(null, 'buyer');

		    }

		    $data['faqs'] = array_merge($allFaq, $companyFaq, $companyTypeFaq, $buyerFaq);

		    $pageContent = $view->viewFaq($data);

		}else if ($_GET['page'] == 'viewSectors' && $user_type == 'buyer'){    
		
		    $data = [];
		
		    $data['sectors'] = $process->getSectors();

		    $pageContent = $view->viewSectors($data);

		}else if ($_GET['page'] == 'viewMusic' && $user_type == 'buyer'){    
		
		    $data = [];
		
		    $data['musics'] = $process->getMusics();

		    //getting interested music of buyer
		    $data['music_interests'] = $process->getBuyerMusicInterest(null, $user_id);

		    $pageContent = $view->viewMusic($data);

		}else if ($_GET['page'] == 'viewServices' && $user_type == 'buyer'){    
		
		    $data = [];
		    $data['searchBy']['serviceCat'] = $process->getServiceCategory();
		    $data['searchBy']['subServiceCat'] = $process->getSubServiceCategory();

		    //getting buyer service interest
		    $data['service_interests'] = $process->getBuyerServiceInterest(null, $user_id);

		    if (isset($_GET['scId'])){
			//filtering by service category
			$decryptId = decrypt($_GET['scId']);
			$serCategory = $process->getServiceCategory($decryptId);
			$serCatAc =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($serCategory[0]['acronym'] ?? '')) );
			
			if (empty($serCategory)){
			    //sector not found
			    $pageContent = $view->pageNotFound();

			}else if ($serCatAc != $_GET['scName']){

			    $pageContent = $view->pageNotFound();

			}else{
			    //gets filtered products by service
			    $data['searchBy']['scId'] = $serCategory[0]['id'];
			    $data['services'] = $process->getServices(null, null, null, null, $serCategory[0]['id'], null);
			    $pageContent = $view->viewServices($data);

			 }

		    }else if (isset($_GET['sscId'])){
			//filtering by sub service category
			$decryptId = decrypt($_GET['sscId']);
			$subSerCategory = $process->getSubServiceCategory($decryptId);
			$subSerCatName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($subSerCategory[0]['sub_service_category_name'] ?? '')) );
			
			if (empty($subSerCategory)){
			    //sector not found
			    $pageContent = $view->pageNotFound();

			}else if ($subSerCatName != $_GET['sscName']){

			    $pageContent = $view->pageNotFound();

			}else{
			    //gets filtered products by service
			    $data['searchBy']['sscId'] = $subSerCategory[0]['id'];
			    $data['services'] = $process->getServices(null, null, null, null, null, $subSerCategory[0]['id']);
			    $pageContent = $view->viewServices($data);

			}
		    }else{

			    $data['services'] = $process->getServices();
			    $pageContent = $view->viewServices($data);

		    }

		}else if ($_GET['page'] == 'viewProducts' && $user_type == 'buyer'){    
		
		    $data = [];
		    $data['searchBy']['sectors'] = $process->getSectors();
		    $data['searchBy']['exportMarkets'] = $process->getExportMarkets();

		    //getting interested products of buyer
		    $data['prod_interests'] = $process->getBuyerProductInterest(null, $user_id);

		
		    if (isset($_GET['sectorId'])){
			//sector id was passed

			$decryptId = decrypt($_GET['sectorId']);
			$data['sector'] = $process->getSectors($decryptId);
			
			if (empty($data['sector'])){
			    //sector not found
			    $pageContent = $view->pageNotFound();

			}else{
			    //sector found
			    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['sector'][0]['name'])) );
			    if ($sName != $_GET['sectorName']){
		
				    $pageContent = $view->pageNotFound();

			    }else{
				//gets filtered products by sector

				    $data['searchBy']['sectorId'] = $data['sector'][0]['id'];
				    $data['products'] = $process->get_products(null, null, null, $data['sector'][0]['id']);

				    $pageContent = $view->viewProducts($data);

			    } 

			 }

		    }else if (isset($_GET['exMarketId'])){

			$decryptId = decrypt($_GET['exMarketId']);

			$data['export'] = $process->getExportMarkets($decryptId);
			
			if (empty($data['export'])){
			    //sector not found
			    $pageContent = $view->pageNotFound();

			}else{
			    //sector found
			    $emName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['export'][0]['name'])) );
			    if ($emName != $_GET['exMarketName']){
		
				    $pageContent = $view->pageNotFound();

			    }else{
				//gets filtered products by sector

				    $data['searchBy']['exportMarketId'] = $data['export'][0]['id'];
				    $data['products'] = $process->get_products(null, null, null, null, $data['export'][0]['id']);
				    //$data['products'] = $process->getProductsByExportMarket($data['export']['id']);

				    $pageContent = $view->viewProducts($data);


			    } 

			}
			
		    }else if (isset($_GET['hsCode'])){

			    $data['searchBy']['hsCode'] = $_GET['hsCode'];
			    $data['products'] = $process->get_products(null, $_GET['hsCode']);

			    $pageContent = $view->viewProducts($data);


		
		    }else{

			    $data['products'] = $process->get_products();

			    $pageContent = $view->viewProducts($data);

		    }

		}else if ($_GET['page'] == 'musicDetails' && (isset($_GET['mName']) && isset($_GET['mId'])) && $user_type == 'buyer'){    

		    //validating encrypted ID 
		    $mId = decrypt($_GET['mId']);

		    $music = $process->getMusics($mId);
		    $mName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music[0]['name'])) );

		    if (empty($music)){

			$pageContent = $view->pageNotFound();

		    }else if ($_GET['mName'] != $mName){

			$pageContent = $view->pageNotFound();

		    }else{
			//validating url name
			$result['musicDetails'] = $music;
			$result['companyDetails'] = $process->get_company_list(null, $music[0]['company_id']);

			//getting buyer service interest status
			$interested = $process->getBuyerMusicInterest(null, $user_id, $result['musicDetails'][0]['id']);
			if (!empty($interested) && isset($interested[0]['music_id'])){
				$result['musicDetails'][0]['is_interested'] = 1;
			}else{
				$result['musicDetails'][0]['is_interested'] = 0;
			}

			$pageContent = $view->musicDetails($result);

		    }


		}else if ($_GET['page'] == 'sectorDetails' && (isset($_GET['sName']) && isset($_GET['sId'])) && $user_type == 'buyer'){    

		    //validating encrypted ID 
		    $sId = decrypt($_GET['sId']);

		    $sector = $process->getSectors($sId);
		    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector[0]['name'])) );

		    if (empty($sector)){

			$pageContent = $view->pageNotFound();

		    }else if ($_GET['sName'] != $sName){

			$pageContent = $view->pageNotFound();

		    }else{

			if ($sector[0]['id'] == 13){
			//offshore outsourcing sector
				$result['categories'] = $process->getServiceCategory();
				$result['subCategories'] = $process->getSubServiceCategory();

			}else{
			//just a normal sector
				$result['hsCodes'] = $process->getHsCodes(null, null, $sector[0]['id']);

			}

			$result['sectorDetails'] = $sector;
			$result['sectors'] = $process->getSectors();

			$pageContent = $view->sectorDetails($result);

		    }

		}else if ($_GET['page'] == 'serviceDetails' && (isset($_GET['serName']) && isset($_GET['serId']))  && $user_type == 'buyer'){    

		    //validating encrypted ID 
		    $serId = decrypt($_GET['serId']);

		    $service = $process->getServices($serId);
		    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service[0]['service_name'])) );

		    if (empty($service)){

			$pageContent = $view->pageNotFound();

		    }else if ($_GET['serName'] != $sName){

			$pageContent = $view->pageNotFound();

		    }else{
			//validating url name
			$result['serviceDetails'] = $service;
			$result['companyDetails'] = $process->get_company_list(null, $service[0]['company_id']);

			//getting buyer service interest status
			$interested = $process->getBuyerServiceInterest(null, $user_id, $result['serviceDetails'][0]['id']);
			if (!empty($interested) && isset($interested[0]['service_id'])){
				$result['serviceDetails'][0]['is_interested'] = 1;
			}else{
				$result['serviceDetails'][0]['is_interested'] = 0;
			}

			$pageContent = $view->serviceDetails($result);

		    }

		}else if ($_GET['page'] == 'productDetails' && (isset($_GET['productName']) && isset($_GET['productId'])) && $user_type == 'buyer'){    

		    //validating encrypted ID 
		    $pId = decrypt($_GET['productId']);

		    $product = $process->get_products(null, null, $pId);

		    if (empty($product)){
			$pageContent = $view->pageNotFound();
		    }else{
			//validating url name
			$pName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product[0]['product_name'])) );

			if ($_GET['productName'] != $pName){

				$pageContent = $view->pageNotFound();

			}else{

				$result['exportMarkets'] = $process->getExportMarkets();
				$result['exportMarketList'] = $process->getExportMarketList($product[0]['company_id']);
				$result['productDetails'] = $product;
				$result['companyDetails'] = $process->get_company_list(null, $product[0]['company_id']);

				//getting buyer product interest status
				$interested = $process->getBuyerProductInterest(null, $user_id, $result['productDetails'][0]['product_id']);
				if (!empty($interested) && isset($interested[0]['product_id'])){
					$result['productDetails'][0]['is_interested'] = 1;
				}else{
					$result['productDetails'][0]['is_interested'] = 0;
				}

				$pageContent = $view->productDetails($result);

			}
		    }


		}else if ($_GET['page'] == 'companyDetail' && (isset($_GET['companyName']) && isset($_GET['companyId'])) && $user_type == 'buyer'){    

		    //validating encrypted ID 
		    $cId = decrypt($_GET['companyId']);

		    $result['companyDetails'] = $process->get_company_list(null, $cId);

		    if (empty($result['companyDetails'])){

			$pageContent = $view->pageNotFound();

		    }else{
			//validating url name
			$cName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($result['companyDetails'][0]['company_name'])) );

			if ($_GET['companyName'] != $cName){

				$pageContent = $view->pageNotFound();

			}else{

				switch ($result['companyDetails'][0]['company_type_id']){

					case 1://music

						$result['musics'] = $process->getMusics(null, $result['companyDetails'][0]['company_id']);
						break;

					case 2://product
						$result['products'] = $process->getCompanyProducts($result['companyDetails'][0]['company_id']);
						break;

					case 3://service
						$result['services'] = $process->getServices(null, $result['companyDetails'][0]['company_id']);
						break;

				}
				
				$result['pointOfContact'] = $process->getPointOfContact($result['companyDetails'][0]['company_id']);
				$result['exportMarkets'] = $process->getExportMarkets();
				$result['sectors'] = $process->getSectors();
				
				$result['socialContactList'] = $process->getSocialContactList($result['companyDetails'][0]['company_id']);
				$result['exportMarketList'] = $process->getExportMarketList($result['companyDetails'][0]['company_id']);

				//checking if buyer bookmarked this company
				$isBookmarked = $process->getBuyerCompanyBookmark(null, $user_id, $result['companyDetails'][0]['company_id']);
				if (!empty($isBookmarked) && isset($isBookmarked[0]['company_id'])){
					$result['companyDetails'][0]['is_bookmarked'] = 1;
				}else{
					$result['companyDetails'][0]['is_bookmarked'] = 0;
				}

				$pageContent = $view->companyDetails($result);

			}


		    }

		//most of the pages below will be accessed by a admin, su or company
		}else if ($_GET['page'] == 'dashboard'){


			switch ( $user_type ){
	
				case 'su':

					//getting company account requests
					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);

					//getting info on components
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['serviceCat']    	 = $process->getServiceCategory();
					$data['subServiceCat']   = $process->getSubServiceCategory();

					//getting users
					$data['buyers']     	 = $process->get_buyer_list();
					$data['admins']     	 = $process->getUsers(null, 'admin');
					$data['superUsers']    	 = $process->getUsers(null, 'su');
					$data['companys']   	 = $process->get_company_list(null, null, 1);

					//getting items provided by companies
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->superUserDashboard($data);

					break;
	
				case 'admin':

					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['buyers']     	 = $process->get_buyer_list();
					$data['companys']   	 = $process->get_company_list(null, null, 1);
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->adminDashboard($data);

					break;

				case 'company':

					$data['socialContactList'] = $process->getSocialContactList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['exportMarketList'] = $process->getExportMarketList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['companyInfo']   = $process->get_company_list(null, $_SESSION['COMPANYDATA'][0]['company_id']);
					$data['pointOfContact']   = $process->getPointOfContact($_SESSION['COMPANYDATA'][0]['company_id']);

					if ($user_company_type_id == 1){
						// music profile
						$data['musics']      = $process->getMusics(null, $user_company_id);

					}else if ($user_company_type_id == 2){
						//product profile
						$data['products']      = $process->getCompanyProducts($user_company_id);

					}else{
						//service profile
						$data['services']   	 = $process->getServices(null, $user_company_id);

					}

					$pageContent = $view->companyDashboard($data);
					break;
				
				case 'buyer':

					//getting application general information
					$data['sectors']    = $process->getSectors();
					$data['buyerCount'] = count($process->get_buyer_list());
					$data['companys']   = $process->get_company_list();
					$data['products']   = $process->get_products();
					$data['services']   = $process->getServices(null, null, 1);
					$data['musics']     = $process->getMusics();

					//getting buyer interest
					$data['interests'] = $process->getInterestedSector(null, $user_id);
					$data['prod_interests'] = $process->getBuyerProductInterest(null, $user_id);
					$data['service_interests'] = $process->getBuyerServiceInterest(null, $user_id);
					$data['music_interests'] = $process->getBuyerMusicInterest(null, $user_id);

					//getting buyer company bookmarks
					$data['cBookmarks'] = $process->getBuyerCompanyBookmark(null, $user_id);

					$pageContent = $view->buyerDashboard($data);
					break;

				default:

					$pageContent = $view->pageNotFound();
					break;
			}

		}else if ($_GET['page'] == 'profile'){


			switch ( $_SESSION['USERDATA']['user_type'] ){
	
				case 'su':

					$pageContent = $view->superUserProfile();

					break;
	
				case 'admin':

					$pageContent = $view->adminProfile();
					break;


				case 'company':
					
					$cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;

					//checking user type

					$result['companyDetails'] = $process->get_company_list(null,$cId);
					$result['pointOfContact'] = $process->getPointOfContact($cId);
					$result['socialContacts'] = $process->getSocialContact();
					$result['socialContactList'] = $process->getSocialContactList($cId);
					$result['exportMarkets'] = $process->getExportMarkets();
					$result['exportMarketList'] = $process->getExportMarketList($cId);

					$pageContent = $view->companyProfile($result);
					break;
				
				case 'buyer':

					$result['sectors'] = $process->getSectors();
					$result['interest'] = $process->getInterestedSector(null, $user_id);
					$result['buyerInfo'] = $process->get_buyer_list(null, $user_id);

					$pageContent = $view->buyerProfile($result);
					break;

				default:

					$pageContent = $view->pageNotFound();
					break;
			}
		
		}else if ( ( $_GET['page'] == 'editMyProduct' && isset($_GET['pId']) ) && $user_type == 'company'){
			// PAGES ACCESSABLE BY ADMIN AND COMPANY

		    $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
		    $pId = decrypt($_GET['pId'] ?? 0);

		    $result['product'] = $process->get_products(null, null, $pId);

		    if (empty($result['product'])){

			$pageContent = $view->pageNotFound();

		    }else{

			    $result['initialPrev'] = array();
			    $result['initialPrevConfig'] = array();

			    foreach( $result['product'][0]['productImages'] as $key => $productImg ){

				$result['initialPrev'][$key] = array(
				    BASE_URL.$productImg['path']
				);

				$result['initialPrevConfig'][$key] = array(
				    'caption' => $productImg['file_name'],
				    'url' => BASE_URL.'index.php/',
				    'key' => encrypt($productImg['id']),
				    'size' => $productImg['size'],
				    'downloadUrl' => BASE_URL.$productImg['path'],
				    'type' => 'image',//$productImg['type'],
				    'extra' => ['productId'=>encrypt($result['product'][0]['product_id']), 'ajaxRequest'=>'removeProductImg']
				);

			    }

			    $result['uploadExtraData'] = array(
				'ajaxRequest' => 'uploadProductImg',
				'productId' => encrypt($result['product'][0]['product_id'])
			    );
			   
			    $result['pageTitle'] = $result['product'][0]['product_name'];
			    $result['bannerTitle'] = 'Edit Product';
			    $result['hsCodes'] = $process->getHsCodes();

			    $pageContent = $view->editProduct($result);

		    }


		}else if ( ( $_GET['page'] == 'editProduct' && isset($_GET['pId']) ) && ( $user_type == 'admin' || $user_type == 'su' ) ){
			// PAGES ACCESSABLE BY ADMIN AND COMPANY

		    $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
		    $pId = decrypt($_GET['pId'] ?? 0);

		    $result['product'] = $process->get_products(null, null, $pId);

		    if (empty($result['product'])){

			$pageContent = $view->pageNotFound();

		    }else{

			    $result['initialPrev'] = array();
			    $result['initialPrevConfig'] = array();

			    foreach( $result['product'][0]['productImages'] as $key => $productImg ){

				$result['initialPrev'][$key] = array(
				    BASE_URL.$productImg['path']
				);

				$result['initialPrevConfig'][$key] = array(
				    'caption' => $productImg['file_name'],
				    'url' => BASE_URL.'index.php/',
				    'key' => encrypt($productImg['id']),
				    'size' => $productImg['size'],
				    'downloadUrl' => BASE_URL.$productImg['path'],
				    'type' => 'image',//$productImg['type'],
				    'extra' => ['productId'=>encrypt($result['product'][0]['product_id']), 'ajaxRequest'=>'removeProductImg']
				);

			    }

			    $result['uploadExtraData'] = array(
				'ajaxRequest' => 'uploadProductImg',
				'productId' => encrypt($result['product'][0]['product_id']),
				'companyId' => encrypt($result['product'][0]['company_id'])
			    );
			   
			    $result['pageTitle'] = $result['product'][0]['product_name'];
			    $result['bannerTitle'] = 'Edit Product';
			    $result['hsCodes'] = $process->getHsCodes();

			    $pageContent = $view->editProduct($result);

		    }


                }else if ($_GET['page'] == 'myMusic' && ($user_type == 'company' && $user_company_type_id == 1) ){ 
                    //company product profile
                    $result['companyDetails'] = $process->get_company_list(null, $user_company_id);
                    $result['musics'] = $process->getMusics(null, $result['companyDetails'][0]['company_id']);
                    
                    $pageContent = $view->myMusic($result);
    
                }else if ($_GET['page'] == 'myProducts' && ($user_type == 'company' && $user_company_type_id == 2) ){ 
                    //company product profile
                    $result['companyDetails'] = $process->get_company_list(null, $user_company_id);
                    $result['products'] = $process->getCompanyProducts($result['companyDetails'][0]['company_id']);
                    
                    $pageContent = $view->myProducts($result);
    
                }else if ($_GET['page'] == 'myServices' && ($user_type == 'company' && $user_company_type_id == 3) ){ 
                    //company product profile
                    $result['companyDetails'] = $process->get_company_list(null, $user_company_id);
                    $result['services'] = $process->getServices(null, $result['companyDetails'][0]['company_id']);
                    
                    $pageContent = $view->myServices($result);
    
                    
                }else if ($_GET['page'] == 'addProduct' && $user_type != 'buyer'){ 


			if ($user_type == 'admin' || $user_type == 'su'){
				//admin and super users can access this page
				$result = [];
				$company = $process->get_company_list();

				foreach ($company as $key => $company){
					if ($company['company_type_id'] == 2){
						// product type companies
						$result['companys'][] = $company;
					}
				}
					
				$result['hsCodes'] = $process->getHsCodes();
			    
				$pageContent = $view->addProduct($result);
			}else if ($user_type == 'company' && $user_company_type_id == 2){ // company supplies products

				// company
				$result['hsCodes'] = $process->getHsCodes();
			    
				$pageContent = $view->addProduct($result);

			}else{
				$pageContent = $view->pageNotFound();
			}

                }else if ($_GET['page'] == 'addSubServiceCategory' && $user_type == 'su' ){

	 	    $data['serviceCategories'] = $process->getServiceCategory();

		    $pageContent = $view->addSubServiceCategory($data);


                }else if ($_GET['page'] == 'addServiceCategory' && $user_type == 'su' ){

		    $pageContent = $view->addServiceCategory();

                }else if ($_GET['page'] == 'addMusic' && $user_type != 'buyer'){

		     
		    if ($user_type == 'su' || $user_type == 'admin'){
				
   			    $data = [];
			    $companies = $process->get_company_list();

			    foreach($companies as $company){

				if ($company['company_type_id'] == 1){//company provides services
				
					$data['companys'][] = $company; 

				}
			    }

			    $pageContent = $view->addMusic($data);


		    }else if ($user_type = 'company' && $user_company_type_id  == 1){
				// music company profile
			    $pageContent = $view->addMusic();

		    }else{
			$pageContent = $view->pageNotFound();
		    }


                }else if ($_GET['page'] == 'addHsCode' && ($user_type == 'admin' || $user_type == 'su')){

	 	    $data['sectors'] = $process->getSectors();

		    $pageContent = $view->addHsCode($data);

                }else if ($_GET['page'] == 'addFaq' && ($user_type == 'admin' || $user_type == 'su')){

		    $pageContent = $view->addFaq();

                }else if ($_GET['page'] == 'editMusic' && $user_type != 'buyer'){
		     
		    $mId = decrypt($_GET['mId'] ?? 0);

		    if ($user_type == 'su' || $user_type == 'admin'){
				
   			    $data = [];
			    $data['musicInfo'] = $process->getMusics($mId);
			    $companies = $process->get_company_list();

			    foreach($companies as $company){

				if ($company['company_type_id'] == 1){//company provides services
				
					$data['companys'][] = $company; 

				}
			    }

			    $pageContent = $view->editMusic($data);


		    }else if ($user_type = 'company' && $user_company_type_id  == 1){
			// music company profile

			    $data['musicInfo'] = $process->getMusics($mId, $user_company_id);

			    $pageContent = $view->editMusic($data);

		    }else{
			$pageContent = $view->pageNotFound();
		    }

                }else if ( ($_GET['page'] == 'editSubServiceCategory' && isset($_GET['sscId'])) && $user_type == 'su'){
		
		    $sscId = decrypt($_GET['sscId']);
		    $data['subServiceCatInfo'] = $process->getSubServiceCategory($sscId);

		    if (!empty($data['subServiceCatInfo'])){
			
			    $data['serviceCategories'] = $process->getServiceCategory();

			    $pageContent = $view->editSubServiceCategory($data);

	            }else{
			    $pageContent = $view->pageNotFound();

		    }

                }else if ( ($_GET['page'] == 'editServiceCategory' && isset($_GET['scId'])) && $user_type == 'su'){
		
		    $scId = decrypt($_GET['scId']);
		    $data['serviceCatInfo'] = $process->getServiceCategory($scId);

		    if (!empty($data['serviceCatInfo'])){
			
			    $pageContent = $view->editServiceCategory($data);

	            }else{
			    $pageContent = $view->pageNotFound();

		    }

                }else if ( ($_GET['page'] == 'editFaq' && isset($_GET['fId'])) && ($user_type == 'admin' || $user_type == 'su') ){
		
		    $id = decrypt($_GET['fId']);
		    $data['faqInfo'] = $process->getFaq($id);

		    if (!empty($data['faqInfo'])){
			
			    $data['sectors'] = $process->getSectors();

			    $pageContent = $view->editFaq($data);

	            }else{
			    $pageContent = $view->pageNotFound();

		    }
                }else if ( ($_GET['page'] == 'editHsCode' && isset($_GET['hsId'])) && ($user_type == 'admin' || $user_type == 'su') ){
		
		    $hsId = decrypt($_GET['hsId']);
		    $data['hsInfo'] = $process->getHsCodes($hsId);

		    if (!empty($data['hsInfo'])){
			
			    $data['sectors'] = $process->getSectors();

			    $pageContent = $view->editHsCode($data);

	            }else{
			    $pageContent = $view->pageNotFound();

		    }

                }else if ($_GET['page'] == 'subServiceCategoryList' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['serviceCategories'] = $process->getSubServiceCategory();

		    $pageContent = $view->subServiceCategoryList($data);

                }else if ($_GET['page'] == 'serviceCategoryList' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['serviceCategories'] = $process->getServiceCategory();
		    $pageContent = $view->serviceCategoryList($data);

                }else if ($_GET['page'] == 'hsCodeList' && ($user_type == 'admin' || $user_type == 'su')){

		    $data['codes'] = $process->getHsCodes();
		    $pageContent = $view->hsCodeList($data);

                }else if ($_GET['page'] == 'faqList' && ($user_type == 'admin' || $user_type == 'su')){

		    $data['faqs'] = $process->getFaq();

		    $pageContent = $view->faqList($data);

                }else if ($_GET['page'] == 'exportMarketList' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['exportMarkets'] = $process->getExportMarkets();
		    $pageContent = $view->exportMarketList($data);

                }else if ($_GET['page'] == 'musicList' && ($user_type == 'admin' || $user_type == 'su')){

                    if (isset($_GET['cId'])){
                        //display services for a specific company

			$cId = decrypt($_GET['cId']);
		        $company = $process->get_company_list(null, $cId);

                        if (empty($company) || $company[0]['company_type_id'] != 1){
                            //company does not exist or does not make music
                            $pageContent = $view->pageNotFound();

                        }else{
                            //company products found 
			    $result['musics'] = $process->getMusics(null, $cId);

                            $result['bannerTitle'] = 'Music';
                            $result['pageTitle'] = $company[0]['company_name'].' Music';
                            $result['breadCrumb'] ='
                            <li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">Company Music</li>
                            ';

		  	    $pageContent = $view->musicList($result);

                        }

                    }else{
                        //display all services
			$result['musics'] = $process->getMusics();
			
                        $result['bannerTitle'] = 'Music List';
                        $result['pageTitle'] = 'Music';
                        $result['breadCrumb'] ='
                        <li class="breadcrumb-item text-white" aria-current="page">Music</li>
                        ';
                        
		        $pageContent = $view->musicList($result);


                    }
                }else if ($_GET['page'] == 'featuredSectors' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['sectors'] = $process->getSectors(null, null, 1, 1);
		    $data['pageTitle'] = 'Featured';
		    $data['breadCrumbTitle'] = 'Featured Sectors';
		    $data['breadCrumbs'] = '
                        <li class="breadcrumb-item text-white" aria-current="page"><a href="'.BASE_URL.'sector-list"> Sector List</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Featured</li>
		    ';
			
		    $pageContent = $view->sectorList($data);

                }else if ($_GET['page'] == 'sectorList' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['sectors'] = $process->getSectors();
		    $pageContent = $view->sectorList($data);

                }else if ( $_GET['page'] == 'featuredCompany' && ($user_type == 'admin' || $user_type == 'su') ){

		    $result = [];
                    $companies = $process->get_company_list();
			
		    $i = 0;
		    // filtering out companies by getting featured status being 1 
		    foreach ($companies as $key => $company){
			
			if ($company['is_featured'] == 1){

				$result['companies'][$i] = $company;
				//getting the amout of products a company has
				$result['companies'][$i]['productCount'] = count($process->getCompanyProducts($company['company_id']));
				$i++;

			}
		    }

		    //getting buyers info
                    $result['buyers'] = $process->get_buyer_list();
		    if ($user_type == 'su'){

			$result['admins']     	 = $process->getUsers(null, 'admin');
			$result['superUsers']  	 = $process->getUsers(null, 'su');

		    }

                    $pageContent = $view->userList($result);

                }else if ( $_GET['page'] == 'userList' && ($user_type == 'admin' || $user_type == 'su') ){

                    $result['companies'] = $process->get_company_list();
                    $result['buyers'] = $process->get_buyer_list();

		    if ($user_type == 'su'){

			$result['admins']     	 = $process->getUsers(null, 'admin');
			$result['superUsers']  	 = $process->getUsers(null, 'su');

		    }
                    //getting the amout of products a company has
                    foreach ($result['companies'] as $key => $company){
                        $result['companies'][$key]['productCount'] = count($process->getCompanyProducts($company['company_id']));
                    }

                    $pageContent = $view->userList($result);

                }else if ( ($_GET['page'] == 'buyerInfo' && isset($_GET['bId'])) && ($user_type == 'admin' || $user_type == 'su') ){
		
			$bId = decrypt($_GET['bId']);

			$data['buyerInfo'] = $process->get_buyer_list(null, $bId);

			if (!empty($data['buyerInfo'])){
			    //getting all info about the company


				$data['sectors'] = $process->getSectors();
				$data['interests'] = $process->getInterestedSector(null, $data['buyerInfo'][0]['user_id']);

				$pageContent = $view->buyerInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}


                }else if ( ($_GET['page'] == 'serviceInfo' && isset($_GET['serId']) ) && ($user_type == 'admin' || $user_type == 'su') ){
		
			$serId = decrypt($_GET['serId']);

			$data['serviceInfo'] = $process->getServices($serId);

			if (!empty($data['serviceInfo'])){
			    //getting all info about the company

				$data['companyInfo'] = $process->get_company_list(null, $data['serviceInfo'][0]['company_id']);

				$pageContent = $view->serviceInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                }else if ( ($_GET['page'] == 'productInfo' && isset($_GET['pId'])) && ($user_type == 'admin' || $user_type == 'su') ){
		
			$pId = decrypt($_GET['pId']);

			$data['productInfo'] = $process->get_products(null, null, $pId);

			if (!empty($data['productInfo'])){
			    //getting all info about the company

				$data['companyInfo'] = $process->get_company_list(null, $data['productInfo'][0]['company_id']);

				if ($data['companyInfo'][0]['trade_type'] != 'local'){
					$data['exportMarketList'] = $process->getExportMarketList($data['companyInfo'][0]['company_id']);
				}

				$pageContent = $view->productInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                }else if ( ($_GET['page'] == 'companyInfo' && isset($_GET['cId'])) && ($user_type == 'admin' || $user_type == 'su') ){
		
			$cId = decrypt($_GET['cId']);
			$status = 1;

			if (isset($_GET['cStatus']) && $_GET['cStatus'] == 'pending'){
				
				$status = 3;

			}
			
			$data['companyInfo'] = $process->get_company_list(null, $cId, $status);

			if (!empty($data['companyInfo'])){
			    //getting all info about the company

                                $data['pointOfContact'] = $process->getPointOfContact($data['companyInfo'][0]['company_id']);
				$data['socialContactList'] = $process->getSocialContactList($data['companyInfo'][0]['company_id']);
				$data['exportMarketList'] = $process->getExportMarketList($data['companyInfo'][0]['company_id']);
	
				switch($data['companyInfo'][0]['company_type_id']){

					case 1: // Music 

						$data['musics']  = $process->getMusics(null, $data['companyInfo'][0]['company_id']);

					break;

					case 2: // Supplier 

						$data['products']   = $process->getCompanyProducts($data['companyInfo'][0]['company_id']);

					break;

					case 3: // Services 

						$data['services']   = $process->getServices(null, $data['companyInfo'][0]['company_id']);

					break;

				}
	

				$pageContent = $view->companyInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                }else if ( $_GET['page'] == 'editService' && isset($_GET['serId']) && $user_type != 'buyer'){

		    $sId = decrypt($_GET['serId']);
		    $data['serviceInfo'] = $process->getServices($sId);

		    if (empty($data['serviceInfo'])){

			    $pageContent = $view->pageNotFound();

	            }else if($user_type == 'admin' || $user_type == 'su'){
			
			    $data['sectors'] = $process->getSectors();
			    $data['subServiceCategories'] = $process->getSubServiceCategory();
			    $companies = $process->get_company_list();

			    foreach($companies as $company){

				//filtering out companies and selecting those that provide services
				if ($company['company_type_id'] == 3){
				
					$data['companys'][] = $company; 

				}
			    }

			    $pageContent = $view->editService($data);

		    }else{
			//company account
			    $data['sectors'] = $process->getSectors();
			    $data['serviceCategories'] = $process->getSubServiceCategory();

			    $pageContent = $view->editService($data);
		    }
                }else if ( ($_GET['page'] == 'editSector' && isset($_GET['sId'])) && ($user_type == 'admin' || $user_type == 'su') ){

		    $sId = decrypt($_GET['sId']);
		    $data['sectorInfo'] = $process->getSectors($sId);

		    if (!empty($data['sectorInfo'])){

			    $pageContent = $view->editSector($data);

	            }else{
			    $pageContent = $view->pageNotFound();

		    }
                }else if ($_GET['page'] == 'addUser' && ($user_type == 'admin' || $user_type == 'su') ){

		    $data['companyTypes'] = $process->getCompanyTypes();

		    $pageContent = $view->addUser($data);

                }else if ($_GET['page'] == 'addSector' && ($user_type == 'admin' || $user_type == 'su')){

		    $pageContent = $view->addSector();

                }else if ($_GET['page'] == 'addService' && $user_type != 'buyer'){
		    if ($user_type == 'su' || $user_type == 'admin'){

			    $data['sectors'] = $process->getSectors();
			    $data['serviceCategories'] = $process->getSubServiceCategory();
			    $companies = $process->get_company_list();

			    foreach($companies as $company){

				if ($company['company_type_id'] == 3){//company provides services
				
					$data['companys'][] = $company; 

				}
			    }

			    $pageContent = $view->addService($data);


		    }else if ($user_type == 'company'){

			    $data['sectors'] = $process->getSectors();
			    $data['serviceCategories'] = $process->getSubServiceCategory();

			    $pageContent = $view->addService($data);

		    }else{
			$pageContent = $view->pageNotFound();
		    }

                }else if ($_GET['page'] == 'featuredService' && ($user_type == 'admin' || $user_type == 'su')){
			
                        $result['services'] = $process->getServices(null, null, 1);
			
                        $result['bannerTitle'] = 'Featured Services';
                        $result['pageTitle'] = 'Featured';
                        $result['breadCrumb'] ='
                        <li class="breadcrumb-item text-white" aria-current="page"><a href ="'.BASE_URL.'service-list">Services</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Featured</li>
                        ';
                        
		        $pageContent = $view->serviceList($result);

                }else if ($_GET['page'] == 'serviceList' && ($user_type == 'admin' || $user_type == 'su')){

                    if (isset($_GET['cId'])){
                        //display services for a specific company

			$cId = decrypt($_GET['cId']);
		        $company = $process->get_company_list(null, $cId);

                        if (empty($company) || $company[0]['company_type_id'] != 3){
                            //company does not exist or does not provide services 
                            $pageContent = $view->pageNotFound();

                        }else{
                            //company products found 
			    $result['services'] = $process->getServices(null, $cId);

                            $result['companyDetails'] = $company;
                            $result['bannerTitle'] = 'Services';
                            $result['pageTitle'] = $result['companyDetails'][0]['company_name'].' Services';
                            $result['breadCrumb'] ='
                            <li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">Company Services</li>
                            ';

                            $pageContent = $view->serviceList($result);

                        }

                    }else{
                        //display all services

                        $result['services'] = $process->getServices();
			
                        $result['bannerTitle'] = 'Service List';
                        $result['pageTitle'] = 'Services';
                        $result['breadCrumb'] ='
                        <li class="breadcrumb-item text-white" aria-current="page">Services</li>
                        ';
                        
		        $pageContent = $view->serviceList($result);


                    }
                
                }else if ($_GET['page'] == 'featuredProduct' && ($user_type == 'admin' || $user_type == 'su')){

                        $products = $process->get_products();
			
			//getting the all featured products
			foreach ($products as $key => $product){
				
				if ($product['is_featured'] == 1){
					
					$result['products'][] = $product; 
				}
			}
                        $result['bannerTitle'] = 'Featured Products';
                        $result['pageTitle'] = 'Featured';
                        $result['breadCrumb'] ='
                        <li class="breadcrumb-item"><a href="'.BASE_URL.'product-list">Product List</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Featured</li>
                        ';
                        
                        $pageContent = $view->productList($result);

                }else if ($_GET['page'] == 'productList' && ($user_type == 'admin' || $user_type == 'su')){

                    if (isset($_GET['cId'])){
                        //display products for a specific company

			$cId = decrypt($_GET['cId']);
		        $company = $process->get_company_list(null, $cId);

                        if (empty($company) || $company[0]['company_type_id'] != 2){
                            //company products not found

                            $pageContent = $view->pageNotFound();

                        }else{
                            //company products found 
			    $result['products'] = $process->getCompanyProducts($cId);

                            $result['companyDetails'] = $process->get_company_list(null, $cId);
                            $result['bannerTitle'] = $result['companyDetails'][0]['company_name'].' Product List';
                            $result['pageTitle'] = $result['companyDetails'][0]['company_name'].' Products';
                            $result['breadCrumb'] ='
                            <li class="breadcrumb-item"><a href="'.BASE_URL.'user-list">User List</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">Product List</li>
                            ';

                            $pageContent = $view->productList($result);

                        }

                    }else{
                        //display all products

                        $result['products'] = $process->get_products();
                        $result['bannerTitle'] = 'Product List';
                        $result['pageTitle'] = 'Products';
                        $result['breadCrumb'] ='
                        <li class="breadcrumb-item text-white" aria-current="page">Product List</li>
                        ';
                        
                        $pageContent = $view->productList($result);


                    }
                
                }else if ($_GET['page'] == 'editSu' && $user_type == 'su' ){

                    if (isset($_GET['suId'])){

			$id = decrypt($_GET['suId']);

			$data['suInfo'] = $process->getUsers($id, 'su');

			if (!empty($data['suInfo'])){
			        //getting all info about the company
				$pageContent = $view->editSuperUserInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                    }else{
                        $pageContent = $view->pageNotFound();
                    }

                }else if ($_GET['page'] == 'editAdmin' && $user_type == 'su' ){

                    if (isset($_GET['aId'])){

			$id = decrypt($_GET['aId']);

			$data['adminInfo'] = $process->getUsers($id, 'admin');

			if (!empty($data['adminInfo'])){
			        //getting all info about the company
				$pageContent = $view->editAdminInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                    }else{
                        $pageContent = $view->pageNotFound();
                    }

                }else if ($_GET['page'] == 'editBuyer' && ($user_type == 'admin' || $user_type == 'su') ){


                    if (isset($_GET['bId'])){

			$bId = decrypt($_GET['bId']);

			$data['buyerInfo'] = $process->get_buyer_list(null, $bId);

			if (!empty($data['buyerInfo'])){
			        //getting all info about the company
				$pageContent = $view->editBuyerInfo($data);

			}else{
				$pageContent = $view->pageNotFound();

			}

                    }else{
                        $pageContent = $view->pageNotFound();
                    }

                }else if ($_GET['page'] == 'editCompany' && ($user_type == 'admin' || $user_type == 'su')){

                    if (isset($_GET['cId'])){
			$cId = decrypt($_GET['cId']);
                        $result['companyDetails'] = $process->get_company_list(null, $cId);

                        if ($result['companyDetails'] == false){
                            $pageContent = $view->pageNotFound();
                        }else{
                            
                            $result['exportMarkets'] = $process->getExportMarkets();
                            $result['socialContacts'] = $process->getSocialContact();
		            $result['sector'] = $process->getSectors();

                            //Getting Company Profile
                            $result['pointOfContact'] = $process->getPointOfContact($result['companyDetails'][0]['company_id']);
                            $result['products'] = $process->getCompanyProducts($result['companyDetails'][0]['company_id']);
                            $result['socialContactList'] = $process->getSocialContactList($result['companyDetails'][0]['company_id']);
                            $result['exportMarketList'] = $process->getExportMarketList($result['companyDetails'][0]['company_id']);
                            
                            $pageContent = $view->editCompanyInfo($result);
                        }

                    }else{
                        $pageContent = $view->pageNotFound();
                    }


		}else{//end of GET pages for when session is set

			//page not found for user that is logged in
			switch ( $user_type ){
	
				case 'su':

					//getting company account requests
					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);

					//getting info on components
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['serviceCat']    	 = $process->getServiceCategory();
					$data['subServiceCat']   = $process->getSubServiceCategory();

					//getting users
					$data['buyers']     	 = $process->get_buyer_list();
					$data['admins']     	 = $process->getUsers(null, 'admin');
					$data['superUsers']    	 = $process->getUsers(null, 'su');
					$data['companys']   	 = $process->get_company_list(null, null, 1);

					//getting items provided by companies
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->superUserDashboard($data);

					break;
	

				case 'admin':

					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['buyers']     	 = $process->get_buyer_list();
					$data['companys']   	 = $process->get_company_list(null, null, 1);
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->adminDashboard($data);

					break;

				case 'company':

					$data['socialContactList'] = $process->getSocialContactList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['exportMarketList'] = $process->getExportMarketList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['companyInfo']   = $process->get_company_list(null, $_SESSION['COMPANYDATA'][0]['company_id']);
					$data['pointOfContact']   = $process->getPointOfContact($_SESSION['COMPANYDATA'][0]['company_id']);

					if ($user_company_type_id == 1){
						// music profile
						$data['musics']      = $process->getMusics(null, $user_company_id);

					}else if ($user_company_type_id == 2){
						//product profile
						$data['products']      = $process->getCompanyProducts($user_company_id);

					}else{
						//service profile
						$data['services']   	 = $process->getServices(null, $user_company_id);

					}

					$pageContent = $view->companyDashboard($data);
					break;
				
				case 'buyer':
					//getting application general information
					$data['sectors']    = $process->getSectors();
					$data['buyerCount'] = count($process->get_buyer_list());
					$data['companys']   = $process->get_company_list();
					$data['products']   = $process->get_products();
					$data['services']   = $process->getServices(null, null, 1);
					$data['musics']     = $process->getMusics();

					//getting buyer interest
					$data['interests'] = $process->getInterestedSector(null, $user_id);
					$data['prod_interests'] = $process->getBuyerProductInterest(null, $user_id);
					$data['service_interests'] = $process->getBuyerServiceInterest(null, $user_id);
					$data['music_interests'] = $process->getBuyerMusicInterest(null, $user_id);

					//getting buyer company bookmarks
					$data['cBookmarks'] = $process->getBuyerCompanyBookmark(null, $user_id);

					$pageContent = $view->buyerDashboard($data);
					break;

				default:

					$pageContent = $view->pageNotFound();
					break;
			}

		}


	//the pages below will be accessed when logged out
	}else if ( $_GET['page'] == 'signIn' && empty($_SESSION['USERDATA']) ){
	
		$pageContent = $view->signIn();

        }else if ( $_GET['page'] == 'forgotPassword' && empty($_SESSION['USERDATA']) ){

                $pageContent = $view->forgotPassword();

        }else if ( $_GET['page'] == 'resetPassword' && empty($_SESSION['USERDATA']) ){
            	
		if (isset($_GET['resetCode'])){

			$data['code'] = $_GET['resetCode'];
			$pageContent = $view->resetPassword($data);

		}else{
			
			$pageContent = $view->pageNotFound();

		}

        }else if ( $_GET['page'] == 'companyRegistration' && empty($_SESSION['USERDATA']) ){

	    $data['companyTypes'] = $process->getCompanyTypes(null, 'ORDER BY display_order DESC');
	    $data['serviceCategories'] = $process->getServiceCategory();

            $pageContent = $view->companyRegistrationForm($data);

        }else if ($_GET['page'] == 'buyerRegistration' && empty($_SESSION['USERDATA']) ){
            
            $result['sectors'] = $process->getSectors();

            $pageContent = $view->buyerRegistrationForm($result);

        }else if ($_GET['page'] == 'aboutUs'){    

            $pageContent = $view->aboutUs();

        }else if ($_GET['page'] == 'contact'){    

            $pageContent = $view->contact();

        }else if ($_GET['page'] == 'viewCompanies'){    
	
	    $data = [];
            $data['searchBy']['sectors'] = $process->getSectors();
	    $data['searchBy']['exportMarkets'] = $process->getExportMarkets();

	    $data['companys'] = $process->get_company_list();
		
            //getting company social media links
	    foreach ($data['companys'] as $key => $company){

		$data['companys'][$key]['socialContactList'] = $process->getSocialContactList($company['company_id']);

	    }
	
	    $pageContent = $view->viewCompanies($data);

	}else if ($_GET['page'] == 'faqs'){    
		
	    $data = [];
	
	    $allFaq = $process->getFaq(null, 'all');
	    $guestFaq = $process->getFaq(null, 'guest');

	    $data['faqs'] = array_merge($allFaq, $guestFaq);

	    $pageContent = $view->viewFaq($data);


	}else if ($_GET['page'] == 'viewSectors'){    
		
	    $data = [];
	    $data['sectors'] = $process->getSectors();

	    $pageContent = $view->viewSectors($data);

        }else if ($_GET['page'] == 'viewMusic'){    
	
	    $data = [];
	
	    $data['musics'] = $process->getMusics();
	    $pageContent = $view->viewMusic($data);


        }else if ($_GET['page'] == 'viewServices'){    
	
	    $data = [];
            $data['searchBy']['serviceCat'] = $process->getServiceCategory();
	    $data['searchBy']['subServiceCat'] = $process->getSubServiceCategory();

	
	    if (isset($_GET['scId'])){
		//filtering by service category

		$decryptId = decrypt($_GET['scId']);
		$serCategory = $process->getServiceCategory($decryptId);
		$serCatAc =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($serCategory[0]['acronym'] ?? '')) );
		
		if (empty($serCategory)){
	 	    //sector not found
		    $pageContent = $view->pageNotFound();

		}else if ($serCatAc != $_GET['scName']){

		    $pageContent = $view->pageNotFound();

		}else{
		    //gets filtered products by service
		    $data['searchBy']['scId'] = $serCategory[0]['id'];
		    $data['services'] = $process->getServices(null, null, null, null, $serCategory[0]['id'], null);
		    $pageContent = $view->viewServices($data);

	         }

	    }else if (isset($_GET['sscId'])){
		//filtering by sub service category
		$decryptId = decrypt($_GET['sscId']);
		$subSerCategory = $process->getSubServiceCategory($decryptId);
		$subSerCatName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($subSerCategory[0]['sub_service_category_name'] ?? '')) );
		
		if (empty($subSerCategory)){
	 	    //sector not found
		    $pageContent = $view->pageNotFound();

		}else if ($subSerCatName != $_GET['sscName']){

		    $pageContent = $view->pageNotFound();

		}else{
		    //gets filtered products by service
		    $data['searchBy']['sscId'] = $subSerCategory[0]['id'];
		    $data['services'] = $process->getServices(null, null, null, null, null, $subSerCategory[0]['id']);
		    $pageContent = $view->viewServices($data);

		}
	    }else{

		    $data['services'] = $process->getServices();
		    $pageContent = $view->viewServices($data);

	    }

        }else if ($_GET['page'] == 'viewProducts'){    
	
	    $data = [];
            $data['searchBy']['sectors'] = $process->getSectors();
	    $data['searchBy']['exportMarkets'] = $process->getExportMarkets();

	
	    if (isset($_GET['sectorId'])){
		//sector id was passed

		$decryptId = decrypt($_GET['sectorId']);
		$data['sector'] = $process->getSectors($decryptId);
		
		if (empty($data['sector'])){
	 	    //sector not found
		    $pageContent = $view->pageNotFound();

		}else{
		    //sector found
		    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['sector'][0]['name'])) );
		    if ($sName != $_GET['sectorName']){
	
			    $pageContent = $view->pageNotFound();

		    }else{
			//gets filtered products by sector

			    $data['searchBy']['sectorId'] = $data['sector'][0]['id'];
			    $data['products'] = $process->get_products(null, null, null, $data['sector'][0]['id']);
			    //$data['products'] = $process->getProductsBySector($data['sector']['id']);
			    $pageContent = $view->viewProducts($data);

		    } 

	         }

	    }else if (isset($_GET['exMarketId'])){

		$decryptId = decrypt($_GET['exMarketId']);

		$data['export'] = $process->getExportMarkets($decryptId);
		
		if (empty($data['export'])){
	 	    //sector not found
		    $pageContent = $view->pageNotFound();

		}else{
		    //sector found
		    $emName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($data['export'][0]['name'])) );
		    if ($emName != $_GET['exMarketName']){
	
			    $pageContent = $view->pageNotFound();

		    }else{
			//gets filtered products by sector

			    $data['searchBy']['exportMarketId'] = $data['export'][0]['id'];
			    $data['products'] = $process->get_products(null, null, null, null, $data['export'][0]['id']);
			    //$data['products'] = $process->getProductsByExportMarket($data['export']['id']);
			    $pageContent = $view->viewProducts($data);


		    } 

		}
		
	    }else if (isset($_GET['hsCode'])){

		    $data['searchBy']['hsCode'] = $_GET['hsCode'];
		    $data['products'] = $process->get_products(null, $_GET['hsCode']);

		    $pageContent = $view->viewProducts($data);


	
	    }else{

		    $data['products'] = $process->get_products();
		    $pageContent = $view->viewProducts($data);

	    }

        }else if ($_GET['page'] == 'musicDetails' && (isset($_GET['mName']) && isset($_GET['mId'])) ){    

	    //validating encrypted ID 
	    $mId = decrypt($_GET['mId']);

            $music = $process->getMusics($mId);
	    $mName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($music[0]['name'])) );

            if (empty($music)){

                $pageContent = $view->pageNotFound();

            }else if ($_GET['mName'] != $mName){

                $pageContent = $view->pageNotFound();

	    }else{
		//validating url name
		$result['musicDetails'] = $music;
		$result['companyDetails'] = $process->get_company_list(null, $music[0]['company_id']);

		$pageContent = $view->musicDetails($result);

            }


        }else if ($_GET['page'] == 'sectorDetails' && (isset($_GET['sName']) && isset($_GET['sId'])) ){    

	    //validating encrypted ID 
	    $sId = decrypt($_GET['sId']);

            $sector = $process->getSectors($sId);
	    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sector[0]['name'])) );

            if (empty($sector)){

                $pageContent = $view->pageNotFound();

            }else if ($_GET['sName'] != $sName){

                $pageContent = $view->pageNotFound();

	    }else{

		if ($sector[0]['id'] == 13){
		//offshore outsourcing sector
			$result['categories'] = $process->getServiceCategory();
			$result['subCategories'] = $process->getSubServiceCategory();

		}else{
		//just a normal sector
			$result['hsCodes'] = $process->getHsCodes(null, null, $sector[0]['id']);

		}

		$result['sectorDetails'] = $sector;
		$result['sectors'] = $process->getSectors();

		$pageContent = $view->sectorDetails($result);

            }

        }else if ($_GET['page'] == 'serviceDetails' && (isset($_GET['serName']) && isset($_GET['serId'])) ){    

	    //validating encrypted ID 
	    $serId = decrypt($_GET['serId']);

            $service = $process->getServices($serId);
	    $sName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($service[0]['service_name'])) );

            if (empty($service)){

                $pageContent = $view->pageNotFound();

            }else if ($_GET['serName'] != $sName){

                $pageContent = $view->pageNotFound();

	    }else{
		//validating url name
		$result['serviceDetails'] = $service;
		$result['companyDetails'] = $process->get_company_list(null, $service[0]['company_id']);

		$pageContent = $view->serviceDetails($result);

            }

        }else if ($_GET['page'] == 'productDetails' && (isset($_GET['productName']) && isset($_GET['productId'])) ){    

	    //validating encrypted ID 
	    $pId = decrypt($_GET['productId']);

            $product = $process->get_products(null, null, $pId);

            if (empty($product)){
                $pageContent = $view->pageNotFound();
            }else{
		//validating url name
	        $pName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($product[0]['product_name'])) );

		if ($_GET['productName'] != $pName){

			$pageContent = $view->pageNotFound();

		}else{

			$result['exportMarkets'] = $process->getExportMarkets();
			$result['exportMarketList'] = $process->getExportMarketList($product[0]['company_id']);
			$result['productDetails'] = $product;
			$result['companyDetails'] = $process->get_company_list(null, $product[0]['company_id']);

			$pageContent = $view->productDetails($result);

		}
            }


        }else if ($_GET['page'] == 'companyDetail' && (isset($_GET['companyName']) && isset($_GET['companyId'])) ){    

	    //validating encrypted ID 
	    $cId = decrypt($_GET['companyId']);

            $result['companyDetails'] = $process->get_company_list(null, $cId);

            if (empty($result['companyDetails'])){

                $pageContent = $view->pageNotFound();

            }else{
		//validating url name
	        $cName =  preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($result['companyDetails'][0]['company_name'])) );

		if ($_GET['companyName'] != $cName){

			$pageContent = $view->pageNotFound();

		}else{
		        $breadCrumbs = '
				<li class="breadcrumb-item text-white" aria-current="page">Company Details</li>
		        ';

			switch ($result['companyDetails'][0]['company_type_id']){

				case 1://music

					$result['musics'] = $process->getMusics(null, $result['companyDetails'][0]['company_id']);
					break;

				case 2://product
					$result['products'] = $process->getCompanyProducts($result['companyDetails'][0]['company_id']);
					break;

				case 3://service
					$result['services'] = $process->getServices(null, $result['companyDetails'][0]['company_id']);
					break;

			}
			
			$result['pointOfContact'] = $process->getPointOfContact($result['companyDetails'][0]['company_id']);
			$result['exportMarkets'] = $process->getExportMarkets();
			$result['sectors'] = $process->getSectors();
			
			$result['socialContactList'] = $process->getSocialContactList($result['companyDetails'][0]['company_id']);
			$result['exportMarketList'] = $process->getExportMarketList($result['companyDetails'][0]['company_id']);
			$result['breadCrumbs'] = $breadCrumbs;

			$pageContent = $view->companyDetails($result);

		}


	    }

        }else if ($_GET['page'] == 'accountVerification' && isset($_GET['code']) ){    

		//changing the status of the comapny to 3 - Pending Approval
		$result  = $process->activate_account($_GET['code']);
		$title   = '';
		$message = '';
		
		
		if ($result['res_code'] == 1){
			//activation code is valid


			if ($result['user_type'] == 'company'){

				$title = $result['message'];
				$message = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
					<small class="d-block text-center">Thank you for completing the registration proccess.</small> 
					    <span class="d-block text-center">
						<br>Your account will be now be reviewed and you\'ll recieve an email upon approval of your account. <br>This process should not take longer than 3 business days.</span>';


			}else if ($result['user_type'] == 'buyer'){
				
				$title = $result['message'];
				$message = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
					<small class="d-block text-center">Thank you for verifying your account.</small> 
					    <span class="d-block text-center">
						<br>You can now <a href="'.BASE_URL.'signIn">Sign In</a> and browes through our different features available currently. 
					    </span>
				';

			}else{
				//user type not valid for account verification
				$pageContent = $view->pageNotFound();

			}
			

		}else if ($result['res_code'] == 5){
			//activation code has expired 
			$title = $result['message'];
			$message = '
				<small class="d-block text-center">The activation code being used is no loger valid.</small> 
				    <span class="d-block text-center">
					<br>
					Please use the following link to confirm your account creation.<br<br>
					<a href="'.BASE_URL.'verification/'.$result['activation_code'].'"> Confirm Account Creation</a>
				    </span>
			';

			$pageContent = $view->noticeCard($title, $message);
	
		}else{
			//activation code not found or user doesnt exist
			$title = 'An error was encountered!';
			$message = ' 
				    <span class="d-block text-center">
					'.$result['message'].'
				    </span>
			';

		}

		$pageContent = $view->noticeCard($title, $message);


	}else{
		//page not found 
		
		$result['sectors']    = $process->getSectors();
		$result['buyerCount'] = count($process->get_buyer_list());
		$result['companys']   = $process->get_company_list();
		$result['products'] = $process->get_products();
		$result['services'] = $process->getServices(null, null, 1);

		$pageContent = $view->home($result);

	}

    }else if ( $_POST && isset($_POST['action']) ){
	//HANDLES ALL FORM REQUEST WITH THE ACTION ATTRIBUTE

        if ($_POST['action'] == 'signIn' && empty($_SESSION['USERDATA'])){

            $result = $process->validateLogin($_POST);
            
            if ($result == false){

                $message = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Email or Password are not valid!</strong> Please check your email or password and try again.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                $pageContent = $view->signIn($message);

            }else{
                //setting sessions
                
                $_SESSION['USERDATA'] = $result;
                $info = $process->getCompanyIdByUserId($result['user_id']);

		$user_id = $_SESSION['USERDATA']['user_id'] ?? 0;
		$user_type = $_SESSION['USERDATA']['user_type'] ?? 0;

			switch ( $_SESSION['USERDATA']['user_type'] ){

				case 'su':

					//getting company account requests
					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);

					//getting info on components
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['serviceCat']    	 = $process->getServiceCategory();
					$data['subServiceCat']   = $process->getSubServiceCategory();

					//getting users
					$data['buyers']     	 = $process->get_buyer_list();
					$data['admins']     	 = $process->getUsers(null, 'admin');
					$data['superUsers']    	 = $process->getUsers(null, 'su');
					$data['companys']   	 = $process->get_company_list(null, null, 1);

					//getting items provided by companies
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->superUserDashboard($data);

					break;
	
	
				case 'admin':

					$data['accountRequests'] = $process->get_company_list(null, null, 3, null);
					$data['exportMarkets']   = $process->getExportMarkets();
					$data['sectors']    	 = $process->getSectors();
					$data['buyers']     	 = $process->get_buyer_list();
					$data['companys']   	 = $process->get_company_list(null, null, 1);
					$data['products']   	 = $process->get_products();
					$data['musics']   	 = $process->getMusics();
					$data['services']   	 = $process->getServices();

					$pageContent = $view->adminDashboard($data);

					break;

				case 'company':

					$_SESSION['COMPANYDATA'] = $data['companyInfo'] = $process->get_company_list(null, $info['company_id']);
					$user_company_id = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
					$user_company_type_id = $_SESSION['COMPANYDATA'][0]['company_type_id'] ?? 0;

					$data['socialContactList'] = $process->getSocialContactList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['exportMarketList'] = $process->getExportMarketList($_SESSION['COMPANYDATA'][0]['company_id']);
					$data['pointOfContact']   = $process->getPointOfContact($_SESSION['COMPANYDATA'][0]['company_id']);



					if ($user_company_type_id == 1){
						// music profile
						$data['musics']      = $process->getMusics(null, $user_company_id);

					}else if ($user_company_type_id == 2){
						//product profile
						$data['products']      = $process->getCompanyProducts($user_company_id);

					}else{
						//service profile
						$data['services']   	 = $process->getServices(null, $user_company_id);

					}

					$pageContent = $view->companyDashboard($data);
					break;
				
				case 'buyer':
					//getting application general information
					$data['sectors']    = $process->getSectors();
					$data['buyerCount'] = count($process->get_buyer_list());
					$data['companys']   = $process->get_company_list();
					$data['products']   = $process->get_products();
					$data['services']   = $process->getServices(null, null, 1);
					$data['musics']     = $process->getMusics();

					//getting buyer interest
					$data['interests'] = $process->getInterestedSector(null, $user_id);
					$data['prod_interests'] = $process->getBuyerProductInterest(null, $user_id);
					$data['service_interests'] = $process->getBuyerServiceInterest(null, $user_id);
					$data['music_interests'] = $process->getBuyerMusicInterest(null, $user_id);

					//getting buyer company bookmarks
					$data['cBookmarks'] = $process->getBuyerCompanyBookmark(null, $user_id);

					$pageContent = $view->buyerDashboard($data);
					break;

				default:

					$pageContent = $view->pageNotFound();
					break;
			}
                
            }
        }else if ($_POST['action'] == 'resetPassword' && (isset($_POST['resetCode']) && empty($_SESSION['USERDATA'])) ){

		$data['code']    = $_POST['resetCode'];
		$data['message'] = '';

		if ($_POST['newPass'] != $_POST['confirmPass']){
			// passwords dont match
			$data['message'] = '
				
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				    <strong>Passwords do not match!</strong> Please ensure that both passwords are entered correctly.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				    </button>
				</div>

			';

			$pageContent = $view->resetPassword($data);

		}else if (strlen($_POST['confirmPass']) < 8 ){
			//password does not meet minimum of 8 characters	
			$data['message'] = '
				
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				    <strong>Passwords Specifications not met!</strong> Please ensure that your password meets the required specification listed when entering the password .
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				    </button>
				</div>

			';

			$pageContent = $view->resetPassword($data);
			
		
		}else{
			//reseting password
			$result  = $process->confirm_password_reset($_POST['resetCode'], $_POST['confirmPass']);
			$title   = '';
			$message = '';
			
			if ($result['res_code'] == 1){

				$title = $result['message'];
				$message = '
					<h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fas fa-check text-success" style="font-size:50px;"></i>
					</h2> 
					<small class="d-block text-center">Your password was succesfully changged</small> 
					    <span class="d-block text-center">
						<br>
						You can now <a href="'.BASE_URL.'signIn"> sign in </a> to access your account. 
					    </span>
				';

	
			}else if ($result['res_code'] == 5){
				$title = $result['message'];
				$message = '
					<h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fas fa-exclamation-traingle text-warning" style="font-size:50px;"></i>
					</h2> 
					<small class="d-block text-center">Reset code has expired!</small> 
					    <span class="d-block text-center">
						<br>
						Look like the password reset code has expuired, please request another password reset code by going to the <a href="'.BASE_URL.'forgot-password"> forgot password ? </a> page. 
					    </span>
				';

			}else{
			    $title = 'Notice!';
			    $message = '
				<h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger"  style="font-size:50px;"></i>
				</h2> 
			        <span class="d-block text-center">
					'.$result['message'].'
				</span>
			    ';
			}

			$pageContent = $view->noticeCard($title, $message);
		}

        }else if ($_POST['action'] == 'forgotPassword' && empty($_SESSION['USERDATA'])){
		//can only be accessed while logged out

		$result      = $process->request_password_reset($_POST['email']);
		$cardTitle   = '';
		$cardMessage = '';

		if ($result['res_code'] == 1){
			//success
			// sending out email activation code
			$email = new Email();
	
			$title = 'Password Reset';
			$message = '
				Hello, we have recieved a request that you want to reset your password for "'.$_POST['email'].'", if you were the one to request this password reset please proceed by clicking the link below.<br><br><a href="'.BASE_URL.'password-reset/'.$result['reset_code'].'" style="color:#e50d70;text-decoration:underline;">Confirm Password Reset</a>
			';
			$moreInfo = 'If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

			$emailCard = $view->emailCard($title, $message, $moreInfo, 'https://globalvrs.com/wp-content/uploads/2020/05/Recover-a-Forgotten-Password-using-old-password.png');
			
			try{
				$email->set_Subject('Password Reset Confirmation');
				$sent = $email->send($_POST['email'], $emailCard);

				if (!$sent){

				    $cardTitle = 'Password Reset Request not sent!';
				    $cardMessage .= '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <span class="d-block text-center">
					    Unable to send password reset code to your email, please try again later.
					    </span>
				    ';

				}else{

					$cardTitle = 'Password Reset Request Sent!';
					$cardMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fas fa-check text-success text-success" style="font-size:50px;"></i>
						    </h2> 
						<small class="d-block text-center">To complete the password reset you will need access to the email entered.</small> 
						    <span class="d-block text-center">
							<br>
							Please check your email and confirm the password reset by following the intructions specified in the email. 
						    </span>
					';

				}
			}catch(Exception $e){
				
			    $cardTitle = 'Email Error!';
			    $cardMessage .= '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <span class="d-block text-center">
				    Sorry, something went wrong while trying to send out the passord reset code via email. Please try again later.
				    </span>
			    ';

			}

			

		}else{
			//error encountered
			$cardTitle = 'Error Encountered!';
			$cardMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <span class="d-block text-center">
					'.$result['message'].'
				    </span>
			';
		}		
		
		$pageContent = $view->noticeCard($cardTitle, $cardMessage);

        }else if($_POST['action'] == 'sectorSearch'){

	    $result = [];
	    $result['searchBy']['name'] = $_POST['name'] ?? null;

	    //getting results 
	    $result['sectors'] = $process->getSectors(null, $result['searchBy']['name']);
            $pageContent = $view->viewSectors($result);

        }else if($_POST['action'] == 'musicSearch'){

	    $result = [];
	    $result['searchBy']['name'] = $_POST['name'] ?? null;

	    //getting results 
	    $result['musics'] = $process->getMusics(null, null, $result['searchBy']['name']);
            $pageContent = $view->viewMusic($result);

        }else if($_POST['action'] == 'serviceSearch'){

	    $result = [];
	    $result['searchBy']['name'] = $_POST['name'] ?? null;
	    $result['searchBy']['sscId'] = isset($_POST['sscId'])? decrypt($_POST['sscId']) : null;
	    $result['searchBy']['scId'] = isset($_POST['scId'])? decrypt($_POST['scId']) : null;
            $result['searchBy']['serviceCat'] = $process->getServiceCategory();
	    $result['searchBy']['subServiceCat'] = $process->getSubServiceCategory();

	    //getting results 
	    $result['services'] = $process->getServices(null, null, null, $result['searchBy']['name'], $result['searchBy']['scId'], $result['searchBy']['sscId']);
            $pageContent = $view->viewServices($result);

        }else if($_POST['action'] == 'companySearch'){

	    $result = [];
	    $sId = decrypt($_POST['sectorId']);
	    $exMarketId = decrypt($_POST['exportMarketId']);


	    $result['searchBy']['name'] = $_POST['name'] ?? null;
	    $result['searchBy']['sectorId'] = (isset($sId) && $sId != 0)? decrypt($_POST['sectorId']) : null;
	    $result['searchBy']['exportMarketId'] = (isset($exMarketId) && $exMarketId != 0)? decrypt($_POST['exportMarketId']) : null;

            $result['searchBy']['sectors'] = $process->getSectors();
	    $result['searchBy']['exportMarkets'] = $process->getExportMarkets();
	    //getting results 
	
	    $companies = $process->get_company_list($result['searchBy']['name']); // all companies
	    if ($sId != 0 && $sId != null){
		//filtering compan
		$comp1 = $process->getCompaniesBySector($sId);

		$tmp = [];
		foreach ($companies as $key => $company){
			foreach($comp1 as $key => $val){//were val is company id

				if($val == $company['company_id']){
					$tmp[] = $company;
				}

			}
			
		}
		$companies = [];
		$companies = $tmp;
	    }

	    if ($exMarketId != 0 && $exMarketId != null){
		
		$tmp = [];
		foreach ($companies as $key => $company){
			$tmpMarkets = [];
			$tmpMarkets = $process->getExportMarketList($company['company_id']);

			foreach ($tmpMarkets as $key => $market){

				if ($market['export_market_id'] == $exMarketId){
					//company exports to market
					$tmp[] = $company;

				}


			}

		}

		$companies = [];
		$companies = $tmp;
	    }

	    $result['companys'] = $companies;

	    //getting social links
	    foreach ($result['companys'] as $key => $company){

		$result['companys'][$key]['socialContactList'] = $process->getSocialContactList($company['company_id']);

	    }
            $pageContent = $view->viewCompanies($result);

        }else if($_POST['action'] == 'productSearch'){

	    $result = [];
	    $sId = decrypt($_POST['sectorId']);
	    $exMarketId = decrypt($_POST['exportMarketId']);


	    $result['searchBy']['name'] = $_POST['name'] ?? null;
	    $result['searchBy']['sectorId'] = (isset($sId) && $sId != 0)? decrypt($_POST['sectorId']) : null;
	    $result['searchBy']['exportMarketId'] = (isset($exMarketId) && $exMarketId != 0)? decrypt($_POST['exportMarketId']) : null;
	    $result['searchBy']['hsCode'] = $_POST['hsCode'] ?? null;

            $result['searchBy']['sectors'] = $process->getSectors();
	    $result['searchBy']['exportMarkets'] = $process->getExportMarkets();
	    //getting results 

	    $result['products'] = $process->get_products(
					$result['searchBy']['name'],
					$result['searchBy']['hsCode'], 
					null, 
					$result['searchBy']['sectorId'], 
					$result['searchBy']['exportMarketId'],
					1,
					null
				   );

            $pageContent = $view->viewProducts($result);

        }else if($_POST['action'] == 'buyerRegistration'){

	    $fname = $process->sanitize($_POST['firstName']);
	    $lname = $process->sanitize($_POST['lastName']);
	    $email = $process->sanitize($_POST['email']);
	    $companyName = $process->sanitize($_POST['companyName']);

            $userExist 	     = $process->getUserSalt($email);
            $data['sectors'] = $process->getSectors();
	    $data['message'] = '';


	    if (!isset($fname) || strlen($fname) < 3 || strlen($fname) > 150){

                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> First name must be within the range of 3 - 150 characters!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if (!isset($lname) || strlen($lname) < 3 || strlen($lname) > 150 ){

                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Last name must be within the range of 3 - 150 characters!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){

                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Invalid email "'.$email.'", please enter a valid email...
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

            }else if ($userExist == true){

                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Email: "'.$_POST['email'].'" already exist!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

            }else if ($_POST['newPass'] != $_POST['confirmPass']){

                    $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Please make sure both passwords are entered correctly.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ';

            }else{
		//validations were succeful

                    //return buyer Id upon success
                    $result = $process->register_buyer_account(
			$fname,
			$lname,
			$email,
			$companyName,
			$_POST['confirmPass']
		    );
                    
                    if ($result['res_code'] == 1 && isset($result['user_id'])){

			$data['message'] .= '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong>Success!</strong> Your account has been created! 
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			';

			$error = 0;
			$sectors = []; 
			foreach ($_POST['interest'] as $key => $interest){

				$sId = decrypt($interest['sId']);

				if ($sId > 0 && !in_array($sId, $sectors)){
					//adding if sector was not already choosen
					$added = $process->addInterestedSector($result['user_id'], $sId);

					if (!$added){
						$error++;
					}

					$sectors[] = $sId; 

				}

			}
			//error message if an interest was not added
                        if ($error > 0){
                            $data['message'] .= '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> Sorry, an error occured while trying to save interest selected.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';
			}


			// sending out email activation code
			$email = new Email();
	
			$title = 'Thank for joining the Export Platform';
			$message = '
				Hello '.$_POST['firstName'].' '.$_POST['lastName'].', the registation process is almost complete for your exportPlatform Account. Please confirm that this email was used to create that account.<br><br><a href="'.BASE_URL.'verification/'.$result['activation_code'].'" style="color:#e50d70;text-decoration:underline;">Confirm Account Creation</a>
			';
			$moreInfo = 'Thank you for joining our ExportBelize Platform! If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

			$emailCard = $view->emailCard($title, $message, $moreInfo);
			
			try{
				$email->set_Subject('Account Verification');
				$sent = $email->send($_POST['email'], $emailCard);

				if (!$sent){

				    $data['message'] .= '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					    <strong>Notice:</strong> Unable to send account activation code to your email, please contact us to activate your account.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				    ';
				}else{

				    $data['message'] .= '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					    <strong>Success!</strong> Please verify your new account by using the activation link sent to the email used in the registration process.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>

				    ';

				}
			}catch(Exception $e){
				
			    $data['message'] .= '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				    <strong>Error!</strong> Sorry and error occured and we were unable to send out a account verification via email. Please try again later.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';


			}


                    }else{ 
                        $data['message'] = '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Notice:</strong> '.$result['message'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        ';
                    }


            }
            $pageContent = $view->buyerRegistrationForm($data);


        }else if($_POST['action'] == 'companyRegistration'){

	    $data = [];
	    $data['message'] = '';

	    //point of contact info 
 	    $pocFname = $process->sanitize($_POST['pointOfContact']['fname']);
 	    $pocLname = $process->sanitize($_POST['pointOfContact']['lname']);
 	    $pocEmail = $process->sanitize($_POST['pointOfContact']['email']);
	
	    //company info
 	    $cEmail = $process->sanitize($_POST['companyInfo']['email']);
	    $companyName = $process->sanitize($_POST['companyInfo']['name']);

	    //checking if user exist
            $userExist = $process->getUserSalt($cEmail);

	    if (empty($pocFname) || strlen($pocFname) < 3 || strlen($pocFname) > 150){
                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Point of contact first name must be within the range of 3 - 150 characters!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';
	    }else if (empty($pocLname) || strlen($pocLname) < 3 || strlen($pocLname) > 150){
                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Point of contact last name must be within the range of 3 - 150 characters!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if (empty($pocEmail) || !filter_var($pocEmail, FILTER_VALIDATE_EMAIL)){
                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Point of contact email "'.$pocEmail.'" is not valid! Please enter a valid email address.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if (empty($companyName) || strlen($companyName) < 3 || strlen($companyName) > 150){
                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Company name must be within the range of 3 - 150 characters!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if (empty($cEmail) || !filter_var($cEmail, FILTER_VALIDATE_EMAIL)){
                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Company email "'.$cEmail.'" not valid! Please enter a valid email address.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

            }else if ($userExist == true){

                $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Email: "'.$_POST['companyInfo']['email'].'" already exist, please use another email address!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                ';

	    }else if ($_POST['newPass'] != $_POST['confirmPass']){

                    $data['message'] = '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Notice:</strong> Please make sure both passwords are entered correctly.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ';

            }else{

                    //return array if successful
                    $result = $process->register_company_account(
			$_POST['companyInfo']['email'],
			$_POST['companyInfo']['name'],
			$_POST['companyInfo']['ctv'],
			$_POST['companyInfo']['address'],
			$_POST['companyInfo']['district'],
			$_POST['companyInfo']['description'],
			decrypt($_POST['companyInfo']['type']),
			$_POST['companyInfo']['tradeArea'],
			$_POST['confirmPass'],
			$_POST['companyInfo']['website'],
			$_POST['companyInfo']['establishedOn'],
			$_POST['companyInfo']['phone']
		    );
                    
                    if (isset($result['user_id'])){

			$data['message'] .= '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong>Success!</strong><br>Account information and credentials has been saved.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>
			';
			//adding point of contact information
			$pocAdded = $process->addPointOfContact(
				$result['company_id'],
				$_POST['pointOfContact']['fname'],
				$_POST['pointOfContact']['lname'],
				$_POST['pointOfContact']['position'],
				$_POST['pointOfContact']['email'],
				$_POST['pointOfContact']['phone'],
				$result['user_id']
			);

			if ($pocAdded == false){
				    $data['message'] .= '
					<div class="alert alert-error alert-dismissible fade show" role="alert">
					    <strong>Error!</strong> Sorry, an error occured while trying to save the Point of contact information provided.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				    ';
			}
			
			
			// only if company registered provides services
		        if (decrypt($_POST['companyInfo']['type']) == 3){

				// adding company service additional info 

				$serviceAdded = $process->addCompanyServiceInfo(
							$result['company_id'], 
							$_POST['companyInfo']['currentSeatCapacity'],
							$_POST['companyInfo']['expanPotential'],
							$_POST['companyInfo']['servicesOffered'],
							$_POST['companyInfo']['industriesServiced'],
							$result['user_id']
				);
					
				if ($serviceAdded == false){

				    $data['message'] .= '
					<div class="alert alert-error alert-dismissible fade show" role="alert">
					    <strong>Error!</strong> Sorry, an error occured while trying to save some additonal information for your service.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				    ';

				}	

			}
			
			// sending out email activation code
			$email = new Email();
	
			$title = 'Thank for joining the Export Platform';
			$message = '
				Hello '.$_POST['companyInfo']['email'].', the registation process is almost complete for your company account, <span style="color:#e50d70;">'.ucfirst($_POST['companyInfo']['name']).'</span>. Please confirm that this email was used to create that account.<br><br><a href="'.BASE_URL.'verification/'.$result['activation_code'].'" style="color:#e50d70;text-decoration:underline;">Confirm Account Creation</a>
			';
			$moreInfo = 'Thank you for joining our ExbortBelize Platform! After confirming your email our team will review your account and then you will recieve a notice via email that your account has been approved. If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

			$emailCard = $view->emailCard($title, $message, $moreInfo);
			
			try{
				$email->set_Subject('Account Verification');
				$sent = $email->send($_POST['companyInfo']['email'], $emailCard);

				if (!$sent){

				    $data['message'] .= '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					    <strong>Notice:</strong> Unable to send account activation code to '.$_POST['companyInfo']['email'].'.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				    ';
				}else{

				    $data['message'] .= '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					    <strong>Success!</strong><br>Help us verify your email by using the activation code sent to <strong>'.$_POST['companyInfo']['email'].'</strong>
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>

				    ';

				}
			}catch(Exception $e){
				
			    $data['message'] .= '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				    <strong>Error!</strong> Sorry and error occured and we were unable to send out a account verification via email. Please try again later.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';


			}

                    }else{ 
                        $data['message'] .= '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Notice:</strong> '.$result['message'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        ';
                    }

            }

	    $data['companyTypes'] = $process->getCompanyTypes(null, 'ORDER BY display_order DESC');
	    $data['serviceCategories'] = $process->getServiceCategory();

            $pageContent = $view->companyRegistrationForm($data);


	}else if ( !empty($_SESSION['USERDATA']) && $user_type != 'buyer' && $_POST['action'] == 'updatePointOfContact'){

		$data = [];
		$data['message'] = '';
		$pocId = decrypt($_POST['pocId']);
		$cId = 0; 


		if ($user_type == 'admin' || $user_type == 'su'){

			$data['companyTypes'] = $process->getCompanyTypes();
			$cId = decrypt($_POST['cId']);

		}else{
		//company updating thier Point of Contact
		
			$cId = $user_company_id;
			
		}

		$pocInfo = $process->getPointOfContact($cId);

		if (!empty($pocInfo)){
			//update poc info
			$updated = $process->updatePointOfContact(
					$pocId,
					$cId,
					$_POST['fname'],
					$_POST['lname'],
					$_POST['position'],
					$_POST['phone'],
					$_POST['email'],
					$user_id
						
			);	

			if (!$updated){
				
				$data['message'] = '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					    <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Warning!</strong><br> Sorry, an error occured while updating the point of contact information
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				';

			}else{

			    $data['message'] = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-check fa-lg"></i> Success!</strong> Point of contact information was saved!
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';


			}

		}else{
			//add new poc info
	
			$added = $process->addPointOfContact(
					$cId,
					$_POST['fname'],
					$_POST['lname'],
					$_POST['position'],
					$_POST['email'],
					$_POST['phone'],
					$user_id
						
			);	

			if (!$added){
				
				$data['message'] = '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					    <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Warning!</strong><br> Sorry, an error occured while adding the point of contact information
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				';

			}else{

			    $data['message'] = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-check fa-lg"></i> Success!</strong> Point of contact information was added!
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';


			}

		}

		    $data['socialContacts'] = $process->getSocialContact();
		    $data['exportMarkets'] = $process->getExportMarkets();

		    //Getting Company Profile
		    $data['companyDetails'] = $process->get_company_list(null, $cId);
		    $data['pointOfContact'] = $process->getPointOfContact($data['companyDetails'][0]['company_id']);
		    $data['socialContactList'] = $process->getSocialContactList($data['companyDetails'][0]['company_id']);
		    $data['exportMarketList'] = $process->getExportMarketList($data['companyDetails'][0]['company_id']);

		    if($user_type == 'admin' || $user_type == 'su'){

			    $pageContent = $view->editCompanyInfo($data);

		    }else{

			    $pageContent = $view->companyProfile($data);

		    }

	}else if ( !empty($_SESSION['USERDATA'])  && $user_type != 'buyer' && $_POST['action'] == 'updateMusic'){

		$zero = encrypt(0);
		$noticeBtn = '';
		$noticeTitle = '';
		$noticeMessage = '';
		$oldAudioPath = '';
		$mId = decrypt($_POST['mId'] ?? $zero);
		$cId = 0;
		$accesViolation = 0;

		//getting current music info 
		$musicInfo = $process->getMusics($mId);
		$oldAudioPath = $musicInfo[0]['audio_path'];

		//validating user 
		if ($user_type == 'admin' || $user_type == 'su'){

			$cId = decrypt($_POST['cId'] ?? $zero);

			$noticeBtn = '
			    <a href="'.BASE_URL.'music-list" type="submit" class="btn btn-primary mr-3">Music List</a>&nbsp
			    <a href="'.BASE_URL.'edit/music/'.encrypt($mId).'" type="submit" class="btn btn-primary"> Edit Music</a>
			';
			

		}else if ($user_type == 'company' && $user_company_type_id == 1){
			//music company profile
			$cId = $user_company_id ?? 0;
			
			$noticeBtn = '
			    <a href="'.BASE_URL.'my-music" class="btn btn-primary mr-3">My Music</a>&nbsp
			';
			
			if ($cId != $musicInfo[0]['company_id']){
				
				$accessViolation = 1;

			}else{
				$noticeBtn .= '
				    <a href="'.BASE_URL.'edit/music/'.encrypt($mId).'" type="submit" class="btn btn-primary"> Edit Music</a>
				';

			}


		}else{
			$cId = 0;
		}
			


		if ($accessViolation == 1){

			    $noticeTitle = 'Access Violation!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					The music that you are editing does not belong to you.
				    </div>
			    ';

		}else if ($mId == 0){
			    $noticeTitle = 'Not Found!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Please select a valid music to edit.
				    </div>
			    ';
		}else if ($cId == 0){
			    $noticeTitle = 'Company Not Found!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry Invalid company selected, please try another company.
				    </div>
			    ';
	        }else if (!empty($_FILES) && isset($_FILES['audio']['name']) && $_FILES['audio']['error'] != 4){
			//audio file is attached
			
			$allowedTypes = [
			   'audio/mpeg' => 'mpeg',
			   'audio/mp3' => 'mp3'
			];

			//getting file info
			$fileTmpPath = $_FILES['audio']['tmp_name'];
			$fileSize = filesize($fileTmpPath);
			$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
			$filetype = finfo_file($fileinfo, $fileTmpPath);
			$newFilepath = '';

			//audio validation starts
			if($_FILES['audio']['error'] != 0){
				//error occured 
				    $noticeTitle = 'File Upload Error (Error-'.$_FILES['audio']['error'].')!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						An error occured while uploading the audio file, please try again later.
					    </div>
				    ';

			}else if( (($fileSize/1024)/1024) <= 0 ||  (($fileSize/1024)/1024) > 1){

				    $noticeTitle = 'File size not acceptable!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						File size is but be less than 1MB, file size: '.round( ($fileSize/1024)/1024 , 2).'. Please try another file.
					    </div>
				    ';

			}else if(!in_array($filetype, array_keys($allowedTypes))){//check file type

				    $noticeTitle = 'File type not acceptable!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						File type must be MP3, please try another file.
					    </div>
				    ';
			}else{

				//upload audio and create record
				$filename = basename($fileTmpPath); // I'm using the original name here, but you can also change the name of the file here
				$extension = $allowedTypes[$filetype];
				$targetDirectory = 'uploads/music'; // __DIR__ is the directory of the current PHP file

				$newFilepath = $targetDirectory . "/" . $filename .time(). "." . $extension;

				if (!copy($fileTmpPath, $newFilepath )) { // Copy the file, returns false if failed
				    $noticeTitle = 'File Upload Error!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, an error occured while uploading the file. Please try again later.
					    </div>
				    ';
				}else{

					//editing music record with new audio file
					$updated = $process->updateMusic($mId, $cId, $_POST['name'], $_POST['description'], $newFilepath, $user_id);

					if (!$updated){

					    $noticeTitle = 'Failed to updated music!';
					    $noticeMessage = '

						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error while updating your music. Please try again later.
						    </div>
					    ';
				
					}else{

					    $noticeTitle = 'Music was updated!';
					    $noticeMessage = '

						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Your music was succesfully updated.
						    </div>
					    ';

					}

				}

				unlink($fileTmpPath); // Delete the temp file
			}

		}else{
			//updating music record with existing audio file
			$updated = $process->updateMusic($mId, $cId, $_POST['name'], $_POST['description'], $oldAudioPath, $user_id);

			if (!$updated){

			    $noticeTitle = 'Failed to updated music!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error while updating your music. Please try again later.
				    </div>
			    ';
		
			}else{

			    $noticeTitle = 'Music was updated!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Your music was succesfully updated.
				    </div>
			    ';

			}


		}

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);
		


	}else if ( (!empty($_SESSION['USERDATA']) && $user_type != 'buyer') && $_POST['action'] == 'updateService'){

		$noticeTitle = '';
		$noticeMessage = '';
		$serId = decrypt($_POST['serId']);

		$serviceInfo = $process->getServices($serId);
		if (empty($serviceInfo)){
			
			$pageContent = $view->pageNotFound();

		}else if ($user_type == 'admin' || $user_type == 'su'){

			$noticeBtn = '
			    <a href="'.BASE_URL.'service-list" class="btn btn-primary mr-3">Service List</a>&nbsp
			    <a href="'.BASE_URL.'edit/service/'.encrypt($serviceInfo[0]['id']).'" class="btn btn-primary"> Edit Service</a>
			';

			$updated = $process->updateService($serId, decrypt($_POST['cId']), decrypt($_POST['sId']), decrypt($_POST['sscId']), $_POST['name'], $_POST['description'], $user_id);

			if (!$updated){
				$noticeTitle = 'Error!';
				$noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-times text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					An error occured while updating the service info, please try again later.
				    </div>
				';
			}else{
				$noticeTitle = 'Service Updated!';
				$noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Service was successfully updated.
				    </div>
				';
			}

			$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

		}else if ($user_type == 'company' && $user_company_id != $serviceInfo[0]['company_id']){
			//service does not belong to the following company 
			$pageContent = $view->pageNotFound();

		}else{
			$noticeBtn = '
			    <a href="'.BASE_URL.'my-services" class="btn btn-primary mr-3">My Services</a>&nbsp
			    <a href="'.BASE_URL.'edit/service/'.encrypt($serviceInfo[0]['id']).'" class="btn btn-primary"> Edit Service</a>
			';


			//company update sector 
			$updated = $process->updateService($serId, $user_company_id, decrypt($_POST['sId']), decrypt($_POST['sscId']), $_POST['name'], $_POST['description'], $user_id);

			if (!$updated){
				$noticeTitle = 'Error!';
				$noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-times text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					An error occured while updating the service info, please try again later.
				    </div>
				';
			}else{
				$noticeTitle = 'Service Updated!';
				$noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Service was successfully updated.
				    </div>
				';
			}
			//$result['services'] = $process->getServices(null, $user_company_id);
			//$pageContent = $view->myServices($result);

			$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);
		}

	}else if ( !empty($_SESSION['USERDATA']) && $_POST['action'] == 'updateSubServiceCategory' && $user_type == 'su' ){

		$id = decrypt($_POST['sscId']);
		$info = $process->getSubServiceCategory($id);

		if (empty($info)){
				//no longer exists

			$noticeTitle = 'Sub Service category not found!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, sub service category was not found and changes were not applied, please select a existing sub service category.
				    </div>
			';

				
		}else{
			//exist
			$updated = $process->updateSubServiceCategory(
						$id, 
						decrypt($_POST['scId']),
						$_POST['name'], 
						$_POST['icon'], 
						$_POST['description'], 
						$user_id
			);

			if (!$updated){

				$noticeTitle = 'Error!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, an error occured while trying to update sub service cat. information, please try again later.
					    </div>
				';

			}else{

				$noticeTitle = 'Sub Service Category Updated!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sub Service Category was successfully updated.
					    </div>
				';

			}

		}
		
		$noticeBtn = '
		    <a href="'.BASE_URL.'sub-service-category-list" class="btn btn-primary mr-3"> Sub Service Cat. List</a>
		    <a href="'.BASE_URL.'edit/sub-service-category/'.encrypt($id).'" class="btn btn-primary">Edit Sub Service Cat.</a>
		';
		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

		
	}else if ( !empty($_SESSION['USERDATA']) && $_POST['action'] == 'updateServiceCategory' &&  $user_type == 'su' ){

		$result = [];
		$id = decrypt($_POST['scId']);
		$info = $process->getServiceCategory($id);

		if (empty($info)){
				//no longer exists

			$noticeTitle = 'Service category not found!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, service category was not found and changes were not applied, please select a existing service category.
				    </div>
			';

				
		}else{
			//exist
			$updated = $process->updateServiceCategory(
						$id, 
						$_POST['name'], 
						$_POST['acronym'], 
						$_POST['icon'], 
						$_POST['description'], 
						$user_id
			);

			if (!$updated){

				$noticeTitle = 'Error!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-warning" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, an error occured while trying to update service cat. info, please try again later.
					    </div>
				';

			}else{

				$noticeTitle = 'Service Category Updated!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Service Category was successfully updated.
					    </div>
				';

			}

		}
		
		$noticeBtn = '
		    <a href="'.BASE_URL.'service-category-list" class="btn btn-primary mr-3"> Service Cat. List</a>
		    <a href="'.BASE_URL.'edit/service-category/'.encrypt($id).'" class="btn btn-primary">Edit Service Cat.</a>
		';
		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

	}else if ( !empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') && $_POST['action'] == 'updateFaq' ){

		$id = decrypt($_POST['fId']);
		$info = $process->getFaq($id);
        
		if (empty($info)){

		    $pageContent = $view->pageNotFound();

		}else{

		    $noticeTitle = '';
		    $noticeMessage = '';
		    $noticeBtn = '';

                    //return buyer Id upon success
                    $updated = $process->updateFaq(
						$info[0]['id'],
						$_POST['question'], 
						$_POST['answer'],
						$_POST['displayTo'],
						$user_id
				    );
                    
                    if ($updated){
        
			$noticeTitle = 'Faq Updated!';
			$noticeMessage = '
			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fas fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Faq was successfully updated and saved.
			    </div>
			';

                    }else{ 
			$noticeTitle = 'Error!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured while updating the faq, please try again later.
				    </div>
			';

                    }
		
		    $noticeBtn = '
			    <a href="'.BASE_URL.'faq-list" class="btn btn-primary mr-3"> Faq List</a>
			    <a href="'.BASE_URL.'edit/faq/'.encrypt($info[0]['id']).'" class="btn btn-primary"> Edit Again</a>
		    ';
		    $pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

		}
	}else if ( !empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') && $_POST['action'] == 'updateHsCode'){

		$result = [];
		$oldHsCode = decrypt($_POST['hsc']);
		$hsId = decrypt($_POST['hsId']);
		$hsCodeInfo = $process->getHsCodes(null, $_POST['hsCode']);

		if (($_POST['hsCode'] != $oldHsCode) && !empty($hsCodeInfo)){
				//exists
			$result['message'] = '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Warning!</strong><br> The Hs Code that you\'ve entered already exists, please try another Hs Code.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>
			';
		}else{

			$wasAdded = $process->updateHsCode($hsId, $_POST['hsName'], $_POST['hsCode'], decrypt($_POST['sId']), $_SESSION['USERDATA']['user_id']);

			if ($wasAdded){
			    $result['message'] = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-check fa-lg"></i> Success!</strong> Hs Code Info was saved!
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';
			}else{

				$result['message'] = '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					    <strong><i class="fa fa-times fa-lg"></i> Failed!</strong><br> An error occured while updating the Hs Code please notify the developer.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				';
			}

		}
		
		$result['codes'] = $process->getHsCodes();
		$pageContent = $view->hsCodeList($result);

	}else if ( !empty($_SESSION['USERDATA']) && $user_type == 'su' && $_POST['action'] == 'editAdminInfo' ){

		$id = decrypt($_POST['aId']);
		$userInfo = $process->getUsers($id, 'admin');
        
		if (empty($userInfo)){

		    $pageContent = $view->pageNotFound();

		}else{

		    $noticeTitle = '';
		    $noticeMessage = '';
		    $noticeBtn = '';

                    //return buyer Id upon success
                    $updated = $process->updateAdminProfile(
						$userInfo[0]['id'],
						$_POST['firstName'], 
						$_POST['lastName'],
						$_POST['email'],
						$user_id
				    );
                    
                    if ($updated){
        
			$noticeTitle = 'Admin Profile Updated!';
			$noticeMessage = '
			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fas fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				User information was updated and saved successfully
			    </div>
			';

                    }else{ 
			$noticeTitle = 'Error!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured while updating the users information, please try again later.
				    </div>
			';

                    }
		
		    $noticeBtn = '
			    <a href="'.BASE_URL.'user-list#admin-tab" class="btn btn-primary mr-3"> Admin List</a>
			    <a href="'.BASE_URL.'edit/admin/'.encrypt($userInfo[0]['id']).'" class="btn btn-primary"> Edit Again</a>
		    ';
		    $pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

		}

	}else if ( !empty($_SESSION['USERDATA']) && $user_type == 'su' && $_POST['action'] == 'editSuInfo' ){

		$id = decrypt($_POST['suId']);
		$userInfo = $process->getUsers($id, 'su');
        
		if (empty($userInfo)){

		    $pageContent = $view->pageNotFound();

		}else{

		    $noticeTitle = '';
		    $noticeMessage = '';
		    $noticeBtn = '';

                    //return buyer Id upon success
                    $updated = $process->updateSuperUserProfile(
						$userInfo[0]['id'],
						$_POST['firstName'], 
						$_POST['lastName'],
						$_POST['email'],
						$user_id
				    );
                    
                    if ($updated){
        
			$noticeTitle = 'Super User Updated!';
			$noticeMessage = '
			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fas fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				User information was updated and saved succefully
			    </div>
			';

                    }else{ 
			$noticeTitle = 'Error!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured while updating the users information, please try again later.
				    </div>
			';

                    }
		
		    $noticeBtn = '
			    <a href="'.BASE_URL.'user-list#su-tab" class="btn btn-primary mr-3"> Super User List</a>
			    <a href="'.BASE_URL.'edit/super-user/'.encrypt($userInfo[0]['id']).'" class="btn btn-primary"> Edit Again</a>
		    ';
		    $pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

		}

	}else if ( !empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') && $_POST['action'] == 'editBuyerInfo' ){

		$bId = decrypt($_POST['bId']);
		
		$data['buyerInfo'] = $process->get_buyer_list(null, $bId);
        
		if (empty($data['buyerInfo'])){

		    $pageContent = $view->pageNotFound();

		}else{

                    //return buyer Id upon success
                    $buyerUpdated = $process->updateBuyerProfile(
						$data['buyerInfo'][0]['user_id'],
						$_POST['firstName'], 
						$_POST['lastName'],
						$_POST['company_name'],
						$_POST['description'],
						$_SESSION['USERDATA']['user_id']
				    );
                    
                    if ($buyerUpdated){
        
			     $data['message'] = '
				 <div class="alert alert-success alert-dismissible fade show" role="alert">
				     <strong>Success!</strong> The information was saved.
				     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					 <span aria-hidden="true">&times;</span>
				     </button>
				 </div>
		
			     ';
        
                    }else{ 
                        $data['message'] = '
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Notice!</strong> An error occured and some of the information were not saved. Please try again later. 
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                        ';
                    }
		
			$data['buyerInfo'] = $process->get_buyer_list(null, $bId);	
			$pageContent = $view->editBuyerInfo($data);

		}

	}else if ( (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'buyer') && $_POST['action'] == 'saveBuyerInterest' ){

		$uId = $_SESSION['USERDATA']['user_id'] ?? 0;
		$result['message'] = '';
		$sectors = [];
		$error = 0;

		foreach ($_POST['interest'] as $interest){
			
			$sId = decrypt($interest['sId']);

			if (array_key_exists('intId', $interest) ){
				//interest record exist

				if ( $sId == 0 || in_array($sId, $sectors) ){
					//delete interest 
					$removed = $process->deleteInterestedSector($uId, decrypt($interest['intId']) );

					if (!$removed){
						$error++;
					}

				}else{

					//update interest
					$updated = $process->updateInterestedSector($uId, decrypt($interest['intId']), $sId);

					if (!$updated){
						$error++;
					}else{
						$sectors[] = $sId;
					}


				}

			}else{
				//interest record oes not exist
				if ($sId != 0 && !in_array($sId, $sectors)){
					//add interest
					$added = $process->addInterestedSector($uId, $sId);
			
					if (!$added){

						$error++;
					}else{
					
						$sectors[] = $sId;
					
					}
				}
			}
		}

		if ($error > 0 ){

			$result['message'] .= '
			     <div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Notice!</strong> Sorry, some errors occured while trying to save interest. Please try again later.
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';

		}else{

			$result['message'] .= '
			     <div class="alert alert-success alert-dismissible fade show" role="alert">
				 <strong>Success!</strong> Your interest have been saved.
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';

		}

		$result['sectors'] = $process->getSectors();
		$result['interest'] = $process->getInterestedSector(null, $uId);
		$result['buyerInfo'] = $process->get_buyer_list(null, $uId);

		$pageContent = $view->buyerProfile($result);

	}else if ( (!empty($_SESSION['USERDATA']) && $user_type == 'su') && $_POST['action'] == 'saveSuProfile' ){

       		    $result['message'] = ''; 
		    $uId = $user_id ?? 0;
			
                    //return buyer Id upon success
                    $wasUpdated = $process->updateSuperUserProfile(
					$uId,
					$_POST['fName'],
					$_POST['lName'],
					$uId
				   );
                    
                    if ($wasUpdated){
        
			$result['message'] .= '
			     <div class="alert alert-success alert-dismissible fade show" role="alert">
				 <strong>Success!</strong> Your profile have been saved.
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                        
                    }else{ 
			$result['message'] .= '
			     <div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Notice!</strong> Sorry, an error occured while updating your profile. 
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                    }

		$userInfo = $process->getUsers($uId);
		$_SESSION['USERDATA']['full_name'] = $userInfo[0]['full_name'];

		$pageContent = $view->adminProfile($result);
		    	
	}else if ( (!empty($_SESSION['USERDATA']) && $user_type == 'admin') && $_POST['action'] == 'saveAdminProfile' ){

       		    $result['message'] = ''; 
		    $uId = $user_id ?? 0;
			
                    //return buyer Id upon success
                    $wasUpdated = $process->updateAdminProfile(
					$uId,
					$_POST['fName'],
					$_POST['lName'],
					$uId
				   );
                    
                    if ($wasUpdated){
        
			$result['message'] .= '
			     <div class="alert alert-success alert-dismissible fade show" role="alert">
				 <strong>Success!</strong> Your profile have been saved.
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                        
                    }else{ 
			$result['message'] .= '
			     <div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Notice!</strong> Sorry, an error occured while updating your profile. 
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                    }

		$userInfo = $process->getUsers($uId);
		$_SESSION['USERDATA']['full_name'] = $userInfo[0]['full_name'];

		$pageContent = $view->adminProfile($result);
		    	
	}else if ( (!empty($_SESSION['USERDATA']) && $user_type == 'buyer') && $_POST['action'] == 'saveBuyerProfile' ){

       		    $result['message'] = ''; 
		    $uId = $_SESSION['USERDATA']['user_id'] ?? 0;
			
                    //return buyer Id upon success
                    $wasUpdated = $process->updateBuyerProfile(
					$uId,
					$_POST['firstName'],
					$_POST['lastName'],
					$_POST['companyName'],
					null,
					$uId
				   );
                    
                    if ($wasUpdated){
        
			$result['message'] .= '
			     <div class="alert alert-success alert-dismissible fade show" role="alert">
				 <strong>Success!</strong> Your profile have been saved.
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                        
                    }else{ 
			$result['message'] .= '
			     <div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Notice!</strong> Sorry, an error occured while updating your profile. 
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				     <span aria-hidden="true">&times;</span>
				 </button>
			     </div>

			';
                    }

		$result['sectors'] = $process->getSectors();
		$result['interest'] = $process->getInterestedSector(null, $uId);
		$result['buyerInfo'] = $process->get_buyer_list(null, $uId);
		
		$_SESSION['USERDATA']['full_name'] = $result['buyerInfo'][0]['full_name'];
		$_SESSION['USERDATA']['email'] = $result['buyerInfo'][0]['full_name'];

		$pageContent = $view->buyerProfile($result);
		    	
	}else if ( (!empty($_SESSION['USERDATA']) &&  $user_type == 'company') && $_POST['action'] == 'updateSocialContacts'){

		    $data = [];
		    $cId = $user_company_id;
		    $doesExist = $process->get_company_list(null, $cId);

		    if (!empty($doesExist)){

			    $result2 = [];
			    $result2 = $process->setSocialContactList($_POST['socialContacts'], $cId);
		
			    if ($result2['count'] > 0){
				$links = '';
				for ($i = 0; $i < $result2['count']; $i++){
					$links .= $result2['links'][$i]." for ".$result2['for'][$i]." Link\n";
				}
				$word = ($resutl2['count'] > 1)? 'were':'was'; 
					$data['message'] = '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Notice!</strong><br> 
						'.$result2['count'].' invalid link(s) detected and '.$word.' not saved. <br>The following '.$word.' not saved:<br>'.$links.'
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
			    }else{

				$data['message'] = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Social Contact links updated!</strong>
						All changes made has been saved.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				';			     

			    }	

			$data['exportMarkets'] = $process->getExportMarkets();
			$data['socialContacts'] = $process->getSocialContact();

			$data['companyDetails'] = $process->get_company_list(null,$cId);
			$data['pointOfContact'] = $process->getPointOfContact($cId);
			$data['socialContactList'] = $process->getSocialContactList($cId);
			$data['exportMarketList'] = $process->getExportMarketList($cId);

			$pageContent = $view->companyProfile($data);
		    }else{

			$pageContent = $view->pageNotFound();

		    }

	}else if ( (!empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') ) && $_POST['action'] == 'updateSocialContacts'){

		    $cId = decrypt($_POST['cId']);
		    $doesExist = $process->get_company_list(null, $cId);

		    if (!empty($doesExist)){

			    $result2 = $process->setSocialContactList($_POST['socialContacts'], $cId);
		
			    if ($result2['count'] > 0){
				$links = '';
				for ($i = 0; $i < $result2['count']; $i++){
					$links .= $result2['links'][$i]." for ".$result2['for'][$i]." Link\n";
				}
				$word = ($resutl2['count'] > 1)? 'were':'was'; 
					$data['message'] .= '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Notice!</strong><br> 
						'.$result2['count'].' invalid link(s) detected and '.$word.' not saved. <br>The following '.$word.' not saved:<br>'.$links.'
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
			    }else{

				$data['message'] = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Social Contact links updated!</strong>
						All changes made has been saved.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				';			     

			    }	


                            $data['socialContacts'] = $process->getSocialContact();
                            $data['exportMarkets'] = $process->getExportMarkets();
			    $data['companyTypes'] = $process->getCompanyTypes();
			    $data['serviceCategories'] = $process->getServiceCategory();

                            //Getting Company Profile
                            $data['companyDetails'] = $process->get_company_list(null, $cId);
                            $data['pointOfContact'] = $process->getPointOfContact($data['companyDetails'][0]['company_id']);
                            $data['products'] = $process->getCompanyProducts($data['companyDetails'][0]['company_id']);
                            $data['socialContactList'] = $process->getSocialContactList($data['companyDetails'][0]['company_id']);
                            $data['exportMarketList'] = $process->getExportMarketList($data['companyDetails'][0]['company_id']);

			    $pageContent = $view->editCompanyInfo($data);
		    }else{

			$pageContent = $view->pageNotFound();

		    }


	}else if ( (!empty($_SESSION['USERDATA']) && $user_type != 'buyer' ) && $_POST['action'] == 'editCompanyInfo' ){

                    $_POST['companyDetail']['logoImagePath'] = $_POST['logoPath'];
                    $data = [];
                    $data['message'] = '';

		    $minWidthSize  = 300;
		    $maxWidthSize  = 600;

		    $minHeightSize = 200;
		    $maxHeightSize = 400;
	
		    $cId = 0;
		    $industryServiced = '';
		    //checking user type 
		    if($user_type == 'admin' || $user_type == 'su'){

			    $cId = decrypt($_POST['companyDetail']['companyId']);
			    $industryServiced = null;

	  	    }else{

			    $cId = $user_company_id ?? 0;
			    $_POST['companyDetail']['tradeArea'] = $_SESSION['COMPANYDATA'][0]['trade_type'] ?? '';
			    $industryServiced = $_POST['companyDetail']['industryServiced'] ?? '';

		    }

		    $doesExist = $process->get_company_list(null, $cId);

		    if (!empty($doesExist)){

			    if (isset($_FILES) && $_FILES['businessLogo']['name'] != '' && $_FILES['businessLogo']['error'] == 0){
				
				//uploading image if it exist 
				$target_dir = "uploads/companyLogos/";
				$target_file = $target_dir . basename($_FILES["businessLogo"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				
				// Check if image file is a actual image or fake image
				// $check = getimagesize($_FILES["businessLogo"]["tmp_name"]);
			        list( $width, $height, $type, $attr ) = getimagesize( $_FILES["businessLogo"]["tmp_name"] );

				//checking image dimensions
				if ($width < $minWidthSize || $width > $maxWidthSize || $height < $minHeightSize || $height > $maxHeightSize){

					$data['message'] .= '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Warning!</strong><br> 
							Image dimension must be within the range of, <br>Width: '.$minWidthSize.' - '.$maxWidthSize.' px <br>Height: '.$minHeightSize.' - '.$maxHeightSize.' px
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     

				    $uploadOk = 0;

				}
				// Check file size
				if ($_FILES["businessLogo"]["size"] > 2000000) {
					$data['message'] .= '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Warning!</strong> 
							Your profile pic is too large, file must be less than 2MB
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
				    $uploadOk = 0;
				}
		
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					$data['message'] .= '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Warning!</strong> 
							Only JPG, JPEG and PNG files are allowed.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
				    $uploadOk = 0;
				}
		
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$data['message'] .= '
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Image Upload Error!</strong> 
							Sorry, the profile pic was not uploaded.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
				} else {
				    // if everything is ok, try to upload file
				    if (compressImage($_FILES["businessLogo"]["tmp_name"], $target_file, 60)) {
					$data['message'] .= '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Company Profile Pic Updated!</strong><br>
							The file '. basename( $_FILES['businessLogo']['name']).' has been saved.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
					$_POST['companyDetail']['logoImagePath'] = $target_file;

				    } else {
					$data['message'] .= '
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Image Upload Error!</strong>
							Sorry, there was an error uploading your profile pic.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     
				    }
				}
		
			    }

			    $_POST['companyDetail']['companyId'] = $cId;
			    $_POST['companyDetail']['updateBy'] = $user_id;
			    $_POST['companyDetail']['updateType'] = 'edit';
			    $_POST['companyDetail']['updateOn'] = date("Y-m-d H:i:s");

			    $result1 = $process->updateCompanyProfile($_POST['companyDetail']);
			    if(!$result1){

					$data['message'] .= '
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Company Info Update Error!</strong>
							Sorry, an error occured while updating the company profile information.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';			     


			    }else{

					$data['message'] .= '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Company Information was Updated!</strong>
							Changes made has been saved.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					';	

					if ($doesExist[0]['company_type_id'] == 3){
						// service provider

						if (isset($doesExist[0]['company_service_info_id'])){
							//exists
							$updated = $process->updateCompanyServiceInfo(
								$doesExist[0]['company_service_info_id'],
								$cId,
								$_POST['companyDetail']['seatCapacity'],
								$_POST['companyDetail']['expansionPotential'],
								null,
								$industryServiced,
								$user_id //session user
							);

							if (!$updated){

								$data['message'] .= '
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
									  <strong>Notice!</strong>
										Sorry, we were unable to save some service information.
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>
								';			     

							}

						}else{
							//does not exist adding new service info record 
							$added = $process->addCompanyServiceInfo(
								$cId,
								$_POST['companyDetail']['seatCapacity'],
								$_POST['companyDetail']['expansionPotential'],
								null,
								$industryServiced,
								$user_id //session user
							);
							
							if (!$added){

								$data['message'] .= '
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
									  <strong>Notice!</strong>
										Sorry, we were unable to add the service information.
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>
								';			     

							}
						}

					}		     

			    }
			

			    if ($user_type == 'admin' || $user_type == 'su'){

				    $data['socialContacts'] = $process->getSocialContact();
				    $data['exportMarkets'] = $process->getExportMarkets();
				    $data['companyTypes'] = $process->getCompanyTypes();

				    //Getting Company Profile
				    $data['companyDetails'] = $process->get_company_list(null, $cId);
				    $data['pointOfContact'] = $process->getPointOfContact($data['companyDetails'][0]['company_id']);
				    //$data['products'] = $process->getCompanyProducts($data['companyDetails'][0]['company_id']);
				    $data['socialContactList'] = $process->getSocialContactList($data['companyDetails'][0]['company_id']);
				    $data['exportMarketList'] = $process->getExportMarketList($data['companyDetails'][0]['company_id']);

				    $pageContent = $view->editCompanyInfo($data);

			    }else{
				//company profile
				
				    $data['socialContacts'] = $process->getSocialContact();
				    $data['exportMarkets'] = $process->getExportMarkets();

				    //Getting Company Profile
				    $_SESSION['COMPANYDATA'] = $data['companyDetails'] = $process->get_company_list(null, $cId);
				    $data['pointOfContact'] = $process->getPointOfContact($data['companyDetails'][0]['company_id']);
				    //$data['products'] = $process->getCompanyProducts($data['companyDetails'][0]['company_id']);
				    $data['socialContactList'] = $process->getSocialContactList($data['companyDetails'][0]['company_id']);
				    $data['exportMarketList'] = $process->getExportMarketList($data['companyDetails'][0]['company_id']);

				    $pageContent = $view->companyProfile($data);

			    }

		    }else{

			$pageContent = $view->pageNotFound();

		    }
                    

	}else if ( (!empty($_SESSION['USERDATA']) && $_SESSION['USERDATA']['user_type'] == 'admin') && ($_POST['action'] == 'updateSector' && isset($_POST['sId']))){
		
		$sId = decrypt($_POST['sId']);
		$sectorInfo = $process->getSectors($sId);

		if (!empty($sectorInfo)){
			
			$data = [];
			$data['message'] = '';
			$isFeatured = 0;
			$sectorImg = $sectorInfo[0]['sector_img'];

			//image sizes
			$minWidthSize  = 500;
			$maxWidthSize  = 900;
			$minHeightSize = 300;
			$maxHeightSize = 600;
			
			//checking if new image uploaded for sector
			if ($_FILES['files']['error'] != 4 && isset($_FILES['files']['tmp_name']) ){
			    $imgSize = getimagesize($_FILES['files']['tmp_name']);

			    if (($_FILES['files']['size']/1000000) > 2){
				
				$data['message'] .= '
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Image to large!</strong><br> Sector image uploaded is exceeds image size (2MB), please try again uploading a smaller image size. Image was not saved, old image was kept.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
				

			    }else{

				    //imgSize[0] contains the width and imgSize[1] contains the height of the image
				    if ($_FILES['files']['error'] == 0 && ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){
					$targetDir = 'uploads/sectors/';
					$fileInfo  = pathinfo($_FILES['files']['name']);
					$imageFileType = strtolower($fileInfo['extension']);

					if ($imageFileType != 'jpg' || $imageFileType != 'jpeg' || $imageFileType != 'png'){

					    //uploading sector image
					    $imgUploaded = uploadImages($_FILES, $targetDir, 60);
						
					    if (empty($imgUploaded) || $imgUploaded == false){

						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Error Occured!</strong><br> An error occured while trying to upload the sector image. Image was not saved.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					    }else{
						$sectorImg = $imgUploaded['file_path'];
					    }	
					}else{
						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Image type not accepted!</strong><br> Please upload an image with the following extension, PNG, JPEG or JPG. Image was not saved.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					}
				    }else{

					$data['message'] .= '
					    <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Image Dimension not acceptable!</strong><br> Please upload an image with the following dimensions, width: '.$minWidthSize.' 
						- '.$maxWidthSize.' and height: '.$minHeightSize.' - '.$maxHeightSize.'. Image was not saved.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';

				    }
			    }
			}


			if (isset($_POST['isFeatured']) && $sectorInfo[0]['is_featured'] == 0){
				//sector was choosen to be featured but it must not be currently featured to feature it 

				$featuredCount = count($process->getSectors(null, 1, 1));

				if ($featuredCount >= MAX_FEATURED_SECTORS ){
					//maxed out featured sectors
					$data['message'] .= '
					    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Warning!</strong><br> 
						Sector was not featured, max featured amount ('.MAX_FEATURED_SECTORS.') has already been used up, please un feature some sectors so you can feature this one.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';
				}else{
					$isFeatured = 1;
				}
				
			}else{

				if (isset($_POST['isFeatured']) && $sectorInfo[0]['is_featured'] == 1){

					$isFeatured = 1;
				}
			}
			
			$updated = $process->updateSector($sId, $_POST['name'], $_POST['description'], $isFeatured, $sectorImg, $_SESSION['USERDATA']['user_id']);

			if (!$updated){
				//error message
				$data['message'] .= '
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Update Error!</strong><br> 
					We\'re sorry, an error occured while trying to save the sector information. Please try again later and report this to the developer.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			}else{
				// success 
				$data['message'] .= '
				    <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success!</strong> 
					The sector information was saved and updated.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			}

			$data['sectors'] = $process->getSectors();
			$pageContent = $view->sectorList($data);

		}else{

			$pageContent = $view->pageNotFound();

		}
		

	}else if ( !empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') && $_POST['action'] == 'addSector'){

		$data = [];
		$data['message'] = '';
		
		//image sizes
		$minWidthSize  = 500;
		$maxWidthSize  = 900;
		$minHeightSize = 300;
		$maxHeightSize = 600;

		//when error is 4, no file was uplaoded 
		if (!empty($_FILES['files']) && $_FILES['files']['error'] !== 4){

		    $imgSize = getimagesize($_FILES['files']['tmp_name']);

		    if (($_FILES['files']['size']/1000000) > 2){
			
			$data['message'] .= '
			    <div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Image to large!</strong><br> Sector image uploaded is exceeds image size (2MB), please try again uploading a smaller image size. Image was not saved, old image was kept.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
			    </div>
			';
			

		    }else{

			    //imgSize[0] contains the width and imgSize[1] contains the height of the image
			    if ($_FILES['files']['error'] == 0 &&  ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){

				$targetDir = 'uploads/sectors/';
				$fileInfo  = pathinfo($_FILES['files']['name']);
				$imageFileType = strtolower($fileInfo['extension']);

				if ($imageFileType != 'jpg' || $imageFileType != 'jpeg' || $imageFileType != 'png'){

				    //uploading sector image
				    $imgUploaded = uploadImages($_FILES, $targetDir, 60);
					
				    if (empty($imgUploaded) || $imgUploaded == false){

					$data['message'] .= '
					    <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error Occured!</strong><br> An error occured while trying to upload the sector image. Sector was not added.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';

				    }else{
					// checking if item was choosen to be featured
					$isFeatured = 0;

					if (isset($_POST['isFeatured'])){

						$featuredCount = count($process->getSectors(null,1,1));

						if ($featuredCount >= MAX_FEATURED_SECTORS){
							$data['message'] .= '
							    <div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Warning!</strong><br> 
								Sector was not featured, max featured amount ('.MAX_FEATURED_SECTORS.') has already been used up, please unfeature some sectors so you can feature this one.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								</button>
							    </div>
							';
						}else{

							$isFeatured = 1;
						}

					}

					//adding sector
					$sectorAdded = $process->addSector($_POST['name'], $_POST['description'], $isFeatured, $imgUploaded['file_path'], $_SESSION['USERDATA']['user_id']);
					if (!$sectorAdded){
						
						$data['message'] = '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Error!</strong><br> Sorry, an error occured while trying to add the sector. Sector was not added, please report the error the developer.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					}else{

						$data['message'] = '
						    <div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Success!</strong> Sector was added.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';
					
					}

				    }
				}else{
					$data['message'] = '
					    <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Image type not accepted!</strong><br> Please upload an image with the following extension, PNG, JPEG or JPG.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';
				}
			    }else{
				$data['message'] = '
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Image Dimension not acceptable!</strong><br> Please upload an image with the following dimensions, width: '.$minWidthSize.' 
					- '.$maxWidthSize.' and height: '.$minHeightSize.' - '.$maxHeightSize.'.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			     }
		     }

		}else{
			$data['message'] = '
			    <div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>No Image detected!</strong><br> Please upload an image it is required in order for us to add the sector.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
			    </div>
			';
		}

		$data['sectors'] = $process->getSectors();
		$pageContent = $view->sectorList($data);

	}else if (!empty($_SESSION['USERDATA']) && ( $user_type == 'admin' || $user_type == 'su') && $_POST['action'] == 'addUser'){

		$result = [];
		$result['message'] = '';
		$errorCount = 0;
		$errorMessage = '';
		$userEmail = '';
		$cName = '';

		$userExist = $process->getUserSalt($_POST['companyInfo']['email'] ?? $_POST['email']);
		if ($userExist != false){
			//exists
			$noticeTitle = 'User Exist!';
			$noticeMessage = '
				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fas-exlamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					The following email, "'.$_POST['email'].'". has already been used to create an account, please refer to the <a href="'.BASE_URL.'user-list">user list</a>.
				    </div>
			';

		}else{
		
			$wasAdded = [];

			switch ($_POST['user']){

				case 'buyer':

					$userEmail = $_POST['email'];
					$cName = isset($_POST['companyName'])? $_POST['companyName'] : $_POST['fName'].' '.$_POST['lName'];

					$wasAdded = $process->add_user(
							$_SESSION['USERDATA']['user_id'], 
							'buyer', 
							$_POST['fName'], 
							$_POST['lName'], 
							$_POST['email'], 
							$_POST['companyName']
						);
				break;

				case 'company':

					$userEmail = $_POST['companyInfo']['email'];
					$cName = $_POST['companyInfo']['name'];

					$wasAdded = $process->add_user(
							$_SESSION['USERDATA']['user_id'],
							'company',
							null, // has no firstname
							null, //has no lastname
							$_POST['companyInfo']['email'], 
							$_POST['companyInfo']['name'], 
							$_POST['companyInfo']['description'],
							$_POST['companyInfo']['ctv'],
							$_POST['companyInfo']['address'],
							$_POST['companyInfo']['district'],
							decrypt($_POST['companyInfo']['type']),
							$_POST['companyInfo']['tradeArea'],
							$_POST['companyInfo']['phone'],
							$_POST['companyInfo']['establishedOn'],
							$_POST['companyInfo']['website']
						);

					if (isset($wasAdded['user_id'])){

						//adding point of contact information
						$pocAdded = $process->addPointOfContact(
							$wasAdded['company_id'],
							$_POST['pointOfContact']['fname'],
							$_POST['pointOfContact']['lname'],
							$_POST['pointOfContact']['position'],
							$_POST['pointOfContact']['email'],
							$_POST['pointOfContact']['phone'],
							$_SESSION['USERDATA']['user_id']
						);

						if ($pocAdded == false){
							$errorCount++;
						}
						
						
						// only if company registered provides services
						if (decrypt($_POST['companyInfo']['type']) == 3){

							// adding company service additional info 
							$serviceAdded = $process->addCompanyServiceInfo(
										$wasAdded['company_id'], 
										$_POST['companyInfo']['currentSeatCapacity'],
										$_POST['companyInfo']['expanPotential'],
										null,//services offered
										null,//industries serviced
										$_SESSION['USERDATA']['user_id']
							);
								
							if ($serviceAdded == false){
								$errorCount++;

							}	

						}


					}

				break;

				case 'admin':
					if($user_type == 'su'){

						$userEmail = $_POST['email'];
						$cName = $_POST['fName'].' '.$_POST['lName'];

						//adding user	
						$wasAdded = $process->add_user(
								$_SESSION['USERDATA']['user_id'], 
								'admin', 
								$_POST['fName'], 
								$_POST['lName'], 
								$_POST['email']
						);

					}else{

						$wasAdded['res_code'] = -1;
					}


				break;
				case 'su':
					if($user_type == 'su'){

						$userEmail = $_POST['email'];
						$cName = $_POST['fName'].' '.$_POST['lName'];

						//adding user	
						$wasAdded = $process->add_user(
								$_SESSION['USERDATA']['user_id'], 
								'su', 
								$_POST['fName'], 
								$_POST['lName'], 
								$_POST['email']
						);

					}else{

						$wasAdded['res_code'] = -1;
					}


				break;
			}
			

			if ($wasAdded['res_code'] == 1){

				// sending out email activation code
				$email = new Email();
				$errorMessage = '';
				$emailError = 0;
				
				$title = 'Account Created';
				$message = '
					Hello '.$cName.', this email account has been used to create a '.$_POST['user'].' account for the <a href="'.BASE_URL.'" style="color:#e50d70;text-decoration:underline;">Export Belize Plaform</a>. To access your account please set a new password by requesting a <a href="'.BASE_URL.'forgot-password" style="color:#e50d70;text-decoration:underline;">password reset</a>. From there you can proceed by following the instruction provided. 
				';
				$moreInfo = 'Thank you for joining our ExbortBelize Platform! If you have any problems you can <a href="'.BASE_URL.'contact" style="color:#e50d70;text-decoration:underline;">contact us</a> and we\'ll see how best we can assist you.';

				$emailCard = $view->emailCard($title, $message, $moreInfo);
				
				try{
					$email->set_Subject('Account Created');
					$sent = $email->send($userEmail, $emailCard);

					if (!$sent){
						$errorMessage .= '
							      Failed to notify "'.$userEmail.'" via email, please instruct the user to proceed by requesting a "forgot pasword" request by going to the sign in section of the website. Thereafter the user should follow the instructions provided to them.
						';

						$emailError++;

					}else{

					    $errorMessage .= '
							The '.ucfirst($_POST['user']).' account for "'.$userEmail.'" was notified via email that their account was created!
					    ';

					}

				}catch(Exception $e){


					$errorMessage .= '
					      Failed to notify "'.$userEmail.'" via email, please instruct the user to proceed by requesting a "forgot pasword" request by going to the sign in section of the website. Thereafter the user should follow the instructions provided to them.
					';
					$emailError++;

				}
				if ($errorCount > 0){
					//not all company service information was saved
					$noticeTitle = 'Notice!';
					$noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fas fa-exlamation-triangle text-warning" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							User was added but some errors were encounterd while trying to save some aditional info. <br><br>
							'.$errorMessage.'
						    </div>
					';

				}else if($emailError > 0){

					$noticeTitle = 'Notice!';
					$noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fas fa-exlamation-triangle text-warning" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							User was added. <br><br>
							'.$errorMessage.'
						    </div>
					';


				}else{

					$noticeTitle = 'User Added!';
					$noticeMessage = '
						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fas fa-check-circle text-success" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							User was added <br><br>
							'.$errorMessage.'
						    </div>
					';

				}

			}else if ($wasAdded['res_code'] == -1){

				$noticeTitle = 'Permission Needed!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, but you cannot add this type of user!
					    </div>
				';

			}else{
				$noticeTitle = 'User was not added!';
				$noticeMessage = '
					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry an error occured and the user was not added. <br><br>
						'.$wasAdded['message'].'
					    </div>
				';
			}

		}

		$noticeBtn = '
		    <a href="'.BASE_URL.'user-list" class="btn btn-primary mr-3"> User List</a>
		    <a href="'.BASE_URL.'add-user" class="btn btn-primary"> Add User</a>
		';
		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


	}else if ( (!empty($_SESSION['USERDATA']) && ($user_type == 'admin' || $user_type == 'su') ) && $_POST['action'] == 'addExportMarket'){


		$result = [];
		$eMarket = $process->getExportMarkets(null, $_POST['name']);

		if (!empty($eMarket)){
			//exists
			$result['message'] = '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Warning!</strong><br> The Export Market name that you\'ve entered, "<strong>'.$eMarket[0]['name'].'</strong>" already exists, please try another name.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>
			';
		}else{

			$wasAdded = $process->addExportMarket($_POST['name'], $_SESSION['USERDATA']['user_id']);

			if ($wasAdded){
			    $result['message'] = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-check fa-lg"></i> Success!</strong> New Export Market was created!
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';
			}else{

				$result['message'] = '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					    <strong><i class="fa fa-times fa-lg"></i> Failed!</strong><br> An error occured while trying to create the export market please report this error to the developer.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				';
			}


		}

	     	$result['exportMarkets'] = $process->getExportMarkets();
	    	$pageContent = $view->exportMarketList($result);

	}else if ( !empty($_SESSION['USERDATA']) && $user_type == 'su' && $_POST['action'] == 'addServiceCategory'){

		$noticeTitle = '';
		$noticeMessage = '';

		$added = $process->addServiceCategory(
			$_POST['name'],
			$_POST['acronym'],
			$_POST['icon'],
			$_POST['description'],
			$user_id
		);

		if (!$added){

			$noticeTitle = 'Error!';
			$noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fa fa-times text-danger" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Sorry, we encountered an error while adding the service category, please try again later.
			    </div>
			';

		}else{

			$noticeTitle = 'Service Category added!';
			$noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="far fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				New service category was successfully added.
			    </div>
			';


		}

		$noticeBtn = '
		    <a href="'.BASE_URL.'service-category-list" class="btn btn-primary mr-3">Service Cat. List</a>&nbsp
		    <a href="'.BASE_URL.'add-service-category" class="btn btn-primary"> Add Service Cat.</a>
		';

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


	}else if ( !empty($_SESSION['USERDATA']) && $user_type == 'su' && $_POST['action'] == 'addSubServiceCategory'){

		$noticeTitle = '';
		$noticeMessage = '';

		$added = $process->addSubServiceCategory(
			decrypt($_POST['scId']),
			$_POST['name'],
			$_POST['icon'],
			$_POST['description'],
			$user_id
		);

		if (!$added){

			$noticeTitle = 'Error!';
			$noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fa fa-times text-danger" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Sorry, we encountered an error while adding the sub service category, please try again later.
			    </div>
			';

		}else{

			$noticeTitle = 'Sub Service Category added!';
			$noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="far fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				New sub service category was successfully added.
			    </div>
			';


		}

		$noticeBtn = '
		    <a href="'.BASE_URL.'sub-service-category-list" class="btn btn-primary mr-3">Sub Service Cat. List</a>&nbsp
		    <a href="'.BASE_URL.'add-sub-service-category" class="btn btn-primary"> Add Sub Service Cat.</a>
		';

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

	}else if ( !empty($_SESSION['USERDATA'])  && $user_type != 'buyer' && $_POST['action'] == 'addMusic'){


		
		$noticeBtn = '';
		$noticeTitle = '';
		$noticeMessage = '';
		$cId = 0;

		if ($user_type == 'admin' || $user_type == 'su'){

			$zero = encrypt(0);
			$cId = decrypt($_POST['cId'] ?? $zero);

			$noticeBtn = '
			    <a href="'.BASE_URL.'music-list" type="submit" class="btn btn-primary mr-3">Music List</a>&nbsp
			    <a href="'.BASE_URL.'add-music" type="submit" class="btn btn-primary"> Add Music</a>
			';
			

		}else if ($user_type == 'company' && $user_company_type_id == 1){
			//music company profile
			$cId = $user_company_id ?? 0;
			$noticeBtn = '
			    <a href="'.BASE_URL.'my-music" class="btn btn-primary mr-3">My Music</a>&nbsp
			    <a href="'.BASE_URL.'add-music" class="btn btn-primary"> Add Music</a>
			';
		}else{
			
			$cId = 0;

		}
		//getting file info
		$fileTmpPath = $_FILES['audio']['tmp_name'];
		$fileSize = filesize($fileTmpPath);
		$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
		$filetype = finfo_file($fileinfo, $fileTmpPath);

		$allowedTypes = [
		   'audio/mpeg' => 'mpeg',
		   'audio/mp3' => 'mp3'
		];

		if ($cId == 0){
			    $noticeTitle = 'Company Not Found!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry Invalid company selected, please try another company.
				    </div>
			    ';
		//audio validation starts
	        }else if (empty($_FILES) || !isset($_FILES['audio']['name'])){

			    $noticeTitle = 'Invalid File!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					No audio file detected please try another file.
				    </div>
			    ';
			

		}else if($_FILES['audio']['error'] != 0){
			//error occured 
			    $noticeTitle = 'File Upload Error!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					An error occured while uploading the audio file, error: '.$_FILES['audio']['error'].'. Please try again.
				    </div>
			    ';

		}else if( (($fileSize/1024)/1024) <= 0 ||  (($fileSize/1024)/1024) > 1){

			    $noticeTitle = 'File size not acceptable!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					File size is but be less than 1MB, file size: '.round( ($fileSize/1024)/1024 , 2).'. Please try another file.
				    </div>
			    ';

		}else if(!in_array($filetype, array_keys($allowedTypes))){//check file type

			    $noticeTitle = 'File type not acceptable!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fas fa-exclamation-triangle text-warning" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					File type must be MP3, please try another file.
				    </div>
			    ';


		}else{

			//upload audio and create record
			$filename = basename($fileTmpPath); // I'm using the original name here, but you can also change the name of the file here
			$extension = $allowedTypes[$filetype];
			$targetDirectory = 'uploads/music'; // __DIR__ is the directory of the current PHP file

			$newFilepath = $targetDirectory . "/" . $filename .time(). "." . $extension;

			if (!copy($fileTmpPath, $newFilepath )) { // Copy the file, returns false if failed
			    $noticeTitle = 'File Upload Error!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured while uploading the file. Please try again later.
				    </div>
			    ';
			}else{
				//created music record
				$added = $process->addMusic($cId, $_POST['name'], $_POST['description'], $newFilepath, $user_id);

				if (!$added){

				    $noticeTitle = 'Failed to Add Music!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, an error while adding your music. Please try again later.
					    </div>
				    ';
			
				}else{

				    $noticeTitle = 'Music was added!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
						<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Your music was succesfully added.
					    </div>
				    ';

				}
			}
			unlink($fileTmpPath); // Delete the temp file

		}

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);
		
	}else if ( !empty($_SESSION['USERDATA'])  && ($user_type == 'su' || $user_type == 'admin' ) && $_POST['action'] == 'addFaq'){

		$noticeTitle = '';
		$noticeMessage = '';
		$noticeBtn = '
		    <a href="'.BASE_URL.'faq-list" type="submit" class="btn btn-primary mr-3">Faq List</a>&nbsp
		    <a href="'.BASE_URL.'add-faq" type="submit" class="btn btn-primary"> Add Faq</a>
		';

		$wasAdded = $process->addFaq($_POST['question'], $_POST['answer'], $_POST['displayTo'], $user_id);

		if ($wasAdded){
		    $noticeTitle = 'Faq was added!';
		    $noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Faq was succesfully added.
			    </div>
		    ';
		}else{

		    $noticeTitle = 'Failed to add Faq!';
		    $noticeMessage = '

			    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
				<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Sorry, an error while adding the Faq, please try again later.
			    </div>
		    ';
		}

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


	}else if ( !empty($_SESSION['USERDATA'])  && ($user_type == 'su' || $user_type == 'admin' ) && $_POST['action'] == 'addHsCode'){

		$result = [];
		$hsCodeInfo = $process->getHsCodes(null, $_POST['hsCode']);

		if (!empty($hsCodeInfo)){
			//exists
			$result['message'] = '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Warning!</strong><br> The Hs Code that you\'ve entered already exists, please try another Hs Code.
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>
			';
		}else{

			$wasAdded = $process->addHsCode($_POST['hsName'], $_POST['hsCode'], decrypt($_POST['sId']), $_SESSION['USERDATA']['user_id']);

			if ($wasAdded){
			    $result['message'] = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				    <strong><i class="fa fa-check fa-lg"></i> Success!</strong> Hs Code was added!
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				    </button>
				</div>

			    ';
			}else{

				$result['message'] = '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					    <strong><i class="fa fa-times fa-lg"></i> Failed!</strong><br> An error occured while adding the Hs Code please notify the developer.
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					    </button>
					</div>
				';
			}


		}

		$result['codes'] = $process->getHsCodes();
		$pageContent = $view->hsCodeList($result);


	}else if ( !empty($_SESSION['USERDATA']) && $_POST['action'] == 'addService' && $user_type != 'buyer'){

		$noticeBtn = '';
		$cId = 0;

		//validating user access
		if ($user_type == 'admin' || $user_type == 'su'){

			$cId = decrypt($_POST['cId']);

			//just making sure company provides services
			$companyInfo = $process->get_company_list(null, $cId);
			$cType = $companyInfo[0]['company_type_id']; 

			$noticeBtn = '
			    <a href="'.BASE_URL.'service-list" type="submit" class="btn btn-primary mr-3">Service List</a>&nbsp
			    <a href="'.BASE_URL.'add-service" type="submit" class="btn btn-primary"> Add Service</a>
			';

		}else if ($user_type == 'company' && $user_company_type_id == 3){
			//company account provides services

			$cId = $user_company_id; 
			$noticeBtn = '
			    <a href="'.BASE_URL.'my-services" type="submit" class="btn btn-primary mr-3">My Service</a>&nbsp
			    <a href="'.BASE_URL.'add-service" type="submit" class="btn btn-primary"> Add Service</a>
			';

		}else{

			$cId = 0;

		}

		//final validation of comany profile
		if ($cId == 0){
			//id passed does not exist

			$pageContent = $view->pageNotFound();

		}else{
			//validation succesful 

			$noticTitle = '';
			$noticeMessage = '';

			$added = $process->addService(
				$cId,
				decrypt($_POST['sId']),
				decrypt($_POST['sscId']),
				$_POST['name'],
				$_POST['description'],
				$user_id
			);

			
			if (!$added){
			    $noticeTitle = 'An Error Occured!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, we encountered and error while trying to add your service, please try again later.
				    </div>
			    ';
			}else{

			    $noticeTitle = 'Success!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
					<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Service was succesfully added.
				    </div>
			    ';
			}

			$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);
		} 	


	    //adding a image but provide image size restrictions 550 by 500 is the normal image size on the templates
	}else if (!empty($_SESSION['USERDATA']) && $user_type != 'buyer'  && $_POST['action'] == 'addProduct'){
		//company and admin have the ability to add products

	            $cId  	    = 0;
		    $imgCount 	    = 0;
		    $fileError      = 0;
		    $uploadError    = 0;
		    $fileSizeError  = 0;
		    $dimensionError = 0;
		    $imgTypeError   = 0;
		    $insertImgError = 0;
		    $hsId 	    = decrypt($_POST['hsId']);

		    $data = [];
		    $data['message'] = '';
		
		    //image sizes
		    $minWidthSize  = 500;
		    $maxWidthSize  = 1080;
		    $minHeightSize = 500;
		    $maxHeightSize = 900;

		    // getting companyId
		    if ($user_type == 'company' && $user_company_type_id == 2){
			//comapny supplies products

			$cId = $user_company_id;


		    }else if (($user_type = 'admin' || $user_type == 'su') && isset($_POST['cId'])){
			//admin or super user				
			$cId = decrypt($_POST['cId']);
			
			$companyInfo = $process->get_company_list(null, $cId);

			if ($companyInfo[0]['company_type_id'] != 2){
				//company does not supply products
				$cId = 0;
			}

		    }else{

			$cId = 0;

		    }

   
		    if ($cId != 0 && isset($hsId) && $hsId != 0){

				//number of uploaded images
				$fileCount = is_array($_FILES['files']['name'])? count($_FILES['files']['name']) : 1;
				
				//checking if product name exist 
				$productInfo = $process->get_products($_POST['prodName']);
				if (!empty($productInfo)){
					
					$data['message'] = '
					    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Product Already Exist!</strong><br> The product you are trying to create already exist. Please use the link below to edit the existing product.<br>
							<a href="'.BASE_URL.'edit/my-product/'.encrypt($productInfo[0]['product_id']).'" class="btn btn-link bs-text-primary">
								<i class="fas fa-pencil-alt"></i>
								Edit Product
							</a>	
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';
						
	
				}else if ($fileCount <= 0 ){
					$data['message'] = '
					    <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>No Image detected!</strong><br> Please upload an image it is required in order for us to add the product.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';

				}else{

				    //setting product info
				    $productId = $process->setProductDetails(
					null,
					$cId, 
					$hsId, 
					$_POST['prodName'], 
					$_POST['productDescription'], 
					$_SESSION['USERDATA']['user_id']
				     );

				     if ($productId != false){

					for($i = 0; $i < $fileCount; $i++){
						
						//only 5 images are required for a product	
						if ($fileCount < 5){

							if ($_FILES['files']['error'][$i] == 0){
					
								//checking file size 
							    if (($_FILES['files']['size'][$i]/1000000) > 0 && ($_FILES['files']['size'][$i]/1000000) <= 2){ // less than 2 MB
					
								    $imgSize = getimagesize($_FILES['files']['tmp_name'][$i]);


								    //imgSize[0] contains the width and imgSize[1] contains the height of the image
								    if ( ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){
									    //valid width and height=

									    $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime-type extension
									    $mime = finfo_file($finfo, $_FILES['files']['tmp_name'][$i]);
									    finfo_close($finfo);

									    $type = explode('/', $mime);
									    $imgType = strtolower($type[1]);
									    $validImgTypes = array("jpg", "png", "jpeg");

									    if (in_array($imgType, $validImgTypes)){

										$file = pathinfo($_FILES['files']['name'][$i]);

										$result = uploadImage(
											$_FILES['files']['name'][$i],		//filename 
											$_FILES['files']['tmp_name'][$i], 	//tmpname of uploaded file	
											'uploads/products/',			//upload Location
											60					//image quality
										);


										if ($result['error'] == 0){

											//inserting image 
											$addedImg = $process->addProductImage(
												$productId,
												$result['file_path'],
												$result['file_name'],
												$_FILES['files']['size'][$i],
												$imgType
											);
											
 											if(!$addedImg){
												$insertImgError++;
											}

										}else{
											//upload error encountered
											$uploadError++;
										}
											

									    }else{
			
										$imgTypeError++;
									    }

								    }else{

									$dimensionError++;

								    }
								
							    }else{

								$fileSizeError++;

							    }
				
							}else{

								$fileError++;

							}
						}
					}

					$errorTotal = ($fileError + $fileSizeError + $dimensionError + $imgTypeError + $uploadError + $insertImgError);
					if ($errorTotal == $fileCount ){

						$data['message'] = '
						    <div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Some errors occured!</strong><br> Product Information was saved and no images were saved. Product will not be displayed publicly without images please add images to have this product displayed publicly.<br>
							<a href="'.BASE_URL.'edit/my-product/'.encrypt($productId).'" class="btn btn-link bs-text-primary">
								<i class="fas fa-pencil-alt"></i>
								Edit recently created product
							</a>	
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';


					}else if ($errorTotal > 0){
						
						$data['message'] = '
						    <div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Some errors occured!</strong><br> Product information was saved but some images were not saved.<br>
							<a href="'.BASE_URL.'edit/my-product/'.encrypt($productId).'" class="btn btn-link bs-text-primary">
								<i class="fas fa-pencil-alt"></i>
								Edit recently created product
							</a>	
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';
			

					}else{

						$data['message'] = '
						    <div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Success!</strong><br> Product Information and image(s) were saved.<br>
							<a href="'.BASE_URL.'edit/my-product/'.encrypt($productId).'" class="btn btn-link bs-text-primary">
								<i class="fas fa-pencil-alt"></i>
								Edit recently created product
							</a>	
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					}
					

					//getting error messages 
					if ($fileError > 0){
						
						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>File Upload Error!</strong><br> '.$fileError.' file upload error encountered, please try adding the images again. 
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';
			

					}

					if ($fileSizeError > 0){
						
						$word = ($fileSizeError > 1)? 'were' : 'was';
						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Image to large!</strong><br> '.$fileSizeError.' product image(s) '.$word.' not uploaded. Exceeds image max size (2MB), please try uploading a smaller image size. 
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';
			

					}

					if ($dimensionError > 0){
						
						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Image Dimension not acceptable!</strong><br> '.$dimensionError.' image(s) did not met the following dimension requirements,<br><strong>Width: '.$minWidthSize.'- '.$maxWidthSize.' and height: '.$minHeightSize.' - '.$maxHeightSize.'. px</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';
			

					}

					if ($imgTypeError > 0){

						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Image type not accepted!</strong><br> '.$imgTypeError.' image(s) did not meet the following image extension type, PNG, JPEG or JPG. 
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					}

					if ($uploadError > 0 || $insertImgError > 0){

						$count = $uploadError + $insertImgError;
						$word = ($count > 1)? 'were' : 'was';
						$data['message'] .= '
						    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed to Add Image!</strong><br>Sorry, an error occured and  '.$count.' image(s) '.$word.' not saved.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
						    </div>
						';

					}

				     }else{

					$data['message'] = '
					    <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error!</strong><br> Sorry an error occured while trying to add the product information, please try again later.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					';

				     }

			         }
			    
			    $data['hsCodes'] = $process->getHsCodes();

			    $pageContent = $view->addProduct($data);

		    }else{
	
			$pageContent = $view->pageNotFound();
		    }


	}else if( !empty($_SESSION['USERDATA']) && $_POST['action'] == 'saveProductDetails'){
		//companies and admins are able to saveProductDetails
		    
		    $result['initialPrev'] = array();
		    $result['initialPrevConfig'] = array();

	    	    $pId = decrypt($_POST['pId']);
	    	    $hsId = decrypt($_POST['hsId']);

		    $productInfo = $process->get_products(null, null, $pId);

		    if (empty($productInfo)){

			$pageContent = $view->pageNotFound();

		    }else if ($user_type == 'admin' || $user_type == 'su'){
			
			    $cId = decrypt($_POST['cId'] ?? 0);

			    $updated = $process->setProductDetails(
					$pId,
					$cId,
					$hsId,
					$_POST['prodName'],
					$_POST['prodDescription'],
					$_SESSION['USERDATA']['user_id']
				);

			    if ($updated == false){
				$result['message'] = '
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>We\'re Sorry,</strong> Product Details were not saved.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			    }else{
				$result['message'] = '
				    <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong><i class="fa fa-check fa-lg"></i> Success!</strong> Product Detail was updated!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			    }

			    $result['product'] = $process->get_products(null, null, $pId);

			    foreach( $result['product'][0]['productImages'] as $key => $productImg ){

				$result['initialPrev'][$key] = array(
				    BASE_URL.$productImg['path']
				);

				$result['initialPrevConfig'][$key] = array(
				    'caption' => $productImg['file_name'],
				    'url' => BASE_URL.'index.php/',
				    'key' => encrypt($productImg['id']),
				    'size' => $productImg['size'],
				    'downloadUrl' => BASE_URL.$productImg['path'],
				    'type' => 'image',//$productImg['type'],
				    'extra' => ['productId'=>encrypt($result['product'][0]['product_id']), 'ajaxRequest'=>'removeProductImg']
				);

			    }

			    $result['uploadExtraData'] = array(
				'ajaxRequest' => 'uploadProductImg',
				'productId' => encrypt($result['product'][0]['product_id'])
			    );
			   
			    $result['pageTitle'] = $result['product'][0]['product_name'];
			    $result['bannerTitle'] = 'Edit Product';
			    $result['hsCodes'] = $process->getHsCodes();

			    $pageContent = $view->editProduct($result);


		    }else if ($userType == 'company' && $_SESSION['COMPANYDATA'][0]['company_id'] == $productInfo[0]['company_id']){

			    $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;

			    $updated = $process->setProductDetails(
					$pId,
					$cId,
					$hsId,
					$_POST['prodName'],
					$_POST['prodDescription'],
					$_SESSION['USERDATA']['user_id']
				);

			    if ($updated == false){
				$result['message'] = '
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>We\'re Sorry,</strong> Product Details were not saved.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			    }else{
				$result['message'] = '
				    <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong><i class="fa fa-check fa-lg"></i> Success!</strong> Product Detail was updated!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				    </div>
				';
			    }

			    //getting product info
			    $result['product'] = $process->get_products(null, null, $pId);

			    foreach( $result['product'][0]['productImages'] as $key => $productImg ){

				$result['initialPrev'] = array(
				    BASE_URL.$productImg['path']
				);

				$result['initialPrevConfig'][$key] = array(
				    'caption' => $productImg['file_name'],
				    'url' => BASE_URL.'index.php/',
				    'key' => encrypt($productImg['id']),
				    'size' => $productImg['size'],
				    'downloadUrl' => BASE_URL.$productImg['path'],
				    'type' => 'image',//$productImg['type'],
				    'extra' => ['productId'=>encrypt($result['product'][0]['product_id']), 'ajaxRequest'=>'removeProductImg']
				);

			    }

			    $result['uploadExtraData'] = array(
				'ajaxRequest' => 'uploadProductImg',
				'productId' => encrypt($result['product'][0]['product_id'])
			    );
			   
			    $result['pageTitle'] = $result['product'][0]['product_name'];
			    $result['bannerTitle'] = 'Edit Product';
			    $result['hsCodes'] = $process->getHsCodes();

			    $pageContent = $view->editProduct($result);

	            }else{

			$pageContent = $view->pageNotFound();

		    }


		    
		    $result['sectors'] = $process->getSectors();

	}else if ($_POST['action'] == 'contactCompany' && isset($_POST['cId']) ){

		$noticeTitle   = '';
		$noticeMessage = '';

		if(!empty($_POST['g-recaptcha-response'])){

			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SECRET.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);

			if($responseData->success){
				//recaptcha validation successful
				$cId = decrypt($_POST['cId']);
				$company = $process->get_company_list(null, $cId);

				if (!empty($company)){

					$title = '';
				
					//product contact
					if (isset($_POST['pId'])){
						$pId = decrypt($_POST['pId']);

						//getting product info
						$product = $process->get_products(null, null, $pId);

						$title = 'Contacted from Product Details - <br> '.$product[0]['product_name'];

					}else if (isset($_POST['sId'])){
					//service contact
						$id = decrypt($_POST['sId']);

						//getting product info
						$service = $process->getServices($id);

						$title = 'Contacted from Service Detail - <br>'.$service[0]['service_name'];

					}else if (isset($_POST['mId'])){
					//music Contact
						$id = decrypt($_POST['mId']);

						//getting product info
						$music = $process->getMusic($id);

						$title = 'Contacted from Music Detail - <br>'.$music[0]['name'];

					}else{
						//from company details
						$title = 'Client trying to connect!';

					}
					// sending out email activation code
					$email = new Email();
			
					$message = '<strong>'.ucfirst($_POST['name']).'</strong> is reaching out to you and their contact email is:<br><br>
						<a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a><br><br><br>
						<strong> '.ucfirst($_POST['subject']).'</strong><br><br>
						<i>"'.ucfirst($_POST['message']).'"</i>
					';
					$moreInfo = 'This email was sent by the '.PLATFORM_NAME.' Platform, please contact the individual with the email stated above to engage in further conversation with them.';

					$emailCard = $view->emailCard($title, $message, $moreInfo, '
						https://neilpatel.com/wp-content/uploads/2017/09/8-Email-Personalization-Techniques-That-Work-Better-Than-The-Name-Game.jpg
					');
					
					try{
						$email->set_Subject(PLATFORM_NAME.' Potential Client');
						$sent = $email->send($company[0]['company_email'], $emailCard);

						if (!$sent){

						    $noticeTitle = 'Failed to send email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
								<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, we were unable to send email, please try again later.
							    </div>
						    ';
						}else{

							$noticeTitle = 'Email Sent';
							$noticeMessage = '
								    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
									<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
								    </h2> 
								    <div class="text-center">
									Thank you for connecting with '.$company[0]['company_name'].', look forward to a response via the email provided.
								    </div>
							';

						}

					}catch(Exception $e){
						
						    $noticeTitle = 'An error occured while sending email';
						    $noticeMessage = '

							    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
								<i class="fa fa-times text-danger" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								Sorry, an error occured while trying the email.
							    </div>
						    ';

					}
					
					
				}else{
					
				    $noticeTitle = 'Company Not Found!';
				    $noticeMessage = '

					    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
						<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
					    </h2> 
					    <div class="text-center">
						Sorry, but the company you\'re trying to get in touch is not available.
					    </div>
				    ';

				}



			}else{
			// validation succesful sending email

			    $noticeTitle = 'Re-Captcha Error!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured, "'.$responseData->{'error-codes'}[0].'". Please try again.
				    </div>
			    ';

			}

		}else{
		    // recaptcha not captured
		    $noticeTitle = 'Re-Captcha not selected!';
		    $noticeMessage = '

			    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
				<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Sorry, but we could not detect the recaptach being selected, please try again and select I am not a Robot.
			    </div>
		    ';
			

		} 	

		$noticeBtn = '
		    <a href="'.$_SERVER['HTTP_REFERER'].'" type="submit" ><i class="fa fa-arrow-left"></i> Go Back</a>&nbsp
		';

		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);


	}else if ($_POST['action'] == 'contactUs'){

		$noticeTitle   = '';
		$noticeMessage = '';

		if(!empty($_POST['g-recaptcha-response'])){


			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SECRET.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);

			if($responseData->success){
			//recaptcha validation successful

				// sending out email activation code
				$email = new Email();
		
				$title = 'ExportBelize Contact Us';
				$message = '<strong>'.ucfirst($_POST['name']).'</strong> has requested assistance his contact email is:<br><br>
					<a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a><br><br><br>
					<strong> '.ucfirst($_POST['subject']).'</strong><br><br>
					<i>"'.ucfirst($_POST['message']).'"</i>
				';
				$moreInfo = 'This email was sent by the ExportBelize Platform, please contact the individual with the email stated above.';

				$emailCard = $view->emailCard($title, $message, $moreInfo, '
					https://neilpatel.com/wp-content/uploads/2017/09/8-Email-Personalization-Techniques-That-Work-Better-Than-The-Name-Game.jpg
				');
				
				try{
					$email->set_Subject('Export Platform Contact Us');
					$sent = $email->send(RECIEVER_EMAIL, $emailCard);

					if (!$sent){

					    $noticeTitle = 'Failed to send email';
					    $noticeMessage = '

						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, we were unable to send email, please try again later.
						    </div>
					    ';
					}else{

						$noticeTitle = 'Email Sent';
						$noticeMessage = '
							    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
								<i class="fa fa-check-circle text-success" style="font-size:50px;"></i>
							    </h2> 
							    <div class="text-center">
								You should recieve a response no longer than three (3) business days.
							    </div>
						';

					}

				}catch(Exception $e){
					
					    $noticeTitle = 'An error occured while sending email';
					    $noticeMessage = '

						    <h2 class="text-center mt-0 mb-0 pt-0 pb-0">
							<i class="fa fa-times text-danger" style="font-size:50px;"></i>
						    </h2> 
						    <div class="text-center">
							Sorry, an error occured while trying the email.
						    </div>
					    ';

				}

			}else{
			// validation succesful sending email

			    $noticeTitle = 'Re-Captcha Error!';
			    $noticeMessage = '

				    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
					<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
				    </h2> 
				    <div class="text-center">
					Sorry, an error occured, "'.$responseData->{'error-codes'}[0].'". Please try again.
				    </div>
			    ';

			}


			/*

			*/
		}else{
			// recaptcha not captured
			
		    $noticeTitle = 'Re-Captcha not selected!';
		    $noticeMessage = '

			    <h2 class="text-center mt-0 mb-3 pt-0 pb-0">
				<i class="far fa-times-octagon text-danger" style="font-size:50px;"></i>
			    </h2> 
			    <div class="text-center">
				Sorry, but we could not detect the recaptach being selected, please try again and select I am not a Robot.
			    </div>
		    ';
			

		} 	

		$noticeBtn = '
		    <a href="'.BASE_URL.'" type="submit" class="btn btn-primary mr-2"> Home</a>
		    <a href="'.BASE_URL.'contact" type="submit" class="btn btn-primary"> Contact Us</a>
		';
		$pageContent = $view->noticeCard($noticeTitle, $noticeMessage, $noticeBtn);

	}else{

		$pageContent = $view->pageNotFound();
	}

    }else if ( $_POST && isset($_POST['ajaxRequest']) ){
	//PERFORM ALL AJAX REQUEST MADE VIA POST

	$ajaxRequest = 1;
		
        if (!empty($_SESSION) && isset($_SESSION['USERDATA']['user_id'])){
            //HANDLE SESSION FOR LOGGED IN USER

            if ($user_type == 'admin' || $user_type == 'su'){
                // ALL AJAX REQUESTS AVAILABLE FOR ADMIN ACCOUNT 


               if($_POST['ajaxRequest'] == 'getUnFeaturedProducts'){

			$products = $process->get_products();
			$unFeatured = [];

			if (!empty($products)){
				
				foreach ($products as $key => $product){
				
					if ($product['is_featured'] == 0){
						
						$product['product_id'] = encrypt($product['product_id']);
						$unFeatured[] = $product;
			
					}

				}
			}	
			
			echo json_encode($unFeatured);			
			
                }else if($_POST['ajaxRequest'] == 'getUnFeaturedCompany'){

			$companys = $process->get_company_list(null, null, 1);
			$unFeatured = [];

			if (!empty($companys)){
				
				foreach ($companys as $key => $company){
				
					if ($company['is_featured'] == 0){
						
						$company['company_id'] = encrypt($company['company_id']);
						$unFeatured[] = $company;
			
					}

				}
			}	
			
			echo json_encode($unFeatured);			
			
                }else if($_POST['ajaxRequest'] == 'getUnFeaturedSector'){

			$unFeatured = [];
			$sectors = $process->getSectors(null, 1, 0);

			if (!empty($sectors)){
				
				foreach ($sectors as $key => $sector){
				
					if ($sector['is_featured'] == 0){
						
						$sector['id'] = encrypt($sector['id']);
						$unFeatured[] = $sector;
			
					}

				}
			}	

			echo json_encode($unFeatured);			


                }else if($_POST['ajaxRequest'] == 'addFeaturedProduct'){

			$result = [];

			if (isset($_POST['pId'])){

				$pId = decrypt($_POST['pId']);
				$productInfo = $process->get_products(null, null, $pId);

				if (!empty($productInfo)){
					
					if($productInfo[0]['is_featured'] == 1){

						$result = array(
							'error' => 1,
							'message' => 'Product is currently featured!'
						);
					}else{

						$featuredCount = 0;
						$products = $process->get_products();
						
						foreach ($products as $key => $product){
						   
						    if ($product['is_featured'] == 1){
							$featuredCount++;
						    }
						    
						}

						if($featuredCount > 2){
							
							$result = array(
								'error' => 1,
								'message' => 'You can only feature 3 products, please remove some featured products and try again!'
							);

						}else{
							// success adding company as featured
							
							$updated = $process->setProductFeaturedStatus($productInfo[0]['product_id'], 1);
							
							if ($updated){

								$pUrlName   = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($productInfo[0]['product_name'])));

								$result = array(
									'error'    	  => 0,
									'message'  	  => '',
									'product_url_name'=> $pUrlName,
									'product_name'    => ucwords($productInfo[0]['product_name']),
									'product_id'      => encrypt($productInfo[0]['product_id'])
								);
							}else{

								$result = array(
									'error' => 1,
									'message' => 'An error occured while setting the product as featured!'
								);
							
							}
						}

					}

				}else{
					$result = array(
						'error' => 1,
						'message' => 'Product was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please choose a product'
				);

			}
			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'addFeaturedService'){

			$result = [];

			if (isset($_POST['serId'])){

				$sId = decrypt($_POST['serId']);
				$serviceInfo = $process->getServices($sId);

				if (!empty($serviceInfo)){
					
					if($serviceInfo[0]['is_featured'] == 1){

						$result = array(
							'error' => 1,
							'message' => 'Service is currently featured!'
						);
					}else{

						$featuredCount = count($process->getServices(null, null, 1));
						if($featuredCount >= 4){
							
							$result = array(
								'error' => 1,
								'message' => 'You can only feature 4 services, please remove a featured service and try again!'
							);

						}else{
							// success adding company as featured
							
							$updated = $process->setServiceFeaturedStatus($serviceInfo[0]['id'], 1);
							
							if ($updated){

								$result = array(
									'error'    	  => 0,
									'message'  	  => '',
								);
							}else{

								$result = array(
									'error' => 1,
									'message' => 'An error occured while setting the service featured status!'
								);
							
							}
						}

					}

				}else{
					$result = array(
						'error' => 1,
						'message' => 'Service was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Service was not found!'
				);

			}
			echo json_encode($result);			


                }else if($_POST['ajaxRequest'] == 'addFeaturedSector'){

			$result = [];

			if (isset($_POST['sId'])){

				$sId = decrypt($_POST['sId']);
				$sectorInfo = $process->getSectors($sId);

				if (!empty($sectorInfo)){
					
					if($sectorInfo[0]['is_featured'] == 1){

						$result = array(
							'error' => 1,
							'message' => 'Sector is currently featured!'
						);
					}else{

						$featuredCount = count($process->getSectors(null, 1, 1));
						if($featuredCount >= MAX_FEATURED_SECTORS){
							
							$result = array(
								'error' => 1,
								'message' => 'You can only feature '.MAX_FEATURED_SECTORS.' sectors, please remove some featured sectors and try again!'
							);

						}else{
							// success adding company as featured
							
							$updated = $process->setSectorFeaturedStatus($sectorInfo[0]['id'], 1);
							
							if ($updated){
								$cUrlName   = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($sectorInfo[0]['name'])));

								$result = array(
									'error'    	  => 0,
									'message'  	  => '',
									'sector_url_name'=> $cUrlName,
									'sector_name'    => ucwords($sectorInfo[0]['name']),
									'sector_id'      => encrypt($sectorInfo[0]['id'])
								);
							}else{

								$result = array(
									'error' => 1,
									'message' => 'An error occured while setting the sector as featured!'
								);
							
							}
						}

					}

				}else{
					$result = array(
						'error' => 1,
						'message' => 'Sector was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Sector was not found!'
				);

			}
			echo json_encode($result);			


                }else if($_POST['ajaxRequest'] == 'addFeaturedCompany'){

			$result = [];

			if (isset($_POST['cId'])){

				$cId = decrypt($_POST['cId'] ?? 0);//decrypt($_POST['cId']) ?? 0;
				$company = $process->get_company_list(null, $cId, 1, null);

				if (!empty($company)){
					
					if($company[0]['is_featured'] == 1){

						$result = array(
							'error' => 1,
							'message' => 'Company is currently featured!'
						);
					}else{

						$featuredCount = count($process->getFeaturedCompanies());
						if($featuredCount > 9){
							
							$result = array(
								'error' => 1,
								'message' => 'You can only feature 10 companies, please remove some featured companies and try again!'
							);

						}else{
							// success adding company as featured
							
							$updated = $process->setCompanyFeaturedStatus($company[0]['company_id'], 1);
							
							if ($updated){
								$cUrlName   = preg_replace('![^a-z0-9]+!i', '-', strtolower(trim($company[0]['company_name'])));

								$result = array(
									'error'    	  => 0,
									'message'  	  => '',
									'company_url_name'=> $cUrlName,
									'company_name'    => ucwords($company[0]['company_name']),
									'company_id'      => encrypt($company[0]['company_id']),
									'mibStatus'  	  => 0
								);
							}else{

								$result = array(
									'error' => 1,
									'message' => 'An error occured while setting the company as featured!'
								);
							
							}
						}

					}

				}else{
					$result = array(
						'error' => 1,
						'message' => 'Company was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Company was not found!'
				);

			}

			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'removeFeaturedCompany'){

			$cId = decrypt($_POST['cId']) ?? 0;
			$company = $process->get_company_list(null, $cId, 1);
			$result = [];
	
			if (!empty($company)){
				
				if($company[0]['is_featured'] == 0){

					$result = array(
						'error' => 1,
						'message' => 'Company is currently not featured!'
					);


				}else{
					// success adding company as featured
					$updated = $process->setCompanyFeaturedStatus($company[0]['company_id'], 0);
					
					if ($updated){
						$result = array(
							'error'    	  => 0,
							'message'  	  => 'success',
							'mibStatus'  	  => 0
						);
					}else{
						$result = array(
							'error' => 1,
							'message' => 'An error occured while setting the company as featured!'
						);
					}

				}

			}else{

				$result = array(
					'error' => 1,
					'message' => 'Company was not found!'
				);
			}	

			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'removeFeaturedProduct'){

			$result = [];

			if ( isset($_POST['pId']) ){

				$pId     = decrypt($_POST['pId']);
				$product = $process->get_products(null, null, $pId);

				if (!empty($product)){
					
					if($product[0]['is_featured'] == 0){

						$result = array(
							'error' => 1,
							'message' => 'Product is currently not featured!'
						);


					}else{
						// success adding company as featured
						$updated = $process->setProductFeaturedStatus($product[0]['product_id'], 0);
						
						if ($updated){
							$result = array(
								'error'    	  => 0,
								'message'  	  => 'success'
							);
						}else{
							$result = array(
								'error' => 1,
								'message' => 'An error occured while changing the featured status!'
							);
						}

					}

				}else{

					$result = array(
						'error' => 1,
						'message' => 'Product was not found!'
					);
				}	

				//$result['sId'] = decrypt($_POST['pId']);

			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a sector!'
				);
			}

			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'removeFeaturedService'){

			$result = [];

			if ( isset($_POST['serId']) ){

				$sId    = decrypt($_POST['serId'] ?? 0);
				$service = $process->getServices($sId);

				if (!empty($service)){
					
					if($service[0]['is_featured'] == 0){

						$result = array(
							'error' => 1,
							'message' => 'Service is currently not featured!'
						);


					}else{
						// success adding company as featured
						$updated = $process->setServiceFeaturedStatus($service[0]['id'], 0);
						
						if ($updated){
							$result = array(
								'error'    	  => 0,
								'message'  	  => 'success'
							);
						}else{
							$result = array(
								'error' => 1,
								'message' => 'An error occured while changing the featured status!'
							);
						}

					}

				}else{

					$result = array(
						'error' => 1,
						'message' => 'Service was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a service!'
				);
			}

			echo json_encode($result);			



                }else if($_POST['ajaxRequest'] == 'removeFeaturedSector'){

			$result = [];

			if ( isset($_POST['sId']) ){

				$sId    = decrypt($_POST['sId'] ?? 0);
				$sector = $process->getSectors($sId);

				if (!empty($sector)){
					
					if($sector[0]['is_featured'] == 0){

						$result = array(
							'error' => 1,
							'message' => 'Sector is currently not featured!'
						);


					}else{
						// success adding company as featured
						$updated = $process->setSectorFeaturedStatus($sector[0]['id'], 0);
						
						if ($updated){
							$result = array(
								'error'    	  => 0,
								'message'  	  => 'success'
							);
						}else{
							$result = array(
								'error' => 1,
								'message' => 'An error occured while changing the featured status!'
							);
						}

					}

				}else{

					$result = array(
						'error' => 1,
						'message' => 'Sector was not found!'
					);
				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a sector!'
				);
			}

			echo json_encode($result);			



                }else if($_POST['ajaxRequest'] == 'getAvailableExportMarkets' && isset($_POST['cId'])){

		    $cId = decrypt( $_POST['cId'] ?? 0 );
		    $exportMarkets = $process->getExportMarkets();
		    $exportMarketList = $process->getExportMarketList($cId);
		    $data['availableExportMarkets'] = [];

			if (!empty($exportMarkets)){

				foreach ($exportMarkets as $key => $market){

					if (!empty($exportMarketList)){

						$marketListIds = array_column($exportMarketList, 'export_market_id');

						if (!in_array($market['id'], $marketListIds)){

							$market['id'] = encrypt($market['id']);
							$data['availableExportMarkets'][] = $market;

						}

					}else{

							$market['id'] = encrypt($market['id']);
							$data['availableExportMarkets'][] = $market;

					}
				}
			}

		    echo json_encode($data['availableExportMarkets']);


                }else if ($_POST['ajaxRequest'] == 'addToExportMarketList' && isset($_POST['cId'])){
			
		    $data['error'] = 0;
		    $emId = decrypt($_POST['emId']) ?? 0;
		    $selectedExpMarket = $process->getExportMarkets($emId);

		    if (!empty($selectedExpMarket)){
				
			    $cId = decrypt($_POST['cId'] ?? 0);
			    $emlId = $process->addToExportMarketList($emId, $cId);

			    if ($emlId){

				$emCount  = count($process->getExportMarkets() ?? 0);
				$emlCount = count($process->getExportMarketList($cId) ?? 0);
				
				$data['emSelected'] = '

				    <div class="col-12 mb-3">
					<div class="input-group">
					  <input type="text" class="form-control" value="'.$selectedExpMarket[0]['name'].'" readonly/>
					  <div class="input-group-append">
						<button class="remove-export-market btn btn-danger" value="'.encrypt($emlId).'"><i class="fa fa-minus"></i></button>
					  </div>
					</div>
				    </div>

				';
				$data['displayBtn'] = 1;

				if ($emlCount >= $emCount){
				
					$data['displayBtn'] = 0;

				}

				$data['message'] = 'Export Market has been saved';


			    }else{
				$data['error'] = 1;
				$data['message'] = 'Sorry, unable to add the Export Market';
			    }

	            }else{

			$data['error'] = 1;
			$data['message'] = 'The export market selected is not valid!';

		    }

		    echo json_encode($data);

                }else if ($_POST['ajaxRequest'] == 'removeExportMarket'){
    
                    $result = $process->removeExportMarketFromList($_POST);
                    $data['message'] = '';
		    $data['error'] = 0;

                    if (!$result){
			$data['error'] = 1;
                        $data['message'] = 'Sorry, unable to remove the Export Market';
                    }else{
                        $data['message'] = 'Export Market has been removed';
                    }

                    echo json_encode($data);

                }else if ($_POST['ajaxRequest'] == 'uploadProductImg'){
                    
		    $result = [];
		    $result['message'] = '';

	            $cId  	    = 0;
		    $imgCount 	    = 0;
		    $fileError      = 0;
		    $uploadError    = 0;
		    $fileSizeError  = 0;
		    $dimensionError = 0;
		    $imgTypeError   = 0;
		    $insertImgError = 0;

		    //image sizes
		    $minWidthSize  = 500;
		    $maxWidthSize  = 1080;
		    $minHeightSize = 500;
		    $maxHeightSize = 900;

		    $pId = decrypt($_POST['productId']);

                    $result['error'] = '<br>No image uploaded';

	            $productInfo = $process->get_products(null, null, $pId);

	            if (empty($productInfo)){

			    $result['error'] = '<br>Product not found!';

                    }else{ 
			
			if(!empty($_FILES)){

				$result['error'] = [];
				//number of uploaded images
				$fileCount = is_array($_FILES['files']['name'])? count($_FILES['files']['name']) : 1;
	
				if ($fileCount <= 0 ){
					$result['error'] = '
						<br>No image detected!
					';

				}else{
					//looping through images
					for($i = 0; $i < $fileCount; $i++){
						
						//only 5 images are required for a product	
						if ($fileCount < 5){

							if ($_FILES['files']['error'][$i] == 0){
					
								//checking file size making sure its not 0 or greater than 2MB
							    if (($_FILES['files']['size'][$i]/1000000) > 0 && ($_FILES['files']['size'][$i]/1000000) <= 2){ // less than 2 MB
					
								    $imgSize = getimagesize($_FILES['files']['tmp_name'][$i]);

								    //imgSize[0] contains the width and imgSize[1] contains the height of the image
								    if ( ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){
									    //valid width and height

									    $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime-type extension
									    $mime = finfo_file($finfo, $_FILES['files']['tmp_name'][$i]);
									    finfo_close($finfo);

									    $type = explode('/', $mime);
									    $imgType = strtolower($type[1]);
									    $validImgTypes = array("jpg", "png", "jpeg");

									    if (in_array($imgType, $validImgTypes)){

										$file = pathinfo($_FILES['files']['name'][$i]);

										$result = uploadImage(
											$_FILES['files']['name'][$i],		//filename 
											$_FILES['files']['tmp_name'][$i], 	//tmpname of uploaded file	
											'uploads/products/',			//upload Location
											60					//image quality
										);


										if ($result['error'] == 0){

											//inserting image 
											$addedImg = $process->addProductImage(
												$pId,
												$result['file_path'],
												$result['file_name'],
												$_FILES['files']['size'][$i],
												$imgType
											);
											
 											if(!$addedImg){
												$insertImgError++;
											}

										}else{
											//upload error encountered
											$uploadError++;
										}
											

									    }else{
			
										$imgTypeError++;
									    }

								    }else{

									$dimensionError++;

								    }
								
							    }else{

								$fileSizeError++;

							    }
				
							}else{

								$fileError++;

							}

						}
					}
				}
			

				$errorTotal = ($fileError + $fileSizeError + $dimensionError + $imgTypeError + $uploadError + $insertImgError);
				if ($errorTotal == $fileCount ){

					$result['error'] = '
						<br><strong>Some errors occured!</strong><br> Image upload failed, no images saved. Product will not be displayed publicly without images. Please esure there is atleast one (1) image saved
					';


				}else if ($errorTotal > 0){
					
					$result['error'] = '
						<br><strong>Some errors occured!</strong><br> Some Images were not uplaoded<br>
					';
		

				}else{

					$result['error'] = '';

				}
				

				//getting error messages 
				if ($fileError > 0){
					
					$result['error'] .= '
					<br><strong>Upload Error!</strong><br> '.$fileError.' image upload error encountered, please try adding the images again
					';
		

				}

				if ($fileSizeError > 0){
					
					$word = ($fileSizeError > 1)? 'were' : 'was';
					$result['error'] .= '
					<br><strong>Image to large!</strong><br> '.$fileSizeError.' product image(s) '.$word.' not uploaded. Exceeds image max size of (2MB), please try uploading a smaller image size
					';
		

				}

				if ($dimensionError > 0){
					
					$result['error'] .= '
						<br><strong>Image Dimension not acceptable!</strong><br> '.$dimensionError.' image(s) did not met the following dimension requirements,<br><strong>Width: '.$minWidthSize.'- '.$maxWidthSize.'px and height: '.$minHeightSize.' - '.$maxHeightSize.'px</strong>
					';
		

				}

				if ($imgTypeError > 0){

					$result['error'] .= '
					<br><strong>Image type not accepted!</strong><br> '.$imgTypeError.' image(s) did not meet the following image extension type, PNG, JPEG or JPG
					';

				}

				if ($uploadError > 0 || $insertImgError > 0){

					$count = $uploadError + $insertImgError;
					$word = ($count > 1)? 'were' : 'was';
					$result['error'] .= '
					<br><strong>Failed to Add Image!</strong><br>Sorry, an error occured and  '.$count.' image(s) '.$word.' not saved
					';
				}
			 }
		    }

		    echo json_encode($result);


		}else{

			echo json_encode([
				'error' => 1,
				'message' => 'Request not found!'
			]);
		}

            }else if($_SESSION['USERDATA']['user_type'] == 'company'){
                // ALL AJAX REQUESTS AVAILABLE FOR COMPANY ACCOUNT 

                if($_POST['ajaxRequest'] == 'saveMyProfile'){
                    if($process->updateUserProfile($_POST)){
                        $message = 'Changes have been saved!';
                    }else{
                        $message = 'Sorry, changes were not saved, try again later.';
                    }
                    echo $message;

                }else if($_POST['ajaxRequest'] == 'saveCompanyProfile'){
    
                    $_POST['companyDetail']['logoImagePath'] = $_POST['logoPath'];
                    $message = '';
		    $minWidthSize  = 300;
		    $maxWidthSize  = 700;
		    $minHeightSize = 300;
		    $maxHeightSize = 600;
                    
                    if (isset($_FILES) && $_FILES['businessLogo']['name'] != '' && getimagesize($_FILES['businessLogo']['tmp_name'])){
                        
                        //uploading image if it exist 
                        $target_dir = "./uploads/companyLogos/";
                        $target_file = $target_dir . basename($_FILES["businessLogo"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        
		        if ($_FILES['files']['error'] == 0 && ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){
			
                            $message .= "Image dimension must be within the range of, Width: ".$minWidthSize." - ".$maxWidthSize." px and Height: ".$minHeightSize." - ".$maxHeightSize." px\n";
                            $uploadOk = 0;

			}
                        // Check file size
                        if ($_FILES["businessLogo"]["size"] > 2000000) {
                            $message .= "Your profile pic is too large, file must be less than 2MB.\n";
                            $uploadOk = 0;
                        }
        
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                            $message .= "Only JPG, JPEG and PNG files are allowed.\n";
                            $uploadOk = 0;
                        }
        
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $message .= "Sorry, your profile pic was not uploaded.\n";
		            $message .= "Image Error:\n".$message;
                        } else {
                            // if everything is ok, try to upload file
                            if (compressImage($_FILES["businessLogo"]["tmp_name"], $target_file, 60)) {
                                $message .= "The file ". basename( $_FILES["businessLogo"]["name"]). " has been saved.";
                                $_POST['companyDetail']['logoImagePath'] = $target_file;
                            } else {
                                $message .= "Sorry, there was an error uploading your profile pic.";
                            }
                        }
        
                    }

		    $_POST['companyDetail']['companyId'] = decrypt($_POST['companyDetail']['companyId']);
		    $_POST['companyDetail']['updateBy'] = $_SESSION['USERDATA']['user_id'];
		    $_POST['companyDetail']['updateType'] = 'edit';
		    $_POST['companyDetail']['updateOn'] = date("Y-m-d H:i:s");

                    $result1 = $process->updateCompanyProfile($_POST['companyDetail']);
                    $result2 = $process->setSocialContactList($_POST['socialContacts'], $_SESSION['COMPANYDATA'][0]['company_id']);
        
		    if ($result2['count'] > 0){
			$links = '';
			for ($i = 0; $i < $result2['count']; $i++){
				$links .= $result2['links'][$i]." for ".$result2['for'][$i]." Link\n";
			}
			$word = ($resutl2['count'] > 1)? 'were':'was'; 
			$message .= $result2['count']." invalid link(s) detected and ".$word." not saved.\n\nThe following ".$word." not saved:\n".$links;
		    }	
                    if(!$result1){

                        $message .= 'Sorry, an error occured while updating your company profile.';

                    }else{

                        $_SESSION['COMPANYDATA'] = $process->get_company_list(null, $_SESSION['COMPANYDATA'][0]['company_id']);

                    }
		
    		    $data = [];
		    $data['message'] = '';
		    $data['error'] = 0;

		    if ($message != ''){
			$data['message'] = $message;
			$data['error'] = 1;
		    }
                    echo json_encode($data);

                }else if ($_POST['ajaxRequest'] == 'getAvailableExportMarkets'){

		    $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
		    $exportMarkets = $process->getExportMarkets();
		    $exportMarketList = $process->getExportMarketList($cId);
		    $data['availableExportMarkets'] = [];


			if (!empty($exportMarkets)){


				foreach ($exportMarkets as $key => $market){

					if (!empty($exportMarketList)){

						$marketListIds = array_column($exportMarketList, 'export_market_id');

						if (!in_array($market['id'], $marketListIds)){

							$market['id'] = encrypt($market['id']);
							$data['availableExportMarkets'][] = $market;

						}

					}else{

							$market['id'] = encrypt($market['id']);
							$data['availableExportMarkets'][] = $market;

					}
				}
			}

		    echo json_encode($data['availableExportMarkets']);

                }else if ($_POST['ajaxRequest'] == 'addToExportMarketList'){
			
		    $data['error'] = 0;
		    $emId = decrypt($_POST['emId']) ?? 0;
		    $selectedExpMarket = $process->getExportMarkets($emId);

		    if (!empty($selectedExpMarket)){
				
			    $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;

			    $emlId = $process->addToExportMarketList($emId, $cId);

			    if ($emlId){

				$emCount  = count($process->getExportMarkets() ?? 0);
				$emlCount = count($process->getExportMarketList($cId) ?? 0);
				
				$data['emSelected'] = '

				    <div class="col-12 mb-3">
					<div class="input-group">
					  <input type="text" class="form-control" value="'.$selectedExpMarket[0]['name'].'" readonly/>
					  <div class="input-group-append">
						<button class="remove-export-market btn btn-danger" value="'.encrypt($emlId).'"><i class="fa fa-minus"></i></button>
					  </div>
					</div>
				    </div>

				';
				$data['displayBtn'] = 1;

				if ($emlCount >= $emCount){
				
					$data['displayBtn'] = 0;

				}

				$data['message'] = 'Export Market has been saved';


			    }else{
				$data['error'] = 1;
				$data['message'] = 'Sorry, unable to add the Export Market';
			    }

	            }else{

			$data['error'] = 1;
			$data['message'] = 'The export market selected is not valid!';

		    }

		    echo json_encode($data);
			
                }else if ($_POST['ajaxRequest'] == 'removeExportMarket'){
    
                    $result = $process->removeExportMarketFromList($_POST);
                    $data['message'] = '';
		    $data['error'] = 0;

                    if (!$result){
			$data['error'] = 1;
                        $data['message'] = 'Sorry, unable to remove the Export Market';
                    }else{
                        $data['message'] = 'Export Market has been removed';
                    }

                    echo json_encode($data);

                }else if ($_POST['ajaxRequest'] == 'removeProductImg'){
    
                    $result = [];
    
                    //updates image sets status to 0 - Deleted
                    $key = $process->changeProductImageStatus(decrypt($_POST['productId']), decrypt($_POST['key']), 0);//removing product img
    
                    if ($key == false) {

                        $result['error'] = 'Oh snap! We could not remove the image now. Please try again later.';

                    }else{
			$result['key'] = encrypt($key);
		    }
		    
                    echo json_encode($result);
    
                }else if ($_POST['ajaxRequest'] == 'uploadProductImg'){
                    
		    $result = [];
		    $result['message'] = '';

	            $cId  	    = 0;
		    $imgCount 	    = 0;
		    $fileError      = 0;
		    $uploadError    = 0;
		    $fileSizeError  = 0;
		    $dimensionError = 0;
		    $imgTypeError   = 0;
		    $insertImgError = 0;

		    //image sizes
		    $minWidthSize  = 500;
		    $maxWidthSize  = 1080;
		    $minHeightSize = 500;
		    $maxHeightSize = 900;

		    $pId = decrypt($_POST['productId']);
	            $cId = $_SESSION['COMPANYDATA'][0]['company_id'] ?? 0;
		    // getting companyId

                    $result['error'] = '<br>No image uploaded';

	            $productInfo = $process->get_products(null, null, $pId);

	            if (empty($productInfo)){

			    $result['error'] = '<br>Product not found!';

		    }else if ($productInfo[0]['company_id'] != $cId){

			    $result['error'] = '<br>You cannot add images for the selected product!';
	
                    }else{ 
			
			if(!empty($_FILES)){

				$result['error'] = [];
				//number of uploaded images
				$fileCount = is_array($_FILES['files']['name'])? count($_FILES['files']['name']) : 1;
	
				if ($fileCount <= 0 ){
					$result['error'] = '
						<br>No image detected!
					';

				}else{
					//looping through images
					for($i = 0; $i < $fileCount; $i++){
						
						//only 5 images are required for a product	
						if ($fileCount < 5){

							if ($_FILES['files']['error'][$i] == 0){
					
								//checking file size making sure its not 0 or greater than 2MB
							    if (($_FILES['files']['size'][$i]/1000000) > 0 && ($_FILES['files']['size'][$i]/1000000) <= 2){ // less than 2 MB
					
								    $imgSize = getimagesize($_FILES['files']['tmp_name'][$i]);

								    //imgSize[0] contains the width and imgSize[1] contains the height of the image
								    if ( ($imgSize[0] >= $minWidthSize && $imgSize[0] <= $maxWidthSize) && ($imgSize[1] >= $minHeightSize && $imgSize[1] <= $maxHeightSize)){
									    //valid width and height

									    $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime-type extension
									    $mime = finfo_file($finfo, $_FILES['files']['tmp_name'][$i]);
									    finfo_close($finfo);

									    $type = explode('/', $mime);
									    $imgType = strtolower($type[1]);
									    $validImgTypes = array("jpg", "png", "jpeg");

									    if (in_array($imgType, $validImgTypes)){

										$file = pathinfo($_FILES['files']['name'][$i]);

										$result = uploadImage(
											$_FILES['files']['name'][$i],		//filename 
											$_FILES['files']['tmp_name'][$i], 	//tmpname of uploaded file	
											'uploads/products/',			//upload Location
											60					//image quality
										);


										if ($result['error'] == 0){

											//inserting image 
											$addedImg = $process->addProductImage(
												$pId,
												$result['file_path'],
												$result['file_name'],
												$_FILES['files']['size'][$i],
												$imgType
											);
											
 											if(!$addedImg){
												$insertImgError++;
											}

										}else{
											//upload error encountered
											$uploadError++;
										}
											

									    }else{
			
										$imgTypeError++;
									    }

								    }else{

									$dimensionError++;

								    }
								
							    }else{

								$fileSizeError++;

							    }
				
							}else{

								$fileError++;

							}

						}
					}
				}
			
				$errorTotal = ($fileError + $fileSizeError + $dimensionError + $imgTypeError + $uploadError + $insertImgError);
				if ($errorTotal == $fileCount ){

					$result['error'] = '
						<br><strong>Some errors occured!</strong><br> Image upload failed, no images saved. Product will not be displayed publicly without images. Please esure there is atleast one (1) image saved
					';


				}else if ($errorTotal > 0){
					
					$result['error'] = '
						<br><strong>Some errors occured!</strong><br> Some Images were not uplaoded<br>
					';
		

				}else{

					$result['error'] = '';

				}
				

				//getting error messages 
				if ($fileError > 0){
					
					$result['error'] .= '
					<br><strong>Upload Error!</strong><br> '.$fileError.' image upload error encountered, please try adding the images again
					';
		

				}

				if ($fileSizeError > 0){
					
					$word = ($fileSizeError > 1)? 'were' : 'was';
					$result['error'] .= '
					<br><strong>Image to large!</strong><br> '.$fileSizeError.' product image(s) '.$word.' not uploaded. Exceeds image max size of (2MB), please try uploading a smaller image size
					';
		

				}

				if ($dimensionError > 0){
					
					$result['error'] .= '
						<br><strong>Image Dimension not acceptable!</strong><br> '.$dimensionError.' image(s) did not met the following dimension requirements,<br><strong>Width: '.$minWidthSize.'- '.$maxWidthSize.'px and height: '.$minHeightSize.' - '.$maxHeightSize.'px</strong>
					';
		

				}

				if ($imgTypeError > 0){

					$result['error'] .= '
					<br><strong>Image type not accepted!</strong><br> '.$imgTypeError.' image(s) did not meet the following image extension type, PNG, JPEG or JPG
					';

				}

				if ($uploadError > 0 || $insertImgError > 0){

					$count = $uploadError + $insertImgError;
					$word = ($count > 1)? 'were' : 'was';
					$result['error'] .= '
					<br><strong>Failed to Add Image!</strong><br>Sorry, an error occured and  '.$count.' image(s) '.$word.' not saved
					';
				}
			 }
		    }

		    echo json_encode($result);


                }else{
                    // request not found
                    echo json_encode(array('message' => 'Request not found', 'error' => 1));
                }

            }else if($user_type == 'buyer'){
                // ALL AJAX REQUESTS AVAILABLE FOR BUYER ACCOUNT 

                if($_POST['ajaxRequest'] == 'setCompanyBookmark'){

			$result = [];

			if (isset($_POST['cId'])){

				$cId = decrypt($_POST['cId']);
				$company = $process->get_company_list(null, $cId);
				$bookmark = $process->getBuyerCompanyBookmark(null, $user_id, $cId);//getting buyer bookmark

				if (empty($company)){
					//company not found
					$result = array(
						'error' => 1,
						'message' => 'Company does not exist!',
						'status' => 0
					);

				
				}else if (empty($bookmark)){
					//bookmark doesnt exist add new one	
					$added = $process->addBuyerCompanyBookmark($user_id, $cId);
					
					if ($added){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 1
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while bookmarking the selected company!',
							'status'  => 0
						);
					
					}
				}else{
				     //removing buyer company bookmark
					$deleted = $process->deleteBuyerCompanyBookmark($user_id, $cId);
					
					if ($deleted){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 0
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while un-bookmarking the selected company!',
							'status'  => 1
						);
					
					}

				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a valid company to bookmark!'
				);

			}

			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'setInterestedMusic'){

			$result = [];

			if (isset($_POST['mId'])){

				$id = decrypt($_POST['mId']);
				$music = $process->getMusics($id);
				$interest = $process->getBuyerMusicInterest(null, $user_id, $id);//getting buyer music interest

				if (empty($music)){
					//company not found
					$result = array(
						'error' => 1,
						'message' => 'Music does not exist!',
						'status' => 0
					);

				
				}else if (empty($interest)){
					//bookmark doesnt exist add new one	
					$added = $process->addBuyerMusicInterest($user_id, $id);
					
					if ($added){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 1
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while adding interest!',
							'status'  => 0
						);
					
					}
				}else{
				     //removing buyer company bookmark
					$deleted = $process->deleteBuyerMusicInterest($user_id, $id);
					
					if ($deleted){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 0
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while removing interest!',
							'status'  => 1
						);
					
					}

				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a valid music!'
				);

			}

			echo json_encode($result);			


                }else if($_POST['ajaxRequest'] == 'setInterestedProduct'){

			$result = [];

			if (isset($_POST['pId'])){

				$id = decrypt($_POST['pId']);
				$product = $process->get_products(null, null, $id);
				$interest = $process->getBuyerProductInterest(null, $user_id, $id);//getting buyer product interest

				if (empty($product)){
					//company not found
					$result = array(
						'error' => 1,
						'message' => 'Product does not exist!',
						'status' => 0
					);

				
				}else if (empty($interest)){
					//bookmark doesnt exist add new one	
					$added = $process->addBuyerProductInterest($user_id, $id);
					
					if ($added){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 1
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while adding interest!',
							'status'  => 0
						);
					
					}
				}else{
				     //removing buyer company bookmark
					$deleted = $process->deleteBuyerProductInterest($user_id, $id);
					
					if ($deleted){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 0
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while removing interest!',
							'status'  => 1
						);
					
					}

				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a valid product!'
				);

			}

			echo json_encode($result);			

                }else if($_POST['ajaxRequest'] == 'setInterestedService'){

			$result = [];

			if (isset($_POST['sId'])){

				$id = decrypt($_POST['sId']);
				$service = $process->getServices($id);
				$interest = $process->getBuyerServiceInterest(null, $user_id, $id);//getting buyer product interest

				if (empty($service)){
					//company not found
					$result = array(
						'error' => 1,
						'message' => 'Service does not exist!',
						'status' => 0
					);

				
				}else if (empty($interest)){
					//bookmark doesnt exist add new one	
					$added = $process->addBuyerServiceInterest($user_id, $id);
					
					if ($added){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 1
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while adding interest!',
							'status'  => 0
						);
					
					}
				}else{
				     //removing buyer company bookmark
					$deleted = $process->deleteBuyerServiceInterest($user_id, $id);
					
					if ($deleted){

						$result = array(
							'error'      => 0,
							'message'    => 'success',
							'status'     => 0
						);
					}else{

						$result = array(
							'error'   => 1,
							'message' => 'An error occured while removing interest!',
							'status'  => 1
						);
					
					}

				}	


			}else{

				$result = array(
					'error' => 1,
					'message' => 'Please select a valid service!'
				);

			}

			echo json_encode($result);			




                }else{
                    echo json_encode(array('message' => 'Request not found', 'error' => 1));
                }

            }else{
                    echo json_encode(array('message' => 'Request not found', 'error' => 1));
            }
        }else{

            //HANDLES AJAX REQUEST FOR GUEST USERS
            if($_POST['ajaxRequest']){

            }else{
                    echo json_encode(array('message' => 'Request not found', 'error' => 1));
            }
        }

    }else{
	
	if (!empty($_SESSION['USERDATA'])){

		switch ( $user_type ){

			case 'su':

				//getting company account requests
				$data['accountRequests'] = $process->get_company_list(null, null, 3, null);

				//getting info on components
				$data['exportMarkets']   = $process->getExportMarkets();
				$data['sectors']    	 = $process->getSectors();
				$data['serviceCat']    	 = $process->getServiceCategory();
				$data['subServiceCat']   = $process->getSubServiceCategory();

				//getting users
				$data['buyers']     	 = $process->get_buyer_list();
				$data['admins']     	 = $process->getUsers(null, 'admin');
				$data['superUsers']    	 = $process->getUsers(null, 'su');
				$data['companys']   	 = $process->get_company_list(null, null, 1);

				//getting items provided by companies
				$data['products']   	 = $process->get_products();
				$data['musics']   	 = $process->getMusics();
				$data['services']   	 = $process->getServices();

				$pageContent = $view->superUserDashboard($data);

				break;

			case 'admin':

				$data['accountRequests'] = $process->get_company_list(null, null, 3, null);
				$data['exportMarkets']   = $process->getExportMarkets();
				$data['sectors']    	 = $process->getSectors();
				$data['buyers']     	 = $process->get_buyer_list();
				$data['companys']   	 = $process->get_company_list(null, null, 1);
				$data['products']   	 = $process->get_products();
				$data['musics']   	 = $process->getMusics();
				$data['services']   	 = $process->getServices();

				$pageContent = $view->adminDashboard($data);

				break;

			case 'company':

				$data['socialContactList'] = $process->getSocialContactList($_SESSION['COMPANYDATA'][0]['company_id']);
				$data['exportMarketList'] = $process->getExportMarketList($_SESSION['COMPANYDATA'][0]['company_id']);
				$data['companyInfo']   = $process->get_company_list(null, $_SESSION['COMPANYDATA'][0]['company_id']);
				$data['pointOfContact']   = $process->getPointOfContact($_SESSION['COMPANYDATA'][0]['company_id']);

				if ($user_company_type_id == 1){
					// music profile
					$data['musics']      = $process->getMusics(null, $user_company_id);

				}else if ($user_company_type_id == 2){
					//product profile
					$data['products']      = $process->getCompanyProducts($user_company_id);

				}else{
					//service profile
					$data['services']   	 = $process->getServices(null, $user_company_id);

				}

				$pageContent = $view->companyDashboard($data);
				break;
			
			case 'buyer':

				//getting application general information
				$data['sectors']    = $process->getSectors();
				$data['buyerCount'] = count($process->get_buyer_list());
				$data['companys']   = $process->get_company_list();
				$data['products']   = $process->get_products();
				$data['services']   = $process->getServices(null, null, 1);
				$data['musics']     = $process->getMusics();

				//getting buyer interest
				$data['interests'] = $process->getInterestedSector(null, $user_id);
				$data['prod_interests'] = $process->getBuyerProductInterest(null, $user_id);
				$data['service_interests'] = $process->getBuyerServiceInterest(null, $user_id);
				$data['music_interests'] = $process->getBuyerMusicInterest(null, $user_id);

				//getting buyer company bookmarks
				$data['cBookmarks'] = $process->getBuyerCompanyBookmark(null, $user_id);

				$pageContent = $view->buyerDashboard($data);
				break;

			default:

				$pageContent = $view->pageNotFound();
				break;
		}

	}else{

		//no request passed 
		$result['sectors']    = $process->getSectors();
		$result['buyerCount'] = count($process->get_buyer_list());
		$result['companys']   = $process->get_company_list();
		$result['products'] = $process->get_products();
		$result['services'] = $process->getServices(null, null, 1);

		$pageContent = $view->home($result);

	}

    }

    if ( !$ajaxRequest ){
	
        echo $view->header();
        echo $view->topBar();
        echo $pageContent;
        echo $view->footer();

    }

?>
