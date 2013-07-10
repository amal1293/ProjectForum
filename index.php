<?php
	session_start(); 
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>| Forum |</title>
	<link type='text/css' rel='stylesheet' href='style.css'/>
</head>
<body>
	<div id='menus'>
	<?php
		if(isset($_SESSION['id'])){
			$sql = "SELECT username FROM users WHERE id = '".$_SESSION['id']."'";
			$query = mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($query) > 0){
				$name = mysql_fetch_assoc($query);
				echo "Welcome, ".$name['username'].".";
				echo " | <a href='logout.php'>Logout</a> |<br/>";
				$sql2 = "SELECT admin FROM users WHERE id = '".$_SESSION['id']."'";
				$query2 = mysql_query($sql2);
				if(mysql_result($query2, 0) == '1'){
					echo "<a href='adminpanel.php'>Admin Control Panel</a>";
				}
			}
			else{
				echo "You are currently not logged in. | <a href='login.php'>Login</a> | <a href='register.php'>Register</a> |<br/>";
			}
		}
		else{
			echo "You are currently not logged in. | <a href='login.php'>Login</a> | <a href='register.php'>Register</a> |<br/>";
		}
	?>
	</div>
	<div id='content'>
		<?php
			if(isset($_SESSION['id'])){
				$sql3 = "SELECT admin FROM users WHERE id='".$_SESSION['id']."'";
				$query3 = mysql_query($sql3);
				$adminlevel = mysql_result($query3,0);
			}
			else
				$adminlevel = 0;
			$sql4 = "SELECT * FROM categories WHERE permission <= '$adminlevel'";
			$query4 = mysql_query($sql4);
			if(mysql_num_rows($query4) == 0){
				echo "No Category Created.";
			}
			else{
				while($category = mysql_fetch_assoc($query4)){
					echo $category['name'].'<br/>';
					$sql5 = "SELECT * FROM forum WHERE catid='".$category['id']."'";
					$query5 = mysql_query($sql5) or die(mysql_error());
					if(mysql_num_rows($query5) > 0){
						//echo $category['name'].'<br/>';
						while($forumname = mysql_fetch_assoc($query5)){
							echo "<a href='forum.php?fid=".$forumname['id']."&catid=".$forumname['catid']."'>".$forumname['name']."</a><br/>";
						}
					}
				}
			}
		?>
	</div>
</body>
</html>