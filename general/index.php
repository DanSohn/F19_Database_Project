<?php 

	include('config/db_connect.php');

	//write query for all persons
	$sql = 'SELECT FName, LName, SIN, PhoneNumber FROM person';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);


 ?>

 <!DOCTYPE html>
 <html>

	<?php  include('templates/header.php');?>
	<?php  include('config/cookies.php');?>

	<h4 class="center grey-text">Users!</h4>

	<div class="container">
		<div class="row">
			
			<?php foreach($user as $person): ?>
				<div class="col s6 md3">
					<div class="card z-depth-1">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($person['FName']); ?></h6>
							<div><?php echo htmlspecialchars($person['LName']) ?></div>
						</div>
						<div class="card-action right-align">
							<a class="Pink" href="details.php?sin=<?php echo $person['SIN']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

	<?php  include('templates/footer.php');?>

 </html>