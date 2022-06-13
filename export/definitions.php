<?php 
    //Database connection constants
    DEFINE('DB_USER', 'root');
    DEFINE('DB_PASS', 'Enter123*');
    //DEFINE('DB_USER', 'exportBelize');
    //DEFINE('DB_PASS', 'f(>V(4he');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_NAME', 'export');
    DEFINE('BASE_URL', ($_SERVER['REQUEST_SCHEME'] ?? 'https').'://'.($_SERVER['SERVER_NAME']).'/export/');

    //Encryption
    DEFINE ('CIPHER_TYPE', 'AES-128-CTR');// Store the cipher method
    DEFINE ('CIPHER_KEY','H45@#T3p&GP$%d6@_ptr_D@4MUagfsH_122#w777');// Store the encryption key
    DEFINE ('CIPHER_OPTIONS', 0);
    DEFINE ('ENCRYPTION_IV','7145432623623413');// Non-NULL Initialization Vector for encryption
    DEFINE ('DECRYPTION_IV','7145432623623413');// Non-NULL Initialization Vector for decryption

    // for email class
    DEFINE ('SENDER_EMAIL', 'beltraide.export.belize@gmail.com');//the sender of the emails 
    DEFINE ('RECIEVER_EMAIL', '7son7of7god@gmail.com');//reciever of the emails from contact us
    DEFINE ('SENDER_NAME', 'ExportBelize');
    DEFINE ('SENDER_PASS', 'kgkqgfueoijzhxif');
       
    // Website definitions
    DEFINE ('PLATFORM_NAME', 'ExportBelize');
	
    //Google Recaptach Credentials
    DEFINE ('RECAPTCHA_SECRET', '6LeankcbAAAAAFQokTzcBTC_D95zNfVsjdDFXcii');
    DEFINE ('RECAPTCHA_SITE_KEY', '6LeankcbAAAAAA_5-9WarEvxlZYCwfu-cuLj2KcE');
    

?>
