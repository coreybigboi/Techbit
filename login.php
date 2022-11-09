<?php
session_start();

// this function logs the user in
function login(){
	require "dbconn.php";

	// function only executes if the form is submitted
	if($_SERVER["REQUEST_METHOD"] != "POST") return;
	
	$username = htmlspecialchars($_POST["username_login"]);
	$password = htmlspecialchars($_POST["password_login"]);
	$hashedPassword = crypt($password, '$1$kit202');

	$sql = "SELECT * FROM User WHERE Username = \"$username\" and Password = \"$hashedPassword\"";

	// log in user if the username and password find a match in the database
	$result = $conn->query($sql);
	if($result && mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$_SESSION["id"] = $row["UserName"]; 
    	$_SESSION["role"] = $row["Role"];
		header("Location:index.php");
    }

	// display error if no match
	echo "<br>";
	echo "<p style=\"color : red\">Username or password is incorrect. Please try again.</p>";
}

login();

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="centreContent">
      <h1>Log In</h1>
      <form id="loginForm" method="POST" action="login.php" onsubmit="return  loginvalidation()">
        <label for="username_login">Username </label>
        <input type="text" id="username_login" name="username_login" placeholder="Your Username"/>
        <br />
        <label for="password_login">Password </label>
        <input type="password" id="password_login" name="password_login" placeholder="Your Password"/>
        <p>Not a member? <a href="register.php"><b>Register Here!</b></a></p>
        <p id="errorMessageLogin" class="errorMessage"></p>
        <button type="submit" id="logInButton">Log In</button>
        <a href="index.php" class="returnButton">Return Home</a>
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>