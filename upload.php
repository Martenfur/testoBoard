<?php
$target_dir = "images/";

session_start();

// Check if image file is a actual image or fake image
if (isset($_POST["addPic"])) 
{

	$check = getimagesize($_FILES["picFile"]["tmp_name"]);
	if ($check !== false) 
	{
		include "database.php";
		
		dbConnect();

		$additionDate = date("y/m/d H:i:s");
		$name = basename($_FILES["picFile"]["name"]);
		$imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

		$path = $target_dir . getHash($name) . "." . $imageFileType;
		

		dbAddImage(
			$path, 
			$additionDate, 
			$_POST["picName"]
		);
		
		move_uploaded_file(
			$_FILES["picFile"]["tmp_name"], 
			$path
		);

		//dbPrint();
	}


}


function getHash($filename)
{
	return sha1($filename . date("y/m/d H:i:s"));
}

header("Location: /userPanel.php");

?>
