<?php
include("../form-functions.php");
//for start session
@startsession();
$base_url = siteURL();
$base_url =$base_url.'/landing/fp-mailing-solutions';
include('mailsendclass.php');
$email_to = "sales@ecsdigital.ca";
if($_POST['titleForm1']){
	$sitename = $_POST['titleForm1']; 
}
elseif($_POST['titleForm2']){
	$sitename = $_POST['titleForm2'];
}
define('SITE_URL',$base_url);
$recaptcha_id = $_POST['recaptcha_id'];
//echo "<pre>"; print_r($_REQUEST); echo "</pre>";
//exit;
################################################################
if($_POST['recaptchaResponse'.$recaptcha_id]){
 $ch = curl_init();	
 curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, [
   'secret' => "6LcNhDQlAAAAAH6OvSRDodH9kleIc0qqvnEPMbcY",
   'response' => $_POST['recaptchaResponse'.$recaptcha_id],
   'remoteip' => $_SERVER['REMOTE_ADDR']
 ]);
}

$resp = json_decode(curl_exec($ch));
curl_close($ch);
if($resp->score >= 0.5)
{	
	if(isset($_REQUEST['formHidId1']) && $_REQUEST['formHidId1']=='footer-form')
	{
		$form_id =  $_REQUEST['formHidId1'];
	
		if( $_POST['afldToken']==''|| $_POST['atoken']=='')
		{
			?>
			<script language="javascript">
				alert('Invalid Data. Cannot Proceed.');
				window.location='<?php echo SITE_URL; ?>';
			</script>
			<?php
			exit();
		}
		else
		{
			$afldToken = $_POST['afldToken'];
			$token = $_POST['atoken'];
			$name=stripslashes($_POST['aname'.$afldToken]);
			$email=stripslashes($_POST['aemail'.$afldToken]);
			$phone=stripslashes($_POST['aphone'.$afldToken]);
			$comments=stripslashes($_POST['acomments'.$afldToken]);
			$email_fieldname=$_POST['aemail'.$afldToken];
			$phone_fieldname=$_POST['aphone'.$afldToken];
			$comments=nl2br($comments);
			$array=array(
				'aname'.$afldToken => "Name",
				'aemail'.$afldToken => "Email",					
				'aphone'.$afldToken => "Phone",
				'acomments'.$afldToken => "Questions/Comments"	
			);
			$form_name = $_POST['formName1'];
			$subject = $form_name." - " .$sitename;
		}
	}
	if(isset($_REQUEST['formHidId2']) && $_REQUEST['formHidId2']=='pop-up-form')
	{
		$form_id =  $_REQUEST['formHidId2'];
		if( $_POST['bfldToken']==''|| $_POST['btoken']=='')
		{
			?>
			<script language="javascript">
				alert('Invalid Data. Cannot Proceed.');
				window.location='<?php echo SITE_URL; ?>';
			</script>
			<?php
			exit();
		}
		else
		{
			$bfldToken = $_POST['bfldToken'];
			$token = $_POST['btoken'];
			$name=stripslashes($_POST['bname'.$bfldToken]);
			$phone=stripslashes($_POST['bphone'.$bfldToken]);
			$email=stripslashes($_POST['bemail'.$bfldToken]);
			$comments=stripslashes($_POST['bcomments'.$bfldToken]);
			$email_fieldname=$_POST['bemail'.$bfldToken];
			$phone_fieldname=$_POST['bphone'.$bfldToken];
			$comments=nl2br($comments);
			$array=array(
				'bname'.$bfldToken => "Name",
				'bemail'.$bfldToken => "Email",					
				'bphone'.$bfldToken => "Phone",
				'bcomments'.$bfldToken => "Questions/Comments"
			);
			$form_name = $_POST['formName2'];
			$subject = $form_name." - " .$sitename;
		}
	}	
}
else{ ?>
	 <script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<?php echo SITE_URL; ?>';
		</script>
<?php
exit();
}
/*if($name=="" || $email=="" || $phone==""){ ?>
 <script language="javascript">
		alert('Invalid Data. Cannot Proceed.');
		window.location='<?php echo SITE_URL; ?>';
		</script>
<?php
exit();
}*/
//Replacing the to, cc and bcc email address if @techwyseintl.com is found STARTS HERE  

