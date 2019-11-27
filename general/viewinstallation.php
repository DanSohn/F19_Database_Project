<?php
    $user = '';
	include('config/db_connect.php');
    include('config/cookies.php');
    $sql = '';
    $sin = $user['SIN'];
    if($user['PersonType'] == 'Client') {
        $sql = "SELECT OrderNumber, Status
                FROM installation_table AS i, order_table AS o
                WHERE o.Client_SIN = $sin, o.OrderNumber = i.OrderNumber";

    } else {
        $sql = "SELECT OrderNumber, Status
                  FROM installation_table AS i JOIN order_table AS o ON o.OrderNumber = i.OrderNumber
                  WHERE o.Client_SIN = $sin";
    }
	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$installation = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
 ?>

 <!DOCTYPE html>
 <html>

	<?php  include('templates/header.php');?>
	<?php  include('config/cookies.php');?>

	<h4 class="center grey-text">All Installations</h4>

<!-- footer style not added -->
	<div class="row justify-content-center white z-depth-2" style ="width:1040px">
		<table class = "table">
            <thread>
                <tr>
                    <th class = "center">Installation Order Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($installation as $one):?>
              <tr>
                  <td class = "center"><?php echo htmlspecialchars($one['OrderNumber']); ?></td>
                  <td class = "center"><?php echo htmlspecialchars($one['status']); ?></td>
                  <td class = "center">
                      <?php if ($one['status'] == "In Progress"): ?>
                          <a href="#.php?InvoiceNumber=<?php echo $one['OrderNumber']?>" class = "btn btn-info">Request</a>
                      <?php endif; ?>
                  </td>
              </tr>
            <?php endforeach; ?>
        </table>
		</div>
	</div>

	<?php  include('templates/footer.php');?>

 </html>
