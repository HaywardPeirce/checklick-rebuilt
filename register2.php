<?php
	if(mysql_connect('localhost', 'root', '') && mysql_select_db('NSC')){

		$firstname= @ $_POST['firstname'];
		$lastname= @ $_POST['lastname'];
		$address= @ $_POST['address'];
		$email= @ $_POST['email'];
		$homephone= @ $_POST['homephonenumber'];
		$workphone= @ $_POST['workphonenumber'];
		$cellphone= @ $_POST['cellphonenumber'];
		$numchildren= @ $_POST['numchildren'];
		$date = @ date("Y-m-d");
		$submitparents = @ $_POST['submitparents'];
		//true if the user has pressed submit
				
		$submit = @ $_POST['submit'];
		
				
		if($submit){
			$course_capacity = mysql_query("SELECT `spots` from `courses` WHERE `id`='$child1level'");
			$result = mysql_fetch_array($course_capacity);
			$capacity = $result['spots'];
			echo "The capacity of course ".$child1level." is: ".$capacity."<br>";
			$error=0;
			for($count=1; count<5;$count++){
				$childlevelcheck = @ $_POST['childlevel[$count]'];
				$childsessioncheck = @ $_POST['childsession[$count]'];
				
				$session_query = mysql_query("SELECT `session`, `level` FROM `students` WHERE `session`='$child1sessioncheck' && `level`='$childlevelcheck'");
				if(mysql_num_rows($session_query)>=$capacity){
					echo "Session ".$childsessioncheck." of course ".$childlevelcheck." for child ".$count." is already full!!";
					$error = 
				}
			}	
				
				
				else{
				
					$queryparentreg = "INSERT into `parents` VALUES('', '$firstname', '$lastname', '$address', '$email', '$homephone', '$workphone', '$cellphone', '$numchildren','$date')";
					
					if(mysql_query($queryparentreg)){
						echo "the parent has been registered";				
						$parentidcheck = mysql_query("SELECT `id` FROM `parents` WHERE `email`='$email'");				
						if(mysql_num_rows($parentidcheck)==0){
							echo 'no entries yet';
						}
						//if there are users in the table
						else{
						
							while($entries_row = mysql_fetch_assoc($parentidcheck)){
								$parent_id = $entries_row['id'];
								}
							
							echo "<br>The id of the parent being registered with the email ".$email." is: ".$parent_id."<br>";
							
							for($count=1; count<5;$count++){
								$childlevel = @ $_POST['childlevel[$count]'];
								$childsession = @ $_POST['childsession[$count]'];
								$child_firstname = @ $_POST['child_firstname[$count]'];
								$child_lastname = @ $_POST['child_lastname[$count]'];
								$child_age = @ $_POST['child_age[$count]'];
							
								$querystudentreg = "INSERT into `students` VALUES('', '$parent_id','$child_firstname', '$child_lastname', '$child_age','$child1level', '$child1session')";
								if(mysql_query($querystudentreg)){
									die("Your children have been registered, thank you for choosing NSC");
								}
							
							}
							
										
						}
						
					}
				}
			
			
			
			
			
		}
	}


?>

<form action="register2.php" method="post">
	<form>
		Please enter the following parental registration information:<br>
		First Name:<input type="text" name="firstname" value="<?php echo @$firstname; ?>"><br>
		Last Name: <input type="text" name="lastname" value="<?php echo @$lastname; ?>"><br>
		Address:<input type="text" name="address" value="<?php echo @$address; ?>"><br>
		Email: <input type="test" name="email" value="<?php echo @$email; ?>"><br>
		Home Phone number:<input type="text" name="homephonenumber" value="<?php echo @$homephone; ?>"><br>
		Work Phone number:<input type="text" name="workphonenumber" value="<?php echo @$workphone; ?>"><br>
		Cell Phone number:<input type="text" name="cellphonenumber" value="<?php echo @$cellphone; ?>"><br>
		Number of children being registered: 
		<select name="numchildren">
			<option value="1" selected>1</option>
			<option value="2" <?php if($numchildren==2){ ?>selected <?php }?>>2</option>
			<option value="3" <?php if($numchildren==3){ ?>selected <?php }?>>3</option>
			<option value="4" <?php if($numchildren==4){ ?>selected <?php }?>>4</option>
		</select><br><br>
		<input type="submit" name="submitparents" value="Continue">
	</form>
	<?php
	
	$childlevel = array();
	$childsession = array();
	$child_firstname = array();
	$child_lastname = array();
	$child_age = array();
	if(isset($submitparents)){
		for($count=1;$count<=$numchildren;$count++){
		?>
			Child <?php echo"$count"; ?>:<br>
			Please select a level to check course session availability:<br>
			<?php
			//add php into the name of the form depending on which child it is for
			//add code in options so that the selected option stays selected when page refreshes
			?>
			<select name="child_level[$count]" >
				
				<option value="1" selected>White Sail 1</option>
				<option value="2" >White Sail 2</option>
				<option value="3" >Intro to White Sail 3</option>
				<option value="4" >White Sail 3</option>
				<option value="5" >Bronze 4</option>
				<option value="6" >Bronze 5</option>
				<option value="7" >Silver 6</option>
				<option value="8" >HP</option>
			</select><br>

			<select name="child_session[$count]" >
				<option value="1" selected>Session 1 (July 4-15)</option>
				<option value="2" >Session 2 (july 18-29)</option>
				<option value="3" >Session 3 (August 1-12)</option>
				<option value="4" >Session 4 (August 15-26)</option>
			</select><br>
			Please enter the following registration information:<br>
			First Name:<input type="text" name="child_firstname[$count]"><br>
			Last Name: <input type="text" name="child_lastname[$count]"><br>
			Age:<input type="text" name="child_age[$count]"><br>
			
			<input type="submit" name="submit" value="Submit">
			<br><br>
			<?php
		}
	}
	?>
</form>