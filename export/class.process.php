<?php 
// The process class handles all transactions to the database
// The functions that start with get, feth rows from the database,
// while those that start with set, perform an Update or an Insert depending on the values passed to it.

/*
	Note: The status column in various tables follow the according numbering 
	
	0 - Removed / Deleted
	1 - Approved / Completed
	2 - Pending Activation
	3 - Pending Approval
	4 - Rejected

*/
require_once('./class.ilog.php');

class Process{

    const MAX_INDUSTRY_SERVICED_CHAR = 400;
    const MAX_COMPANY_DESC_CHAR = 350;
    const MAX_PRODUCT_DESC_CHAR = 350;
    const MAX_SERVICE_DESC_CHAR = 350;
    const MAX_MUSIC_DESC_CHAR = 350;

    private $conn;
    private $status;
    private $log;
    private $pepper = '3xp0rtBe71z3';

    function __construct(){

        $this->status = true;

        try {
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->log = new iLog();
          
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $this->status = false;
            die();

        }
    }
    // Validates login
    public function validateLogin ($data = null){

        $email = $this->sanitize($data['email']) ?? '';
        $pass = $data['password'] ?? '';

        $result = $this->getUserSalt($email);

        if ($result != false ){
            
            $pass = md5($pass.$result['salt'].$this->pepper);
            
            //salt was returned
            $sql = 'SELECT id AS user_id, full_name, email, user_type FROM users u WHERE u.email = ? AND u.password = ? and status = 1';
            $query = $this->conn->prepare($sql);
            $query->execute([$email, $pass]);

            if ($query->rowCount() > 0 ){
                return $query->fetch();
            }
            $this->log->info('User: '.$email.' Failed login attempt');
        }
        return false;

    }
    //registers a buyer account returning its user id and activation code
    public function register_buyer_account($pFname, $pLname, $pEmail, $pCompanyName, $pPassword){
	
	//sanitizing inputs
        $firstName = $this->sanitize($pFname);
        $lastName = $this->sanitize($pLname);
        $email = $this->sanitize($pEmail);
        $companyName = $this->sanitize($pCompanyName);

        $salt = md5(time().bin2hex(random_bytes(7)));
	
        $query = $this->conn->prepare('call register_buyer_account(?,?,?,?,?);');
	
	$fullname = $firstName.' '.$lastName;
	$pass = $pPassword.$salt.$this->pepper;

	$query->bindParam(1, $fullname);
	$query->bindParam(2, $email);
	$query->bindParam(3, $companyName);
	$query->bindParam(4, $pass);
	$query->bindParam(5, $salt);
	
	$query->execute();
	
	return $query->fetch();

    }

