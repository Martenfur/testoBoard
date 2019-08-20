<?php

session_start();

if (isset($_POST["addComment"]) && isset($_SESSION["username"]))
{
	include "../database.php";
	dbConnect();


	$userID = $_SESSION["userID"];
	$boardID = $_POST["boardID"];
	$contents = $_POST["comment"];
	$postDate = date("y/m/d H:i:s");

	$request = "INSERT INTO boardcomments (boardID, author, postDate, contents) 
	VALUES ($boardID, $userID, '$postDate', '$contents');";
	
	if (!mysqli_query($connection, $request))
	{
		echo "ERROR: Could not able to execute. " . mysqli_error($connection);
	}

	header("Location: /boards/board.php?boardID=" . $boardID);		
}
else
{
	header("Location: /userPanel.php");	
}

?>

