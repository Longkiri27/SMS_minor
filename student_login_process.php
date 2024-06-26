<?php
// Start session
session_start();

// Database connection
include 'db_connection.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve email and password from form
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize input to prevent SQL injection
$email = mysqli_real_escape_string($conn, $email);

// SQL query to retrieve user details based on email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 1) {
    // User found, retrieve hashed password
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];

    // Debugging: Output stored email, stored hashed password, user-entered email, and user-entered password
    echo "Stored Email: " . $row['email'] . "<br>";
    echo "Stored Hashed Password: " . $hashed_password . "<br>";
    echo "User Entered Email: " . $email . "<br>";
    echo "User Entered Password: " . $password . "<br>";
    // Verify the password
echo "User Entered Password: " . $password . "<br>";
echo "Hashed Password from Database: " . $hashed_password . "<br>";
echo "Password Verification Step Reached.<br>";

if (password_verify($password, $hashed_password)) {
    // Password is correct, login successful
    $_SESSION['email'] = $row['email'];
    header("Location: student_dashboard.php"); // Redirect to dashboard or any other page
    exit();
} else {
    echo "Password verification failed.<br>";
}


    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, login successful
        $_SESSION['email'] = $row['email'];
        header("Location: student_dashboard.php"); // Redirect to dashboard or any other page
        exit();
    } else {
        // Incorrect password
        echo '<script>alert("Invalid Username or password"); window.location.href = "student_login.html";</script>';
        exit();
    }
} else if (mysqli_num_rows($result) == 0) {
    // No user found
    echo '<script>alert("No user found. Please register."); window.location.href = "student_login.html";</script>';
    exit();
} else {
    // More than one user found (should not happen)
    echo '<script>alert("Multiple users found. Please contact support."); window.location.href = "student_login.html";</script>';
    exit();
}

// Close connection
mysqli_close($conn);
?>
