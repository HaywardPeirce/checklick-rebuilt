<?php
/*****************************************************************************************
member.php                                   Hayward Peirce
This file displays main event, comment, and event creation code
******************************************************************************************/


//start the session
session_start();
//if the session username is set
if($_SESSION['username']){
	//welcome the user and link them to the logout page
	echo "Welcome, ". $_SESSION['name']. "! <br><a href='logout.php'>Logout</a>";
	echo "<hr>";
	
	
	
	?>

	<table border="1">
	<tr>
	  <td width="600">

	<?php
	//connect to the localhost server, and connect to the create_event database which contains the event and event comment details
	if(mysql_connect('localhost', 'root', '') && mysql_select_db('checkclick')){
		//display entries
		//if the user has clicked on an event and set that event choice id set that as a session variable
		if(isset($_GET['sid'])){
			$studentid=$_GET['sid'];
			
			$_SESSION['sid']= $studentid;
		}
		
		//code for printing out the list of upcoming events
		
		//query the database for the info related to the events: name, time, studentid; and order by time
		$entries = mysql_query("SELECT * FROM `student` ORDER BY `name` DESC");
		//if there are no events tell the user so
		if(mysql_num_rows($entries)==0){
			echo 'no entries yet';
		}
		//if there are events:
		else{
			echo '<h1><strong> <a href="member.php"> Current Session: </a></strong></h1>';
			if($_SESSION['admin']==1){
				echo '<a href="admin.php"> Admin page: </a> ';
			}
			
			//sycling through the rows:
			while($entries_row = mysql_fetch_assoc($entries)){
				//get the event info from the database
				$entries_name = $entries_row['name'];
				$entries_id = $entries_row['id'];
				$entries_current_level= $entries_row['current_level'];
				$entries_current_session= $entries_row['current_session'];
				$_SESSION['studentchoice'] = $entries_id;
				
				if($_SESSION['instructor_session']==$entries_current_session){
					//code for the event list
					//if the user has admin privilages
					if($_SESSION['admin']==1){
						//table for displaying the list of events
						?>
						<table>
							<tr>
								<td>
								<?php echo '<p> <strong>  --- <a href="member.php?sid='.$entries_id.'"> '.$entries_name.' </a> ('.$entries_time.') </strong>';
								echo '</p>';
								?>
								</td>
								<td>
								<form action="member.php?delete=<?php echo $entries_id; ?>" method="post">
									<input type="submit" value="Delete" name="delete">
								</form>
								</td>
							</tr>
						</table>
						
						<?php
						//if the admin has clicked the delete button
						if(isset($_GET['delete'])){
							//set the delete variable from the earlier created delete session variable
							$deletesubmit = $_GET['delete'];
							$delete = "DELETE FROM `event` WHERE `studentid`='$deletesubmit'";
							//if the deletion works redirect back to the member.php page
							if(mysql_query($delete)){
								echo 'this event has been deleted';
								header('Location: member.php');
							}
						}			
					}
					//if the user has no admin privalages display the event list without the delete button
					else {
						echo '<p> <strong>  --- <a href="member.php?sid='.$entries_id.'"> '.$entries_name.' </a></strong></p> ';
					}
				}
			}
			
		}
		
		
		
			
	}
	
	?>

	<td width="600">
	<?php 
	//include("ava.php"); 
	if(isset($_GET['sid'])){
				
		//code for printing out the details of a specific event
		//echo '<strong>Event Details:</strong>';
		
		$entries_full = mysql_query("SELECT * FROM `student` WHERE `id`='$studentid' ");
		
		//if there are no events
		if(mysql_num_rows($entries_full)==0){
			echo 'no event yet';
		}
		//if there are events
		else{
			//keeping the list refreshed, updating the entries from the queried table
			while($entries_full_row = mysql_fetch_assoc($entries_full)){
				$entries_full_birthday = date("l d F Y",strtotime($entries_full_row['birthday']));
				$entries_full_name= $entries_full_row['name'];
				$entries_full_current_level= $entries_full_row['current_level'];
				$entries_full_current_session= $entries_full_row['current_session'];
				$entries_full_Wetfeet=$entries_full_row['Wetfeet'];
				$entries_full_CANSail_1=$entries_full_row['CANSail 1'];
				$entries_full_CANSail_2=$entries_full_row['CANSail 2'];
				$entries_full_CANSail_3=$entries_full_row['CANSail 3'];
				$entries_full_CANSail_4=$entries_full_row['CANSail 4'];
				$entries_full_CANSail_5=$entries_full_row['CANSail 5'];
				$entries_full_CANSail_6=$entries_full_row['CANSail 6'];
				
				
				
				$student_level_query = mysql_query("SELECT * FROM `course` WHERE `id`='$entries_full_current_level' ");
				$student_level_query_result=mysql_fetch_array($student_level_query);
				$level_name = $student_level_query_result['name'];
				

				//displaying the students current info
				echo '<p><strong> '.$entries_full_name.' Born: '.$entries_full_birthday.' </strong><br>';
				//echo '<strong>Current Level: </strong>'.$entries_full_current_level.'<br><strong> Current Session: </strong>'.$entries_full_current_session.'<br></p>';
				echo '<strong>Current Level: </strong>'.$level_name.'<br>';
				if($entries_full_row[$level_name]!=0){
					if($entries_full_row[$level_name]==2){
						echo '<strong>  --- Status:</strong> Passed';
					}
					else echo '<strong> --- Status:</strong> In Progress';
				}
				else echo '<strong> --- Status:</strong> Incomplete';
				echo '<br><strong> Current Session: </strong> Session '.$entries_full_current_session.'<br><hr>';
				
				
			}
		}
		//code for the checklist
		echo $level_name.' checklist';
		
		$entries_checklist = mysql_query("SELECT * FROM '$level_name' WHERE `id`='$studentid' ");
		
		//if there are no events
		if(mysql_num_rows($entries_checklist)==0){
			echo 'no event yet';
		}
		//if there are events
		else{
			//keeping the list refreshed, updating the entries from the queried table
			while($entries_checklist_row = mysql_fetch_assoc($entries_checklist)){
				$entries_checklist_test_activity_1 = $entries_full_row['name'];
				$entries_checklist_test_activity_2= $entries_full_row['name'];
				
	}
	
	?>

	</tr>
	</table>


<?php
	
}
//if you are not within a session kill the page 	
else die("You must be logged in!")
?>

<hr>