<?php

include_once("db.class.php");

class Comment
{
	private $m_sText;
    
    private $conn;
    
	public function __construct()
	{
		$database = new Db();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function Save($comment)
	{	
        
        try
		{
			$statement = $this->conn->prepare("INSERT INTO db_comments(comment) 
		                                               VALUES(:comment)");								  
			$statement->bindparam(":comment", $comment);	
				
			$statement->execute();	
			
			return $statement;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	  
        
	}
	
	public function getRecentActivities() 
    {
        $result = $this->conn->query("SELECT * FROM db_comments ORDER BY id DESC");
        return $result;
    }
}
?>