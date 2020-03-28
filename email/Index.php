<?php
// A possible sendEmail  Function using PHPMailer.php



// replace XXXXX with appropriate information
require_once('./class.PHPMailer.php');


set_time_limit(0);

$messageHTML = '<html>
<head>
<title>HTML email</title>
</head>
<body>
<font color="green"><b>Important   stuff</font></b><br> 
We are have our Grand Opening <br> 
You are invited <br> 
<a href="http://www.indeed.com/viewjob?jk=c86f8129249f8304&q=c%23&l=Augusta,GA&tk=18899c2de06ag7tq&from=ja&alid=775532c681841a1c&utm_source=jobseeker_emails&utm_medium=email&utm_campaign=job_alerts">Important stuff</a><br><br> 
</body>
</html>
';

$message =  ' This is information that will not be HTML friendly for Emails that do not support HTML';
 

$email = new PHPMailer();

$email->IsSMTP();

// The jabezdailey in the following will need to be adjusted as with Host if not using gmail
// $email->IsSendmail();
$email->Host       = "smtp.gmail.com";   //Will need to be modified
$email->SMTPAuth   = true;  
// $email->Port       = 465;                // The PORTS will vary
$email->Port       = 465;
$email->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)  
$email->SMTPSecure = 'ssl';            // ssl is most recent but may need tls 
// $email->SMTPSecure = 'ssl';    
$email->Username   = "murielbroom@gmail.com"; // SMTP account username Will need to be modified
$email->Password   = "applepies4me";        // SMTP account password Will need to be modified
$email->SetFrom('murielbroom@gmail.com', 'applepie4me');  //Will need to be modified – identifies email of sender
// $email->MsgHTML($message);
$email->SingleTo  = true;	// true allows that only one person will receive an email per array group
$email->From      = 'murielbroom@gmail.com'; //Will need to be modified – identifies email of sender
$email->FromName  = 'Muriel Broom'; //Will need to be modified – identifies email of sender
$email->Subject   = 'Purchases from Guitar Shop PHP Class'; // appears in subject of email
$email->Body      = $messageHTML ;  // the body will interpret HTML - $messageHTML identified above
$email->AltBody = $message;            // the AltBody will not interpret HTML - $message identified above
$destination_email_address = 'jabezdailey@icloud.com'; // Destination address
$destination_user_name = 'Bez'; // Destination name

// $email->AddAddress( 'xxxx@xxxx.xxx' );

//$file_to_attach = 'images.pdf';  // Used if you want attachments to email - This is the name of your attachment file.
                                 // File has to be located in same folder as index.php
//$email->AddAttachment( $file_to_attach ); // Used if you want attachments to email

       //$email->AddAddress($this->$destination_email_address, $destination_user_name); 
       $email->AddAddress($destination_email_address, $destination_user_name);
	// AddAddress method identifies destination and sends email	
         if(!$email->Send()) {
         echo "Mailer Error: " . $email->ErrorInfo;
          } else {
           echo "Message sent!";
          }
  
	


?>
