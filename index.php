<?php
	session_start(); 
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>| Forum |</title>
</head>
<body>
	<div>
	<?php
		if(isset($_SESSION['id'])){
			$sql = "SELECT username FROM users WHERE id = '".$_SESSION['id']."'";
			$query = mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($query) > 0){
				$name = mysql_fetch_assoc($query);
				echo "Welcome, ".$name['username'].".<br/>";
				echo "<a href='logout.php'>Logout</a>";
			}
			else{
				echo "You are currently not logged in.<br/>";
			}
		}
		else{
			echo "You are currently not logged in.<br/>";
		}
	?>
	</div>
	<div>
	</div>
</body>
</html>