<?php
//$child1level = $_GET['child1level'];
//echo 'child1: '.$child1level;
if(mysql_connect('localhost', 'root','') && mysql_select_db('NSC')){
		//add code in here to loop for the number of chosen children
		$child1level = @ $_GET['child1level'];
		$child1session = @ $_POST['child1session'];
		$child_firstname = @ $_POST['child_firstname'];
		$child_lastname = @ $_POST['child_lastname'];
		$child_age = @ $_POST['child_age'];
		$submit = @ $_POST['submit'];
		
		$submitrents = @ $_POST['submitrents'];
		$firstname= @ $_POST['firstname'];
		$lastname= @ $_POST['lastname'];
		$address= @ $_POST['address'];
		$email= @ $_POST['email'];
		$homephone= @ $_POST['homephone'];
		$workphone= @ $_POST['workphone'];
		$cellphone= @ $_POST['cellphone'];
		$numchildren= @ $_POST['numchildren'];
		$date = @ date(Y-m-d);
		
		if($submit){
			
			echo 'i got this far';
			
			
			$queryparentreg = "INSERT into `parents` VALUES('', '$firstname', '$lastname', '$address', '$email', '$homephone', '$workphone', '$cellphone')";
			//read back the parent id so it can be submitted with the sudent info
			
			$entries = mysql_query("SELECT `id` FROM `parents` WHERE email='.$email.'");
			//if there are no users in the table
			if(mysql_num_rows($entries)==0){
				echo 'no entries yet';
			}
			while($entries_row = mysql_fetch_assoc($entries)){
				$parent_id = $entries_row['id'];
			}
			if(isset($parent_id)){
				$querystudentreg = "INSERT into `students` VALUES('', '$parent_id','$firstname', '$lastname', '$age','$child1level', '$child1session')";
				if(mysql_query($queryreg)){
					die("Your children _____ and _____ have been registered, thank you for choosing NSC");
				}
			}
		}
	}	
	else{
		echo 'Could not connect';
	}
?>

<form action="register.php" method="post">
	<form>
	Child 1:<br>
	Please select a level to check course session availability:<br>
	<?php
	//add php into the name of the form depending on which child it is for
	//add code in options so that the selected option stays selected when page refreshes
	?>
	<select name="child1level" >
		
		<option value="register.php?child1level=whitesail1" selected>White Sail 1</option>
		<option value="register.php?child1level=whitesail2" >White Sail 2</option>
		<option value="register.php?child1level=whitesail3" >White Sail 3</option>
		<option value="register.php?child1level=bronze4" >Bronze 4</option>
		<option value="register.php?child1level=bronze5" >Bronze 5</option>
		<option value="register.php?child1level=silver6" >Silver 6</option>
		<option value="register.php?child1level=hpyrt" >HP</option>
	</select><br>
	<input type="button" name="Continue" value="Go" 
		onClick="top.location.href = this.form.child1level.options[this.form.child1level.selectedIndex].value;
		return false;">
	</form>
	<?php
	if(isset($_GET['child1level'])){
		//add code here to make the name of the course look nice
		echo $child1level;
		//add code here to make sure that there is room in the course
				
		echo '<br><br>Please choose from one of the available sessions: ';
		?>
		<?php
		//<form action="register.php" method="post">
		?>
		<select name="child1session" >
			<option value="ses1" selected>Session 1 (July 4-15)</option>
			<option value="ses2" >Session 2 (july 18-29)</option>
			<option value="ses3" >Session 3 (August 1-12)</option>
			<option value="ses4" >Session 4 (August 15-26)</option>
		</select><br>
		<form action="register.php" method="post">
			Please enter the following registration information:<br>
			First Name:<input type="text" name="child_firstname"><br>
			Last Name: <input type="text" name="child_lastname"><br>
			Age:<input type="text" name="child_age"><br>
		</form>
		<input type="submit" name="submit" value="Submit">
		<?php
		//</form>
		?>
	<?php	
		}
	?>
	
</form>
	
	