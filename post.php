<?php

require_once("classes/session.php");

require_once("classes/post.class.php");

include("templates/header.php");

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


    
?>

    <div class="clearfix"></div>
    	  
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
        
        <form method="post" class="form-post">
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
    
<?php include("templates/footer.php")?>
