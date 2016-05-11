<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");
require_once("templates/header.php");


	$update_pass = new User();
	
	
	$user_id = $_SESSION['session'];
	
	$statement = $update_pass->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST))
{
	$oldpass = strip_tags($_POST['oldpass']);
	$newpass = strip_tags($_POST['newpass']);
    $checkpass = strip_tags($_POST['checkpass']);
	
    if($oldpass=="")	{
		$error[] = "Fill in old password";
	}
	else if($newpass=="")	{
		$error[] = "Fill in  newpassword";
	}
    else if($newpass!=$checkpass)	{
		$error[] = "New password does not match";
	}
    else if($oldpass == $newpass)	{
		$error[] = "New password is the same as current password";
	}
	else if(strlen($newpass) < 6){
		$error[] = "New password needs to have atleast 6 characters";	
	}
	else
	{
		try
		{
			$statement = $update_pass->runQuery("SELECT password FROM db_users WHERE id=:id");
			$statement->execute(array(":id"=>$user_id));
			$row = $statement->fetch(PDO::FETCH_ASSOC);
				
			if(password_verify($oldpass, $row['password'])) {
				$error[] = "Password is incorrect";
			}
			else
			{
				if($update_pass->updatePass($newpass)){	
					$update_pass->redirect('password.php?joined');
				}
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


    <div class="container-fluid" style="margin-top:80px;">

        <div class="container">

            <form method="post" class="form-edit-pass">
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
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;
                        <?php echo $error; ?>
                    </div>
                    <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                        <div class="alert alert-info">
                            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Password updated
                        </div>
                        <?php
			}
			?>
                            <div class="form-group">
                                <input type="password" class="form-control" name="oldpass" placeholder="Old password" id="oldpass" />
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="newpass" placeholder="New password" id="fullname" />
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="checkpass" placeholder="Re-type new password" id="checkpass" />
                            </div>

                            <div class="clearfix"></div>
                            <hr />
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary" name="btn-signup">
                                    <i class="glyphicon glyphicon-open-file"></i>&nbsp;Update
                                </button>

                            </div>
            </form>

        </div>

    </div>

   
    <?php require_once("templates/footer.php") ?>