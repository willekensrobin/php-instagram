<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");
	$auth_user = new User();
	
	
	$user_id = $_SESSION['session'];
	
	$statement = $auth_user->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $userRow['fullname']; ?></title>
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
            <li class="active"><a href="#">Dummy 1</a></li>
            <li><a href="#">Dummy 2</a></li>
            <li><a href="#">Dummy 3</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hello <?php echo $userRow['fullname']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown">
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
    
    	<label class="h5">Welcome : <?php print($userRow['fullname']); ?></label>
        <hr />
        
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></h1>
        <hr />
        
        <p class="h4">Profile</p> 
        
    
    </div>

</div>

</body>
</html>