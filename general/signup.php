<?php 

	include('config/db_connect.php');
	$firstName = $middleName = $lastName = $email = $sin = $phone = $address = $city = $postalCode = "";
	$errors = array('firstName' => '','middleName' => '', 'lastName' => '','sin' => '','email' => '', 'password' => '',
	 'sin' => '', 'phone' => '', 'address' => '', 'city' => '', 'postalCode' => '');

  	if(isset($_POST['submit'])) {

  		$firstName = $_POST['firstName'];
  		$middleName = $_POST['middleName'];
  		$lastName = $_POST['lastName'];
  		$email = $_POST['email'];
  		$password = $_POST['password'];
  		$sin = $_POST['sin'];
  		$phone = $_POST['phoneNumber'];
  		$address = $_POST['address'];
  		$city = $_POST['city'];
  		$postalCode = $_POST['postalCode'];

  		//valid firstName check
  		if(empty($firstName)){
  			$errors['firstName'] = 'please enter your first name. <br />';
  		} else {
  			if(!preg_match('/^[a-zA-z\s]+$/', $firstName)) {
  				$errors['firstName'] = 'First name must be letters and spaces only.';
  			}
  		}

  		//valid middleName check
  		if(!preg_match('/^[a-zA-z\s]+$/', $middleName)) {
  			$errors['middleName'] = 'Middle name must be letters and spaces only.';
  		}


  		//valid lastName check
  		if(empty($lastName)){
  			$errors['lastName'] = 'please enter your last name. <br />';
  		} else {
  			if(!preg_match('/^[a-zA-z\s]+$/', $lastName)) {
  				$errors['lastName'] = 'Last name must be letters and spaces only.';
  			}
  		}

  		//Valid Email Check
 		if(empty($email)){
  			$errors['email'] = 'Email Address required. <br />';
  		} else {
  			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  				$errors['email'] =  'please enter a valid email address.';
  			}
  		}

  		//Valid Password Check
 		if(empty($password)){
  			$errors['password'] = 'Password required. <br />';
  		}

  		//valid sin check
  		if(empty($sin)){
  			$errors['sin'] = 'Social Insurance Number required. <br />';
  		} else {
  			$sin = str_replace("-", "", $sin);
  			if(!filter_var($sin, FILTER_SANITIZE_NUMBER_INT)){
  				$errors['sin'] = 'Please enter a valid SIN.';
  			}
  		}

  		//valid phone number check
  		if(empty($phone)){
  			$errors['phone'] = 'Phone Number required. <br />';
  		} else {
  			$phone = str_replace("-", "", $phone);
  			if(!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)){
  				$errors['phone'] = 'Please enter a valid SIN.';
  			}
  		}

  		//valid address check
  		if(empty($address)){
  			$errors['address'] = 'please enter your last name. <br />';
  		}

  		//valid city check
  		if(empty($city)){
  			$errors['city'] = 'please enter your city. <br />';
  		} else {
  			if(!preg_match('/^[a-zA-z\s]+$/', $city)) {
  				$errors['city'] = 'Please enter a valid city.';
  			}
  		}

  		//valid postalCode check
  		if(empty($postalCode)){
  			$errors['postalCode'] = 'please enter your last name. <br />';
  		}

  		if (!array_filter($errors)){
  			$firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
  			$middleName = mysqli_real_escape_string($conn,$_POST['middleName']);
  			$lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
  			$email = mysqli_real_escape_string($conn,$_POST['email']);
  			$password = password_hash(mysqli_real_escape_string($conn,$_POST['password']), PASSWORD_DEFAULT);
  			$sin = mysqli_real_escape_string($conn,$_POST['sin']);
  			$phone = mysqli_real_escape_string($conn,$_POST['phoneNumber']);
  			$address = mysqli_real_escape_string($conn,$_POST['address']);
  			$city = mysqli_real_escape_string($conn,$_POST['city']);
  			$postalCode = mysqli_real_escape_string($conn,$_POST['postalCode']);

  			$sql = "INSERT INTO person(SIN, FName, MName, LName,Email, PhoneNumber, Address, City, PostalCode, Password) VALUES
  			 ('$sin', '$firstName','$middleName','$lastName','$email','$phone','$address','$city', '$postalCode','$password')";

  			//save to DB
  			if (mysqli_query($conn, $sql)){
  				//success
  				header('Location: index.php');
  			} else {
  				//error
  				echo 'query error: '. mysqli_error($conn);
  			}
  			
  		}
  	}


  		

?>

 <!DOCTYPE html>
 <html>

	<?php  include('templates/header.php');?>

	<section class="container grey-text">
		<h4 class="center">Sign up </h4>
		<form class="white" action ="signup.php" method="POST">

			<label>First Name:</label>
			<input type="text" name="firstName" value = "<?php echo $firstName?>">
			<div class="red-text"><?php echo $errors['firstName'];?></div>

			<label>Middle Name:</label>
			<input type="text" name="middleName" value = "<?php echo $middleName?>">
			<div class="red-text"><?php echo $errors['middleName'];?></div>

			<label>Last Name:</label>
			<input type="text" name="lastName" value = "<?php echo $lastName?>">
			<div class="red-text"><?php echo $errors['lastName'];?></div>

			<label>Email:</label>
			<input type="text" name="email" value = "<?php echo $email?>">
			<div class="red-text"><?php echo $errors['email'];?></div>

			<label>Password:</label>
			<input type="password" name="password">
			<div class="red-text"><?php echo $errors['password'];?></div>

			<label>Social Insurance Number:</label>
			<input type="text" name="sin" value = "<?php echo $sin?>">
			<div class="red-text"><?php echo $errors['sin'];?></div>

			<label>Phone Number:</label>
			<input type="text" name="phoneNumber" value = "<?php echo $phone?>">
			<div class="red-text"><?php echo $errors['phone'];?></div>

			<label>Address:</label>
			<input type="text" name="address" value = "<?php echo $address?>">
			<div class="red-text"><?php echo $errors['address'];?></div>

			<label>City:</label>
			<input type="text" name="city" value = "<?php echo $city?>">
			<div class="red-text"><?php echo $errors['city'];?></div>

			<label>Postal Code:</label>
			<input type="text" name="postalCode" value = "<?php echo $postalCode?>">
			<div class="red-text"><?php echo $errors['postalCode'];?></div>

			<div class="center">
				<input type="submit" name="submit" value = "submit" class= "btn brand z-depth-1">
			</div>
		</form>
	</section>

	<?php  include('templates/footer.php');?>

 </html>