$email=stripslashes($email);
$email_string = strstr($email, "@techwyseintl.com"); //Checking whether email string contains @techwyseintl.com
$to = ($email_string=="@techwyseintl.com")? stripslashes($email) : $email_to;
$bcc_email = ($email_string=="@techwyseintl.com")? "" : $email_bcc;
$cc_email = ($email_string=="@techwyseintl.com")? "" : $email_cc;
$con_subject="Confirmation - " .$sitename;


if($email!='')
{ 
$obj = new formTempclass();
$obj->name 		            = $name; // This is mantatory- Field name of name
$obj->email_fieldname 		= $email_fieldname; // This is mantatory- Field name of Email which send to user 
$obj->phone_fieldname 		= $phone_fieldname; // This is mantatory- Field name of Phone  which send to user
$obj->formname              = $form_name;
$obj->captcha_fieldname 	= $captcha_fieldname; // This is mantatory- Field name of Captcha  which send to user
$obj->session_fieldname 	= $session_fieldname; // This is mantatory- Field name of Session  which send to user
$obj->postval_array	        = $array;
$obj->sitename 				= $sitename; //Site Name
$obj->siteurl 				= $base_url;  // Site Url 
$obj->mail_banner 			= $base_url."/assets/images/mail-template.jpg"; // path of mail image 
$obj->rowbgcolor   			= "#fff"; // Bg color of each row
$obj->rowsubtitlebgcolor	= "#f00"; // Bg color of titles like persoonal Details
$obj->footerbgcolor			= "#f00";
$obj->footer_txtcolor		= "#fff";
$obj->bordercolor 			= "#000";
$obj->admin_mailto 			= $to;
$obj->admin_bcc_mail		= $bcc_email;
$obj->admin_cc_mail 		= $cc_email;
$obj->admin_subject 		= $subject;
$obj->con_subject			= $con_subject; // Confirmation mail Sublect
$obj->send_to_user          = true;
$obj->AdminmailSend(); 
//--- uncomment for view the tempahtes in browser
$body = $obj->UserTemplate($array);
$bodyadmin = $obj->adminTemplate($array);
// print_r($_POST);
// print_r($body);
// print_r($bodyadmin);exit;
//exit;
//--- uncomment for view the tempahtes in browser
//--------------------------------------adluge code--------------------------------------
require_once("clientcenter-api-library.php"); 
$lead = new clientcenter();
$lead->client_code="l9atyz2iq8ejsw2"; // Mandatory. Unique identification code.
$lead->fname=$name; //post  Value of first name \
$lead->email=$email;//post  Value of Email addess 
$lead->phone=$phone;//post Value of Phone Number 
$lead->comments=$comments;//post Value of Comments
$lead->postalcode=$postalcode; //post  Value of first name 
$lead->other_fields=json_encode($other_fields);//post Value of other_fields
$lead->status=1; // No need to change this
//No need to modify any of the below code
$lead->useragent = $_SERVER['HTTP_USER_AGENT']; //browser properties
$lead->remote_ip=$_SERVER['REMOTE_ADDR']; //ip address
$lead->referrer=$_SERVER['HTTP_REFERER'];// page source
$lead->contact_date=date("Y-m-d h:i:s");
$lead->search_engine=$_COOKIE['adl_durl'];
$lead->keyword=$_COOKIE['adl_key'];
$lead->source=$_COOKIE['adl_camp'];
$lead->randomnum=$_COOKIE['adl_rand'];
$lead->adl_ref=$_COOKIE['adl_ref'];
$lead->gclid=$_COOKIE['gclid'];	
$lead->send_to_adluge=true; // Set to true If you are sending leads to adluge //default true
$lead->send();
//echo "thank-you";exit;
//--------------------------------------------------------------------------------------------------
echo "<script>window.location.href='".$base_url."/thank-you.php';</script>";
}
else
{
echo "<script>window.location.href='".$base_url."';</script>";
}
?>
