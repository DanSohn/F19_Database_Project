<?php

    $user = '';
    include('config/db_connect.php');
    include('config/cookies.php');
    $sql = '';
    $sin = $user['SIN'];
    if($user['PersonType'] == 'Client') {
        $sql = "SELECT OrderNumber, OrderStatus FROM order_table WHERE Client_SIN = $sin";
        //write query for all orders ordered by date (this can change if we like)
    }
    else{
        $sql = 'SELECT OrderNumber, OrderStatus FROM order_table ORDER BY OrderStatus DESC';
    }
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

<h4 class="center grey-text">Requested Orders</h4>
<div class="row justify-content-center yellow lighten-3 z-depth-2" style ="width:1040px;">
    <table class = "table">
        <thread>
            <tr>
                <th class = "center">Order Number</th>
                <th class = "center">Status</th>
                <th colspan = '2' class ="center">Action</th>
            </tr>
        </thread>
        <?php foreach ($orders as $order):?>
            <?php if($order['OrderStatus'] == 'Requested'):?>
                <tr>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                    <td class = "center">
                        <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>

<?php if($user['PersonType'] == "Client"):?>
    <h4 class="center grey-text">Orders in Progress</h4>
    <div class="row justify-content-center green lighten-3 z-depth-2" style ="width:1040px;">
        <table class = "table">
            <thread>
                <tr>
                    <th class = "center">Order Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($orders as $order):?>
                <?php if(!($order['OrderStatus'] == 'Rejected') || (!$order['OrderStatus'] =='Requested')):?>
                    <tr>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                        <td class = "center">
                            <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
<?php else:?>
    <h4 class="center grey-text">Approved Orders</h4>
    <div class="row justify-content-center green lighten-3 z-depth-2" style ="width:1040px;">
        <table class = "table">
            <thread>
                <tr>
                    <th class = "center">Order Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($orders as $order):?>
                <?php if($order['OrderStatus'] == 'Approved'):?>
                    <tr>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                        <td class = "center">
                            <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <h4 class="center grey-text">Design Completed Orders</h4>
    <div class="row justify-content-center purple lighten-3 z-depth-2" style ="width:1040px;">
        <table class = "table">
            <thread>
                <tr>
                    <th class = "center">Order Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($orders as $order):?>
                <?php if($order['OrderStatus'] == 'Design Complete'):?>
                    <tr>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                        <td class = "center">
                            <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <h4 class="center grey-text">Prepared Orders</h4>
    <div class="row justify-content-center brown lighten-3 z-depth-2" style ="width:1040px;">
        <table class = "table">
            <thread>
                <tr>
                    <th class = "center">Order Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($orders as $order):?>
                <?php if($order['OrderStatus'] == 'Order Prepared'):?>
                    <tr>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                        <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                        <td class = "center">
                            <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif;?>

<h4 class="center grey-text">Rejected Orders</h4>
<div class="row justify-content-center red lighten-3 z-depth-2" style ="width:1040px;">
    <table class = "table">
        <thread>
            <tr>
                <th class = "center">Order Number</th>
                <th class = "center">Status</th>
                <th colspan = '2' class ="center">Action</th>
            </tr>
        </thread>
        <?php foreach ($orders as $order):?>
            <?php if($order['OrderStatus'] == 'Rejected'):?>
                <tr>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                    <td class = "center">
                        <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>

<h4 class="center grey-text">Completed Orders</h4>
<div class="row justify-content-center grey lighten-3 z-depth-2" style ="width:1040px;">
    <table class = "table">
        <thread>
            <tr>
                <th class = "center">Order Number</th>
                <th class = "center">Status</th>
                <th colspan = '2' class ="center">Action</th>
            </tr>
        </thread>
        <?php foreach ($orders as $order):?>
            <?php if($order['OrderStatus'] == 'Completed'):?>
                <tr>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderNumber']); ?></td>
                    <td class = "center"><?php echo htmlspecialchars($order['OrderStatus']); ?></td>
                    <td class = "center">
                        <a href="orderstatus.php?OrderNumber=<?php echo $order['OrderNumber']?>" class = "btn btn-info">Details</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>

</div>

<?php  include('templates/footer.php');?>

</html>