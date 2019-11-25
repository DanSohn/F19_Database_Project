<?php
	include('config/db_connect.php');

	//check GET request id param
	if(isset($_GET['InvoiceNumber'])){
		$InvoiceNumber = mysqli_real_escape_string($conn, $_GET['InvoiceNumber']);

		//make sql
		$sql = "SELECT * FROM invoice_table WHERE InvoiceNumber=$InvoiceNumber";

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
<div class="container center" style="padding-bottom:5rem;">
	<?php if($status): ?>
		<h4><?php echo htmlspecialchars($status['InvoiceNumber']." ".$status['cost']." ".$status['status']);?></h4>
	<?php else: ?>
		<h5>Order not completed, invoice does not exist yet.</h5>

	<?php endif; ?>
</div>

<?php  include('templates/footer.php');?>

</html>
