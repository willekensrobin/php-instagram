<?php

	require_once("classes/session.php");
	
	require_once("classes/user.class.php");

	$auth_user = new User();
	
	if(isset($_SESSION['loggedin_userid'])){
	$user_id = $_SESSION['loggedin_userid'];
	
	$statement = $auth_user->runQuery("SELECT * FROM db_users WHERE id=:id");
	$statement->execute(array(":id"=>$user_id));
	
	$userRow=$statement->fetch(PDO::FETCH_ASSOC);
    }
else{
    $userRow = [];
}

?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Instagram -
            <?php echo $userRow['fullname']; ?>
        </title>
        <link rel="shortcut icon" href="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>


        <body>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="home.php"><p>IMDSTAGRAM</p></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href=""><i class="fa fa-camera" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-bell" aria-hidden="true"></i>
</a>
                        </li>
                        <li>
                            <a href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>
</a>
                        </li>
                         <li>
                            <a href="post.php"><i class="fa fa-upload" aria-hidden="true"></i>
</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                               <?php if(isset($_SESSION['loggedin_userid'])){ ?>
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Hello
                                <?php echo $userRow['fullname']; ?>&nbsp;<span class="caret"></span></a> 
                                <ul class="dropdown-menu">
                                  <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>
                                <li><a href="account.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;Edit Account</a></li>
                                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                          
                               <?php }else{?>
                                <li><a href="login.php">Login</a></li>
                                <?php } ?>
                                  </ul>
                                
                            
                        </li>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
                
                <!-- /.container-fluid -->
            </nav>