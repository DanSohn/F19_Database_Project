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
		$invoice = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
        //grabbing the client information
        $clientSin = $invoice['C_SIN'];
        $sql = "SELECT * FROM person_table WHERE SIN=$clientSin";
        $result = mysqli_query($conn, $sql);
        $client = mysqli_fetch_assoc($result);
        
        mysqli_free_result($result);
        
        //end of client information
        
        
        $orderNumber = $invoice['OrderNumber'];
        $sql = "SELECT * FROM order_table WHERE OrderNumber=$orderNumber";

        //get the query result
        $result = mysqli_query($conn, $sql);

        //fetch result in array format
        $order = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        $sql = "SELECT * FROM installation_table WHERE OrderNumber=$orderNumber";
        $result = mysqli_query($conn, $sql);
        
        // check if there is any installation for the order number
        $install = "Yes";
        if (mysqli_num_rows($result) == 0) { 
            $install = "No";
        }
        mysqli_free_result($result);
		mysqli_close($conn);

	}
 ?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>
<h3>Order Number: <?php echo htmlspecialchars($orderNumber);?> (<?php echo htmlspecialchars($invoice['status']);?>)</h3>
<div class="row justify-content-center white z-depth-2"style ="padding:20px; width:1040px">
	<?php if($invoice): ?>
        <h5>Created Date:</h5>
        <h6><?php echo htmlspecialchars($order['CreatedDate']);?></h6>

        <h5>Client Details:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">Name</th>
                    <th class ="center">Address</th>
                    <th class ="center">City</th>
                    <th class ="center">Postal Code</th>
                    <th class ="center">Phone Number</th>
                    <th class ="center">Email</th>
                </tr>
            </thread>
            <tr>
                <td class = "center"><?php echo htmlspecialchars($client['FName']);?></td>
                <td class = "center"><?php echo htmlspecialchars($client['Address']);?></td>
                <td class = "center"><?php echo htmlspecialchars($client['City']);?></td>
                <td class = "center"><?php echo htmlspecialchars($client['PostalCode']);?></td>
                <td class = "center"><?php echo htmlspecialchars($client['PhoneNumber']);?></td>
                <td class = "center"><?php echo htmlspecialchars($client['Email']);?></td>
            </tr>
        </table>

        <h5>Company:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">Name</th>
                    <th class ="center">Address</th>
                    <th class ="center">City</th>
                    <th class ="center">Postal Code</th>
                    <th class ="center">Phone Number</th>
                    <th class ="center">Email</th>
                </tr>
            </thread>
            <tr>
                <td class = "center">NKG Graphics</td>
                <td class = "center">123 Namkoong Drive SW</td>
                <td class = "center">Calgary</td>
                <td class = "center">T3Z 0C9</td>
                <td class = "center">4039999357</td>
                <td class = "center">peter@nkggraphics.com</td>
            </tr>
        </table>

        <h5>Order Details:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">Length</th>
                    <th class ="center">Width</th>
                    <th class ="center">Quantity</th>
                    <th class ="center">Total</th>
                </tr>
            </thread>
            <tr>
                <td class = "center"><?php echo htmlspecialchars($order['length']);?>"</td>
                <td class = "center"><?php echo htmlspecialchars($order['width']);?>"</td>
                <td class = "center"><?php echo htmlspecialchars($order['Quantity']);?></td>
                <td class = "center">$<?php echo htmlspecialchars($order['Cost']);?></td>
            </tr>
        </table>

        <h5>Installation Required:</h5>
        <h6><?php echo htmlspecialchars($install);?></h6>

        <h5>Comment Section:</h5>
        <p>Thank you for your business!</p>

        <h5>Payment Section:</h5>
        <?php if($invoice['status'] == 'Not Paid'): ?>
            <a href="settle_invoice.php?InvoiceNumber=<?php echo $invoice['InvoiceNumber']?>" class = "btn btn-info">Settle now</a>
        <?php else: ?>
            <h6>Paid</h6>
        <?php endif; ?>
	<?php else: ?>
		<h5>Order not completed, invoice does not exist yet.</h5>

	<?php endif; ?>
</div>

<?php  include('templates/footer.php');?>

</html>
