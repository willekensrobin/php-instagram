<?php

require_once("classes/session.php");
include("templates/header.php");
require_once("classes/post.class.php");
include_once("classes/comment.class.php");

$p = new Post();

$posts = $p->getPosts();

$activity = new Comment();

$recentActivities = $activity->GetRecentActivities();

	
	//controleer of er een update wordt verzonden
	if(!empty($_POST['activitymessage']))
	{
		$comment = $_POST['activitymessage'];
		try 
		{
			$activity->Save();
		} 
		catch (Exception $e) 
		{
			$feedback = $e->getMessage();
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
    <title>Instagram</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        $(document).ready(function()
        {
            $("#btnSubmit").on("click", function(e){
                //tekstvak uitlezen 
                var message = $("#activitymessage").val();

                //post naar comment.php pagina om op te slaan 
                $.post( "ajax/comment.php", { message:message  }).done(function( respons ) {

                    //boodschap bijvoegen in UI 
                    if(respons.status == "succes")
                    {
                        var li = "<li style='display:none;'><h1>Follower</h1>" + respons.message + "/<li>";
                        $("ul#listupdates").prepend(li);
                        $("ul#listupdates li:first-child").slideDown("fast");

                        //laatste weghalen
                        $("ul#listupdates li").last().slideUp("fast", function(){
                        $(this).remove();
                        });
                    }

                });

                e.preventDefault();
            });

        });
    </script> 

    <script type="text/javascript">


    </script>
</head>

<body>
   
    <div class="clearfix"></div>
    	 
    <div class="container-fluid" style="margin-top:80px;">
	
        <div class="container">

            <p class="h4">Dashboard</p>
            
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
            
              <hr /> 
              
              <?php while($post = $posts->fetch(PDO::FETCH_ASSOC)):?>
               
                <div class="user-post">
                    <!-- naam poster -->
                    <a href="#">Robin Willekens</a> <br/>
                    <!-- afbeelding -->
                    <?php echo '<img height="500" width="500" src="data:image;base64,'. $post['picture']. ' "> ';?><br/>
                    <!-- naam poster + beschrijving -->
                    <span><a href="#">Robin Willekens </a><?php echo $post['description']; ?></span> <br/>
                    <!-- aantal likes -->
                    <span>2 likes</span> <br/>
                    <!-- reactie + naam van persoon die reageert -->
                    <span><a href=""></a></span> <br/>
                    <!-- Like button -->
                    <button>&hearts;</button>
                    <!-- reactieveld -->
                    <input type="text" name="activitymessage" id="activitymessage" placeholder="Add reaction" />
                    <input type="submit" value="Comment" id="btnSubmit">
                    <!-- tijd post -->
                    <span> 1min </span>
                    <div class="statusupdates">
                    <ul id="listupdates">
                    <?php 
                        if(count($recentActivities) > 0)
                        {		
                            foreach($recentActivities as $key=>$singleActivity)
                            {
                                echo "<li><h4>Follower</h4> ". $singleActivity['comment'] ."</li>";
                            }
                        }
                        else
                        {
                            echo "<li>Waiting for first status update</li>";	
                        }
                    ?>
                    </ul>
                    </div>
                </div>
                
                <br />
                <hr />
                <?php endwhile; ?>

        </div>

    </body>
</html>