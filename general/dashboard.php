<?php
	include('config/db_connect.php');

	if (isset($_POST['request'])){
		header('Location: neworder.php');
	}
	if (isset($_POST['orders'])){
		header('Location:vieworder.php');
	}
	if (isset($_POST['invoices'])){
		header('Location: viewinvoice.php');
	}
	if (isset($_POST['installations'])){
		header('Location: viewinstallation.php');
	}
if (isset($_POST['supplies'])){
    header('Location: supplies.php');
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
                <?php if ($user['PersonType'] == "Client") :?>
                    <input type="submit" name="request" value = "request new order" class= "btn brand z-depth-1" style = "width:300px; height:150px">
                <?php endif; ?>
            </div>
            <br><div class="center">
                <input type="submit" name="orders" value = "view orders" class= "btn green z-depth-1" style = "width:300px; height:150px">
            </div>

            <br><div class="center">
                <input type="submit" name="invoices" value = "view invoices" class= "btn grey z-depth-1" style = "width:300px; height:150px">
            </div>

            <br><div class="center">
                <input type="submit" name="installations" value = "view installations" class= "btn blue z-depth-1" style = "width:300px; height:150px">
            </div>
            <br><div class="center">
                <?php if ($user['PersonType'] == "Manager") :?>
                    <input type="submit" name="supplies" value = "Order Supplies" class= "btn brand z-depth-1" style = "width:300px; height:150px">
                <?php endif; ?>
            </div>
        </div>
        </form>
        </div>
    </div>

	<?php  include('templates/footer.php');?>

 </html>
