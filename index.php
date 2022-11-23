<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php
   	session_start();
    	require "dbconn.php";
	
	// user pressed upvote
	if(isset($_POST["upvote"])){
    		upvote();
   	}
	
	// user pressed downvote
	if(isset($_POST["downvote"])){
    		downvote();
    	}
	
	function upvote(){   
    		global $conn;
    		$postid = $_POST["postid"];
    		$userid = $_SESSION["id"];
   		
   		// check if user has already voted
    		$rating = "-1";
        	$ratingResult = $conn->query("SELECT VoteType FROM Rates WHERE UserID = '$userid' AND PostID = $postid");
        	if(mysqli_num_rows($ratingResult) > 0){
        		$rating = $ratingResult->fetch_assoc()["VoteType"];
        	}
    	
    		// already upvoted
    		if($rating === '1'){ 
        		$upvotes= $conn->query("SELECT Upvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Upvotes"] - 1;
        		$sql = "UPDATE Post SET Upvotes = '$upvotes' WHERE PostID = '$postid'";	
    			$conn->query($sql);
        		// delete rating from table
        		$conn->query("DELETE FROM Rates WHERE UserID = '$userid' AND PostId = '$postid'");
        		return;
        	}
    	
    		// changing vote from down to up
    		if($rating === '0'){
        		// decrement downvotes
        		$downvotes = $conn->query("SELECT Downvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Downvotes"] - 1;
        		$sql = "UPDATE Post SET Downvotes = '$downvotes' WHERE PostID = '$postid'";	
    			$conn->query($sql);
        		// update rating in table
        		$conn->query("UPDATE Rates SET VoteType = 1 WHERE UserID = '$userid' AND PostId = '$postid'");
        	}
    	
    		// increment upvotes
    		$upvotes = 1 + $conn->query("SELECT Upvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Upvotes"];
    		$sql = "UPDATE Post SET Upvotes = '$upvotes' WHERE PostID = '$postid'";	
    		$conn->query($sql);
    
   	 	// user has not voted yet
    		if($rating == "-1"){
    			// insert rating into rates table
    			$sql = "INSERT INTO Rates (UserID, PostID, VoteType) VALUES (\"$userid\", \"$postid\", 1)";
    			$conn->query($sql);
    	   	}
    	}	

	function downvote(){   
    		global $conn;
    		$postid = $_POST["postid"];
    		$userid = $_SESSION["id"];
   		
   		// check if user has already voted
    		$rating = "-1";
        	$ratingResult = $conn->query("SELECT VoteType FROM Rates WHERE UserID = '$userid' AND PostID = $postid");
        	if(mysqli_num_rows($ratingResult) > 0){
        		$rating = $ratingResult->fetch_assoc()["VoteType"];
        	}
    	
    		// already downvoted
    		if($rating === '0'){ 
        		$downvotes= $conn->query("SELECT Downvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Downvotes"] - 1;
        		$sql = "UPDATE Post SET Downvotes = '$downvotes' WHERE PostID = '$postid'";	
    			$conn->query($sql);
        		// delete rating from table
        		$conn->query("DELETE FROM Rates WHERE UserID = '$userid' AND PostId = '$postid'");
        		return;
        	}
    	
    		// changing vote from up to down
    		if($rating === '1'){
        		// decrement upvotes
        		$upvotes= $conn->query("SELECT Upvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Upvotes"] - 1;
        		$sql = "UPDATE Post SET Upvotes = '$upvotes' WHERE PostID = '$postid'";	
    			$conn->query($sql);
        		// update rating in table
        		$conn->query("UPDATE Rates SET VoteType = 0 WHERE UserID = '$userid' AND PostId = '$postid'");
        	}
    	
    		// increment downvotes
    		$downvotes = 1 + $conn->query("SELECT Downvotes FROM Post WHERE PostID = '$postid'")->fetch_assoc()["Downvotes"];
    		$sql = "UPDATE Post SET Downvotes = '$downvotes' WHERE PostID = '$postid'";	
    		$conn->query($sql);
    
    		// user has not voted yet
    		if($rating == "-1"){
    			// insert rating into rates table
    			$sql = "INSERT INTO Rates (UserID, PostID, VoteType) VALUES (\"$userid\", \"$postid\", 0)";
    			$conn->query($sql);
    		}
    	}
	
	function voteButtons($row){	
    		global $conn;
    		$postid = $row["PostID"];
    		$userid = $_SESSION["id"];
        	$sql = "SELECT VoteType FROM Rates WHERE UserID = '$userid' AND PostID = $postid";
    		$rating = "-1";
        	$ratingResult = $conn->query($sql);
        	if(mysqli_num_rows($ratingResult) > 0){
        		$rating = $ratingResult->fetch_assoc()["VoteType"];
        	}
     		echo "<form id=\"vote\" method=\"POST\" action=\"index.php\">";   
        	echo "<input type=\"text\" name=\"postid\" value=\"" . $row["PostID"] . "\" hidden>";
        	if($rating === '1'){ 
        		echo "<button type=\"submit\" name=\"upvote\" id=\"upvote\" style=\"background-color : #c96567\">Upvote</button>";
        	}
        	else{
        		echo "<button type=\"submit\" name=\"upvote\" id=\"upvote\">Upvote</button>";
        	}
        	if($rating === '0'){ 
     			echo "<button type=\"submit\" name=\"downvote\" id=\"downvote\" style=\"background-color : #c96567\">Downvote</button>";
        	}
      		else{
        		echo "<button type=\"submit\" name=\"downvote\" id=\"downvote\">Downvote</button>";
        	}
       	        echo "</form>";
    	}

	function postRecent(){
		global $conn;
		$sql = "SELECT * FROM Post ORDER BY PostID DESC"; 
		$result = $conn->query($sql);
		
		if($result == NULL){ 
        		return;
        	}

    		for($i = 0; $i < 4; $i++){
    			$row = $result->fetch_assoc();
        		if($row == NULL){ // less than 4 resutlts
            			$result->free();
				$conn->close();
            			return;
            		}
        		echo "<br />";
   			echo "<div class=\"container\">";
      			echo "<h2>" . $row["Title"] . "</h2>";
      			echo "<h3><i>" . $row["CreationDate"] . "</i></h3>";
        		echo "<h3>Written by <i>" . $row["Author"] . "</i></h3>"; 
      			echo "<p>" . $row["Content"] . "</p>"; 
        		echo "<br>";
        		echo "<h3>" . $row["Upvotes"] . " Upvotes &nbsp &nbsp" . $row["Downvotes"] . " Downvotes</pre></h3>"; 
        		if(isset($_SESSION["id"])){ // only allow logged in users to vote
            			voteButtons($row);
 			}
    			echo "</div>";
        	}
    		$result->free();
		$conn->close();
	}

    	require "menu.php";
	echo "<br />";
	if(isset($_SESSION["id"])){
    		$name = $_SESSION["id"];
    		echo "<br />";
   		echo "<p>Hello $name,</p>";
        	echo "<br />";
    	}
	echo "<h1 class=\"pageTitle\">Home</h1>";
	postRecent();
    ?>
    <script src="script.js" class="navigation"></script>
  </body>
</html>
