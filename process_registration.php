<?php
session_start(); // Start PHP session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Your code to send the OTP and store it in the session

    // Store other registration data in session
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;

    // Redirect to OTP verification page
    header("Location: otp_verification.html");
    exit();
}
?>
