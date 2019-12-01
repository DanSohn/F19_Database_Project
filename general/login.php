<?php
	include('config/db_connect.php');

	$email = $password = '';

	$errors = array('credentials' => '', 'email' => '', 'password' => '');

	if(isset($_POST['login'])){
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);

		if(empty($email)){
			$errors['email'] = 'Email cannot be empty. <br />';
		}
		if(empty($password)){
			$errors['password'] = 'Password cannot be empty. <br />';
		}
		if (!array_filter($errors)){
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$sql = "SELECT * FROM person_table WHERE Email = '".$email."'";
			$result = mysqli_query($conn, $sql);
			if ($details = mysqli_fetch_assoc($result)){
				if($password == $details['Password']){
					echo "inside";
					setcookie("uname", $details['Email'], time()+3600);
					header("location: dashboard.php");
				}
				else{
					$errors['credentials'] = "Invalid credentials";
					setcookie("uname", $details['Email'], time()-3600);
				}
			}
		}
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php  include('templates/header.php');?>
 	<?php if(isset($_COOKIE['uname'])):?>
 		<?php header('location:index.php'); ?>
	<?php endif; ?>

    <!-- footer style not added -->
	<section class="container grey-text">
		<h4 class="center">Log In</h4>
		<form class="white z-depth-2" action = "login.php" method = "POST">
			<div class="red-text"><?php echo $errors['credentials']; ?></div>
			<label>Email:</label>
			<input type="text" name="email">
			<div class = "red-text"><?php echo $errors['email'];?></div>

			<label>Password:</label>
			<input type="password" name="password">

			<div class="center">
				<input type="submit" name = "login" class = "btn brand z-depth-1"></input>
			</div>
			<div class="card-action center-align">
				<br>Don't have an account?<a href="signup.php"> Sign up here.</a>
			</div>
		</form>
	</section>

 	<?php  include('templates/footer.php');?>

 </html>
