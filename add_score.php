<?php
	include_once 'db_config.php';
	
		if(isset($_POST['details']))
		{	
			//store data in variables
			$name = $_POST['details'];
			$quiz = $_POST['type'];		
			$score = $_POST['result'];

			//create an SQL query
			$sql = "SELECT * FROM users WHERE name='$name'";
			//store the database response of the query				
			$result = mysqli_query($conn, $sql);
			//if such records exist in the databse			
			if(mysqli_num_rows($result)>0)
			{
				$row = mysqli_fetch_assoc($result);		
				$temp = $row['userid'];//get userID from the database
				//save the user's progress for the quiz they've taken
				$sql = "INSERT INTO scores (userID, quizName, score) VALUES ('$temp', '$quiz', '$score')";
					//if the results have been successfully saved in the database				
					if (mysqli_query($conn, $sql))
					{	
						echo "Your result has been saved! ";
						echo "Re-log in to see your updated progress. ";
					}
					//if couldn't save the results 
					else
					{
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
			} 
			else
			{
				echo "Could not determine user :(";		
			}
		}
?> 
