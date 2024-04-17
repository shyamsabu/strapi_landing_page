<?php
date_default_timezone_set('America/Los_Angeles');
class formTempclass
{ 
public   $temphead;
public   $tempfooter;
public   $sitename;
public   $mail_banner;
public   $siteurl;
public   $body;
public   $rowbgcolor;
public   $rowsubtitlebgcolor;
public   $footerbgcolor;
public   $footer_txtcolor;
public   $bordercolor;
public   $email_fieldname;
public   $phone_fieldname;
public   $captcha_fieldname;
public   $session_fieldname;
public   $admin_mailto; 
public   $admin_bcc_mail;
public   $admin_cc_mail ;
public   $admin_subject ;
public   $con_subject;
public   $postval_array;
public   $name;
public   $formname;

function formTemp()
{
	 $array    =  $this->postval_array;	
	 $array2   = $_POST; 

			  $temphead='';
		foreach( $array as $key => $value)
			   {
					$label=$value;
					if(!is_array($_POST[$key])){
					if( trim($_POST[$key])!="")
					 {	  
						if($key == $this->email_fieldname)
							{
							 $postval = '<a href="mailto:'.stripslashes( $_POST[$key]).'">'.stripslashes( $_POST[$key]).' </a>';
							} 
						else 
							$postval= stripslashes(nl2br($_POST[$key]));
					
						$temphead.='<tr><td style="width:30%;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>'.   $label .'</strong></td><td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">'.nl2br($postval).'</td>  </tr>'; 
					  }
					}
					else{
						if(is_array($_POST[$key])){
							$postval = nl2br(implode("\n", $_POST[$key]));
							$temphead.='<tr><td style="width:30%;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>'.   $label .'</strong></td><td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">'.$postval.'</td>  </tr>';
						}
					}
				}
	
	 return $temphead;	
}

function adminTemplate($array)
{ 


    $topbody1   = $this->sub_topMsg('admin');
	$topbody    = $this->formTemp($array);
	$tempfooter = $this->Admintempfooter();
	
    return   $topbody1.$topbody.$tempfooter;
	
}

