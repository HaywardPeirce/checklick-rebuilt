<?php
/*****************************************************************************************
register.php                                   Hayward Peirce
This file containsd the code related to the registration of a new user
******************************************************************************************/


	echo '<h1>Register:</h1>';
	//connect to the localhost server, and connect to the phplogin database which contains the user credentials
	if(mysql_connect('localhost', 'root', '') && mysql_select_db('NSC')){
		
		$firstname= @ $_POST['firstname'];
		$lastname= @ $_POST['lastname'];
		$address= @ $_POST['address'];
		$email= @ $_POST['email'];
		$homephone= @ $_POST['homephone'];
		$workphone= @ $_POST['workphone'];
		$cellphone= @ $_POST['cellphone'];
		$numchildren= @ $_POST['numchildren'];
		$date = @ date(Y-m-d);
				
		//true if the user has pressed submit
				
		$submit = @ $_POST['submit'];
		$child1level = @ $_GET['child1level'];
		$child1session = @ $_POST['child1session'];
		$child_firstname = @ $_POST['child_firstname'];
		$child_lastname = @ $_POST['child_lastname'];
		$child_age = @ $_POST['child_age'];
		
		//when submited
		if($submit){
			
			//connect to the localhost server, and connect to the phplogin database which contains the user credentials
			$connect = mysql_connect('localhost', 'root', '');
			mysql_select_db('NSC'); //select database
			
			$queryparentreg = "INSERT into `parents` VALUES('', '$firstname', '$lastname', '$address', '$email', '$homephone', '$workphone', '$cellphone')";

			
			//query the server for the usernames 
			$parentidcheck = mysql_query("SELECT id FROM users WHERE email='$email'"); 
			
			$count = mysql_num_rows($parentidcheck);
			//if no usernames kill the page
			if($count=0){
				die("No parent Registered");
			}
			
			//if all the form fields are filled out
			if($child_firstname&&$child_lastname&&$child1level&&$child1session&&$child_age){
				//if both enetered passwords match
				if($password==$repeatpassword){
					//if both the username or full name are greater than 25 characters, error
					if(strlen($username)>25 || strlen($fullname)>25){
						echo 'max limit for username and fullname is 25 characters';
					}
					else{
						//if the password is greater than 25 or less than 6, error
						if(strlen($password)>25|| strlen($password)<6){
							echo 'Passord must be between 6 and 25 characters ';
						}
						
						//if not of the above error conditions have been met, allow the user to be registered
						else{
							//encrypt password
							$password = md5($password);
							$repeatpassword = md5($repeatpassword);
							
							$queryreg = "INSERT INTO `users` VALUES ('','$fullname','$email','$username','$password','$date','')";
							if(mysql_query($queryreg)){
								//when the user has been regitered link them back to the login index.php page
								die("you have been registered, <a href= 'index.php'>Return to login page</a>");
							}
							
						}
						
					}
				
				}
				//tell the user their passwords dont match
				else{
					echo 'Your passwords do not match';
				}
				
			}
			//tell the user they have left fields blank
			else
				 echo 'Please complete all fields';
		}
	}
	//if the page could not connect to the server
	else{
		echo 'Could not connect';
	}

//code for the registration form	
?>
<form action="register.php" method="post">
	<br />
	
	<table>
		<tr>
			<td>
			Your Full Name:
			</td>
			<td>
			<input type="text" name="fullname" value="<?php echo @$fullname; ?>">
			</td>
		</tr>
		<tr>
			<td>
			Your Email:
			</td>
			<td>
			<input type="text" name="email" value="<?php echo @$email; ?>">
			</td>
		</tr>
		<tr>
			<td>
			Username:
			</td>
			<td>
			<input type="text" name="username" value="<?php echo @$username; ?>">
			</td>
		</tr>
		<tr>
			<td>
			Password:
			</td>
			<td>
			<input type="password" name="password" >
			</td>
		</tr>
		<tr>
			<td>
			Repeat password:
			</td>
			<td>
			<input type="password" name="repeatpassword" >
			</td>
		</tr>
	</table>
	<p>
	<input type="submit" name="submit" value="Register">
</form>

	