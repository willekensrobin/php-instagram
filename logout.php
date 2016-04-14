<?php

	require_once('classes/session.php');

	require_once('classes/user.class.php');

	$user_logout = new User();
	
	if($user_logout->loggedin()!="")
	{
		$user_logout->redirect('home.php');
	}
	if(isset($_GET['logout']) && $_GET['logout'] == "true")
	{
		$user_logout->logout();
		$user_logout->redirect('index.php');
	}

?>