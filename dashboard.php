<?php

require_once("classes/session.php");

require_once("classes/post.class.php");

include("templates/header.php");

$p = new Post();

$posts = $p->getPosts();

?>

    <div class="clearfix"></div>
    	 
    <div class="container-fluid" style="margin-top:80px;">
	
        <div class="container">

            <p class="h4">Dashboard</p>
            
              <hr /> 
              
              <?php while($post = $posts->fetch(PDO::FETCH_ASSOC)):?>
               
                <div class="user-post">
                    <!-- naam poster -->
                    <a href="#">Wobin Rillekens</a> <br/>
                    <!-- afbeelding -->
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($post['picture']); ?>" alt="" /> <br/>
                    <!-- naam poster + beschrijving -->
                    <span><a href="#"></a><?php echo $post['description']; ?></span> <br/>
                    <!-- aantal likes -->
                    <span>2 likes</span> <br/>
                    <!-- reactie + naam van persoon die reageert -->
                    <span><a href=""></a></span> <br/>
                    <!-- Like button -->
                    <button>&hearts;</button>
                    <!-- reactieveld -->
                    <input type="text" placeholder="Add a reacton" />
                    <!-- tijd post -->
                    <span> 2u </span>
                </div>
                
                <br />
                <hr />
                <?php endwhile; ?>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
