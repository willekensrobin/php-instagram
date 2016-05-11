<?php

require_once('db.class.php');

class Post
{	

	private $conn;
    
	public function __construct()
	{
		$database = new Db();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
    
    public function savePost($picture, $comment)
	{
		try
		{
			$statement = $this->conn->prepare("INSERT INTO db_picture(picture, description) 
		                                               VALUES(:picture, :comment)");								  
			$statement->bindparam(":picture", $picture);
            $statement->bindparam(":comment", $comment);										  
				
			$statement->execute();	
			
			return $statement;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
    
    public function getPosts () 
    {
        $result = $this->conn->query("SELECT * FROM db_picture");
        return $result;
    }
    
    public function redirect($url)
	{
		header("Location: $url");
	}

}
?>