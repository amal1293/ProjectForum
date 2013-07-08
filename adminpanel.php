<?php 
	session_start(); 
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Control Panel</title>
	</head>
	<body>
		<div>
			<?php
				if(!isset($_SESSION['id'])){
					header('Location:login.php');
				}
				else{
					$sql = "SELECT admin FROM users WHERE id='".$_SESSION['id']."'";
					$query = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($query) == 0 || mysql_result($query,0) == 0){
						header('Location:index.php');
					}
					else{
						$sql2 = "SELECT username FROM users WHERE id='".$_SESSION['id']."'";
						$query2 = mysql_query($sql2);
						echo "| <a href='index.php'>Index</a> | ".mysql_result($query2,0)." |<br/>";
					}
				}
			?>
		</div>
		<div>
			<a href="adminpanel.php?val=createcat">Create New Category</a> | 
			<a href="adminpanel.php?val=createforum">Create Forum</a><br/>
			<?php
				if(isset($_GET['val'])){

					if($_GET['val'] == 'createcat'){
						if(isset($_POST['createcat'])){
							$catname = trim(mysql_real_escape_string($_POST['catname']));
							$catdesc = trim(mysql_real_escape_string($_POST['catdesc']));
							$createcat = 1;
							if(empty($catname)){
								echo 'Enter a Category Name.<br/>';
								$createcat = 0;
							}
							else{
								$sql2 = "SELECT id FROM categories WHERE name='".$catname."'";
								$query2 = mysql_query($sql2);
								if(mysql_num_rows($query2) > 0){
									echo "Category Name already exists.<br/>";
									$createcat = 0;
								}
							}
							if($createcat == 1){
								if($_POST['permission'] == 'all')
									$permission = 0;
								else if($_POST['permission'] == 'admins')
									$permission = 1;
								$sql3 = "INSERT INTO categories(`name`,`desc`,`permission`) VALUES('".$catname."','".$catdesc."','$permission')";
								$query3 = mysql_query($sql3) or die(mysql_error());
								echo "Category Successfully Created.<br/>";
							}
						}

						echo "<table border = '0'>";
						echo "<form action='adminpanel.php?val=createcat' method='POST'>";
						echo "<tr><td>Category Name:</td><td><input type='text' name='catname'></td></tr>";
						echo "<tr><td>Description:</td><td><textarea name='catdesc'></textarea></td></tr>";
						echo "<tr><td>Permissions:</td><td><select name='permission'>
								<option value='all'>All Users</option>
								<option value='admins'>Admins Only</option></select></td></tr>";
						echo "<tr><td colspan='2'><input type='submit' value='Create Category' name='createcat'/></td></tr>";
						echo "</form>";
						echo "</table>";


					}
					else if($_GET['val'] == 'createforum'){
						if(isset($_POST['createforum'])){
							$title = trim(mysql_real_escape_string($_POST['title']));
							$desc = trim(mysql_real_escape_string($_POST['forumdesc']));
							$createforum = 1;
							if(empty($title)){
								echo "Enter a title for the forum.<br/>";
								$createforum = 0;
							}
							$sql6 = "SELECT id FROM forum WHERE name='".$title."' AND catid='".$_POST['catid']."'";
							$query6 = mysql_query($sql6) or die(mysql_error());
							if(mysql_num_rows($query6) > 0){
								echo "The forum title already exists under the category.<br/>";
								$createforum = 0;
							}
							if($createforum == 1){
								$sql7 = "INSERT INTO forum(catid,name,description) VALUES('".$_POST['catid']."','".$title."','".$desc."')";
								$query7 = mysql_query($sql7) or die(mysql_error());
								echo "Forum Created Successfully.<br/>";
							}
						}
						$sql4 = "SELECT id FROM categories";
						$query4 = mysql_query($sql4);
						if(mysql_num_rows($query4) == 0){
							echo "No categories exist.Create a category first to create a forum.<br/>";
						}
						else{
							echo "<table border='0'>";
							echo "<form method='POST' action='adminpanel.php?val=createforum'>";
							echo "<tr><td>Forum Title:</td><td><input type='text' name='title'/></td></tr>";
							echo "<tr><td>Category:</td><td><select name='catid'>";
							$sql5 = "SELECT name,id FROM categories";
							$query5 = mysql_query($sql5);
							while($catname = mysql_fetch_assoc($query5)){
								echo "<option value='".$catname['id']."'>".$catname['name']."</option>";
							}
							echo "</select></td></tr>";
							echo "<tr><td>Description:</td><td><textarea name='forumdesc'></textarea></td></tr>";
							echo "<tr><td colspan='2'><input type='submit' name='createforum' value='Create Forum'></td></tr>";
							echo "</forum>";
							echo "</table>";
						}
					}
				}
			?>
		</div>
	</body>
</html>