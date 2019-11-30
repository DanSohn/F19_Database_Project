<?php
	include('config/db_connect.php');

	//check GET request id param
	if(isset($_GET['OrderNumber'])){
		$OrderNumber = mysqli_real_escape_string($conn, $_GET['OrderNumber']);

		//make sql
		$sql = "SELECT * FROM installation_table WHERE OrderNumber=$OrderNumber";

		//get the query result
		$result = mysqli_query($conn, $sql);

		//fetch result in array format
		$installations = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
        
        
        
        //employee responsible for the installation
        $emp_SIN = $installations['E_SIN'];
        $sql = "SELECT * FROM person_table WHERE SIN=$emp_SIN";
        //get the query result
        $result = mysqli_query($conn, $sql);
        //fetch result in array format
        $employee = mysqli_fetch_assoc($result);
        mysqli_free_result($result);


        //end of employee
        
        
        
        //beginning of ORDER information
        
        $sql = "SELECT * FROM order_table WHERE OrderNumber=$OrderNumber";

        //get the query result
        $result = mysqli_query($conn, $sql);
        //fetch result in array format
        $order = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        //end of ORDER inforamation
        
        
        
        //grabbing the client information
        $clientSin = $order['Client_SIN'];
        $sql = "SELECT * FROM person_table WHERE SIN=$clientSin";
        $result = mysqli_query($conn, $sql);
        $client = mysqli_fetch_assoc($result);
        
        mysqli_free_result($result);
        
        //end of client information
        

  
		mysqli_close($conn);

	}
 ?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>
<h4>Order Number: <?php echo htmlspecialchars($OrderNumber);?></h4>
<div class="row justify-content-center white z-depth-2"style ="padding:20px; width:1040px">
	<?php if($installations): ?>

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

        <h5>Installation Details:</h5>
        <table class = "table">
            <thread>
                <tr>
                    <th class ="center">Employee Responsible</th>
                    <th class ="center">Location</th>
                    <th class ="center">Substrate</th>
                    <th class ="center">Status</th>
                </tr>
            </thread>
            <tr>
                <td class = "center"><?php echo htmlspecialchars($employee['FName']);?></td>
                <td class = "center"><?php echo htmlspecialchars($installations['Location']);?></td>
                <td class = "center"><?php echo htmlspecialchars($installations['Substrate']);?></td>
                <td class = "center"><b><?php echo htmlspecialchars($installations['Status']);?></b></td>
            </tr>
        </table>

	<?php endif; ?>
</div>

<?php  include('templates/footer.php');?>

</html>
