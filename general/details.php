<?php
	include('config/db_connect.php');

	//check GET request id param
	if(isset($_GET['sin'])){
		$sin = mysqli_real_escape_string($conn, $_GET['sin']);

		//make sql
		$sql = "SELECT * FROM person_table WHERE SIN = $sin";

		//get the query result
		$result = mysqli_query($conn, $sql);

		//fetch result in array format
		$detail = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}
 ?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>

<div class="container center" style="padding-bottom:5rem;">
	<?php if($detail): ?>
		<h4><?php echo htmlspecialchars($detail['FName']." ".$detail['MName']." ".$detail['LName']);?></h4>
	<?php else: ?>
		<h5>No such user exists.</h5>

	<?php endif; ?>
</div>

<?php  include('templates/footer.php');?>

</html>
