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

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>

<h4 class="center grey-text">All Orders</h4>

<!-- footer style not added -->
<div class="row justify-content-center white z-depth-2" style ="width:1040px">
    <table class = "table">
        <thread>
            <tr>
                <th class = "center">Invoice Number</th>
                <th class = "center">Status</th>
                <th colspan = '2' class ="center">Action</th>
            </tr>
        </thread>
        <?php foreach ($orders as $order):?>
            <tr>
                <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                <td class = "center">
                    <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>

<?php  include('templates/footer.php');?>

</html>