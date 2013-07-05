<?php
	if(!isset($_SESSION['id'])){
		$validated = 1;
		if(isset($_POST['register'])){
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$password  =$_POST['password'];
			$repassword = $_POST['repassword'];
			$email = $_POST['email'];
			if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($repassword) || empty($email)){
				echo "All fields are mandatory.<br/>";
				$validated  =0;
			}
			if(!empty($firstname[0]) && !($firstname[0] >= 'A' && $firstname[0] <= 'Z')){
				$validated = 0;
				echo "First Name must start with a capital letter.<br/>";
			}
			if(!empty($lastname) && !($lastname[0] >='A' && $lastname[0] <= 'Z')){
				$validated = 0;
				echo "Last Name must start with a capital letter.<br/>";
			}
			if($password != $repassword){
				$validated = 0;
				echo "Passwords do not match.<br/>";
			}
		
			$exists = "SELECT id FROM users WHERE username='$username'";
			$existsquery =mysql_query($exists) or die(mysql_error());
			if(mysql_num_rows($existsquery) > 0){
				$validated = 0;
				echo "Username already taken.<br/>";
			}	
		
		
			if($validated == 1){
				$passwordhash = md5($username.md5($password));
				$query = "INSERT INTO users(firstname,lastname,username,password,email) VALUES('$firstname','$lastname','$username','$passwordhash','$email')";
				$queryresult = mysql_query($query) or die(mysql_error());
				echo "Successfully Registered.<br/>";
			}
		}
	}

?>