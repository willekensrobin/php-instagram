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
    
    public function savePost($image, $name, $description)
	{
		try
		{
			$statement = $this->conn->prepare("INSERT INTO db_picture(picture, name, description) 
		                                               VALUES(:image, :name, :description)");								  
			$statement->bindparam(":image", $image);
            $statement->bindparam(":name", $name);	
            $statement->bindparam(":description", $description);	
				
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
        $result = $this->conn->query("SELECT * FROM db_picture ORDER BY id DESC");
        return $result;
    }
    
    public function redirect($url)
	{
		header("Location: $url");
	}

}
?>