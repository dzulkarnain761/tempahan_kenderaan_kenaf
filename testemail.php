<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

//Configure SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();   
$mail->SMTPAuth = true;
$mail->Username = 'dzulkarnain761@gmail.com';
$mail->Password = 'iksc wsbq jjch gzps';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;    

// Sender information
$mail->setFrom('dzulkarnain761@gmail.com', 'NIGGA');

// Receiver email address and name
$mail->addAddress('dzulkarnain761@gmail.com', 'MUHAMMAD DZULKARNAIN'); 
  
 
$mail->isHTML(true); // Set email format to HTML
 
$mail->Subject = 'PHPMailer SMTP test';
$mail->Body    = "<h1>Testing Email</h1>
                  <p>PHPMailer is working fine for sending mail.</p>
                  <p>This is a tutorial to guide you on PHPMailer integration.</p>
                  <a href='localhost/sistem_tempahan_kenderaan_kenaf/login.php'>Go to page</a>";

$mail->SMTPDebug = 2; // Enables debugging
$mail->Debugoutput = 'html'; // Output the debug as HTML


// Attempt to send the email
if (!$mail->send()) {
    echo 'Email not sent. An error was encountered: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}

$mail->smtpClose();
?>