<?php
include "../database.php";
	
session_start();

if (!isset($_GET["boardID"]))
{
	header("Location: /index.php");	
}

?>

<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		
		<?php 
		dbConnect();
		$boardID = $_GET["boardID"];

		// Retrieving board name.
		$request = "SELECT name, creatorID FROM boards WHERE ID = '" . $_GET["boardID"] . "';";
		$result = mysqli_query($connection, $request);
		$field = mysqli_fetch_assoc($result);
		// Retrieving board name.

		$boardCreatorID = $field["creatorID"];

		echo "Welcome to " . htmlspecialchars($field["name"]);
		
		echo "<br>";

		$request = "SELECT boardcomments.ID, boardcomments.contents, boardcomments.postDate, users.username
			FROM boardcomments 
			JOIN users ON (boardcomments.author = users.ID)
			WHERE boardID = '$boardID'";


		// Printing comments.
		echo "</br>";
		echo "<center>";	
		$result = mysqli_query($connection, $request);
		while($field = mysqli_fetch_assoc($result)) 
		{
			echo htmlspecialchars($field['username']) . " | " . $field['postDate'] . "<br>";
			echo htmlspecialchars($field['contents']) . "<br>";
			echo "<hr>";

			if ($_SESSION["userID"] === $boardCreatorID) // If user created this board, they can moderate it.
			{
				echo '<form name = "deleteForm" method = "POST" enctype = "multipart/form-data" action = "deleteComment.php">
   	 			<input type = "submit" value = "Delete" name = "deleteComment">
    			<input type = "hidden" value = "' . $boardID . '" name = "boardID">
   	 			<input type = "hidden" value = "' . $field["ID"] . '" name = "commentID">
				</form>';
			}
		}
		echo "</center>";
		// Printing comments.


		// Comment form (only displayed to logged in users).
		if (isset($_SESSION["username"]))
		{
			echo '<form name = "postForm" method = "POST" enctype = "multipart/form-data" action = "addComment.php">
				Comment:
				<br>
   	 		<textarea name="comment" rows = "8" cols = "100"></textarea>
   	 		<br>
   	 		<input type = "submit" value = "Post" name = "addComment">
    		<input type = "hidden" value = "' . $boardID . '" name = "boardID">
			</form>';
		}
		// Comment form (only displayed to logged in users).

		

		?>

		</br>

		<a href="boardList.php">View boards</a>

		</br>

	</body>
</html> 