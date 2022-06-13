<?php
    // helper.php defines functions that can be used throughout the application 
    // for example encrpt will be used to encrpt sensative data in the class.interface.php
    // by which decrypt will be used in the index.php to decrpt $_GET encrypted Data

    //Encrypts data
    function encrypt($string){ 
        
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length(CIPHER_TYPE); 
        
        // Use openssl_encrypt() function to encrypt the data 
        $encryption = openssl_encrypt($string, CIPHER_TYPE, CIPHER_KEY, CIPHER_OPTIONS, ENCRYPTION_IV); 

        return base64_encode($encryption);
    } 
    //Decrypts encrypted data
    function decrypt($hash){ 

        // Use openssl_decrypt() function to decrypt the data 
        $data = openssl_decrypt (base64_decode($hash), CIPHER_TYPE, CIPHER_KEY, CIPHER_OPTIONS, DECRYPTION_IV); 

        return $data;

    }
 
    //validates a social media url
    function validateURL($url, $type) {
	    if (!filter_var($url, FILTER_VALIDATE_URL)) {
		return false;
	    }

	    $parts = parse_url($url);
	    $domain = str_ireplace('www.', '', $parts['host']);
	    $socialNetwork = explode('.', $domain);

	    switch ($type) {
		case 'facebook' :
		    return $socialNetwork[0] == 'facebook';

		case 'linkedin':
		    return $socialNetwork[0] == 'linkedin';

		case 'twitter':
		    return $socialNetwork[0] == 'twitter';

		case 'instagram':
		    return $socialNetwork[0] == 'instagram';
		
		default:
		    return false;
	    }
    }

    //compresses an image and uploads it to the destination specified
    function compressImage($source, $destination, $quality) {

	
	    list( $width, $height, $type, $attr ) = getimagesize( $source );
	    $result = false;

	    switch( image_type_to_mime_type($type) ){

		case 'image/jpeg':

		    $image = imagecreatefromjpeg( $source );
		    $result = imagejpeg( $image, $destination, $quality );
		    break;

		case 'image/png':
		
		    $quality = floor($quality/10); // imagepng quality scale is from 0 - 9 
		    $image = imagecreatefrompng( $source );

		    $result = imagepng( $image, $destination, $quality );
		
		    break;
		default:
		    return false;
		    break;              
	    }

	    imagedestroy($image);
	    return $result;

    }

    // Uploads only 1 image
    function uploadImage($filename, $tmpName, $uploadDir, $imgQuality = 60){

	$result = [];
	$newFilePath = '';

	// Count total files

	$file = pathinfo($filename);
	//$file = pathinfo($data['files']['name']);

	$newFilePath = $uploadDir.$file['filename'].'_'.time().'.'.$file['extension'];

	// Upload file
	if (compressImage($tmpName, $newFilePath, $imgQuality)){
	    $result = array(
		'error' => 0,
		'message' => 'success',
		'file_name' => $filename,
		'file_path' => $newFilePath,
	    );
	}else{
	    $result = array(
		'error' => 1,
		'message' => 'Failed to upload Image'
	    );
	}

        return $result;

    }
    // Uploads one or more images 
    function uploadImages($data = [], $uploadDir, $imgQuality = 60){

        if(!empty($data['files'])){

            $fileNames = array();
            $newFilePath = '';

            // Count total files
            $fileCount = is_array($data['files']['name'])? count($data['files']['name']) : 1;
	
	    if ($fileCount > 1){

		    // Looping all files
		    for($i = 0; $i < $fileCount; $i++){

			$file = pathinfo($data['files']['name'][$i]);

			$newFilePath = $uploadDir.$file['filename'].'_'.time().'.'.$file['extension'];

			if (compressImage($data['files']['tmp_name'][$i], $newFilePath, $imgQuality)){
			    $type = explode('/', $data['files']['type'][$i]);
			    $fileNames[$i] = array(
				'file_name' => $data['files']['name'][$i],
				'file_path' => $newFilePath,
				'size' => $data['files']['size'][$i],
				'type' => $type[0]
			    );
			}else{

			    return false;
			}

		    }

	    }else{


		$file = pathinfo($data['files']['name']);

		$newFilePath = $uploadDir.$file['filename'].'_'.time().'.'.$file['extension'];

		// Upload file
		if (compressImage($data['files']['tmp_name'], $newFilePath, $imgQuality)){
		    $type = explode('/', $data['files']['type']);
		    $fileNames = array(
			'file_name' => $data['files']['name'],
			'file_path' => $newFilePath,
			'size' => $data['files']['size'],
			'type' => $type[0]
		    );
		}else{

		    return false;
		}

	    }

            return $fileNames;

        }else{
            return false;
        }


    }


   
?>
