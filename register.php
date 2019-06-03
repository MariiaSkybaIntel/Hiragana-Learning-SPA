<?php
	include_once 'db_config.php'; //connect to the database

		//if the user provided register details
		if(isset($_POST['details']) && $_POST['details']!== "" && $_POST['contact']!== "")
		{
			$name = $_POST['details'];
			$email = $_POST['contact'];
			$pass = $_POST['verify'];		

			//check if there's no duplicate details
			$sql = "SELECT * FROM users WHERE name='$name'";				
			$result = mysqli_query($conn, $sql);
			$sql = "SELECT * FROM users WHERE email='$email'";				
			$result2 = mysqli_query($conn, $sql);
				
			if(mysqli_num_rows($result)>0||mysqli_num_rows($result2)>0)
			{
				echo "Details already exist.";
			} 
			//if the details provided do not already exist
			else 
			{
				//save details in the "users" table
				$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')";
				//	
				if (mysqli_query($conn, $sql))
				{
					//print greeting on screen
					echo "Welcome, ";
					echo $name;			
					echo "! You have successfully registered.";
				} 
				//if saving was unsuccessful
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
		//if no details were provided but the button was clicked
		else
		{
			echo "No details provided.";
		}
?>
