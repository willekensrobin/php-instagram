<?php
session_start();

require_once('classes/user.class.php');

$user = new User();

if($user->loggedin()!="")
{
	$user->redirect('home.php');
}

if(!empty($_POST))
{
	$username = strip_tags($_POST['username']);
    $fullname = strip_tags($_POST['fullname']);
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);	
	
	if($username=="")	{
		$error[] = "Fill in a username";	
	}
    else if($fullname=="")	{
		$error[] = "Fill in your fullname";	
	}
	else if($email=="")	{
		$error[] = "Fill in your email";	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Email does not exist';
	}
	else if($password=="")	{
		$error[] = "Fill in password";
	}
	else if(strlen($password) < 6){
		$error[] = "Password needs to have atleast 6 characters";	
	}
	else
	{
		try
		{
			$statement = $user->runQuery("SELECT username, email FROM db_users WHERE username=:username OR email=:email");
			$statement->execute(array(':username'=>$username, ':email'=>$email));
			$row=$statement->fetch(PDO::FETCH_ASSOC);
				
			if($row['username']==$username) {
				$error[] = "Username is taken";
			}
			else if($row['email']==$email) {
				$error[] = "Email is already in use";
			}
			else
			{
				if($user->register($username,$fullname, $email,$password)){	
					$user->redirect('signup.php?joined');
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
    <title>Signup</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style>body{padding-top:50px;}.starter-template{padding:40px 15px;text-align:center;}</style>

    <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Sign up</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; U bent gerigstreerd <a href='index.php'>Log</a> hier in
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($error)){echo $username;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Fullname" value="<?php if(isset($error)){echo $fullname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email" value="<?php if(isset($error)){echo $email;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="password" placeholder="Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Signup
                </button>
            </div>
            <br />
            <label>Already have an account? <a href="login.php">Login</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>