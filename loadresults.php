<?php
	include_once 'db_config.php';//connect to the database
	
	if(isset($_POST['details']))//if the user is trying to log in check if such user exists
	{
		$name = $_POST['details'];
		$pass = $_POST['verify'];
		$sql = "SELECT * FROM users WHERE name='$name' AND password='$pass'";				
		$result1 = mysqli_query($conn, $sql);
		//if such user exists
		if(mysqli_num_rows($result1)>0)
		{
			$row = mysqli_fetch_assoc($result1);		
			$temp = $row['userid'];	
			//select all rows in the "scores" table that correspond to this user
			$sql = "SELECT * FROM scores WHERE userID='$temp'";				
			$result2 = mysqli_query($conn, $sql);
			$count=0;	
			//if such records exist
			if(mysqli_num_rows($result2)>0)
			{
				//display users progress on screen
				echo "Your Progress: ";
				while ($row = mysqli_fetch_assoc($result2))
				{
					//if the password provided matches the password in the "users" table
					//if($row['password']==$pass)
					//{
						$count=$count+1;
						echo "Attempt ";
						echo $count;
						echo ": quiz ";
						echo $row['quizName'];	
						echo ", score ";		
						echo $row['score'];
						echo "%. ";
					/*}
					else
					{
						echo "You haven't provided a password";
					}	*/				
				}
			}
			else //if user has no progress
			{
				echo "No previous results";
			}
		}
	}
	else
	{
			echo "Unexpected error";
	}
?>			
