<?php
require 'classes/db.class.php';
function checkuser($fuid,$ffname,$femail){
   
    $check = mysql_query("select * from db_users where Fuid='$fuid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO db_users (Fuid,Ffname,email) VALUES ('$fuid','$ffname','$femail')";
	mysql_query($query);	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE db_users SET Ffname='$ffname', email='$femail' where Fuid='$fuid'";
	mysql_query($query);
	}
}?>
