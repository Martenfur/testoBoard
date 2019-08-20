<?php
$username = "root";
$password = "";
$database = "images";
$server = "127.0.0.1";

$connection = null;

function dbConnect()
{
	global $username, 
		$password, 
		$database, 
		$server, 
		$connection;

	if ($connection == null)
	{
		$connection = mysqli_connect($server, $username, $password);
		mysqli_select_db($connection, $database);
	}
}

function dbDisconnect()
{
	global $connection;
	mysqli_close($connection);
}

function dbAddImage($path, $additionDate, $name)
{
	global $connection;
	session_start();
	$userID = $_SESSION["userID"];
	$request = "INSERT INTO images (path, additionDate, name, userID)
		VALUES ('$path', '$additionDate', '$name', $userID);";

	if (!mysqli_query($connection, $request))
	{
		echo "ERROR: Could not able to execute. " . mysqli_error($connection);
	}
}

function dbGetUserID($username)
{
	global $connection;
	$request = "SELECT ID 
		FROM users 
		WHERE username = '$username'";

	$result = mysqli_query($connection, $request);

	while($field = mysqli_fetch_assoc($result)) 
	{
		return $field["ID"];
	}

	return false;
}

function dbDeleteImage($imgID)
{
	global $connection;
	session_start();

	$fileRequest = "SELECT ID, path FROM images WHERE ID = $imgID";
	$result = mysqli_query($connection, $fileRequest);
	while($field = mysqli_fetch_assoc($result))
	{
		// Deleting associated file.
		unlink($field["path"]);
	}

	$request = "DELETE FROM images WHERE ID = $imgID;";

	mysqli_query($connection, $request);
}

function dbPrint()
{
	global $connection;
	$userID = $_SESSION["userID"];
	
	$request = "SELECT 
		images.ID AS 'imgID', 
		images.path, 
		images.additionDate, 
		images.name, 
		images.userID, 
		users.ID 
	FROM images, users 
	WHERE images.userID = users.ID AND users.ID = $userID";

	echo "</br>";
	echo "<center>";	
	$result = mysqli_query($connection, $request);
	while($field = mysqli_fetch_assoc($result)) 
	{
		echo htmlspecialchars($field['name']) . "<br>";
		echo $field['additionDate'] . "<br>";
		print '<img src = "' . $field['path'] . '" alt = "" style = "max-width:300px;"><br>';
		print '<form name = "delPic" method = "POST" action = "delete.php" enctype = "multipart/form-data">
			<input type = "hidden" value = ' . $field['imgID'] . ' name = "imgID">
			<input type = "submit" value = "Delete" name = "delPic">
		</form>';
		echo "<hr>";
	}
	echo "</center>";
		
}


?>
