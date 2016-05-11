<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");

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
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit profile - <?php echo $userRow['fullname']; ?></title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style>body{padding-top:50px;}.starter-template{padding:40px 15px;text-align:center;}</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
       
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          </div>
          
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a> &nbsp;</li>
            <li><input type="text" placeholder="Search"/></li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a> &nbsp;</li>
            <li><a href="post.php"><span class="glyphicon glyphicon-camera"></span> Post</a> &nbsp;</li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hello <?php echo $userRow['fullname']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="account.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Account</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
              </ul>
            </li>
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
</nav>


    <div class="clearfix"></div>
    	
    
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
        
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading"><a href="account.php">Account</a></h2> 
            <h2 class="form-signin-heading"><a href="password.php">Password</a></h2>
            
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Password updated 
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="password" class="form-control" name="oldpass" placeholder="Old password" id="oldpass"/>
            </div>
            
            <div class="form-group">
            <input type="password" class="form-control" name="newpass" placeholder="New password" id="fullname" />
            </div>
            
            <div class="form-group">
            <input type="password" class="form-control" name="checkpass" placeholder="Re-type new password" id="checkpass"  />
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