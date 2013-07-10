<?
	session_start();
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Topic</title>
</head>
<body>
	<div>
		<?php
			if(!isset($_SESSION['id'])){
				header('Location:login.php');
			}
			else if(!isset($_GET['fid'])){
				echo "The forum does not exist.<br/>";
			}
			else{
				$sql="SELECT id FROM forum WHERE id='".$_GET['fid']."'";
				$query=mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "The forum does not exist.<br/>";
				}
				else{
					if(isset($_POST['submit'])){
						$createtopic = 1;
						$subject = trim(mysql_real_escape_string($_POST['subject']));
						$message = trim(mysql_real_escape_string($_POST['message']));
						if(empty($subject)){
							echo "Enter a subject for the topic.<br/>";
							$createtopic = 0;
						}
						if($createtopic == 1){
							$sql = "INSERT INTO topics(forumid,subject,descr,author) VALUES('".$_GET['fid']."','".$subject."','".$message."','".$_SESSION['id']."')";
							$query = mysql_query($sql) or die(mysql_error());
							echo "Topic Created Successfully.<br/>";
						}
					}
					echo "<table border='0'>";
					echo "<form method='POST' action='createtopic.php?fid=".$_GET['fid']."''>";
					echo "<tr><td>Subject:</td><td><input type='text' name='subject'/></td></tr>";
					echo "<tr><td>Message:</td><td><textarea name='message'></textarea></td</tr>";
					echo "<tr><td colspan='2'><input type='submit' value='Create Topic' name='submit'></td></tr>";
					echo "</form>";
					echo "</table>";
				}
			}
		?>
	</div>
</body>
</html>