<?php

session_start();

if (isset($_POST["deleteComment"]) && isset($_SESSION["username"]))
{
	include "../database.php";
	dbConnect();

	$userID = $_SESSION["userID"];
	$boardID = $_POST["boardID"];
	$commentID = $_POST["commentID"];	

	$request = "SELECT COUNT(ID) as c
		FROM boards 
		WHERE ID = $boardID AND creatorID = $userID;";
	
	$result = mysqli_query($connection, $request);
	$field = mysqli_fetch_assoc($result);
	
	if ($field["c"] > 0) // Verifying that the user is creator of the board.
	{
		$request = "DELETE FROM boardcomments WHERE ID = $commentID;";
	
		mysqli_query($connection, $request);
	}

	header("Location: /boards/board.php?boardID=" . $boardID);		
}
else
{
	header("Location: /userPanel.php");	
}

?>

