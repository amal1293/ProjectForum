<?php
	session_start();
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div>
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
	<div>
	<?php
		if(!isset($_GET['fid']) || !isset($_GET['catid'])){
			echo "The forum does not exist.<br/>";
		}
		else{
			$sql4 = "SELECT permission FROM categories WHERE id='".$_GET['catid']."'";
			$query4 = mysql_query($sql4) or die(mysql_error());
			if(mysql_num_rows($query4) == 0){
				echo "The forum does not exist.<br/>";
			}
			else{
				$allowed = 1;
				if(mysql_result($query4,0)==1){
					if(!isset($_SESSION['id'])){
						$allowed  = 0;
						echo "You do not have permission to view this page.<br/>";
					}
					else{
						$sql5 = "SELECT admin FROM users WHERE id='".$_SESSION['id']."'";
						$query5 = mysql_query($sql5) or die(mysql_error());
						if(mysql_num_rows($query5) == 0 || mysql_result($query5,0)==0){
							$qllowed = 0;
							echo "You do not have permission to view this page.<br/>";
						}
					}
				}
				if($allowed == 1){
					echo "<a href='createtopic.php?fid=".$_GET['fid']."''><input type='submit' value='Ceate Topic'/></a><br/>";
					$sql2 = "SELECT * FROM topics WHERE forumid='".$_GET['fid']."'";
					$query2 = mysql_query($sql2) or die(mysql_error());
					if(mysql_num_rows($query2) == 0){
						echo "No Topics created in this forum.<br/>";
					}
					else{
						while($topics = mysql_fetch_assoc($query2)){
							$sql3 = "SELECT username FROM users WHERE id='".$topics['author']."'";
							$query3 = mysql_query($sql3) or die(mysql_error());
							$author = mysql_result($query3,0);
							echo "<a href='topic.php?tid=".$topics['id']."&forid=".$_GET['fid']."'>".$topics['subject'].'</a> By:'.$author.'<br/><br/>';
						}
					}
				}
			}
		}
	?>
	</div>
</body>
</html>