<?php
	include('config/db_connect.php');

	//check GET request id param
	if(isset($_GET['OrderNumber'])){
		$OrderNumber = mysqli_real_escape_string($conn, $_GET['OrderNumber']);

		//make sql
		$sql = "SELECT * FROM order_table WHERE OrderNumber=$OrderNumber";
		//get the query result
		$result = mysqli_query($conn, $sql);
		//fetch result in array format
		$status = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($conn);



	}
 ?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>
<!-- footer style padding not added -->
<h3>Order Number: <?php echo htmlspecialchars($status['OrderNumber']);?></h3>
<div class="row justify-content-center white z-depth-2" style ="width:1040px">

	<?php if($status): ?>
		<h4><?php echo htmlspecialchars($status['OrderNumber']." ".$status['Cost']." ".$status['OrderStatus']);?></h4>
	<?php else: ?>
		<h5>No such order exists.</h5>

	<?php endif; ?>
</div>

<?php  include('templates/footer.php');?>

</html>
