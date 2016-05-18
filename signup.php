<?php
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
    $checkemail = strip_tags($_POST['repeat_email']);
	$password = strip_tags($_POST['password']);
    $checkpass = strip_tags($_POST['repeat_pass']);
	
	if($username=="")	{
		$error[] = "Fill in a username";	
	}
    else if($fullname=="")	{
		$error[] = "Fill in your fullname";	
	}
	else if($email=="")	{
		$error[] = "Fill in your email";	
	}
    else if($email!=$checkemail)	{
		$error[] = "Email does not match";	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Email does not exist';
	}
	else if($password=="")	{
		$error[] = "Fill in password";
	}
    else if($password!=$checkpass)	{
		$error[] = "Password does not match";
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
<?php include("templates/header.php");?>

<div class="form-sign">

<div class="container">
    	
        <form method="post" class="form-signup">
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; You've been successfully registered <a href='login.php'>Login here</a>
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" id="username" onBlur="checkUserName(this.value)" name="username" placeholder="Username" value="<?php if(isset($error)){echo $username;}?>" /><span id="user-availability-status"></span>    
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Fullname" value="<?php if(isset($error)){echo $fullname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email" value="<?php if(isset($error)){echo $email;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="repeat_email" placeholder="Re-type email"/>
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="password" placeholder="Password" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="repeat_pass" placeholder="Re-type password" />
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

