<?php

session_start();

require_once("classes/user.class.php");

$login = new User();

if($login->loggedin()!="")
{
	$login->redirect('dashboard.php');
}

if(!empty($_POST))
{
	$username = strip_tags($_POST['username']);
	$email = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
		
	if($login->login($username,$email,$password))
	{
		$login->redirect('dashboard.php');
	}
	else
	{
		$error = "Email or password incorrect";
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
    <title>Log into Instagram</title>
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
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Login</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username or email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Login
            </button>
        </div>  
      	<br />
            <label>Don't have an account yet? <a href="signup.php">Signup</a></label>
      </form>

    </div>
    
</div>

</body>
</html>