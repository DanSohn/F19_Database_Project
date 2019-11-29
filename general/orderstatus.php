<?php
	include('config/db_connect.php');

	//check GET request id param

    if(isset($_GET['approve'])) {
        $OrderNumber = mysqli_real_escape_string($conn, $_GET['approve']);
        $sql = "UPDATE order_table SET OrderStatus = 'Approved' WHERE OrderNumber = $OrderNumber";
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: vieworder.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['reject'])) {
        $OrderNumber = mysqli_real_escape_string($conn, $_GET['reject']);
        $sql = "UPDATE order_table SET OrderStatus = 'Rejected' WHERE OrderNumber = $OrderNumber";
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: vieworder.php');
        } else {
        //error
            echo 'query error: ' . mysqli_error($conn);
        }
}

	if(isset($_GET['OrderNumber'])){
		$OrderNumber = mysqli_real_escape_string($conn, $_GET['OrderNumber']);

		//make sql
		$sql = "SELECT * FROM order_table WHERE OrderNumber=$OrderNumber";
		//get the query result
		$result = mysqli_query($conn, $sql);
		//fetch result in array format
		$status = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		$msin = $status['M_SIN'];
		$sql = "SELECT * FROM person_table WHERE SIN = $msin";
        $result = mysqli_query($conn, $sql);
        //fetch result in array format
        $manager = mysqli_fetch_assoc($result);
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
<div class="row justify-content-center white z-depth-2" style ="padding:20px; width:1040px";>
	<?php if($status): ?>
        <h5>Created Date:</h5>
    <h6><?php echo htmlspecialchars($status['CreatedDate']);?></h6>

    <h5>Order Status:</h5>
        <h6><?php echo htmlspecialchars($status['OrderStatus']);?></h6><br>

        <h5>Order Details:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">Length</th>
                    <th class ="center">Width</th>
                    <th class ="center">Quantity</th>
                </tr>
            </thread>
                <tr>
                    <td class = "center"><?php echo htmlspecialchars($status['length']);?>"</td>
                    <td class = "center"><?php echo htmlspecialchars($status['width']);?>"</td>
                    <td class = "center"><?php echo htmlspecialchars($status['Quantity']);?></td>
                </tr>
        </table>
        <h5>Design:</h5>
        <h6>Coming soon to a theatre near you.</h6>
        <img src="" alt="">

        <h5>Installation?</h5>
        <h6>Yes or No</h6>

        <h5>Manager On File:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">First Name</th>
                    <th class ="center">Last Name</th>
                    <th class ="center">Email</th>
                    <th class ="center">Phone Number</th>
                </tr>
            </thread>
            <tr>
                <td class = "center"><?php echo htmlspecialchars($manager['FName']);?></td>
                <td class = "center"><?php echo htmlspecialchars($manager['LName']);?></td>
                <td class = "center"><?php echo htmlspecialchars($manager['Email']);?></td>
                <td class = "center"><?php echo htmlspecialchars($manager['PhoneNumber']);?></td>
            </tr>
        </table>

	<?php else: ?>
		<h5>No such order exists.</h5>

	<?php endif; ?>
    <?php if($status['OrderStatus'] == "Requested" and $user['PersonType'] == 'Manager'): ?>
        <a href="orderstatus.php?approve=<?php echo $status['OrderNumber']?>" name = "approve" value = "approve" class = "green btn btn-info">Approve</a>
        <a href="orderstatus.php?reject=<?php echo $status['OrderNumber']?>" name = "reject" value = "reject" class = " red btn btn-info">Reject</a>
    <?php endif;?>
    <br></div>

<?php  include('templates/footer.php');?>

</html>
