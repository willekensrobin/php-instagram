<?php

    include_once("../classes/comment.class.php");
	$activity = new Comment();
	
	//controleer of er een update wordt verzonden
	if(!empty($_POST['message'])) 
	{
		$comment = $_POST['message'];
		try 
		{
			$activity->Save();
            $response['status'] = "succes";
            $response['message'] = $comment;
		} 
		catch (Exception $e) 
		{
			$response['status'] = "error";
            $response['message'] = $e->getMessage();
		}
        
        header('Content-Type: application/json');
        echo json_encode($response);
	}
	
?>