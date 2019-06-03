<?php
	include_once 'db_config.php'; //connect to the database

	//if the user provided login details
	if(isset($_POST['details']) && $_POST['details']!== "")
	{
		//store login data
		$name = $_POST['details'];
		$pass = $_POST['verify'];
		//check if such user exists	
		$sql = "SELECT * FROM users WHERE name='$name'";				
		$result = mysqli_query($conn, $sql);
			
		if(mysqli_num_rows($result)>0)
		{
			while ($row = mysqli_fetch_assoc($result))
			{
				//if the password provided matches the password in the "users" table
				if($row['password']==$pass)
				{
					//print greeting on screen
					echo "Hello, ";	
					echo $row['name'];			
					echo "! You are now logged in.";
				}
				//if the password is wrong
				else 
				{
					echo "Incorrect login details";
				}
			}
		}
		//if the user doesn't exist
		else 
		{
			echo "No such user, please register.";
		}
	}
	//if no login details were provided but the button was clicked
	else
	{
			echo "No details provided.";
	}
?>			
