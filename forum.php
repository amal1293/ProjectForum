<?php
	session_start();
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php
		if(!isset($_GET['id'])){
			echo "The forum does not exist.<br/>";
		}
		else{
			$sql="SELECT * FROM forum WHERE id='".$_GET['id']."'";
			$query = mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($query) == 0){
				echo "The forum does not exist.<br/>";
			}
			else{
				echo "Works";
			}
		}
	?>
</body>
</html>