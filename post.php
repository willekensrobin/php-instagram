<?php

require_once("classes/session.php");

require_once("classes/post.class.php");

$post = new Post();

if(!empty($_POST))
{
    if(getimagesize($_FILES['picture']['tmp_name']) == FALSE)
    {
        echo "Please select an image.";
    }
    else
    {
        $image= addslashes($_FILES['picture']['tmp_name']);
        $name= addslashes($_FILES['picture']['name']);
        $image= file_get_contents($image);
        $image= base64_encode($image);
        $description = $_POST['description'];
        
        if($post->savePost($image, $name, $description))      
        {
            $post->redirect('dashboard.php?joined');
        }
        
    }
}
?>
<?php include("templates/header.php"); ?>
   
    <div class="clearfix"></div>
    	  
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
        
        <form method="post" enctype="multipart/form-data" class="form-post">
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
            <input type="text" class="form-control" name="description" placeholder="Write description" id="description" />
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
