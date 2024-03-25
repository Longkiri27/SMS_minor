<?php
session_start(); // Start PHP session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve OTP entered by the user
    $otp_entered = $_POST['otp'];

    // Retrieve the stored OTP from the session
    $stored_otp = $_SESSION['otp'];

    // Verify the entered OTP
    if ($otp_entered == $stored_otp) {
        // OTP is correct, proceed with registration

        // Retrieve other registration data from session
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];

            // Store other registration data in session
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $name;
          $_SESSION['password'] = $password;

        // Include database connection file
        include 'db_connection.php';


        // SQL query to insert data into the users table with hashed password
        $insert_query = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')";

        if (mysqli_query($conn, $insert_query)) {
            // Registration successful

            // Send email containing registration details to your Gmail
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'importshanse@gmail.com'; // Your Gmail address
            $mail->Password = 'wyxg gmju nyqt rtwa'; // Your Gmail app password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('RASsupport@org.in', 'Rajesh Aryan Subham Private Institute');
            $mail->addAddress('importshanse@gmail.com'); // Your Gmail address
            $mail->isHTML(true);
            $mail->Subject = 'New User Registration';
            $mail->Body = "Dear $name,<br><br>"
            . "Your $email has been successfully verified. Thank you for confirming your details.<br>"
            . "If you have any questions or need further assistance, please feel free to contact us.<br><br>"
            . "Best regards,<br>"
            . "Rajesh Aryan Subham Private Institute";


            if ($mail->send()) {
                // Email sent successfully
                header("Location: registration_success.php");
                exit();
            } else {
                // Email sending failed
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        } else {
            // Registration failed
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    } else {
        // Invalid OTP, display error message
        echo "Invalid OTP. Please try again.";
    }
}
?>
