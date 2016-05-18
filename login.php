<?php

require_once("classes/user.class.php");
include("templates/header.php");
$login = new User();

if($login->loggedin()!="")
{
	$login->redirect('home.php');
}

if(!empty($_POST))
{
	$username = strip_tags($_POST['username']);
	$email = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
		
	if($login->login($username,$email,$password))
	{
        $_SESSION['login'] = 1;
        $_SESSION['loggedin_user'] = $username;
		$login->redirect('home.php');
	}
	else
	{
		$error = "Email or password incorrect";
	}	
}
?>

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
       <div class="form-group">
            <button type="" name="btn-login" class="btn btn-primary">
<i class="fa fa-facebook"></i> <a style="color:#fff;" href="fbconfig.php">Login with Facebook</a>
            </button>
        </div> 

    </div>
    
</div>

<?php require_once("templates/footer.php") ?>
