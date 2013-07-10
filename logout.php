<?php
	session_start();
	if(isset($_SESSION['id'])){
		echo "You have logged out.<br/>";
		session_unset();
		session_destroy();
		echo "Return to <a href='".$_SERVER['HTTP_REFERER']."'>Previous Page</a>.<br/>";
		echo "Return to <a href='index.php'>Forum Index</a>.<br/>";
	}
	else
		echo "You are not logged in.<br/>";
?>