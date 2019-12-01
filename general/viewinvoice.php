<?php
    $user = '';
	include('config/db_connect.php');
    include('config/cookies.php');
    $sql = '';
    $sin = $user['SIN'];
    if($user['PersonType'] == 'Client') {
        $sql = "SELECT InvoiceNumber, OrderNumber, status FROM invoice_table WHERE C_SIN = $sin";
        //write query for all invoices ordered by date (this can change if we like)

    }
    else{
        $sql = 'SELECT InvoiceNumber, OrderNumber, status FROM invoice_table ORDER BY date DESC';
    }
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
	<div class="row justify-content-center white z-depth-2" style ="width:1040px">
		<table class = "table">
            <thread>
                <tr>
                    <th class = "center">Invoice Number</th>
                    <th class = "center">Status</th>
                    <th colspan = '2' class ="center">Action</th>
                </tr>
            </thread>
            <?php foreach ($invoice as $one):?>
              <tr>
                  <td class = "center"><?php echo htmlspecialchars($one['InvoiceNumber']); ?></td>
                  <td class = "center"><?php echo htmlspecialchars($one['status']); ?></td>
                  <td class = "center">
                      <a href="invoicestatus.php?InvoiceNumber=<?php echo $one['InvoiceNumber'];?>" class = "btn btn-info">view</a>
                      <?php if ($one['status'] == "Not Paid" && $user['PersonType'] == "Client"): ?>
                          <a href="settle_invoice.php?InvoiceNumber=<?php echo $one['InvoiceNumber']?>" class = "btn btn-info">Settle</a>
                      <?php endif; ?>
                  </td>
              </tr>
            <?php endforeach; ?>
        </table>
		</div>
	</div>

	<?php  include('templates/footer.php');?>

 </html>
