<?php

session_start();

    //Load Composer's autoloader
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        
        //Server settings
        $mail->isSMTP();                                      
        $mail->Host       = 'smtp.gmail.com';                      
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'smtn5431@gmail.com';                   
        $mail->Password   = 'yypl tvtb dffm mkrk';                             
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;      
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('smtn5431@gmail.com', 'Bid & Giddy');
        $mail->addAddress($_SESSION["otp_info"]["email"]);  

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Bid & Giddy Password Reset';
        $mail->Body    = 'Dear '. $_SESSION["otp_info"]["name"].',<br><br>
        Your password reset request has been received. Please find below your OTP (One-Time Password) for resetting your password:<br><br>
        OTP: '. $_SESSION["otp_info"]["otp"] .'<br><br>
        Please use this OTP to reset your password. If you did not request this password reset, please ignore this email.<br><br>
        Thank you for using Bid & Giddy!<br><br>
        If you need further assistance, feel free to contact our support team at <a href="mailto:smtn5431@gmail.com">smtn5431@gmail.com</a>.<br><br>
        Best regards,<br>
        Bid & Giddy Team';
        $mail->AltBody = 'Your password reset request has been received. Please use the following OTP to reset your password: '. $_SESSION["otp_info"]["otp"] .'.';

        $mail->send();
        echo "<script>";
        // echo "alert('User registered successfully.');";
        echo " window.location.href = '../otpCheck.php';";
        echo "</script>";
    } catch (Exception $e) {
        echo "<script>alert('Mail could not be sent. Please try again later.');</script>";
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

// header('loaction:index.php');

?>
 