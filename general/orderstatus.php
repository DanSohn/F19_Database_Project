<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));

	include('config/db_connect.php');
	include('config/cookies.php');
	$sin = $user['SIN'];

	//check GET request id param
  if(isset($_GET['approve'])) {
    $OrderNumber = mysqli_real_escape_string($conn, $_GET['approve']);
    $sql = "UPDATE order_table SET OrderStatus = 'Approved' WHERE OrderNumber = $OrderNumber";
    if (mysqli_query($conn, $sql)) {
      //success
      //will also create an entry into artwork stating that artwork is in progress
      $sql = "INSERT INTO artwork_table(OrderNumber, Artwork_Status) VALUES('$OrderNumber','In Progress')";
      if (mysqli_query($conn, $sql)){
        header('Location: vieworder.php');
      }else{
				//error
        echo 'query error: ' . mysqli_error($conn);
      }
  	} else {
			//error
    	echo 'query error: ' . mysqli_error($conn);
  	}
  }

	if(isset($_GET['reject'])) {
      $OrderNumber = mysqli_real_escape_string($conn, $_GET['reject']);
      $sql = "UPDATE order_table SET OrderStatus = 'Rejected' WHERE OrderNumber = $OrderNumber";
      if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM installation_table WHERE OrderNumber =$OrderNumber";
        mysqli_query($conn,$sql);
        header('Location: vieworder.php');
      } else {
      	//error
        echo 'query error: ' . mysqli_error($conn);
      }
	}

    if(isset($_GET['design'])) {
		// get designer sin
		$sin = $user['SIN'];
		// wanna make sure its the right order, so get that
        $OrderNumber = mysqli_real_escape_string($conn, $_GET['design']);
		// specify file: Here is error for whatever reason
		//echo $_FILES['image'];
		if(isset($_FILES['image'])){
			$image = $_FILES['image']['name'];
			// image file directory
			$target = '\images/' . basename($image);
			echo $target;
            echo "<br>";
			// update the artwork table - but it never works? Query error apparently
            $sql = "UPDATE artwork_table SET Artwork_Status = 'Completed', D_SIN = $sin, ImagePath='$target' WHERE OrderNumber = $OrderNumber";
            echo $sql . "<br>";
            if (mysqli_query($conn, $sql)) {
                //echo "success";
                // move the file now and everything fails in here..
                echo SITE_ROOT . $target;
                move_uploaded_file(($_FILES['image']['tmp_name']), SITE_ROOT . $target);

                $sql = "UPDATE order_table SET OrderStatus = 'Design Complete' WHERE OrderNumber = $OrderNumber";

                if (mysqli_query($conn, $sql)){
                    header('Location: vieworder.php');
                }else{
                    //error
                    echo 'query error: ' . mysqli_error($conn);
                }

            } else {
                //error
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }



    if(isset($_GET['prepared'])) {
        $OrderNumber = mysqli_real_escape_string($conn, $_GET['prepared']);
        $sql = "UPDATE order_table SET OrderStatus = 'Order Prepared' WHERE OrderNumber = $OrderNumber";
        if (mysqli_query($conn, $sql)) {
            $orderNum = $_GET['prepared'];
            $sql = "SELECT * FROM order_table WHERE OrderNumber = '$orderNum'";
            $result = mysqli_query($conn, $sql);
            $order = mysqli_fetch_assoc($result);
            $cost = $order['Cost'];
            $client = $order['Client_SIN'];
            $sql = "INSERT INTO invoice_table (cost,C_SIN, OrderNumber) VALUES ('$cost','$client','$orderNum')";
            mysqli_query($conn, $sql);
            header('Location: vieworder.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['complete'])) {
        $OrderNumber = mysqli_real_escape_string($conn, $_GET['complete']);
        $sql = "UPDATE order_table SET OrderStatus = 'Completed' WHERE OrderNumber = $OrderNumber";
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

        $orderNumber = $status['OrderNumber'];
        $sql = "SELECT * FROM artwork_table WHERE OrderNumber = '$orderNumber'";
        $art = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($art)) {
            $img_source = $row['ImagePath'];
        }

        $orderNumber = $status['OrderNumber'];
        $sql = "SELECT * FROM installation_table WHERE OrderNumber = '$orderNumber'";
        $data = mysqli_query($conn, $sql);
        $installation = "";
        if(mysqli_num_rows($data) > 0){
            $installation = "Yes";
        }
        else{
            $installation = "No";
        }
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

        <h5>Installation Required:</h5>
        <h6><?php echo htmlspecialchars($installation);?></h6><br>

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

				<h5>Design:</h5>
            <div class= "img-block">
							<?php if (($status['OrderStatus']=="Requested") || ($status['OrderStatus']=="Approved") || ($status['OrderStatus']=="Rejected")):?>
								<img src="./NotAvailable.png" style="width=100%">
							<?php else:?>
								<img src="<?php echo $img_source ?>" style="width:100%; max-width: 500px">
							<?php endif;?>
            </div>

	<?php else: ?>
		<h5>No such order exists.</h5>

	<?php endif; ?>
    <?php if($status['OrderStatus'] == "Requested" and $user['PersonType'] == 'Manager'): ?>
        <a href="orderstatus.php?approve=<?php echo $status['OrderNumber']?>" name = "approve" value = "approve" class = "green btn btn-info">Approve</a>
        <a href="orderstatus.php?reject=<?php echo $status['OrderNumber']?>" name = "reject" value = "reject" class = " red btn btn-info">Reject</a>
    <?php endif;?>

    <?php if($status['OrderStatus'] == "Approved" and $user['PersonType'] == 'Designer'): ?>
			<?php
		    while ($row = mysqli_fetch_array($result)) {
		      echo "<div id='img_div'>";
		      	echo "<img src='images/".$row['image']."' >";
		      	echo "<p>".$row['image_text']."</p>";
		      echo "</div>";
		    }
		  ?>
		  <form method="POST" action="orderstatus.php?design=<?php echo $status['OrderNumber'];?>" enctype="multipart/form-data" >
		  	<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		  	<div>
		  	  <input type="file" name="image"><br><br>

              <input type="submit" name="design" value="Submit Designs" class = "green btn btn-info">
		  	</div>
		  </form>
        <!--<a href="orderstatus.php?design=<?php echo $status['OrderNumber']?>" name = "design" value = "design" class = "green btn btn-info">Submit Designs</a>-->
    <?php endif;?>

    <?php if($status['OrderStatus'] == "Design Complete" and $user['PersonType'] == 'Employee'): ?>
        <a href="orderstatus.php?prepared=<?php echo $status['OrderNumber']?>" name = "prepared" value = "prepared" class = "green btn btn-info">Mark Order As Prepared</a>
    <?php endif;?>

    <?php if($status['OrderStatus'] == "Order Prepared" and $user['PersonType'] == 'Manager'): ?>
        <a href="orderstatus.php?complete=<?php echo $status['OrderNumber']?>" name = "complete" value = "complete" class = "green btn btn-info">Complete Order</a>
    <?php endif;?>
    <br></div>

<?php  include('templates/footer.php');?>

</html>
