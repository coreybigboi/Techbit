<?php
session_start();
    
// creates a new post if the form is submitted
function createPost(){
	require "dbconn.php";

	// function only executes if the form is submitted
	if($_SERVER["REQUEST_METHOD"] != "POST") return;
	
	$title = htmlspecialchars($_POST["createPostTitle"]);
	$content = htmlspecialchars($_POST["createPostContent"]);
	$username = $_SESSION["id"];
	$sql = "INSERT INTO Post (Title, Content, CreationDate, Upvotes, Downvotes, Author) VALUES (\"$title\", \"$content\", CURDATE(), 0, 0, \"$username\")";

	$conn->query($sql);
	$conn->close();
	header("Location: index.php");
}

createPost();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Create</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php
      require "menu.php";
    ?>
    <br />
    <h1 class="pageTitle">Create Post</h1>
    <form id="createPostForm" class="container" method="POST" action="create.php">      
      <label for="createPostTitle">Title </label><br/>
      <input type="text" id="createPostTitle" name="createPostTitle" maxlength="70" placeholder="Your Title" required/>
      <br/>
      <label for="createPostContent">Content </label>
      <textarea id="createPostContent" name="createPostContent" rows="20" cols="80" placeholder="Your Content" required></textarea>
      <button type="submit" id="createPostButton">Post</button>
    </form>
    <script src="script.js"></script>
  </body>
</html>