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
		$error[] = "Geef een gebruikersnaam in";	
	}
    else if($fullname=="")	{
		$error[] = "Geef uw volledige naam in";	
	}
	else if($email=="")	{
		$error[] = "Geef een emailadres in";	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Geef een geldig emailadres in';
	}
	else if($password=="")	{
		$error[] = "Wachtwoord invullen";
	}
	else if(strlen($password) < 6){
		$error[] = "Wachtwoord moet minstens 6 karakters bevatten";	
	}
	else
	{
		try
		{
			$statement = $user->runQuery("SELECT username, email FROM db_users WHERE username=:username OR email=:email");
			$statement->execute(array(':username'=>$username, ':email'=>$email));
			$row=$statement->fetch(PDO::FETCH_ASSOC);
				
			if($row['username']==$username) {
				$error[] = "Gebruikersnaam is al in gebruik";
			}
			else if($row['email']==$email) {
				$error[] = "Emailadres is al in gebruik";
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
            <h2 class="form-signin-heading">Sign up.</h2><hr />
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
            <input type="text" class="form-control" name="username" placeholder="Gebruikersnaam" value="<?php if(isset($error)){echo $username;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Volledige naam" value="<?php if(isset($error)){echo $fullname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Emailadres" value="<?php if(isset($error)){echo $email;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="password" placeholder="Wachtwoord" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Registreren
                </button>
            </div>
            <br />
            <label>Heeft u al een account? <a href="index.php">Aanmelden</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>