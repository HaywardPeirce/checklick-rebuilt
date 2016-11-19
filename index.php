<?php
/*****************************************************************************************
index.php                                   Hayward Peirce
This file displays registration information
******************************************************************************************/
 
	echo '<h1>Wlecome to the Regstration page for the Nepean Sailing School</h1>';
?>

<form action="register.php" method="post">
	Please enter the following registration information:<br>
	First Name:<input type="text" name="firstname"><br>
	Last Name: <input type="text" name="lastname"><br>
	Address:<input type="text" name="address"><br>
	Email: <input type="test" name="email"><br>
	Home Phone number:<input type="text" name="homephonenumber"><br>
	Work Phone number:<input type="text" name="workphonenumber"><br>
	Cell Phone number:<input type="text" name="cellphonenumber"><br>
	Number of children being registered: 
	<select name="numchildren">
		<option value="1" selected>1</option>
		<option value="2" >2</option>
		<option value="3" >3</option>
		<option value="4" >4</option>
	</select><br>
	<input type="submit" name="submitrents" value="Continue">
</form>
