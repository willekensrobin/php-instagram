<?php

require_once("classes/session.php");

require_once("classes/post.class.php");

$post = new Post();

if(!empty($_POST))
{
    $picture = $_POST['picture'];
    $comment = strip_tags($_POST['comment']);
    
    if($picture=="")	
    {
		$error[] = "No picture";	
	}
    else if($comment=="")	
    {
		$error[] = "Add a description";	
	}
    else
    {
        try
		{
            if($post->savePost($picture, $comment))
            {	
				$post->redirect('dashboard.php?joined');
            }
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
}


    
?><!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Post picture</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
            <h2 class="form-signin-heading">Post picture</h2> <hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Success 
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
                <input type="file" class="form-control" name="picture" id="picture">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="comment" placeholder="Write description" id="comment" />
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
            
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Post
                </button>
                
            </div>
        </form>

    </div>

</div>
    
</body>
</html>
