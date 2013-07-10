<?php
	session_start();
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Topics</title>
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
		</div id='content'>
			<?php
				if(!isset($_GET['tid']) || !isset($_GET['forid'])){
					echo "The topic does not exist.<br/>";
				}
				else{
					$sql3 = "SELECT catid FROM forum WHERE id='".$_GET['forid']."'";
					$query3 = mysql_query($sql3) or die(mysql_error());
					if(mysql_num_rows($query3) == 0){
						echo "The topic does not exist.<br/>";
					}
					else{
						$sql4 = "SELECT permission FROM categories WHERE id='".mysql_result($query3,0)."'";
						$query4 = mysql_query($sql4) or die(mysql_error());
						if(mysql_num_rows($query4) == 0){
							echo "The topic does not exist.<br/>";
						}
						else{
							$canviewtopic = 1;
							if(mysql_result($query4,0) == 1){
								if(!isset($_SESSION['id'])){
									$canviewtopic = 0;
									echo "You do not have permission to view this topic.<br/>";
								}
								else{
									$sql5 = "SELECT admin FROM users WHERE id='".$_SESSION['id']."'";
									$query5 = mysql_query($sql5) or die(mysql_error());
									if(mysql_num_rows($query5) == 0 || mysql_result($query5,0) == 0){
										$canviewtopic = 0;
										echo "You do not have permission to view this topic.<br/>";
									}
								}
							}
						}
						if($canviewtopic == 1){
							echo "Can view Topic.<br/>";
						}
					}
				}
			?>
		<div>

		</div>
	</body>
</html>