<?php
session_start(); // Start PHP session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    // Store user details in session
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    
    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);
    
    // Store the OTP in the session
    $_SESSION['otp'] = $otp;

    // Send the OTP via email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'importshanse@gmail.com'; // Your gmail
    $mail->Password = 'wyxg gmju nyqt rtwa'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('importshanse@gmail.com'); // Your gmail
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'OTP for Registration';
    $mail->Body = "Dear $name:<br><br>"
    . "Please enter the following code <strong>$otp</strong> to verify your account.<br>"
    . "Please pay attention:<br>"
    . "After verification, you will be able to modify your password, login email address and cell phone number.<br>"
    . "If you did not apply for a verification code,<br>"
    . "please sign in to your account and change your password to ensure your account's security.<br>"
    . "In order to protect your account, please do not allow others access to your email.";

    
    if ($mail->send()) {
        // Redirect to OTP verification page
        header("Location: otp_verification.html");
        exit();
    } else {
        echo "Failed to send OTP. Please try again later.";
    }
}
?>

