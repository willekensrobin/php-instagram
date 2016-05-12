<?php
	require_once('classes/user.class.php');
	session_start();
    $session = new User();

if($session->loggedin()!=""){

	$conn = new mysqli("localhost", "root", "", "instagram");
	$query = "SELECT * FROM db_users WHERE username = '".$_SESSION['loggedin_user']."';";
	$result = $conn->query($query);
	
	$object = $result->fetch_object();
	$_SESSION['loggedin_userid'] = $object->id;
}
else{
    header('home.php');
};

?>