 function sub_topMsg($arg)
 {
  $topbody1 = $this->temphead();
  if($arg=='UserTemp'){
	
   $topmsg='<tr>
    <td colspan="2"  style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">    
     
     Hello ' .stripslashes($this->name).',
     <br />
      <br />
    Thank you for contacting '.stripslashes($this->sitename).'. Your inquiry has been received and we will contact you within the next 24 hours or the next business day. The details of your request are provided below for your reference:  <br /> <br />
   </td>
  </tr> ';
  } else {
   $topmsg=' <tr>
    <td colspan="2" class="tr-head-class" style="background:'. $this->rowsubtitlebgcolor .';
	color:#FFF;
	height:20px;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;" ><strong>Personal Details</strong></td>
  </tr>';
  
  }
  return $topbody1.$topmsg; 
 
  }
  
function UserTemplate($array)
{ 
$topbody1 = $this->sub_topMsg('UserTemp');

	$topbody = $this->formTemp($array);
	$tempfooter = $this->user_tempfooter();
    return $topbody1. $topbody. $tempfooter;
}

public function temphead()
{
$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="700px" cellpadding="0" cellspacing="0"  style="width:700px;
	border-left:1px solid '. $this->bordercolor .'; 
	border-top:1px solid '. $this->bordercolor .';
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#000;
	margin:0 auto;">
  <tr style="background:'. $this->rowbgcolor .';">
    <td colspan="2" style="padding:0px !important;border-right:1px solid '. $this->bordercolor .';
	border-bottom:0px solid '. $this->bordercolor .';
	">
	
	<a href="'.$this->siteurl.'" title="'. $this->sitename.'" style="font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#000;
	text-decoration:underline;">
	<img src="'.$this->mail_banner.'" alt="'. $this->sitename.'"   /></a>
</td>
  </tr>
 '; 
return $body;
}

public function tempheaduser()
{
$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<table style="width:700px;border-left:1px solid '. $this->bordercolor .';border-top:1px solid '. $this->bordercolor .';font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#000;margin:0 auto" width="700px" cellspacing="0" cellpadding="0">
        <tbody>
          <tr style="background:#fff"><td colspan="2" style="padding:0px!important;"> <a href="'.$this->siteurl.'" title="'. $this->sitename.'" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#000;text-decoration:underline"> <img src="'.$this->mail_banner.'" alt="'. $this->sitename.'" style="display:block" class="CToWUd">
                </a>
            </td>
          </tr>'; 
return $body;
}

function Admintempfooter()
{
$body='
<tr style="background:'. $this->rowbgcolor .';">
    <td colspan="2" class="tr-head-class" style="background:'. $this->rowsubtitlebgcolor .';
	color:#FFF;
	height:20px;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>Form Submitted Details</strong></td>
  </tr>
  <tr style="background:'. $this->rowbgcolor .';">
    <td width="77" style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>Page Name</strong></td>
    <td width="621" style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a></td>
  </tr>
  <tr style="background:'. $this->rowbgcolor .';">
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>IP Address</strong></td>
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">'.$_SERVER['REMOTE_ADDR'].'</td>
  </tr>
   <tr style="background:'. $this->rowbgcolor .';">
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>Date</strong></td>
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">'.date("Y-M-d").'</td>
  </tr>
   <tr style="background:'. $this->rowbgcolor .';">
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><strong>Time</strong></td>
    <td style="border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;">'.date("H:i:s").'</td>
  </tr>  
  <tr style="background:'. $this->rowbgcolor .';">
    <td colspan="2" class="footer-template" style="background:'. $this->footerbgcolor .';
	text-align:center;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><a  href="'.$this->siteurl.'" target="_blank" title="'. $this->sitename.'" style="color:'. $this->footer_txtcolor .' ; 
	text-align:center;
	text-decoration:none !important;">'. $this->sitename.'</a></td>
  </tr>
</table>
</body>
</html>';
return  $body;
}


public function user_tempfooter()
{
$body=' <tr>
		<td colspan="2" class="footer-template" style="background:'. $this->footerbgcolor .';
	text-align:center;border-right:1px solid '. $this->bordercolor .';
	border-bottom:1px solid '. $this->bordercolor .';
	padding:5px;"><a  href="'.$this->siteurl.'" target="_blank" title="'. $this->sitename.'" style="color:'. $this->footer_txtcolor .' ; 
	text-align:center;
	text-decoration:none !important;">'. $this->sitename.'</a></td>
	  </tr>
	</table>
	</body>
	</html>';
return  $body;

}
public function validation()
{
  $badStrings = array("Content-Type:", 
		"MIME-Version:", 
		"Content-Transfer-Encoding:", 
		"http:", 
		"www.", 
		//"Email", 
		"mailto:", 
		"URL:", 
		"bcc:", 
		"cc:",
		"http://www.",
		"URL=http://www.",	
		"<script src=http://",
		"<a href=http://",
		"iframe",
		 "142536",
		 "123456",
		"src=http://",
		"<a href",
		"viagra",
		".html",
		".js",
		".jsp",
		".cgi",
		".pl",
		".asp",
		".aspx",
		".htm",
		".exe");
$arr = $_POST;
unset($arr['base_url']);
foreach ($arr as $key => $value) {
	if(is_array($value)){
		unset($arr[$key]);
	}
}
foreach($arr as $k => $v)
{
	//${$key} = $val;
    foreach($badStrings as $v2)
    { 
 	  if(strpos($v, $v2) !== false)
	   {       
		// echo $v.'mm'.$v2;
		?>
		<script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
	window.location='<?php echo $this->siteurl; ?>';
		</script>
		<?php
        exit(); 
       }
    }
}
if(!isset($_SERVER['HTTP_USER_AGENT']))
{ 
	die("Forbidden - You are not authorized to view this page");   exit; 
}
if(!$_SERVER['REQUEST_METHOD'] == "POST")
{ 
	die("Forbidden - You are not authorized to view this page");   exit;     
}
unset($k, $v, $v2, $badStrings); 
}
 function AdminmailSend()
 {
      $to =  $this->admin_mailto;  
 	  $this->validation(); 
 $useremail = $this->email_fieldname;
	//$useremail = $_POST["$useremail"];
		if($useremail!=""){
	    if(!filter_var($useremail, FILTER_VALIDATE_EMAIL))
		{
			
			$proceed = "false";
			?>
        <script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<?php echo $this->siteurl; ?>';
		</script>
		<?php
		exit();
		}
		else
		{
			$proceed = "true";
		}
		}
		#######################
		$userphone = $this->phone_fieldname;
		$userphone = $_POST["$userphone"];
	
		if (preg_match('#^[\s0-9-()]*$#i', trim($userphone)))
		{
		  $proceed = "true";
		}
		else
		{
		  $proceed = "false";
		?>
        <!-- <script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<?php echo $this->siteurl; ?>';
		</script> -->
		<?php
		//exit();
		}
		 $array =   $this->postval_array;
		 $body  =   $this->adminTemplate($array);
		 if($proceed == "true")
		 {
			$subject=   $this->admin_subject ;						
			$headers= "MIME-Version: 1.0\r\n";
			$headers.="Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
			$headers.= "From:".$useremail."\r\n";
			$headers.= "Bcc:". $this->admin_bcc_mail."\r\n";
			$headers.= "Cc:". $this->admin_cc_mail."\r\n";
			$from_mail= $useremail;
			@mail($to,$subject,$body,$headers);
			// $mail1 = new PHPMailer(true);
			// try {
			// 	//Server settings
			// 	//$mail1->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			// 	$mail1->isSMTP();                                            //Send using SMTP
			// 	$mail1->Host       = 'wysework.net';                     //Set the SMTP server to send through
			// 	$mail1->SMTPAuth   = true;                                   //Enable SMTP authentication
			// 	$mail1->Username   = 'ecsdigital@wysework.net';                     //SMTP username
			// 	$mail1->Password   = '^SGk};wY$==M';                              //SMTP password
			// 	$mail1->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			// 	$mail1->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			// 	//Recipients
			// 	$mail1->setFrom('ecsdigital@wysework.net');
			// 	$mail1->addAddress($to);     //Add a recipient
			// 	if($from_mail){
			// 		$mail1->addReplyTo($from_mail);
			// 	}
			// 	$mail1->isHTML(true);
			// 	$mail1->Subject = $subject;
			// 	$mail1->MsgHTML($body);
			// 	//$mail1->Body    = $body;
			// 	$mail1->send();
			// }catch (Exception $e) {
    		// echo "Message could not be sent. Mailer Error: {$mail1->ErrorInfo}";
			// }
		 } 
		 if( $this->send_to_user==true)
		 {
		   $this-> user_mailSend();
		 }
 }
 function user_mailSend()
 { 
        $array =   $this->postval_array;
 	    $this->validation();
	    $useremail = $this->email_fieldname;
		$useremail = $_POST["$useremail"];
		$subject   = $this->con_subject; 
		
	 if(!filter_var($useremail, FILTER_VALIDATE_EMAIL))
		{
			 $proceed = "false";
		}
		else
		{
			$proceed = "true";
		}
		###########
	$userphone = $this->phone_fieldname;
	$userphone = $_POST["$userphone"];

	if (preg_match('#^[\s0-9-()]*$#i', trim($userphone)))
		{
		  $proceed = "true";
		}
		else
		{
		  $proceed = "false";
		?>
        <!-- <script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<?php echo $this->siteurl; ?>';
		</script> -->
		<?php
		//exit();
		}
#################	
  	 $body = $this->UserTemplate($array);

	 if($proceed=='true')
	  {
	    $subject = $this->con_subject ;						
		$headers = "MIME-Version: 1.0\r\n";
		$headers.="Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
		$headers.= "From:".$this->admin_mailto."\r\n";
	  // echo $body;
	  // echo '<br>from'.$this->admin_mailto;
		$useremail=$this->email_fieldname;
		// echo $this->email_fieldname;
		// echo "usermail".$useremail;
		// echo "<br>";
		// echo "subject".$subject;
		// echo "<br>";
		// echo "body".$body;
		// echo "<br>";
		// echo "header".$headers;

		@mail($useremail,$subject,$body,$headers);
		$from_mail=$this->admin_mailto;

		// $mail2 = new PHPMailer(true);
		// try {
		// 	//Server settings
		// 	//$mail2->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		// 	$mail2->isSMTP();                                            //Send using SMTP
		// 	$mail2->Host       = 'wysework.net';                     //Set the SMTP server to send through
		// 	$mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
		// 	$mail2->Username   = 'ecsdigital@wysework.net';                     //SMTP username
		// 	$mail2->Password   = '^SGk};wY$==M';                               //SMTP password
		// 	$mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		// 	$mail2->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		// 		 //Recipients
		// 	$mail2->setFrom('ecsdigital@wysework.net');
		// 	$mail2->addAddress($useremail);     //Add a recipient
		// 	$mail2->addReplyTo($from_mail);
		// 	$mail2->isHTML(true);
		// 	$mail2->Subject = $subject;
		// 	$mail2->MsgHTML($body);
		// 		 //$mail2->Body    = $body;
		// 	$mail2->send();
		// }catch (Exception $e) {
		// 	echo "Message could not be sent. Mailer Error: {$mail2->ErrorInfo}";
		// }
	 }
 } 
 //For verifying the form token
	public function verifyFormToken($form, $token) {

		// check if a session is started and a token is transmitted, if not return an error
	    if(!isset($_SESSION[$form.'_token'])) { 
	        return 'N';
	    }else if(!isset($token)) {
	        return 'N';
	    }else if ($_SESSION[$form.'_token'] !== $token) {
	        return 'N';
	    }else{
		    return 'Y';
		}
	}

	//start session
	public function startsession() {

		if (version_compare(phpversion(), '5.4.0', '<')) {
		  	if(session_id() == '') {
		    	session_start();
		  	}
		}else{
		  	if (session_status() == PHP_SESSION_NONE) {
		      	session_start();
		  	}
		}
	}
}
?>