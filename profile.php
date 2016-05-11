<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");
    
    include("templates/header.php");
	$auth_user = new User();
	
	
	$user_id = $_SESSION['session'];
	
	$statement = $auth_user->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);
	
?>


	<div class="clearfix"></div>
	
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
        
        <hr />
        
        <p class="h4">Profile</p> 
        
    
    </div>

</div>

<?php include("templates/footer.php"); ?>