    //registers a company account returning its user id and activation code
    public function register_company_account(
			$pEmail, 
			$pCompanyName, 
			$pCtv, 
			$pAddress, 
			$pDistrict,
			$pDescription, 
			$companyType, 
			$tradeArea, 
			$pPassword,
			$pWebLink = null,
			$pEstabYear = null,
			$pPhone = null

	){
	
        $email       = $this->sanitize($pEmail ?? null);
        $companyName = $this->sanitize($pCompanyName ?? null);
        $ctv         = $this->sanitize($pCtv ?? null);
        $address     = $this->sanitize($pAddress ?? null);
        $district    = $this->sanitize($pDistrict ?? null);
        $desc	     = (isset($pDescription)? substr($this->sanitize( trim($pDescription) ), 0, self::MAX_COMPANY_DESC_CHAR) : NULL);

	//additional companyInfo
	$website     = $this->sanitize($pWebLink ?? null);
	$estabYear   = $this->sanitize($pEstabYear ?? null);
	$phone   = $this->sanitize($pPhone ?? null);
	$currentSeatCap = null;
	$expanPotential = null;

        $salt = md5(time().bin2hex(random_bytes(7)));
	
        $query = $this->conn->prepare('call register_company_account(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
	
	$pass = $pPassword.$salt.$this->pepper;

	$query->bindParam(1, $email);
	$query->bindParam(2, $companyName);
	$query->bindParam(3, $ctv);
	$query->bindParam(4, $address);
	$query->bindParam(5, $district);
	$query->bindParam(6, $desc);
	$query->bindParam(7, $companyType);
	$query->bindParam(8, $tradeArea);
	$query->bindParam(9, $pass);
	$query->bindParam(10, $salt);
	$query->bindParam(11, $website);
	$query->bindParam(12, $estabYear);
	$query->bindParam(13, $phone);
	
	$query->execute();
	
	return $query->fetch();

    }
    //sets the registration activity of a user ///////// NOT SURE IF THIS IS STILL BEING USED 
    public function register_user($userId){

	//creating activation code
	$activationCode = md5(uniqid(time(), true).mt_rand());
		
	//entering user register activity
	$query3 = $this->conn->prepare('
		INSERT INTO 
		    registration_activity (
			user_id,
			activation_code, 
			status

		    ) 
		VALUES(?, ?, ?)
	');
	
	$query3->bindParam(1, $userId);
	$query3->bindParam(2, $activationCode);
	$query3->bindParam(3, $status);

	$query3->execute();

	$result = [
		'user_id' => $userId,
		'email' => $email,
		'activation_code' => $activationCode
	];

    }
    //gets the salt of the password for the respective email address provided
    public function getUserSalt($email = null){
        
        $email = $this->sanitize($email);

        $sql = 'SELECT salt FROM users u WHERE u.email = ? ';
        $query = $this->conn->prepare($sql);
        $query->execute([$email]);

        if ($query->rowCount() > 0){
            return $query->fetch();
        }

        $this->log->info('User salt was not found for the email: '.$email);
        return false;


    }
    //get the company list
    // passing status as -1 will return all company accounts 
    public function get_company_list($p_name = null, $p_company_id = null, $p_status = 1, $p_limit = null){
    
	$name = $this->sanitize($p_name);

	//setting user to pending activation
	$query = $this->conn->prepare('
		call get_company_list(?, ?, ?, ?);
	');

	$query->bindParam(1, $name);
	$query->bindParam(2, $p_company_id);
	$query->bindParam(3, $p_status);
	$query->bindParam(4, $p_limit);

	$query->execute();
	
	return $query->fetchAll();


    }
    //get the buyer list
    // passing status as -1 will return all company accounts 
    public function get_buyer_list($p_name = null, $p_user_id = null, $p_status = 1, $p_limit = null){
    
	$name = $this->sanitize($p_name);
	$uId  = $this->sanitize($p_user_id);

	//setting user to pending activation
	$query = $this->conn->prepare('
		call get_buyer_list(?, ?, ?, ?);
	');

	$query->bindParam(1, $name);
	$query->bindParam(2, $uId);
	$query->bindParam(3, $p_status);
	$query->bindParam(4, $p_limit);

	$query->execute();
	
	return $query->fetchAll();


    }
    //returns all featured companies
    public function getFeaturedCompanies(){
	
	$companies = $this->get_company_list(null, null, 1);
	$featuredCompanies = [];

	
	if (!empty($companies)){
		
		foreach ($companies as $key => $company){

			if ($company['is_featured'] == 1){
			
				$featuredCompanies[] = $company;

			}
		}

	}

	return $featuredCompanies;

    }
    //get all users, giving access to getting any users info 
    public function getUsers($uId = null, $uType = null, $status = 1){
        
        $sql = $this->conn->prepare('
		SELECT
			u.id,
			u.full_name,
			u.email,
			u.user_type,
			u.created_by,
			created.full_name as created_by_name,
			DATE_FORMAT(u.created_on, "%d %M %Y") as created_on,
			u.update_by,
			updated.full_name as update_by_name,
			DATE_FORMAT(u.update_on, "%d %M %Y") as update_on,
			u.update_type,
			u.status

		FROM
			users as u
			left join users as created on created.id = u.created_by
			left join users as updated on updated.id = u.update_by

		WHERE
		(
			case
				when :id is null then true
				else u.id = :id
			end
		) AND
		(
			case
				when :type is null then true
				else u.user_type = :type
			end
		) AND
		(
			case
				when :status = null then true
				else u.status = :status
			end
		)


	');
        
        $sql->bindParam(':id', $uId);
        $sql->bindParam(':type', $uType);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('Failed to execute get users');
        return false;
    }
    //gets the company info by comapnyId or by user_id 
    public function getCompanyIdByUserId($userId, $status = 1){

        $sql = 'SELECT id as company_id FROM company WHERE user_id = ? AND status = ?';

        $query = $this->conn->prepare($sql);

	$query->bindParam(1, $userId);
	$query->bindParam(2, $status);

        if ($query->execute()){

            return $query->fetch();
		
	}
        
	$this->log->error('getCompanyIdByUserid failed to execute');
        return false;
    }
    //gets the products for a specifice company
    public function getCompanyProducts($companyId = 0){
        
        $cId = $this->sanitize($companyId);
	$companyProd = [];
	$products = $this->get_products();

	foreach ($products as $key => $product){

		if ($product['company_id'] == $cId){
			
			$companyProd[] = $product;
		
		}

	}

	return $companyProd;
    }
    public function getCompaniesBySector($sId){
        
	$companys = [];

	
	if($sId == 13){

		$services = $this->getServices();
		foreach ($services as $key => $service){

			if ($service['sector_id'] == $sId && !in_array($service['company_id'], $companys)){
				
				$companys[] = $service['company_id'];
			
			}

		}

	}else{

		$products = $this->get_products();
		foreach ($products as $key => $product){

			if ($product['sector_id'] == $sId && !in_array($product['company_id'], $companys)){
				
				$companys[] = $product['company_id'];
			
			}

		}

	}
	return $companys;
    }
    //get all products or a specific product by filter options 
    public function get_products(
	$p_name = null,
 	$p_hs_code = null,
	$p_prod_id = null,
	$p_sector_id = null,
	$p_export_id = null,
	$p_status = 1,
	$p_limit = null
    ){
    
	$name 	   = $this->sanitize($p_name);
	$hsCode    = $this->sanitize($p_hs_code);
	$prodId    = ($p_prod_id == null? null : (is_numeric($p_prod_id)? $p_prod_id : 0));
	$sectorId  = $this->sanitize($p_sector_id);
	$exportId  = $this->sanitize($p_export_id);

	//setting user to pending activation
	$query = $this->conn->prepare('
		call get_products(?, ?, ?, ?, ?, ?, ?);
	');

	$query->bindParam(1, $name);
	$query->bindParam(2, $hsCode);
	$query->bindParam(3, $prodId);
	$query->bindParam(4, $sectorId);
	$query->bindParam(5, $exportId);
	$query->bindParam(6, $p_status);
	$query->bindParam(7, $p_limit);

	$query->execute();
	
	$result['products'] = $query->fetchAll();
	
	//return $result['products'];
        if( !empty($result['products']) ){

		$query->closeCursor();

		foreach ($result['products'] as $key => $val){

			$result['products'][$key]['productImages'] = $this->getProductImages($val['product_id']) ?? [];
		
		}
	
	}

	return $result['products'];

    }
    //gets all the images for a product by Id and status
    //default image status 1 means active image 0 meaning no longer being used - terminated
    public function getProductImages($pId, $status = 1){

		
	$sql = $this->conn->prepare('
	    SELECT 
		id, product_id, file_name, path, size, type 
	    FROM
		product_image
	    WHERE
		product_id = ? and 
		status = 1;   
	');

	$sql->bindParam(1, $pId);

	if($sql->execute()){

	    return $sql->fetchAll();

	}

	$this->log->error('getProductImages() failed to execute.... more info: '.$sql->errorInfo());
	return false;

    }
    //gets the social media links set by a company
    public function getSocialContactList($companyId = null){
        
        $query = $this->conn->prepare('
		SELECT 
			scl.id, scl.company_id, scl.link, scl.social_contact_id, sc.name as social_contact_name, sc.icon
		FROM 
			social_contact_list scl, 
		  social_contacts sc
			
		WHERE 
			scl.social_contact_id = sc.id AND
			company_id = ? AND 
			scl.status = 1 AND 
			sc.status = 1 

	');
	$query->bindParam('1', $companyId);

        if(!$query->execute()){
		$this->log->error('Unable to get social contact list');
		return [];
	}
        
        return $query->fetchAll();
    }
    //gets all the social media that a company can set
    public function getSocialContact($scId = null, $status = 1){
        
        $query = $this->conn->prepare('
		SELECT 
			id,
			name, 
			icon 
		FROM social_contacts 
		WHERE 
			(
				case 
					when :scid is null then true
					else id = :scid
				end
			) and 
			status = :status 
	');
	$query->bindParam(':scid', $scId);
	$query->bindParam(':status', $status);
        
        
        if (!$query->execute()){
		$this->log->error('Unable to get social contacts');
		return false;
        }

	return $query->fetchAll();
    }
    //gets a list of all the export markets pertaining to a company
    public function getExportMarketList($companyId = null){
	
        $query = $this->conn->prepare('
		SELECT eml.id, eml.export_market_id , em.name
                FROM export_market_list as eml, export_market as em 
                WHERE eml.company_id = ? AND eml.export_market_id = em.id AND eml.status = 1 and em.status = 1;
	');

        $query->bindParam('1', $companyId);

        if (!$query->execute()){
		$this->log->error('Unable to get export marketlist');
		return [];
	}
	return $query->fetchAll();

    }
    // Gets all export markets
    public function getExportMarkets($emId = null, $pMarketName = null){

        $eMarketName = $this->sanitize($pMarketName);
        
        $sql = '
		SELECT
			id,
			name,
			created_by,
			DATE_FORMAT(created_on, "%M %d %Y") as created_on,
			(select uCreated.full_name from users as uCreated where uCreated.id = em.created_by) as created_by_name,
			DATE_FORMAT(removed_on, "%M %d %Y") as removed_on,
			(select uRemoved.full_name from users as uRemoved where uRemoved.id = em.removed_by) as removed_by_name,
			COALESCE(count.company_amount, 0) as company_count,
			COALESCE(count.product_amount, 0) as product_count
			
		FROM export_market em

		left join (
				SELECT 
					eml.export_market_id,
					count(distinct eml.company_id) as company_amount,
					count(distinct prod.id) as product_amount
				FROM 
					export_market_list as eml
				
				left join products prod on prod.company_id = eml.company_id
				
				WHERE
					eml.status = 1
					
				GROUP BY 1
			  
			) AS count on count.export_market_id = em.id

		WHERE 
		  status = 1 and 
		  (
			case 
				when :id is null then true
				else id = :id
			end 
		  ) and 
		  (
			case 
				when :name is null then true
				else name LIKE concat("%", :name, "%")
			end

		  )

		ORDER BY name ASC;

	';
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $emId);
        $query->bindParam(':name', $eMarketName);

        if ($query->execute()){
            return $query->fetchAll();
        }
        return false;

    }
    //gets an export market by Id ???///// MAY NO LONGER BE NEEDED
    public function getExportMarketById($exId){
        
	$exMarkets = $this->getExportMarkets();

	foreach ($exMarkets as $key => $val){

		if ($val['id'] == $exId){
			
			return $val;

		}
	}

	return [];
	
    }
    public function getBuyerMusicInterest($inId = null, $uId = null, $mId = null){

        $query = $this->conn->prepare('
		SELECT
			i.id, i.user_id, i.music_id, i.created_on
		FROM
			buyer_music_interest AS i
		WHERE
		(
			case
				when :id is null then true
				else :id  = i.id
			end

		) AND
		(
			case
				when :userId is null then true
				else :userId = i.user_id
			end

		) AND
		(
			case
				when :musicId is null then true
				else :musicId = i.music_id
			end
		);

	');

	$query->bindParam(':id', $inId);
	$query->bindParam(':userId', $uId);
	$query->bindParam(':musicId', $mId);
        
        if (!$query->execute()){
		$this->log->info('getBuyerMusicInterest failed to execute');
		return false;
        }
        return $query->fetchAll();

    }
    public function getBuyerProductInterest($inId = null, $uId = null, $pId = null){

        $query = $this->conn->prepare('
		SELECT
			i.id, i.user_id, i.product_id, i.created_on
		FROM
			buyer_product_interest AS i
		WHERE
		(
			case
				when :id is null then true
				else :id  = i.id
			end

		) AND
		(
			case
				when :userId is null then true
				else :userId = i.user_id
			end

		) AND
		(
			case
				when :productId is null then true
				else :productId = i.product_id
			end
		);

	');

	$query->bindParam(':id', $inId);
	$query->bindParam(':userId', $uId);
	$query->bindParam(':productId', $pId);
        
        if (!$query->execute()){
		$this->log->info('getBuyerProductInterest failed to execute');
		return false;
        }
        return $query->fetchAll();

    }
    public function getBuyerServiceInterest($inId = null, $uId = null, $sId = null){

        $query = $this->conn->prepare('
		SELECT
			i.id, i.user_id, i.service_id, i.created_on
		FROM
			buyer_service_interest AS i
		WHERE
		(
			case
				when :id is null then true
				else :id  = i.id
			end

		) AND
		(
			case
				when :userId is null then true
				else :userId = i.user_id
			end

		) AND
		(
			case
				when :serviceId is null then true
				else :serviceId = i.service_id
			end
		);

	');

	$query->bindParam(':id', $inId);
	$query->bindParam(':userId', $uId);
	$query->bindParam(':serviceId', $sId);
        
        if (!$query->execute()){
		$this->log->info('getBuyerProductInterest failed to execute');
		return false;
        }
        return $query->fetchAll();

    }
    public function getBuyerCompanyBookmark($inId = null, $uId = null, $cId = null){

        $query = $this->conn->prepare('
		SELECT
			i.id, i.user_id, i.company_id, i.created_on
		FROM
			buyer_company_bookmark AS i
		WHERE
		(
			case
				when :id is null then true
				else :id  = i.id
			end

		) AND
		(
			case
				when :userId is null then true
				else :userId = i.user_id
			end

		) AND
		(
			case
				when :companyId is null then true
				else :companyId = i.company_id
			end
		);

	');

	$query->bindParam(':id', $inId);
	$query->bindParam(':userId', $uId);
	$query->bindParam(':companyId', $cId);
        
        if (!$query->execute()){
		$this->log->info('getBuyerCompanyBookmark failed to execute');
		return false;
        }
        return $query->fetchAll();

    }
    // Gets all interest for a user 
    public function getInterestedSector($inId = null, $uId = null, $sId = null){

        $query = $this->conn->prepare('
		SELECT
			i.id, i.user_id, i.sector_id, s.name
		FROM
			buyer_sector_interest AS i, sector AS s
		WHERE
		(
			case
				when :interestId is null then true
				else :interestId  = i.id
			end

		) AND
		(
			case
				when :userId is null then true
				else :userId = i.user_id
			end

		) AND
		(
			case
				when :sectorId is null then 
					s.id = i.sector_id
				else :sectorId = i.sector_id
			end
		);

	');

	$query->bindParam(':interestId', $inId);
	$query->bindParam(':userId', $uId);
	$query->bindParam(':sectorId', $sId);
	$query->bindParam(':status', $status);
        
        if (!$query->execute()){
		$this->log->info('getInterestedSector failed to execute');
		return false;
        }
        return $query->fetchAll();

    }
    public function updateInterestedSector ($uId, $intId, $sId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			buyer_sector_interest
		SET
			sector_id = ?
		where 
			id = ? and 
			user_id = ?
	');

        $query->bindParam('1', $sId);
        $query->bindParam('2', $intId);
        $query->bindParam('3', $uId);

	if (!$query->execute()){

	    $this->log->error('Update Interested Sector failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function updateService ($serId, $pCid, $pSid, $sscId, $pName, $pDescription, $pUpdateBy){

	$name = $this->sanitize($pName) ?? null;
        $desc = (isset($pDescription)? substr($this->sanitize(trim($pDescription)), 0, self::MAX_SERVICE_DESC_CHAR) : NULL);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			services
		SET
			name = ?,
			company_id = ?,
			sector_id = ?,
			sub_service_category_id = ?,
			description = ?, 
			update_by = ?,
			update_on = now(),
			update_type = "edit"
			
		where 
			id = ? AND 
			company_id = ?

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $pCid);
        $query->bindParam('3', $pSid);
        $query->bindParam('4', $sscId);
        $query->bindParam('5', $desc);
        $query->bindParam('6', $pUpdateBy);
        $query->bindParam('7', $serId);
        $query->bindParam('8', $pCid);

	if (!$query->execute()){

	    $this->log->error('updateService failed to execute');
	    return false;
	}

        return true;

    }
    public function updateMusic ($mId, $cId, $pName, $pDescription, $pAudioPath, $pUpdateBy){

	$name = $this->sanitize($pName) ?? null;
        $desc = (isset($pDescription)? substr($this->sanitize(trim($pDescription)), 0, 350) : NULL);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE 
			music
		SET
		   	name = ?,
			description = ?,
			company_id = ?,
			audio_path = ?,
			update_by = ?,
			update_type = "Edit",
			update_on = now()
		where 
			id = ? AND 
			company_id = ?;

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $desc);
        $query->bindParam('3', $cId);
        $query->bindParam('4', $pAudioPath);
        $query->bindParam('5', $pUpdateBy);
        $query->bindParam('6', $mId);
        $query->bindParam('7', $cId);

	if (!$query->execute()){

	    $this->log->error('add music faild to execute');
	    return false;
	}

        return true;

    }
    public function updateSector ($sId, $pName, $pDescription, $isFeatured, $pImgPath, $pUpdateBy){

	$name = $this->sanitize($pName) ?? null;
	$desc = $this->sanitize($pDescription) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			sector
		SET
			name = ?,
			description = ?, 
			is_featured = ?,
			img_path = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
			
		where 
			id = ?
	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $desc);
        $query->bindParam('3', $isFeatured);
        $query->bindParam('4', $pImgPath);
        $query->bindParam('5', $pUpdateBy);
        $query->bindParam('6', $sId);

	if (!$query->execute()){

	    $this->log->error('Unable to update sector');
	    return false;
	}

        return true;

    }
    //adds a buyer or a company account
    public function add_user(
			     $createdBy, 
			     $type, 
			     $pFname = null,
			     $pLname = null,
			     $pEmail, 
			     $pCompanyName = null, 
			     $description = null, 
			     $pCtv = null, 
			     $pAddress = null, 
			     $pDistrict = null, 
			     $pCtype = null, 
			     $pTradeArea = 'N/a', 
			     // additional company info
			     $pPhone = null,
			     $pEstabOn = null,
			     $pWebsite = null

 		     ){
	
        $fname       = $this->sanitize($pFname);
        $lname       = $this->sanitize($pLname);
        $email       = $this->sanitize($pEmail);
        $companyName = $this->sanitize($pCompanyName);
        $ctv         = $this->sanitize($pCtv);
        $address     = $this->sanitize($pAddress);
        $district    = $this->sanitize($pDistrict);
        $description = (isset($description)? substr($this->sanitize( trim($description) ), 0, self::MAX_COMPANY_DESC_CHAR) : NULL);
        $phone       = $this->sanitize($pPhone);
        $estabOn     = $this->sanitize($pEstabOn);
        $website     = $this->sanitize($pWebsite);
	
        $salt = md5(time().bin2hex(random_bytes(7)));
        $pPassword = bin2hex(random_bytes(10));
	
	$fullname = '';

	if ($type == 'company'){
		$fullname = $companyName;
	}else{
		$fullname = $fname.' '.$lname;
	}

        $query = $this->conn->prepare('call add_user(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
	
	$pass = md5($pPassword.$salt.$this->pepper);

	$query->bindParam(1, $createdBy);
	$query->bindParam(2, $type);
	$query->bindParam(3, $fullname);
	$query->bindParam(4, $email);
	$query->bindParam(5, $companyName);
	$query->bindParam(6, $description);
	$query->bindParam(7, $ctv);
	$query->bindParam(8, $address);
	$query->bindParam(9, $district);
	$query->bindParam(10, $pCtype);
	$query->bindParam(11, $pTradeArea);
	$query->bindParam(12, $pass);
	$query->bindParam(13, $salt);
	$query->bindParam(14, $phone);
	$query->bindParam(15, $estabOn);
	$query->bindParam(16, $website);
	
	if (!$query->execute()){

		$this->log->error('add_user failed to execute query');
	}
	
	return $query->fetch();

    }
    public function addMusic ($cId, $pName, $pDescription, $pAudioPath, $pCreatedBy){

	$name = $this->sanitize($pName) ?? null;
        $desc = (isset($pDescription)? substr($this->sanitize(trim($pDescription)), 0, self::MAX_MUSIC_DESC_CHAR) : NULL);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    music(
			name,
			description,
			company_id,
			audio_path,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $desc);
        $query->bindParam('3', $cId);
        $query->bindParam('4', $pAudioPath);
        $query->bindParam('5', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('add music faild to execute');
	    return false;
	}

        return true;

    }
    public function addSector ($pName, $pDescription, $isFeatured, $pImgPath, $pCreatedBy){

	$name = $this->sanitize($pName) ?? null;
	$desc = $this->sanitize($pDescription) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    sector(
			name,
			description,
			is_featured, 
			img_path,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $desc);
        $query->bindParam('3', $isFeatured);
        $query->bindParam('4', $pImgPath);
        $query->bindParam('5', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('Unable to add sector');
	    return false;
	}

        return true;

    }
    public function addPointOfContact($cId, $pFname, $pLname, $pPosition, $pEmail, $pPhone, $createdBy){

	$fname = $this->sanitize($pFname);
	$lname = $this->sanitize($pLname);
	$position = $this->sanitize($pPosition);
	$email = $this->sanitize($pEmail);
	$phone = $this->sanitize($pPhone);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    company_point_of_contact(
			company_id,
			first_name,
			last_name,
			position,
			email,
			phone,
			status, 
			created_on,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?, ?, 1, now(), ?)

	');

        $query->bindParam('1', $cId);
        $query->bindParam('2', $fname);
        $query->bindParam('3', $lname);
        $query->bindParam('4', $position);
        $query->bindParam('5', $email);
        $query->bindParam('6', $phone);
        $query->bindParam('7', $createdBy);

	if (!$query->execute()){

	    $this->log->error('addPointOfContact failed to execute');
	    return false;
	}

        return true;

    }
    public function addCompanyServiceInfo ($cId, $pCurrentSeatCap, $pExpanPotential, $pServiceOffered, $pIndustryServiced, $createdBy){

	$serviceOffered = $this->sanitize($pServiceOffered);
	$industryServiced = $this->sanitize($pIndustryServiced);
        $industryServiced = (isset($pIndustryServiced)? substr($this->sanitize(trim($pIndustryServiced)), 0, self::MAX_INDUSTRY_SERVICED_CHAR) : NULL);
	$expanPotential = $pExpanPotential ?? 0;
	$currentSeatCap = $pCurrentSeatCap ?? 0; 

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    company_service_info(
			company_id,
			current_seat_capacity,
			expansion_potential,
			service_offered,
			industry_serviced,
			status, 
			created_on,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?, 1, now(), ?)

	');

        $query->bindParam('1', $cId);
        $query->bindParam('2', $currentSeatCap);
        $query->bindParam('3', $expanPotential);
        $query->bindParam('4', $serviceOffered);
        $query->bindParam('5', $industryServiced);
        $query->bindParam('6', $createdBy);

	if (!$query->execute()){

	    $this->log->error('addCompanyServiceInfo failed to execute');
	    return false;
	}

        return true;

    }
    public function addExportMarket ($pName, $createdBy){

	$name = $this->sanitize($pName) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    export_market(
			name,
			status, 
			created_on,
			created_by
		    ) 
		VALUES(?, 1, now(), ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $createdBy);

	if (!$query->execute()){

	    $this->log->error('export_market failed to execute query');
	    return false;
	}

        return true;

    }
    //adds a service for a company
    public function addService ($pCid, $pSid, $sscId, $pName, $pDescription,  $pCreatedBy){

	$name = $this->sanitize($pName) ?? null;
        $desc = (isset($pDescription)? substr($this->sanitize(trim($pDescription)), 0, self::MAX_SERVICE_DESC_CHAR) : NULL);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    services(
			name,
			company_id,
			sector_id,
			sub_service_category_id,
			description,
			created_by,
			created_on
		    ) 
		VALUES(?, ?, ?, ?, ?, ?, now())

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $pCid);
        $query->bindParam('3', $pSid);
        $query->bindParam('4', $sscId);
        $query->bindParam('5', $desc);
        $query->bindParam('6', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('addService failed to execute');
	    return false;
	}

        return true;

    }
    //adds a sector interest for a user
    public function addBuyerCompanyBookmark($uId, $cId){

	$query = $this->conn->prepare('
		INSERT INTO 
		    buyer_company_bookmark(
			user_id,
			company_id
		    ) 
		VALUES(?, ?);
	');

	$query->bindParam(1, $uId);
	$query->bindParam(2, $cId);

	if(!$query->execute()){
	    $this->log->error('Add buyer company bookmark failed to execute: '.$query->errorInfo());
	    return false;
	}

	return true;


    }
    public function addBuyerServiceInterest($uId, $sId){

	$query = $this->conn->prepare('
		INSERT INTO 
		    buyer_service_interest(
			user_id,
			service_id
		    ) 
		VALUES(?, ?);
	');

	$query->bindParam(1, $uId);
	$query->bindParam(2, $sId);

	if(!$query->execute()){
	    $this->log->error('Add buyer service interest failed to execute: '.$query->errorInfo());
	    return false;
	}

	return true;


    }
    public function addBuyerMusicInterest($uId, $mId){

	$query = $this->conn->prepare('
		INSERT INTO 
		    buyer_music_interest(
			user_id,
			music_id
		    ) 
		VALUES(?, ?);
	');

	$query->bindParam(1, $uId);
	$query->bindParam(2, $mId);

	if(!$query->execute()){
	    $this->log->error('Add buyer music interest failed to execute: '.$query->errorInfo());
	    return false;
	}

	return true;


    }
    public function addBuyerProductInterest($uId, $pId){

	$query = $this->conn->prepare('
		INSERT INTO 
		    buyer_product_interest(
			user_id,
			product_id
		    ) 
		VALUES(?, ?);
	');

	$query->bindParam(1, $uId);
	$query->bindParam(2, $pId);

	if(!$query->execute()){
	    $this->log->error('Add buyer product interest failed to execute: '.$query->errorInfo());
	    return false;
	}

	return true;


    }
    public function addInterestedSector($uId, $sId){

	$query = $this->conn->prepare('
		INSERT INTO 
		    buyer_sector_interest(
			sector_id,
			user_id
		    ) 
		VALUES(?, ?);
	');

	$query->bindParam(1, $sId);
	$query->bindParam(2, $uId);

	if(!$query->execute()){
	    $this->log->error('Add Interested Sector failed to execute: '.$query->errorInfo());
	    return false;
	}

	return true;


    }
    public function addServiceCategory ($pName, $pAcronym, $pIcon, $pDescription, $pCreatedBy){

	$name = $this->sanitize($pName);
	$acronym = $this->sanitize($pAcronym);
	$icon = $this->sanitize($pIcon);
	$desc = $this->sanitize($pDescription);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    service_category(
			name,
			icon,
			acronym,
			description,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $icon);
        $query->bindParam('3', $acronym);
        $query->bindParam('4', $desc);
        $query->bindParam('5', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('Add service category failed to execute');
	    return false;
	}

        return true;

    }
    public function addSubServiceCategory ($scId, $pName, $pIcon, $pDescription, $pCreatedBy){

	$name = $this->sanitize($pName) ?? null;
	$icon = $this->sanitize($pIcon) ?? null;
	$desc = $this->sanitize($pDescription) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    sub_service_category(
			name,
			icon,
			description, 
			service_category_id,
			created_by
		    ) 
		VALUES(?, ?, ?, ?, ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $icon);
        $query->bindParam('3', $desc);
        $query->bindParam('4', $scId);
        $query->bindParam('5', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('Add sub service category failed to execute');
	    return false;
	}

        return true;

    }
    public function addFaq ($pQuestion, $pAnswer, $pDisplayTo, $pCreatedBy){

	$question = $this->sanitize($pQuestion);
	$answer = $this->sanitize($pAnswer);
	$displayTo = $this->sanitize($pDisplayTo);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    faq(
			question,
			answer, 
			display_to,
			created_by
		    ) 
		VALUES(?, ?, ?, ?)

	');

        $query->bindParam('1', $question);
        $query->bindParam('2', $answer);
        $query->bindParam('3', $displayTo);
        $query->bindParam('4', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('add faq failed to execute');
	    return false;
	}

        return true;

    }
    public function addHsCode ($pName, $pHsCode, $pSid, $pCreatedBy){

	$name = $this->sanitize($pName) ?? null;
	$hsCode = $this->sanitize($pHsCode) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		INSERT INTO 
		    hs_code(
			name,
			hs_code, 
			sector_id,
			created_by
		    ) 
		VALUES(?, ?, ?, ?)

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $hsCode);
        $query->bindParam('3', $pSid);
        $query->bindParam('4', $pCreatedBy);

	if (!$query->execute()){

	    $this->log->error('Unable to add hs_code');
	    return false;
	}

        return true;

    }
    public function deleteUser($userTypeId = null, $uId, $type, $pUpdateBy){

	try{
		$this->conn->beginTransaction();
		
		if ($type == 'company'){
			//setting company status to 0
			
			$query = $this->conn->prepare('
				UPDATE 
					company	
				SET
					status = 0,
					update_by = ?,
					update_on = now(),
					update_type = "removed"

				WHERE 	
					id = ?
				
			');
			$query->bindParam('1', $pUpdateBy);
			$query->bindParam('2', $userTypeId);

			$query->execute();

		}else if ($type == 'buyer'){

			$query = $this->conn->prepare('
				UPDATE 
					buyer
				SET
					status = 0,
					update_by = ?,
					update_on = now(),
					update_type = "removed"

				WHERE 	
					id = ?
				
			');
			$query->bindParam('1', $pUpdateBy);
			$query->bindParam('2', $userTypeId);

			$query->execute();


		}else{
			//do nothing here

		}

		// setting user status to 0
		$query2 = $this->conn->prepare('
			UPDATE 
				users	
			SET
				status = 0,
				update_by = ?,
				update_on = now(),
				update_type = "removed"

			WHERE 	
				id = ?
			
		');
		$query2->bindParam('1', $pUpdateBy);
		$query2->bindParam('2', $uId);

		$query2->execute();
		//updating user profile first then 
		$this->conn->commit();
		return true;

	}catch(PDOException $e){

		$this->conn->rollback();
		$this->log->error('deleteCompany failed! Message: '.$e->getMessage());
		return false;

	}


    }
    public function deleteSubServiceCategory($id, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			sub_service_category
		SET
			status = 0,
			update_by = ?,
			update_on = now(),
			update_type = "removed"
		where 
			id = ?
	');

        $query->bindParam('1', $pUpdateBy);
        $query->bindParam('2', $id);

	if (!$query->execute()){

	    $this->log->error('Delete sub service category failed to execute');
	    return false;
	}

        return true;

    }

    public function deleteServiceCategory($id, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			service_category
		SET
			status = 0,
			update_by = ?,
			update_on = now(),
			update_type = "removed"
		where 
			id = ?
	');

        $query->bindParam('1', $pUpdateBy);
        $query->bindParam('2', $id);

	if (!$query->execute()){

	    $this->log->error('Delete service category failed to execute');
	    return false;
	}

        return true;

    }
    public function deleteMusic($id, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			music
		SET
			status = 0,
			update_by = :updateby,
			update_on = now(),
			update_type = "removed"
		where 
			id = :id
	');

        $query->bindParam(':updateby', $pUpdateBy);
        $query->bindParam(':id', $id);

	if (!$query->execute()){

	    $this->log->error('delete music failed to execute');
	    return false;
	}

        return true;

    }
    public function deleteSector($sId, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			sector
		SET
			status = 0,
			update_by = ?,
			update_on = now(),
			update_type = "removed"
		where 
			id = ?
	');

        $query->bindParam('1', $pUpdateBy);
        $query->bindParam('2', $sId);

	if (!$query->execute()){

	    $this->log->error('Unable to remove sector');
	    return false;
	}

        return true;

    }
    public function deleteExportMarket($emId, $pRemovedBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			export_market
		SET
			status = 0,
			removed_by = ?,
			removed_on = now()
		where 
			id = ?
	');

        $query->bindParam('1', $pRemovedBy);
        $query->bindParam('2', $emId);

	if (!$query->execute()){

	    $this->log->error('deleteExportMarket failed to excute');
	    return false;
	}

        return true;

    }
    public function deleteService($serId, $cId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			services
		WHERE	
			id = ? and 
			company_id = ?;
	');

        $query->bindParam('1', $serId);
        $query->bindParam('2', $cId);

	if (!$query->execute()){

	    $this->log->error('Delete service failed to execute error -> : '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteBuyerMusicInterest($uId, $mId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			buyer_music_interest
		WHERE	
			user_id = ? and
			music_id = ?
		;
	');

        $query->bindParam('1', $uId);
        $query->bindParam('2', $mId);

	if (!$query->execute()){

	    $this->log->error('Delete buyer music interest failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteBuyerServiceInterest($uId, $sId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			buyer_service_interest
		WHERE	
			user_id = ? and
			service_id = ?
		;
	');

        $query->bindParam('1', $uId);
        $query->bindParam('2', $sId);

	if (!$query->execute()){

	    $this->log->error('Delete buyer service interest failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteBuyerProductInterest($uId, $pId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			buyer_product_interest
		WHERE	
			user_id = ? and
			product_id = ?
		;
	');

        $query->bindParam('1', $uId);
        $query->bindParam('2', $pId);

	if (!$query->execute()){

	    $this->log->error('Delete buyer product interest failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteBuyerCompanyBookmark($uId, $cId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			buyer_company_bookmark
		WHERE	
			user_id = ? and
			company_id = ?
		;
	');

        $query->bindParam('1', $uId);
        $query->bindParam('2', $cId);

	if (!$query->execute()){

	    $this->log->error('Delete buyer company bookmark failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteInterestedSector($uId, $intId){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		DELETE FROM
			buyer_sector_interest
		WHERE	
			id = ? and 
			user_id = ?;
	');

        $query->bindParam('1', $intId);
        $query->bindParam('2', $uId);

	if (!$query->execute()){

	    $this->log->error('Delete Interested Sector failed to execute: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function deleteFaq($fId, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			faq
		SET
			status = 0,
			update_by = ?,
			update_on = now(),
			update_type = "removed"
		where 
			id = ?
	');

        $query->bindParam('1', $pUpdateBy);
        $query->bindParam('2', $fId);

	if (!$query->execute()){

	    $this->log->error('Unable to remove faq');
	    return false;
	}

        return true;

    }
    public function deleteHsCode($hsId, $pUpdateBy){

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			hs_code
		SET
			status = 0,
			update_by = ?,
			update_on = now(),
			update_type = "removed"
		where 
			id = ?
	');

        $query->bindParam('1', $pUpdateBy);
        $query->bindParam('2', $hsId);

	if (!$query->execute()){

	    $this->log->error('Unable to remove hs_code');
	    return false;
	}

        return true;

    }
    public function updateCompanyServiceInfo ($csiId, $cId, $pCurrentSeatCap, $pExpanPotential, $pServiceOffered, $pIndustryServiced, $createdBy){

	$serviceOffered = $this->sanitize($pServiceOffered);
	$industryServiced = $this->sanitize($pIndustryServiced);
	$expanPotential = $pExpanPotential ?? 0;
	$currentSeatCap = $pCurrentSeatCap ?? 0; 

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE 
		    company_service_info
		SET
			current_seat_capacity = ?,
			expansion_potential= ?,
			service_offered = ?,
			industry_serviced = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		WHERE
			id = ? and 
			company_id = ?

	');

        $query->bindParam('1', $currentSeatCap);
        $query->bindParam('2', $expanPotential);
        $query->bindParam('3', $serviceOffered);
        $query->bindParam('4', $industryServiced);
        $query->bindParam('5', $createdBy);
        $query->bindParam('6', $csiId);
        $query->bindParam('7', $cId);

	if (!$query->execute()){

	    $this->log->error('updateCompanyServiceInfo failed to execute');
	    return false;
	}

        return true;

    }

    public function updatePointOfContact ($pocId, $cId, $pfname, $plname, $pPosition, $pPhone, $pEmail, $pUpdateBy){

	$fname = $this->sanitize($pfname);
	$lname = $this->sanitize($plname);
	$position = $this->sanitize($pPosition);
	$phone = $this->sanitize($pPhone);
	$email = $this->sanitize($pEmail);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			company_point_of_contact
		SET
			first_name = ?,
			last_name = ?,
			position = ?,
			email = ?, 
			phone = ?, 
			update_by = ?,
			update_on = now(),
			update_type = "edit"
			
		where 
			id = ? and 
			company_id = ?
	');

        $query->bindParam('1', $fname);
        $query->bindParam('2', $lname);
        $query->bindParam('3', $position);
        $query->bindParam('4', $email);
        $query->bindParam('5', $phone);
        $query->bindParam('6', $pUpdateBy);
        $query->bindParam('7', $pocId);
        $query->bindParam('8', $cId);

	if (!$query->execute()){

	    $this->log->error('updatePointOfContact execute failed: '.$query->errorInfo());
	    return false;
	}

        return true;

    }
    public function updateSubServiceCategory ($sscId, $scId, $pName, $pIcon, $pDescription, $pUpdateBy){

	$name = $this->sanitize($pName);
	$icon = $this->sanitize($pIcon);
	$desc = $this->sanitize($pDescription);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE 
		    sub_service_category
		SET 
			name = ?,
			icon = ?,
			service_category_id = ?,
			description = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		   
		WHERE
			id = ?

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $icon);
        $query->bindParam('3', $scId);
        $query->bindParam('4', $desc);
        $query->bindParam('5', $pUpdateBy);
        $query->bindParam('6', $sscId);

	if (!$query->execute()){

	    $this->log->error('update sub service category failed to execute');
	    return false;
	}

        return true;

    }
    public function updateServiceCategory ($scId, $pName, $pAcronym, $pIcon, $pDescription, $pUpdateBy){

	$name = $this->sanitize($pName);
	$acronym = $this->sanitize($pAcronym);
	$icon = $this->sanitize($pIcon);
	$desc = $this->sanitize($pDescription);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE 
		    service_category
		SET 
			name = ?,
			icon = ?,
			acronym = ?,
			description = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		   
		WHERE
			id = ?

	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $icon);
        $query->bindParam('3', $acronym);
        $query->bindParam('4', $desc);
        $query->bindParam('5', $pUpdateBy);
        $query->bindParam('6', $scId);

	if (!$query->execute()){

	    $this->log->error('update service category failed to execute');
	    return false;
	}

        return true;

    }
    public function updateFaq ($fId, $pQuestion, $pAnswer, $pDisplayTo, $pUpdateBy){

	$question = $this->sanitize($pQuestion);
	$answer = $this->sanitize($pAnswer);
	$displayTo = $this->sanitize($pDisplayTo);

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			faq
		SET
			question = ?, 
			answer = ?,
			display_to = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		where 
			id = ?
	');

        $query->bindParam('1', $question);
        $query->bindParam('2', $answer);
        $query->bindParam('3', $displayTo);
        $query->bindParam('4', $pUpdateBy);
        $query->bindParam('5', $fId);

	if (!$query->execute()){

	    $this->log->error('Unable to update faq, failed to execute');
	    return false;
	}

        return true;

    }
    public function updateHsCode ($hsId, $pName, $pHsCode, $pSid, $pUpdateBy){

	$name = $this->sanitize($pName) ?? null;
	$hsCode = $this->sanitize($pHsCode) ?? null;

	//record doesnt exist -- insert
	$query = $this->conn->prepare('
		UPDATE
			hs_code
		SET
			name = ?,
			hs_code = ?, 
			sector_id = ?,
			update_by = ?,
			update_on = now(),
			update_type = "edit"
			
		where 
			id = ?
	');

        $query->bindParam('1', $name);
        $query->bindParam('2', $hsCode);
        $query->bindParam('3', $pSid);
        $query->bindParam('4', $pUpdateBy);
        $query->bindParam('5', $hsId);

	if (!$query->execute()){

	    $this->log->error('Unable to add hs_code');
	    return false;
	}

        return true;

    }
    public function getMusics($mId = null, $cId = null, $pName = null, $status = 1){
        
        $name = $this->sanitize($pName);

        $sql = $this->conn->prepare('

		SELECT
			m.id,
			m.name,
			m.audio_path,
			m.description,
			m.company_id,
			c.name as company_name,	
			m.created_by,
			created.full_name as created_by_name,
			DATE_FORMAT(m.created_on, "%d %M %Y") as created_on,
			m.update_by,
			updated.full_name as update_by_name,
			DATE_FORMAT(m.update_on, "%d %M %Y") as update_on,
			m.update_type


		FROM
			music as m
			left join users as created on created.id = m.created_by
			left join users as updated on updated.id = m.update_by,
			company as c

		WHERE
			m.company_id = c.id AND
			(
			case
				when :cid is null then true
				else m.company_id = :cid
			end
			) AND
			(
			case
				when :mid is null then true
				else m.id = :mid
			end
			) AND
			(
			case
				when :status is null then true
				else m.status = :status
			end
			) AND
			(
			case
				when :name is null then true
				else m.name like CONCAT("%",:name,"%")
			end
			);	

	');
        
        $sql->bindParam(':cid', $cId);
        $sql->bindParam(':mid', $mId);
        $sql->bindParam(':status', $status);
        $sql->bindParam(':name', $name);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('Failed to get HSCodes');
	return false;
    }
    /*
	serId	=> service id
	cId	=> company id 
	scId 	=> service category id
	sscid 	=> sub service category id
    */
    public function getServices($serId = null, $cId = null, $featured = null, $pName = null, $scId = null, $sscId = null){
        
        $name = $this->sanitize($pName);

        $sql = $this->conn->prepare('

		SELECT
			ser.id,
			ser.name as service_name,
			ser.sector_id,
			s.name as sector_name,
			ser.is_featured,
			ser.description,
			ser.company_id,
			c.name as company_name,
			ser.sub_service_category_id,
			ssc.name as sub_service_category_name,
			ssc.icon as sub_service_category_icon,
			sc.acronym as service_category_acronym,
			sc.id as service_category_id,
			sc.name as service_category_name,
			sc.icon as service_category_icon,	
			ser.created_by,
			created.full_name as created_by_name,
			DATE_FORMAT(ser.created_on, "%d %M %Y") as created_on,
			ser.update_by,
			updated.full_name as update_by_name,
			DATE_FORMAT(ser.update_on, "%d %M %Y") as update_on,
			ser.update_type


		FROM
			services as ser
			left join users as created on created.id = ser.created_by
			left join users as updated on updated.id = ser.update_by,
			sub_service_category as ssc,
			service_category as sc,
			sector as s,
			company as c 
			
		WHERE
			ser.sub_service_category_id = ssc.id AND
			ssc.service_category_id = sc.id AND 
			ser.sector_id = s.id and 
			ser.company_id = c.id and 
			
			(
			case
				when :id is null then true
				else ser.id = :id
			end
			) AND
			(
			case
				when :featured is null then true
				else ser.is_featured = :featured
			end
			) AND
			(
			case
				when :cid is null then true
				else ser.company_id = :cid
			end

			) AND
			(
			case
				when :scid is null || :scid = -1 then true
				else sc.id = :scid
			end

			) AND
			(
			case
				when :sscid is null || :sscid = -1 then true
				else ssc.id = :sscid
			end
			) AND
			(
			case
				when :name is null then true
				else ser.name like CONCAT("%",:name,"%")
			end
			);	
	');
        
        $sql->bindParam(':id', $serId);
        $sql->bindParam(':featured', $featured);
        $sql->bindParam(':cid', $cId);
        $sql->bindParam(':scid', $scId);
        $sql->bindParam(':sscid', $sscId);
        $sql->bindParam(':name', $name);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('Failed to get HSCodes');
	return false;
    }
    public function getFaq($fId = null, $displayTo = null, $status = 1){
        
        $sql = $this->conn->prepare('

		SELECT
			f.id,
			f.question,
			f.answer,
			f.display_to,
			created.full_name as created_by_name,
			DATE_FORMAT(f.created_on, "%d %M %Y") as created_on,
			f.update_by,
			updated.full_name as update_by_name,
			DATE_FORMAT(f.update_on, "%d %M %Y") as update_on,
			f.update_type,
			f.status

		FROM
			faq as f
			left join users as created on created.id = f.created_by
			left join users as updated on updated.id = f.update_by

		WHERE
		(
			case 
				when :id is null then true
				else f.id = :id
			end 
		) AND
		(
			case 
				when :displayTo is null then true
				else f.display_to = :displayTo 
			end 
		) AND
		(
			case 
				when :status = -1 then true
				else f.status = :status 
			end 
		)


	');
        
        $sql->bindParam(':id', $fId);
        $sql->bindParam(':displayTo', $displayTo);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('Failed to get faqs');
	return false;
    }
    // gets all hs_codes
    public function getHsCodes($hsId = null, $hsCode = null, $sId = null, $status = 1){
        
        $sql = $this->conn->prepare('

		SELECT
			hsc.id,
			hsc.name as hs_code_name,
			hsc.hs_code,
			hsc.sector_id,
			s.name as sector_name,
			hsc.created_by,
			created.full_name as created_by_name,
			DATE_FORMAT(hsc.created_on, "%d %M %Y") as created_on,
			hsc.update_by,
			updated.full_name as update_by_name,
			DATE_FORMAT(hsc.update_on, "%d %M %Y") as update_on,
			hsc.update_type,
			hsc.status

		FROM
			hs_code as hsc
			left join sector as s on s.id = hsc.sector_id
			left join users as created on created.id = hsc.created_by
			left join users as updated on updated.id = hsc.update_by

		WHERE
		(
			case 
				when :id is null then true
				else hsc.id = :id
			end 
		) AND
		(
			case 
				when :code is null then true
				else hsc.hs_code = :code 
			end 
		) AND
		(
			case 
				when :sectorid is null then true
				else hsc.sector_id = :sectorid 
			end 
		) AND
		(
			case 
				when :status = -1 then true
				else hsc.status = :status 
			end 
		)


	');
        
        $sql->bindParam(':id', $hsId);
        $sql->bindParam(':code', $hsCode);
        $sql->bindParam(':sectorid', $sId);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('Failed to get HSCodes');
	return false;
    }

    public function getSubServiceCategory($sscId = null, $scId = null, $status = 1){
        
        $sql = $this->conn->prepare('

	SELECT
		ssc.id,
		ssc.name as sub_service_category_name,
		ssc.description,
		ssc.icon as sub_service_category_icon,
		ssc.service_category_id,
		sc.acronym as service_category_acronym,
		sc.name as service_category_name,
		sc.icon as service_category_icon,
		ssc.created_by,
		c_by.full_name as created_by_name,
		DATE_FORMAT(ssc.created_on, "%d %M %Y") as created_on,
		ssc.update_by,
		u_by.full_name as update_by_name,
		ssc.update_type,
		DATE_FORMAT(ssc.update_on, "%d %M %Y") as update_on,
		ssc.status

	FROM
		sub_service_category as ssc
		left join users as u_by on u_by.id = ssc.update_by
		left join users as c_by on c_by.id = ssc.created_by,
		service_category as sc

	WHERE
		sc.status = 1 AND
		(
			case
				when :id is null then true
				else
					ssc.id = :id
			end
		) AND
		(
			case
				when :scid is null then 
					ssc.service_category_id = sc.id
				else
					sc.id = :scid
			end
		) AND
		(
			case
				when :status = -1 then true
				else
					ssc.status = :status
			end
		)
		;


	');
        
        $sql->bindParam(':id', $sscId);
        $sql->bindParam(':scid', $scId);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getSectors returned false, no sectors found');
	return false;
    }
    
    public function getServiceCategory($scId = null, $status = 1){
        
        $sql = $this->conn->prepare('
		
	SELECT
		sc.id,
		sc.acronym,
		sc.name,
		sc.icon,
		sc.description,
		(select count(ssc.id) from sub_service_category ssc where ssc.service_category_id = sc.id) as sub_cat_count,
		COALESCE(summary.company_distinct_count, 0) as company_distinct_count,
		COALESCE(summary.company_count, 0) as company_count,
		COALESCE(summary.service_count, 0) as service_count,
		sc.created_by,
		c_by.full_name as created_by_name,
		DATE_FORMAT(sc.created_on, "%d %M %Y") as created_on,
		sc.update_by,
		u_by.full_name as update_by_name,
		sc.update_type,
		DATE_FORMAT(sc.update_on, "%d %M %Y") as update_on,
		sc.status

	FROM
		service_category as sc
		left join users as u_by on u_by.id = sc.update_by
		left join users as c_by on c_by.id = sc.created_by
		left join (

			select
				-- company ammount that provides service under this category
				count(DISTINCT ser.company_id) as company_distinct_count,
				count(ser.company_id) as company_count,
				count(ser.id) as service_count,
				ssc.service_category_id

			from
				services as ser,
				sub_service_category as ssc
			where
				ser.sub_service_category_id = ssc.id and
				ssc.`status` = 1

			GROUP BY 4

		) as summary on sc.id = summary.service_category_id


	WHERE




		(
			case
				when :id is null then true
				else
					sc.id = :id
			end
		) AND
		(
			case
				when :status = -1 then true
				else
					sc.status = :status
			end
		)
		;


	');
        
        $sql->bindParam(':id', $scId);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getSectors returned false, no sectors found');
	return false;
    }
    //gets the point of contact of a company
    public function getPointOfContact($cId = null, $pocId = null, $status = 1){
        
        $sql = $this->conn->prepare('
		SELECT
			cpoc.id,
			cpoc.company_id,
			cpoc.first_name,
			cpoc.last_name,
			cpoc.position,
			cpoc.email,
			cpoc.phone,
			cpoc.created_by,
			c_by.full_name as created_by_name,
			DATE_FORMAT(cpoc.created_on, "%d %M %Y") as created_on,
			cpoc.update_by,
			u_by.full_name as update_by_name,
			cpoc.update_type,
			DATE_FORMAT(cpoc.update_on, "%d %M %Y") as update_on,
			cpoc.status

		FROM
			company_point_of_contact as cpoc
			left join users as u_by on u_by.id = cpoc.update_by
			left join users as c_by on c_by.id = cpoc.created_by
		WHERE
			(
				case
					when :id is null then true
					else
						cpoc.id = :id
				end
			) AND
			(
				case
					when :cid is null then true
					else
						cpoc.company_id = :cid
				end
			) AND
			(
				case
					when :status = -1 then true
					else
						cpoc.status = :status
				end
			)
		;

	');
        
        $sql->bindParam(':id', $pocId);
        $sql->bindParam(':cid', $cId);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getPointOfContact returned false');
	return false;
    }
    public function getIcons($iconId = null){
        
        $sql = $this->conn->prepare('
		SELECT

			i.id,
			i.unicode,
			i.name
		FROM
			icons i
		WHERE
			(
				case
					when :id is null then true
					else
						i.id = :id
				end
			)
		;

	');
        
        $sql->bindParam(':id', $iconId);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getIcons failed to execute');
	return false;
    }
    public function getCompanyTypes($ctId = null, $orderBy = 'ORDER BY display_order ASC', $status = 1){
        
        $sql = $this->conn->prepare('
		SELECT
			ct.id,
			ct.type,
			ct.display_name,
			ct.display_order,
			ct.icon,
			ct.created_by,
			c_by.full_name as created_by_name,
			DATE_FORMAT(ct.created_on, "%d %M %Y") as created_on,
			ct.update_by,
			u_by.full_name as update_by_name,
			ct.update_type,
			DATE_FORMAT(ct.update_on, "%d %M %Y") as update_on,
			ct.status

		FROM
			company_type as ct
			left join users as u_by on u_by.id = ct.update_by
			left join users as c_by on c_by.id = ct.created_by
		WHERE
			(
				case
					when :id is null then true
					else
						ct.id = :id
				end
			) AND
			(
				case
					when :status = -1 then true
					else
						ct.status = :status
				end
			)
		'.$orderBy.'
		;

	');
        
        $sql->bindParam(':id', $ctId);
        $sql->bindParam(':status', $status);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getCompanyTypes returned false');
	return false;
    }
    // Gets all sectors
    public function getSectors($sId = null, $name = null, $status = 1, $isFeatured = null){
        
        $sql = $this->conn->prepare('
		SELECT 
			s.id,
			s.name,
			s.description,
			s.is_featured,
			s.img_path as sector_img,
			s.created_by,
			c_by.full_name as created_by_name,
			DATE_FORMAT(s.created_on, "%d %M %Y") as created_on,
			s.update_by,
			u_by.full_name as update_by_name,
			s.update_type,
			DATE_FORMAT(s.update_on, "%d %M %Y") as update_on,	
			s.status
			
		FROM 
			sector as s
			left join users as u_by on u_by.id = s.update_by
			left join users as c_by on c_by.id = s.created_by
		WHERE 
			(
				case 
					when :id is null then true
					else 
						s.id = :id
				end
			) AND 
			(
				case
					when :status = -1 then true
					else
						s.status = :status
				end
			) AND 
			(
		        case
				when :featured is null then true
				else 
					s.is_featured = :featured
		        end
			) AND
			(
			case
				when :name is null then true
				else s.name like CONCAT("%",:name,"%")
			end
			);	

	');
        
        $sql->bindParam(':id', $sId);
        $sql->bindParam(':name', $name);
        $sql->bindParam(':status', $status);
        $sql->bindParam(':featured', $isFeatured);

        if($sql->execute()){

	        return $sql->fetchAll();
	}

	$this->log->error('getSectors returned false, no sectors found');
	return false;
    }
    //gets a sector by Id ///MAY NO LONGER BE NEED REVISE CODE BEFORE DELETE
    public function getSectorById($sId){
       
	$sectors = $this->getSectors();

	foreach ($sectors as $key => $val){
	
		if ($sId == $val['id']){
			return $sectors[$key];
		}
	}

	return array();
	 
	

    }
    // Updates or inserts a user's social constact list
    public function setSocialContactList ($data = [], $cId){

	$inValid['links'] = [];//the links that failed
	$inValid['count'] = 0;//how many failed url lnks 

        foreach ($data as $key => $array){
            
            $link = $this->sanitize($array['link']);
            $sclId = decrypt($array['socialContactListId']);
            $scId = decrypt($array['socialContactId']);
	    $socialContact = $this->getSocialContact($scId);
	    $type = (strtolower($socialContact[0]['name']) ?? '');

	    if (validateURL($link, $type) || $link == ''){
		
		    if ($sclId != 0){
			//record exist -- update
			$sql = "UPDATE 
				    social_contact_list 
				SET 
				    link = ?

				WHERE 
				    id = ?";
			
			$query = $this->conn->prepare($sql);
		
			$query->bindParam(1, $link);
			$query->bindParam(2, $sclId);

			if (!$query->execute()){
			    $this->log->error('setSocialContactlist update section returned false');
			    return false;
			}

		    }else{
			//record doesnt exist -- insert
			$sql = 'INSERT INTO 
				    social_contact_list(
					social_contact_id,
					company_id, 
					link
				    ) 
				VALUES(?, ?, ? )';
			$query = $this->conn->prepare($sql);

			$query->bindParam(1, $scId);
			$query->bindParam(2, $cId);
			$query->bindParam(3, $link);

			if(!$query->execute()){
			    $this->log->error('setSocialContactist insert section returned false');
			    return false;
			}

		    }
		

	    }else{
		$inValid['links'][] = $link;
		$inValid['for'][] = $socialContact[0]['name'];
		$inValid['count']++;
	    }    


        }
        return $inValid;

    }
    // Updates or Inserts intereset based on data recieved
    public function setInterestList($data  = null, $userId = null){

        try {
            $this->conn->beginTransaction();
            foreach ($data as $array){
                
                $status = 1;
                if ($array['sectorId'] == 0){
                    $status = 0;
                }

                if (isset($array['interestId']) && $status != 0){
                    //record exist  --- update
                    $sql = "UPDATE 
                                interest 
                            SET 
                                ".(($status == 1 )? 'sector_id = ?,' : '')."
                                status = ?
    
                            WHERE 
                                id = ".$array['interestId']." AND 
                                user_id = ".$userId."";
                    
                    $query = $this->conn->prepare($sql);
                    $result = $query->execute([$array['sectorId'], $status]);
                    
                    if (!$result){
                        $this->log->error('setExportMarketList update section returned false');
                        return false;
                    }
    
                }else if (isset($array['interestId']) && $status == 0){

                    // remove record
                    $sql = "UPDATE 
                                interest 
                            SET 
                                
                                status = 0
    
                            WHERE 
                                id = ".$array['interestId']." AND 
                                user_id = ".$userId."";
                    
                    $query = $this->conn->prepare($sql);
                    $result = $query->execute();
                    
                    if (!$result){
                        $this->log->error('setExportMarketList update section returned false');
                        return false;
                    }

                }else{
                    if ($status != 0){
                        //record doesn't exist --- insert
                        $sql = 'INSERT INTO 
                                    interest(
                                        sector_id,
                                        user_id 
                                    ) 
                                VALUES(?, ?)';
                        $query = $this->conn->prepare($sql);
        
                        $result = $query->execute([
                            $array['sectorId'],
                            $userId
                        ]);
        
                        if(!$result){
                            $this->log->error('setExportMarketList insert section returned false');
                            return false;
                        }

                    }
                }
            }
            $this->conn->commit();
            return true;

        }catch (PDOException $e){
            $this->conn->rollback();
            $this->log->error('setInterestList was rolledback due to an error: '.$e->getMessage());
            return false;
        }
      

    }
    // Updates or Inserts product information
    public function setProductDetails($pId = null, $cId = null, $hsId, $pName, $pDescription, $doneBy){

        $name = $this->sanitize($pName);
        $description = (isset($pDescription)? substr($this->sanitize(trim($pDescription)), 0, self::MAX_PRODUCT_DESC_CHAR) : NULL);
        
        if (isset($pId)){
            //record exist  --- update
            $query = $this->conn->prepare('
		    UPDATE 
                        products 
                    SET 
                        name = ?,
                        description = ?,
                        hs_code_id = ?,
                        update_by = ?,
			update_type = "edit",
			update_on = now()

                    WHERE 
                        id = ? and
			company_id = ?
       	    ');
		
	    $query->bindParam(1, $name);
	    $query->bindParam(2, $description);
	    $query->bindParam(3, $hsId);
	    $query->bindParam(4, $doneBy);
	    $query->bindParam(5, $pId);
	    $query->bindParam(6, $cId);
            
            if (!$query->execute()){
                $this->log->error('setProductDetails UPDATE section returned false');
                return false;
            }

        }else{
            //record doesn't exist --- Insert
            $query = $this->conn->prepare('
		    INSERT INTO 
                        products(
                            name,
                            description,
                            hs_code_id,
                            company_id,
			    created_by,
			    created_on
                        ) 
                    VALUES(?, ?, ?, ?, ?, now())
	    ');

	    $query->bindParam(1, $name);
	    $query->bindParam(2, $description);
	    $query->bindParam(3, $hsId);
	    $query->bindParam(4, $cId);
	    $query->bindParam(5, $doneBy);

            if (!$query->execute()){
                $this->log->error('setProductDetails INSERT section returned false');
                return false;
            }

            return $this->conn->lastInsertId();
        }

        return true; 
    }

    // can be used to remove or undo a delete for a specific image 
    public function changeProductImageStatus($pId, $pImgId, $status){
        
            //Record exists --- UPDATE --- removing the product
            $query = $this->conn->prepare('
		    UPDATE 
                        product_image
                    SET 
                        status = ?
                    WHERE 
                        product_id = ? AND
                        id = ?
	    ');

	    $query->bindParam(1, $status);
	    $query->bindParam(2, $pId);
	    $query->bindParam(3, $pImgId);
            
            if (!$query->execute()){
                $this->log->error('changeProductImageStatus returned false');
                return false;
            }

            return $pImgId;

    }
    //stores the path the the images
    public function addProductImage($pId, $imgPath, $fileName, $size, $type){
        
	    $query = $this->conn->prepare('
		INSERT INTO 
			product_image(
			    product_id,
			    file_name, 
			    path,
			    size,
			    type 
			) 
		 VALUES(?, ?, ?, ?, ?)
	    
	    ');
	

	    $query->bindParam(1, $pId);
	    $query->bindParam(2, $fileName);
	    $query->bindParam(3, $imgPath);
	    $query->bindParam(4, $size);
	    $query->bindParam(5, $type);


	    if( !$query->execute() ){
		$this->log->error('addProductImages faild to execute');
                return false;   
	    }
	    return true;

    }
	// 	NOOOO LONGER IN USE
    // Inserts or updates a product image
    public function setProductImages($data = null){
        
        if (isset($data['productImageId'])){
            //Record exists --- UPDATE --- removing the product
            $sql = "UPDATE 
                        product_image
                    SET 
                        status = ?

                    WHERE 
                        product_id = ".$data['productId']." AND
                        id = ".$data['productImageId']."";
                        
            
            $query = $this->conn->prepare($sql);
            $result = $query->execute([
                $data['status']
            ]);
            
            if (!$result){
                $this->log->error('setProductImage UPDATE section returned false');
                return false;
            }

            return $data['productImageId'];

        }else{
            //Record doesnt exist -- INSERT
            try {
                $this->conn->beginTransaction();

	        $fileCount = is_array($data['files']['name'])? count($data['files']['name']) : 1;
                $filePaths = $this->helper->uploadImage($data,'uploads/products/');

               //$fileCount = count($filePaths);

                for ($i = 0; $i < $fileCount; $i++){

                    $sql = 'INSERT INTO 
                                product_image(
                                    product_id,
                                    file_name, 
                                    path,
                                    size,
                                    type 
                                ) 
                            VALUES(?, ?, ?, ?, ?)';

                    $query = $this->conn->prepare($sql);

                    $result = $query->execute([
                        $data['productId'],
                        $filePaths[$i]['file_name'],
                        $filePaths[$i]['file_path'],
                        $filePaths[$i]['size'],
                        $filePaths[$i]['type']

                    ]);

                    if(!$result){
                        $this->log->error('setProductImage INSERT section returned false');
                        throw new PDOException;
                    }
                    
                }
                
                $this->conn->commit();
                return true;
            
            }catch (PDOException $e){
                $this->conn->rollback();
                $this->log->error('setProductImages was rolledback due to an error: '.$e->getMessage());
                return false;
            }
        }

    }
    public function addToExportMarketList($emId, $cId){

	$sql = 'INSERT INTO 
		    export_market_list(
			company_id,
			export_market_id 
		    ) 
		VALUES(?, ?)';
	$query = $this->conn->prepare($sql);

	$result = $query->execute([
	    $cId,
	    $emId
	]);

	if(!$result){
	    $this->log->error('addToExportMarketList inserting records returned false');
	    return false;
	}

        return $this->conn->lastInsertId();

    }
    //THE FOLLOWIGN FUNCTION BELOW CAN BE DISCARDED, NO LONGER IN USE
    // Updates or Inserts export markets for a user 
    public function setExportMarketList($data = null){

	$this->conn->beginTransaction();
	try{
		foreach ($data as $array){

		    if (isset($array['exportMarketListId'])){
			//record exist  --- update
			$sql = "UPDATE 
				    export_market_list 
				SET 
				    export_market_id = ?

				WHERE 
				    id = ".decrypt($array['exportMarketListId'])."";
			
			$query = $this->conn->prepare($sql);
			$result = $query->execute([
			    decrypt($array['exportMarketId'])
			]);
			
			if (!$result){
			    $this->log->error('setExportMarketList update section returned false');
			    return false;
			}

		    }else{
			//record doesn't exist --- insert
			$sql = 'INSERT INTO 
				    export_market_list(
					company_id,
					export_market_id 
				    ) 
				VALUES(?, ?)';
			$query = $this->conn->prepare($sql);

			$result = $query->execute([
			    $_SESSION['COMPANYDATA'][0]['id'],
			    decrypt($array['exportMarketId'])
			]);

			if(!$result){
			    $this->log->error('setExportMarketList insert section returned false');
			    return false;
			}

		    }

		}
		$this->conn->commit();

        } catch(PDOException $e) {
	    $this->log->error('setExportMarketList pdo exception -> '. $e->getMessage());
	    $this->conn->rollback();
	    return false;
        }
        return true;

    }
    //sets the featured status of a product
    public function setProductFeaturedStatus($pId, $isFeatured){
        
        $query = $this->conn->prepare('
		UPDATE 
                    products 
                SET 
                    is_featured = ?
                WHERE 
                    id = ?
	');

	$query->bindParam(1, $isFeatured);
	$query->bindParam(2, $pId);

	if($query->execute()){
            return true;
        }

        $this->log->error('Unable to set product feature status');

        return false;
    }
    //updates a sector featured profile
    public function setServiceFeaturedStatus($sId, $isFeatured){
        
        $query = $this->conn->prepare('
		UPDATE 
                    services
                SET 
                    is_featured = ?
                WHERE 
                    id = ?
	');

	$query->bindParam(1, $isFeatured);
	$query->bindParam(2, $sId);

	if($query->execute()){
            return true;
        }

        $this->log->error('Unable to set service feature status');
        return false;


    }
    //updates a sector featured profile
    public function setSectorFeaturedStatus($sId, $isFeatured){
        
        $query = $this->conn->prepare('
		UPDATE 
                    sector 
                SET 
                    is_featured = ?
                WHERE 
                    id = ?
	');

	$query->bindParam(1, $isFeatured);
	$query->bindParam(2, $sId);

	if($query->execute()){
            return true;
        }

        $this->log->error('Unable to set sector feature status');
        return false;


    }
    public function setProductMIBStatus($id, $status){
        
        $query = $this->conn->prepare('
		UPDATE 
                    products
                SET 
                    mib_catalogue_status = ?
                WHERE 
                    id = ?
	');

	$query->bindParam(1, $status);
	$query->bindParam(2, $id);

	if($query->execute()){
            return true;
        }

        $this->log->error('Unable to set product MIB status');
        return false;


    }
    //updates a comapanys featured profile
    public function setCompanyFeaturedStatus($cId, $isFeatured){
        
        $query = $this->conn->prepare('
		UPDATE 
                    company 
                SET 
                    is_featured = ?
                WHERE 
                    id = ?
	');

	$query->bindParam(1, $isFeatured);
	$query->bindParam(2, $cId);

	if($query->execute()){
            return true;
        }

        $this->log->error('Unable to set Company feature status');
        return false;


    }
    // Removes an export market from export market list (For a Company)
    public function removeExportMarketFromList($data = null){
        
        $query = $this->conn->prepare('
		DELETE FROM
                    export_market_list 
                WHERE 
                    id = ?

	');

	$id = decrypt($data['id']);
	$query->bindParam(1, $id);

        if (!$query->execute()){
            $this->log->error('removeExportMarketFromList returned false');
            return false;
        }

        return true;


    }
    public function removeProduct($pId, $cId, $updateBy){
        
        $query = $this->conn->prepare('
		UPDATE 
                    products 
                SET 
                    status = 0,
		    update_by = ?,
		    update_type = "removed",
		    update_on = now()
                WHERE 
                    id = ? AND 
                    company_id = ?                    

	');

	$query->bindParam(1, $updateBy);
	$query->bindParam(2, $pId);
	$query->bindParam(3, $cId);

        if (!$query->execute()){
            $this->log->error('removeProduct Returned false, product_Id: '.$productId.', userId: '.$_SESSION['USERDATA'][0]['user_id']);
            return false;
        }
        return true;



    }

    public function updateBuyerProfile($pUid, $pFname, $pLname, $pBname = null, $pDsec = null, $pUpdateBy){

        $fName = $this->sanitize($pFname);
        $lName = $this->sanitize($pLname);
        $bName = $this->sanitize($pBname);
        $desc  = (isset($pDesc)? substr($this->sanitize(trim($pDesc)), 0, 350) : NULL);

	$fullName = $fName.' '.$lName;

	try {

		$this->conn->beginTransaction();

		//updates user table
		$query = $this->conn->prepare('
			UPDATE 
				users 
			SET 
				full_name = ?, 
				update_by = ?,
				update_on = now(),
				update_type = "edit"
			WHERE 
				id = ?;
		');

		$query->bindParam(1, $fullName);
		$query->bindParam(2, $pUpdateBy);
		$query->bindParam(3, $pUid);

		$query->execute();

		// updates buyer table
		$query2 = $this->conn->prepare('
			UPDATE 
				buyer 
			SET 
				business_name = ?, 
				description = ?, 
				update_by = ?,
				update_on = now(),
				update_type = "edit"
			WHERE 
				user_id = ?;
		');

		$query2->bindParam(1, $bName);
		$query2->bindParam(2, $desc);
		$query2->bindParam(3, $pUpdateBy);
		$query2->bindParam(4, $pUid);

		$query2->execute();

		$this->conn->commit();
		return true;

	}catch(PDOException $e){

		$this->conn->rollback();
	        $this->log->error('updateBuyerProfile returned false for: '.$fullName.' error: '.$e->getMessage());
		return false;

	}

        

    }
    public function updateSuperUserProfile($pUid, $pFname, $pLname, $pEmail, $pUpdateBy){

        $fName = $this->sanitize($pFname);
        $lName = $this->sanitize($pLname);
        $email = $this->sanitize($pEmail);

	$fullName = $fName.' '.$lName;

        $query = $this->conn->prepare('
		UPDATE 
			users 
		SET 
			full_name = ?, 
			email = ?, 
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		WHERE 
			id = ?;
	');

	$query->bindParam(1, $fullName);
	$query->bindParam(2, $email);
	$query->bindParam(3, $pUpdateBy);
	$query->bindParam(4, $pUid);

        if (!$query->execute()){
            $this->log->error('updateSuperUserProfile returned false for: '.$fullName);
            return false;
        }

        return true;
        

    }
    // Updates the user profile (ADMIN OR BUYER ACCOUTNS)
    public function updateAdminProfile($pUid, $pFname, $pLname, $pEmail, $pUpdateBy){

        $fName = $this->sanitize($pFname);
        $lName = $this->sanitize($pLname);
        $email = $this->sanitize($pEmail);

	$fullName = $fName.' '.$lName;

        $query = $this->conn->prepare('
		UPDATE 
			users 
		SET 
			full_name = ?, 
			email = ?, 
			update_by = ?,
			update_on = now(),
			update_type = "edit"
		WHERE 
			id = ?;
	');

	$query->bindParam(1, $fullName);
	$query->bindParam(2, $email);
	$query->bindParam(3, $pUpdateBy);
	$query->bindParam(4, $pUid);

        if (!$query->execute()){
            $this->log->error('updateAdminProfile returned false for: '.$fullName);
            return false;
        }

        return true;
        

    }
    // Updates a companys profile 
    public function updateCompanyProfile($data = []){
        
        $ctv = $this->sanitize($data['ctv'] ?? NULL);
        $description = (isset($data['description'])? substr($this->sanitize(trim($data['description'])), 0, self::MAX_COMPANY_DESC_CHAR) : NULL);
        $name = $this->sanitize(($data['name'] ?? NULL)) ;
        $phone = $this->sanitize($data['phone'] ?? NULL);
        $address = $this->sanitize($data['address'] ?? NULL);
        $website = $this->sanitize($data['website'] ?? NULL);
        $district = $this->sanitize($data['district'] ?? NULL);
	$logoImg = $data['logoImagePath'] ?? NULL;
	$updateBy = $_SESSION['USERDATA']['user_id'] ?? 0;
	$tradeType = $data['tradeArea'] ?? 'none';
	//$companyTypeId = decrypt($data['companyType']) ;
	$estabDate = $data['establishedOn'] ?? null;
	//service company additional info
	$cId = $data['companyId'] ?? 0;

	$query = $this->conn->prepare('
		UPDATE 
		    company 
		SET 
		    name = ?,
		    description = ?,
		    website_link = ?,
		    phone = ?,
		    ctv = ?,
		    address = ?,
		    district = ?,
		    logo_img_path = ?,
		    update_by = ?, 
		    update_on = now(),
		    update_type = "edit",
		    trade_type = ?,
		    established_on = ?

		WHERE 
		    id = ?
	');

	$query->bindParam(1, $name);
	$query->bindParam(2, $description);
	$query->bindParam(3, $website);
	$query->bindParam(4, $phone);
	$query->bindParam(5, $ctv);
	$query->bindParam(6, $address);
	$query->bindParam(7, $district);
	$query->bindParam(8, $logoImg);
	$query->bindParam(9, $updateBy);
	$query->bindParam(10, $tradeType);
	$query->bindParam(11, $estabDate);
	$query->bindParam(12, $cId);

	if (!$query->execute()){
	    $this->log->error('unable to update company profile');
	    return false;
	}
        
        return true;


    } 
    // request a password reset
    public function request_password_reset($pEmail){
    
	$email = $this->sanitize($pEmail) ?? '';

	$query = $this->conn->prepare('
		call request_password_reset(?);
	');

	$query->bindParam(1, $email);

	$query->execute();
	
	return $query->fetch();

    }
    // resets the password of a user
    public function confirm_password_reset($reset_code, $pPassword){
    
	$query = $this->conn->prepare('
		call confirm_password_reset(?, ?, ?);
	');

	$query->bindParam(1, $reset_code);
	$query->bindParam(2, $pPassword);
	$query->bindParam(3, $this->pepper);

	$query->execute();
	
	return $query->fetch();


    }    // activates a buyer account or sets a company account to pending approval
    public function activate_account($activation_code){
    
	//setting user to pending activation
	$query = $this->conn->prepare('
		call activate_account(?);
	');

	$query->bindParam(1, $activation_code);

	$query->execute();
	
	return $query->fetch();


    }
    //
    public function approve_company_account($pCompanyId, $pApprovedBy,  $pStatus){
        
	//setting user to pending activation
	$query = $this->conn->prepare('
		call approve_company_account(?, ?, ?)
	');

	$query->bindParam(1, $pCompanyId);
	$query->bindParam(2, $pApprovedBy);
	$query->bindParam(3, $pStatus);

	$query->execute();
	
	return $query->fetch();


    }

    /*
    *   Functions below are used to help the process class in carring out additional functionality.
    *   Functions below do not communicate with the database.
    */

    //applies a basic sanitization to text inputs
    public function sanitize($pInput){

        $input = trim($pInput);

        if ($input == null || $input == ''){
                return null;
        }


        $search = array(
          '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
          '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
          '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
          '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

}

?>
