<?php
include "../database.php";
session_start();
?>

<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		
		<?php 
		dbConnect();

		$request = "SELECT boards.ID, boards.name, boards.creationDate, users.username 
			FROM boards
			JOIN users ON users.ID = boards.creatorID ORDER BY boards.creationDate DESC;";
		$result = mysqli_query($connection, $request);
		while($field = mysqli_fetch_assoc($result)) 
		{
			echo '<a href="board.php?boardID=' . $field["ID"] . '">' . htmlspecialchars($field["name"]) . '</a>';
			echo "<br> Created by: " . htmlspecialchars($field["username"]) . " | " . $field["creationDate"];
			echo "<hr>";
		}
		dbDisconnect();

		if (isset($_SESSION["username"]))
		{
			echo '<br><a href="../userPanel.php">Back to user panel</a><br>';
		}
		?>

	</body>
</html> 