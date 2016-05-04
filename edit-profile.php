<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");

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
                $error[] = "shit's empty yo";
            }
			else
			{
				$update_user->updateInfo($username, $fullname, $email);
				$update_user->redirect('profile.php?joined');
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
            <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a> &nbsp;</li>
            <li><input type="text" placeholder="Search"/></li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a> &nbsp;</li>
            <li><a href="post.php"><span class="glyphicon glyphicon-camera"></span> Post</a> &nbsp;</li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hello <?php echo $userRow['fullname']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="edit-profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Edit profile</a></li>
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
            <h2 class="form-signin-heading">Edit profile</h2> <hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Profile updated 
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
                <input type="file" class="form-control" name="avatar" id="avatar">
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