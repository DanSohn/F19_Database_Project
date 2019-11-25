<?php

	include('config/db_connect.php');

	//write query for all invoices ordered by date (this can change if we like)
	$sql = 'SELECT InvoiceNumber, OrderNumber, status FROM invoice_table ORDER BY date DESC';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$invoice = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);


 ?>

 <!DOCTYPE html>
 <html>

	<?php  include('templates/header.php');?>
	<?php  include('config/cookies.php');?>

	<h4 class="center grey-text">All Invoices</h4>

<!-- footer style not added -->
	<div class="container">
		<div class="row">

			<?php foreach($invoice as $one): ?>
				<div class="col s6 md3">
					<div class="card z-depth-1">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($one['InvoiceNumber']); ?></h6>
							<div><?php echo htmlspecialchars($one['OrderNumber']) ?></div>
						</div>
            <div class="card-action right-align">
							<a class="Pink" href="invoicestatus.php?InvoiceNumber=<?php echo $one['InvoiceNumber']?>">View Details of Invoice</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

	<?php  include('templates/footer.php');?>

 </html>
