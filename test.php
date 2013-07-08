<?php
	session_start();	
?>
<script type='text/javascript'>
	function refreshimg(){
		var img = document.getElementById('captcha');
		img.src = 'captcha.php';
		return false;
	}
</script>
<img id= 'captcha' src='captcha.php'/>
<a href = '' onclick = 'return refreshimg()'>Refresh</a>
