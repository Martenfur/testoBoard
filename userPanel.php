<?php

session_start();


if (isset($_POST["logout"]))
{
	session_destroy();
	header("Location: /index.php");	
}

// Redirecting, if not logged in.
if (!isset($_SESSION["username"]))
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

		echo "Sup, " . htmlspecialchars($_SESSION["username"]);
		
		?>

		</br>

		<a href="boards/boardList.php">View boards</a>

		</br>
		
		<form name = "logout" method = "POST" enctype = "multipart/form-data">
			<input type = "submit" value = "Log Out" name = "logout">
		</form>
		
		</br>
		
		<form name = "addPic" method = "POST" action = "upload.php" enctype = "multipart/form-data">
			<input type = "text" name = "picName" value = "">
			<input type = "file" name = "picFile" id = "picFile">
			<input type = "submit" value = "Add Picture" name = "addPic">
		</form>
		
		<br>

		<form name = "createBoard" METHOD = "POST" action = "boards/createBoard.php" enctype = "multipart/form-data">
			<input type = "text" name = "boardName" value = "">
			<input type = "submit" value = "Create Board" name = "createBoard">
		</form>

		<?php
		include "database.php";

		dbConnect();
		dbPrint();
		?>

	</body>
</html> 