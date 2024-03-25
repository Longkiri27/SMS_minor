<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
</head>
<body>

<h2>Registration Form</h2>
<form action="send_otp.php" method="POST">
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br><br>
  
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br><br>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br><br>
  
  <input type="submit" value="Send OTP">
</form>

</body>
</html>
