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
        $mail->addAddress($_SESSION["EmailID"]);  

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Welcome to Bid & Giddy';
        $mail->Body    = 'Dear '. $_SESSION["name"].',<br><br>
        Welcome to Bid & Giddy! We are thrilled to have you join our online auction community.<br><br>
        Your account has been successfully created. Here are your account details:<br>
        Username: '. $_SESSION["name"].'<br>
        Email Address: '. $_SESSION['EmailID'].'<br><br>
        Thank you for choosing Bid & Giddy. We hope you enjoy your experience and find exciting items to bid on.<br><br>
        If you have any questions or need assistance, feel free to contact our support team at <a href="mailto:smtn5431@gmail.com">smtn5431@gmail.com</a>.<br><br>
        Happy bidding!<br><br>
        Best regards,<br>
        Bid & Giddy Team';

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<script>";
        // echo "alert('User registered successfully.');";
        echo "setTimeout(function() {
            window.location.href = '../userPanel.php';
        }, 500);";
        echo "</script>";
    } catch (Exception $e) {
        echo "<script>alert('Mail could not be sent. Please try again later.');</script>";
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

header('loaction:index.php');

?>
