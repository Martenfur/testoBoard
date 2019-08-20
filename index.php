<?php
	include "database.php";
		
	session_start();

	if (isset($_SESSION["username"]))
	{
		header("Location: /userPanel.php");	
	}

	if (isset($_POST["loginSubmit"]))
	{
		dbConnect();
		$SQL = "SELECT username, passwordHash, ID 
			FROM users 
			WHERE (username = '" . $_POST["usernameInput"] . "');";

		$result = mysqli_query($connection, $SQL);
		while($field = mysqli_fetch_assoc($result)) 
		{
			if (password_verify($_POST["passwordInput"], $field["passwordHash"]))
			{
				$_SESSION["username"] = $_POST["usernameInput"];
				$_SESSION["userID"] = $field["ID"];
				
				header("Location: /userPanel.php");
			}
		}
		dbDisconnect();
	}


	$userExists = false;
	if (isset($_POST["registerSubmit"]))
	{
		dbConnect();
			
		$username = $_POST["usernameInput"];
			
		$hash = password_hash($_POST["passwordInput"], PASSWORD_DEFAULT);
		$SQL = "INSERT INTO users (username, passwordHash)
			VALUES ('$username', '$hash');";

		// Username is unique, so query will return false if it's repeating.
		$result = mysqli_query($connection, $SQL);	
		if ($result === false)
		{
			$userExists = true;
		}
		else
		{
			$userExists = false;
		}

		dbDisconnect();
	}
			
?>

<!DOCTYPE html>
<html>
	<head>
	</head>

	<body>
		<form name = "loginForm" method = "POST" enctype = "multipart/form-data">
			Log in:
    	<input type = "text" name = "usernameInput" value = "">
    	<input type = "password" name = "passwordInput" value = "">
    	<input type = "submit" value = "Log In" name = "loginSubmit">
		</form>
		</br>
		<form name = "registerForm" method = "POST" enctype = "multipart/form-data">
			Register:
    	<input type = "text" name = "usernameInput" value = "">
    	<input type = "password" name = "passwordInput" value = "">
    	<input type = "submit" value = "Register" name = "registerSubmit">
		</form>
		<?php 
		if ($userExists)
		{
			echo "User with this name already exists!";
		}
		?>

	</body>
</html> 