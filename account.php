<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");
    
    include("templates/header.php");

	$update_user = new User();
	
	
	$user_id = $_SESSION['session'];
	
	$statement = $update_user->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST))
{
	$username = strip_tags($_POST['username']);
    $fullname = strip_tags($_POST['fullname']);
	$email = strip_tags($_POST['email']);	

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Email does not exist';
	}
	else
	{
		try
		{
			$statement = $update_user->runQuery("SELECT username, email FROM db_users WHERE id=:id");
			$statement->execute(array(":id"=>$user_id));
			$row=$statement->fetch(PDO::FETCH_ASSOC);
            
				
			if($row['username']==""){
                $error[] = "Username is empty";
            }
			else
			{
				$update_user->updateInfo($username, $fullname, $email);
				$update_user->redirect('account.php?joined');
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>

    <div class="clearfix"></div>
    	
    
    <div class="container" style="margin-top:80px;">
	
    <div class="container">
        
        <form method="post" class="form-edit-account">
            <a class="btn btn-custom" href="account.php">Account</a> 
            <a class="btn btn-custom" href="password.php">Password</a>
            
            
            <hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Account updated 
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
                <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Picture">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="<?php echo $userRow["username"];?>" />
            </div>
            
            <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Fullname" id="fullname" value="<?php echo $userRow["fullname"];?>" />
            </div>
            
            <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email" id="email" value="<?php echo $userRow["email"];?>" />
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
            
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Update
                </button>
                
            </div>
        </form>

    </div>

</div>

</body>
</html>