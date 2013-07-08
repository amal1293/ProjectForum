<?php
	session_start();
	if(isset($_SESSION['id'])){
		echo "You have logged out.<br/>";
		session_destroy();
	}
	else
		echo "You are not logged in.<br/>";
	echo "Return to <a href='index.php'>Forum</a>";
?>