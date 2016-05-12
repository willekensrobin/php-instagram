<?php 
// http://www.itechroom.com : Technology News, Web Development and more

$arr_user=array("itechroom", "trialuser");
$username=$_POST['user_name'];


if(in_array($username,$arr_user)) 
{echo '<span class="error">Username already exists.</span>';exit;}

else if(strlen($username) < 6 || strlen($username) > 15){echo '<span class="error">Username must be 6 to 15 characters</span>';}
else if (preg_match("/^[a-zA-Z1-9]+$/", $username)) 
{
       echo '<span class="success">Username is available.</span>';
} 
else 
{
      echo '<span class="error">Use alphanumeric characters only.</span>';
}

?>