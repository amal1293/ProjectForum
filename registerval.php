<?php
	if(!isset($_SESSION['id'])){
		$validated = 1;

		if(isset($_POST['register'])){
			$firstname = trim(mysql_real_escape_string($_POST['firstname']));
			$lastname = trim(mysql_real_escape_string($_POST['lastname']));
			$username = trim(mysql_real_escape_string($_POST['username']));
			$password = trim($_POST['password']);
			$repassword = trim($_POST['repassword']);
			$email = trim(mysql_real_escape_string($_POST['email']));
			$captchatext = trim(mysql_real_escape_string($_POST['captchatext']));

			if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($repassword) || empty($email)){
				echo "All fields are mandatory.<br/>";
				$validated  =0;
			}
			if(!empty($firstname[0]) && !($firstname[0] >= 'A' && $firstname[0] <= 'Z')){
				$validated = 0;
				$_POST['firstname'] = "";
				echo "First Name must start with a capital letter.<br/>";
			}
			if(!empty($lastname) && !($lastname[0] >='A' && $lastname[0] <= 'Z')){
				$validated = 0;
				$_POST['lastname'] = "";
				echo "Last Name must start with a capital letter.<br/>";
			}
			if($password != $repassword){
				$validated = 0;
				echo "Passwords do not match.<br/>";
			}
			if($captchatext == ""){
				echo "Enter the text in the image.<br/>";
				$validated = 0;
			}
			else if($captchatext != $_SESSION['captcha']){
				echo "Enter the captcha text correctly.<br/>";
				$validated = 0;
			}
		
			$exists = "SELECT id FROM users WHERE username='$username'";
			$existsquery =mysql_query($exists) or die(mysql_error());
			if(mysql_num_rows($existsquery) > 0){
				$validated = 0;
				$_POST['username'] = "";
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