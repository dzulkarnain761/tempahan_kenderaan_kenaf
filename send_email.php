<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/**
 * Send an email using PHPMailer.
 *
 * @param string $subject The subject of the email.
 * @param string $body The HTML content of the email.
 * @param array $recipients List of recipient email addresses.
 * @param string $fromEmail Sender's email address.
 * @param string $fromName Sender's name.
 * @return bool|string True on success, error message on failure.
 */
function sendEmail($subject, $body, $recipients, $fromEmail, $fromName = '')
{
    $mail = new PHPMailer(true);

    try {
        // Configure SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dzulkarnain761@gmail.com'; // Replace with your email
        $mail->Password = 'tdpt vwwi jsut eyvb'; // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender information
        $mail->setFrom($fromEmail, $fromName);

        // Add recipients
        foreach ($recipients as $recipient) {
            if (!empty($recipient)) { // Only add valid email addresses
                $mail->addAddress($recipient);
            }
        }
        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Email not sent. Error: " . $mail->ErrorInfo;
    } finally {
        $mail->smtpClose();
    }
}


?>
