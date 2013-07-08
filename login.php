<!-- LOGIN PAGE -->
<?php 
	session_start(); 
	require 'connect.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link type='text/css' rel='stylesheet' href='style.css'/>
	</head>
	<body>
		<div id='login'>
			<h2>Login</h2>
			<?php
				if(isset($_SESSION['id'])){
					echo "You are already logged in.<br/>";
				}
				else{
					if(isset($_POST['login'])){
						$sql = "SELECT id FROM users WHERE username='".$_POST['username']."' AND password='".md5($_POST['username'].md5($_POST['password']))."'";
						$query = mysql_query($sql) or die(mysql_error());
						if(mysql_num_rows($query) == 0){
							echo "Incorrect username or password.<br/>";
						}
						else{
							echo "You have successfully logged in.<br/>";
							$_SESSION['id'] = mysql_result($query,0);
						}
					}
				}
			?>
			<table border='0'>
				<form action='login.php' method='POST'>
					<tr>
						<td>Username:</td>
						<td><input type='text' name='username'/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type='password' name='password'/></td>
					</tr>
					<tr>
						<td colspan='2'><input type='submit' name='login' value='Login'/></td>
					</tr>
				</form>
			</table>
			<p>Not a registered user? <a href='register.php'>Register here</a>.</p>
		</div>
	</body>
</html>