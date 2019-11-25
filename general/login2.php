<?php 
	include('config/db_connect.php');

	$errors = array('credentials' => '', 'email' => '', 'password' => '');

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(empty($email)){
			$errors['email'] = 'Email cannot be empty. <br />';
		}
		if(empty($password)){
			$errors['password'] = 'Password cannot be empty. <br />';
		}

		if(!array_filter($errors)){
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$sql = "SELECT Email, Password FROM person";

			$result = mysqli_query($conn, $sql);

		//fetch result in array format
			$list = mysqli_fetch_all($result, MYSQLI_ASSOC);

			mysqli_free_result($result);

			foreach($list as $person) {
				if ($person['Email'] == $email) {
					if(password_verify($password, $person['Password'])){
						echo "TRUE";
					}
				}
				else{
					$errors['credentials'] = "Invalid credentials. Please Try Again. <br />";
				}
			}
		}
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php  include('templates/header.php');?>


    <!-- footer style not added -->
	<section class="container grey-text">
		<h4 class="center">Sign Up</h4>
		<form class="white" action = "login2.php" method = "POST">
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