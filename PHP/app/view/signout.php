<?php
	session_destroy();
	session_unset();
	
	App::redirect('index.php?page=home');
?>
