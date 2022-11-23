<?php
session_start();

// this function logs the user in
function register(){
	require "dbconn.php";

	// function only executes if the form is submitted
	if($_SERVER["REQUEST_METHOD"] != "POST") return;
	
	$username = htmlspecialchars($_POST["user"]);
	$email = htmlspecialchars($_POST["email"]);
  	$phone = htmlspecialchars($_POST["phone"]);
	$password = htmlspecialchars($_POST["regpass"]);
	$hashedPassword = crypt($password, '$1$kit202');
	
	$userSQL = "SELECT * FROM User WHERE Username='$username'";
  	$emailSQL = "SELECT * FROM User WHERE EmailAddress='$email'";

  	$checkUser = mysqli_query($conn, $userSQL);
 	$checkEmail = mysqli_query($conn, $emailSQL);

	if (mysqli_num_rows($checkUser) > 0) {
    		echo "<br>";	
  		echo "<p style=\"color : red\" >Sorry, this username is already taken. Please select another one! </p>"; 	
  	}
	else if(mysqli_num_rows($checkEmail) > 0){
    		echo "<br>";	
  		echo  "<p style=\"color : red\" > Sorry, this email address is already taken. Please select another one!</p>"; 	
  	}
	else{
		$sql = $sql = "INSERT INTO User (Username, EmailAddress, PhoneNumber, Password, Role) VALUES (\"$username\", \"$email\", \"$phone\", \"$hashedPassword\", \"Member\")";	
		$conn->query($sql);
		$conn->close();
		header("Location: login.php");
	}
}

register();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="centreContent">
      <h1>Registration</h1>
      <form id="registerForm" method="POST" action="register.php" onsubmit="return validateForm()">
        <label for="username">Username </label><br>
        <input type="text" id="username" name="user" placeholder="Your Username"/><br>
        <label for="email">Email Address </label><br>
        <input type="text" id="email" name="email" placeholder="Your Email Address"/><br>
        <label for="phone">Phone Number </label><br>
        <input type="text" id="phone" name="phone" placeholder="Your Phone Number"/><br>
        <label for="regpass">Password (at least 8 characters long with minimum 1 symbol, 1 number, 1 uppercase letter and 1 lowercase letter)</label><br>
        <input type="password" id="regpass" name="regpass" placeholder="Your Password"/><br>
        <label for="regpass2">Confirm Password</label><br>
        <input type="password" id="regpass2" name="regpass2" placeholder="Confirm Password"/><br>
        <p>Already a member? <a href="login.php"><b>Log in here!</b></a></p>
        <p id="errorMessageRegistration" class="errorMessage"></p>
        <button type="submit" class="registerbtn">Register</button>
        <a href="index.php" class="returnButton">Return Home</a>
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>
