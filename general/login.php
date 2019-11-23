<?php 

	include('config/db_connect.php');
	$email1 = $password1 = '';

	$errors1 = array('email' => '', 'password' => '');

	if(isset($_POST['login'])) {
		$email1 = $_POST['email'];
		$password1 = $_POST['password'];

		if (empty($email1)) {
			$errors1['email'] = "Please enter your email. <br />";
		}
		if(empty($password1)) {
			$errors1['password'] = "Please enter your password. <br />";
		}
		header('Location: login.php');
	}

 ?>

 <!DOCTYPE html>
 <html>
 	<?php  include('templates/header.php');?>

 	<section class="container black-text">
 		
 		<form class="white lighten-5 z-depth-2" action = "login.php" method = "POST">
 			<h4 class="center">Sign In</h4>

 			<label>Email:</label>
			<input type="text" name="email" value = "<?php echo $email1?>">
			<div class="red-text"><?php echo $errors1['email'];?></div>

			<label>Password:</label>
			<input type="password" name="password">
			<div class="red-text">
				<?php echo $errors1['password'];?>
			</div>
			<br><div class="center">
				<input type="submit" name="Login" value = "login" class= "btn brand z-depth-1">
			</div>
			<div class="card-action center-align">
				<br>Don't have an account?<a href="signup.php"> Sign up here.</a>
			</div>
 		</form>
 	</section>

 	<?php  include('templates/footer.php');?>
 </html>