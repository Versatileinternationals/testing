<?php
	/*
		THIS EMAIL CLASS USES PHPMailer
	*/	

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require './external/PHPMailer/src/Exception.php';
	require './external/PHPMailer/src/PHPMailer.php';
	require './external/PHPMailer/src/SMTP.php';


/**
* Email class allows for the email to a specified email.
*/
class Email 
{

	private $log;

	private $sender_Email;
	private	$sender_Name;
	private $sender_Password;
	//private $site_Link;
	private $subject;
	//private $body;
	
	function __construct()//link to a site of your choice
	{
	        $this->log = new iLog();

		$this->set_Sender_Name(SENDER_NAME);
		$this->set_Sender_Email(SENDER_EMAIL);
		$this->set_Sender_Password(SENDER_PASS);
		//$this->set_Link($link);

	}

	function set_Sender_Email($sender){

		$this->sender_Email = $sender;
	}
	function get_Sender_Email(){

		return $this->sender_Email;
	}

	public function set_Sender_Name($name){

		$this->sender_Name = $name;

	}
	public function get_Sender_Name(){

		return $this->sender_Name;

	}
	public function set_Sender_Password($pass){

		$this->sender_Password = $pass;

	}
	public function get_Sender_Password(){

		return $this->sender_Password;

	}
	public function set_Subject($text){

		$this->subject = $text;
	}
	public function get_Subject(){

		return $this->subject;
	}

	//takes two parameters the recievers name and the recievers email adress
	function send($recipient, $message){

		//Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = $this->sender_Email;                    //SMTP username
		    $mail->Password   = $this->sender_Password;                 //SMTP password
		    $mail->SMTPSecure = 'tls';				        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom($this->sender_Email, $this->sender_Name);
		    $mail->addAddress($recipient);               		//Name is optional

		    //Content
		    $mail->isHTML(true);                                  	//Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = $message;

		    if ($mail->send()){

			    return true;

		    }
		    return false;
			

		} catch (Exception $e) {
		    $this->log->error('PHPMailer Failed to send message : '.$mail->ErrorInfo);
		}		

	}




}
?>
