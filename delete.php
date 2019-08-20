<?php
$target_dir = "images/";

session_start();

if (isset($_POST["delPic"])) 
{
	include "database.php";
		
	dbConnect();

	dbDeleteImage($_POST["imgID"]);

	dbDisconnect();
}

header("Location: /userPanel.php");

?>
