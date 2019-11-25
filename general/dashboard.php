<?php 
	include('config/db_connect.php');
	$email = mysqli_real_escape_string($conn, $_COOKIE['uname']);
	$sql = "SELECT * FROM person_table WHERE Email = '$email'";
	$result = mysqli_query($conn, $sql);
	$detail = mysqli_fetch_array($result);
	mysqli_close($conn);

	if (isset($_POST['request'])){
		header('Location: neworder.php');
	}
	if (isset($_POST['orders'])){
		header('Location:vieworder.php');
	}
	if (isset($_POST['invoices'])){
		header('Location: viewinvoice.php');
	}

 ?>


 <!DOCTYPE html>
 <html>

	<?php  include('templates/header.php');?>
	<?php  include('config/cookies.php');?>
    <!-- footer purposes, not adding style="padding-bottom:5rem;" to the div tag. Seems like a new div tag needs to be made to encompass -->
    <div class = "container" style="padding-bottom:5rem;">
        <h4 class="center grey-text">Dashboard</h4>
        <div class="card-action center-align" >
        <form class = "white z-depth-2" action = "dashboard.php" method = "POST">
        <div class="container">
            <div class="center">
                <?php if ($detail['PersonType'] == "Client") :?>
                    <input type="submit" name="request" value = "request new order" class= "btn brand z-depth-1" style = "width:300px; height:150px">
                <?php endif; ?>
            </div>
            <br><div class="center">
                <input type="submit" name="orders" value = "view orders" class= "btn green z-depth-1" style = "width:300px; height:150px">
            </div>

            <br><div class="center">
                <input type="submit" name="invoices" value = "view invoices" class= "btn grey z-depth-1" style = "width:300px; height:150px">
            </div>
        </div>
        </form>
        </div>
    </div>

	<?php  include('templates/footer.php');?>

 </html>