<?php

function approvedModelEmail($email, $title) {
    // Load Composer's autoloader
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    $check = false; // Initialize $check to false

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'smtn5431@gmail.com';
        $mail->Password   = 'yypl tvtb dffm mkrk';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('smtn5431@gmail.com', 'Bid & Giddy');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Product Approved - Bid & Giddy';
        $mail->Body    = 'Dear ' . $email . ',<br><br>
        Your product titled "' . $title . '" has been approved by the admin.<br><br>
        Thank you for listing your product with Bid & Giddy.<br><br>
        Best regards,<br>
        Bid & Giddy Team';

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Attempt to send the email
        $mail->send();
        $check = true; // Set $check to true if the email was sent successfully
    } catch (Exception $e) {
        // Handle exceptions (e.g., log the error)
        echo "Error sending email: {$mail->ErrorInfo}"; // You can uncomment this line for debugging
    }

    return $check; // Return the status of email sending (true or false)
}

?>
