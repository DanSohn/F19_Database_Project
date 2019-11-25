<?php

	include('config/db_connect.php');

	//write query for all orders ordered by date (this can change if we like)
	$sql = 'SELECT OrderNumber, OrderStatus FROM order_table ORDER BY CreatedDate DESC';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);


 ?>

 <!DOCTYPE html>
 <html>
    <!-- header contains the whole head tag, and the beginning of the body tag -->
	<?php  include('templates/header.php');?>
	<?php  include('config/cookies.php');?>
    
	<h4 class="center grey-text">All Orders</h4>

	<div class="container" style="padding-bottom:5rem;">
    
		<div class="row">

			<?php foreach($orders as $order): ?>
				<div class="col s6 md3">
					<div class="card z-depth-1">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($order['OrderNumber']); ?></h6>
							<div><?php echo htmlspecialchars($order['OrderStatus']) ?></div>
						</div>
            <div class="card-action right-align">
							<a class="Pink" href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>">View Details of Order</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
        
	
    </div>

	<?php  include('templates/footer.php');?>

 </html>
