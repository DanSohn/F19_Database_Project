<?php
	include('config/db_connect.php');
	include('config/cookies.php');
	//check GET request id param
	if(isset($_GET['PhoneNumber'])){
		$PhoneNumber = mysqli_real_escape_string($conn, $_GET['PhoneNumber']);

		//make sql
		$sql = "SELECT * FROM person_table WHERE PhoneNumber=$PhoneNumber";
		//get the query result
		$result = mysqli_query($conn, $sql);
		//fetch result in array format
		$status = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
  }
 ?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>
<!-- footer style padding not added -->
<h3>Client: <?php echo htmlspecialchars($status['PhoneNumber']);?></h3>
<div class="row justify-content-center beige z-depth-2" style ="padding:20px; width:1040px";>
  <h5>Client Details:</h5>
  <table class = "table">
    <thread>
      <tr>
        <th class ="center">First Name</th>
        <th class ="center">Middle Name</th>
        <th class ="center">Last Name</th>
        <th class ="center">Phone Number</th>
        <th class ="center">Email</th>
        <th class ="center">Address</th>
        <th class ="center">City</th>
        <th class ="center">Postal Code</th>
      </tr>
    </thread>
      <tr>
        <td class = "center"><?php echo htmlspecialchars($status['FName']);?>"</td>
        <td class = "center"><?php echo htmlspecialchars($status['MName']);?>"</td>
        <td class = "center"><?php echo htmlspecialchars($status['LName']);?></td>
        <td class = "center"><?php echo htmlspecialchars($status['PhoneNumber']);?>"</td>
        <td class = "center"><?php echo htmlspecialchars($status['Email']);?>"</td>
        <td class = "center"><?php echo htmlspecialchars($status['Address']);?></td>
        <td class = "center"><?php echo htmlspecialchars($status['City']);?>"</td>
        <td class = "center"><?php echo htmlspecialchars($status['PostalCode']);?>"</td>
      </tr>
    </table>
</div>
<?php  include('templates/footer.php');?>

</html>
