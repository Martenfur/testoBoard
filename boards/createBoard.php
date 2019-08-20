<?php

session_start();

if (isset($_POST["createBoard"]) && isset($_SESSION["username"]))
{
	include "../database.php";
	dbConnect();


	$name = $_POST["boardName"];
	$creator = $_SESSION["username"];
	$creationDate = date("y/m/d H:i:s");

	$SQL = "INSERT INTO boards (name, creatorID, creationDate) 
	VALUES 
	(
		'$name', 
		(
			SELECT ID 
			FROM users 
			WHERE username = '$creator' 
			LIMIT 1
		), 
		'$creationDate'
	);";

	if (!mysqli_query($connection, $SQL))
	{
		echo "ERROR: Could not able to execute. " . mysqli_error($connection);
	}

	$creatorID = dbGetUserID($_SESSION["username"]);
	
	$SQL = "SELECT ID 
	FROM boards 
	WHERE name = '$name';";
	
	$result = mysqli_query($connection, $SQL);
	$field = mysqli_fetch_assoc($result);
	
	header("Location: /boards/board.php?boardID=" . $field["ID"]);		
}
else
{
	header("Location: /userPanel.php");	
}

?>