<?php

	$auth_user = new User();
	
	if(isset($_SESSION['loggedin_userid'])){
	$user_id = $_SESSION['loggedin_userid'];
	
	$statement = $auth_user->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);
    }
else{
    $userRow = [];
}
?>