function validate(){
	var firstname = document.getElementById('firstname');
	var lastname = document.getElementById('lastname');
	var username = document.getElementById('username');
	var password = document.getElementById('password');
	var repassword = document.getElementById('repassword');
	var email = document.getElementById('email');
	
	var errorval = document.getElementById('validation');
	errorval.innerHTML = "";
	
	var returnvalue = true;
	
	if(firstname.value == "" || lastname.value == "" || username.value == "" || password.value == "" || repassword.value == "" || email.value == ""){
		errorval.innerHTML += "All fields are mandatory.<br/>";
		returnvalue = false;
	}
	
	if(firstname.value != "" && !(firstname.value[0] >= 'A' && firstname.value[0] <= 'Z')){
		errorval.innerHTML += "First Name must start with a capital letter.<br/>";
		returnvalue = false;
	}
	
	if(lastname.value != "" && !(lastname.value[0] >= 'A' && lastname.value[0] <= 'Z')){
		errorval.innerHTML += "Last Name must start with a capital letter.<br/>";
		returnvalue = false;
	}
	
	if(password.value != repassword.value){
		errorval.innerHTML += "Passwords do not match.<br/>";
		returnvalue = false;
	}
	return returnvalue;
}


function usernamecheck(){
	var xmlhttp;
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
	var username = document.getElementById('username');
	var validation = document.getElementById('validation');
	xmlhttp.open('GET','usernamecheck.php?username='+username.value,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			validation.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
}