function checkUserName(usercheck)
{
	$.post("../classes/checkuser.class.php", {user_name: usercheck} , function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {				   
				  $('#usercheck').html(data);	
			   }
          });
}