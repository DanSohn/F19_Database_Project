<?php

	include('config/db_connect.php');
	$name = $email = $phone = $subject = $message = $success = "";
	$errors = array('name' => '', 'email' => '', 'phone' => '', 'subject' => '', 'message' => '');

	if(isset($_POST['submit'])) {
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$phone = htmlspecialchars($_POST['phone']);
		$subject = htmlspecialchars($_POST['subject']);
		$message = htmlspecialchars($_POST['message']);

		if(empty($name)){
  			$errors['name'] = 'please enter your name. <br />';
  		} else {
  			if(!preg_match('/^[a-zA-z\s]+$/', $name)) {
  				$errors['name'] = 'name must be letters and spaces only.';
  			}
  		}

  		if(empty($email)){
  			$errors['email'] = 'Email Address required. <br />';
  		} else {
  			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  				$errors['email'] =  'please enter a valid email address.';
  			}
  		}

  		if(empty($phone)){
  			$errors['phone'] = 'Phone Number required. <br />';
  		} else {
  			$phone = str_replace("-", "", $phone);
  			if(!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)){
  				$errors['phone'] = 'Please enter a valid SIN.';
  			}
  		}


  		if(empty($subject)){
  			$errors['subject'] = 'Subject must not be empty. <br />';
  		}

  		if(empty($message)){
  			$errors['message'] = 'Please explain why you are contacting us. <br />';
  		}

  		if (!array_filter($errors)){
  			$name = mysqli_real_escape_string($conn,$_POST['name']);
  			$email = mysqli_real_escape_string($conn,$_POST['email']);
  			$phone = mysqli_real_escape_string($conn,$_POST['phone']);
  			$subject = mysqli_real_escape_string($conn,$_POST['subject']);
  			$message = mysqli_real_escape_string($conn,$_POST['message']);
  			
  			//if (mail($email,$subject, $message)){
  				$success = "Message sent. Thank you for contacting us!";
  				$name = $email = $phone = $subject = $message = "";
  			//}

  		}
	}
 ?>

 <!DOCTYPE html>
 <html>

 	<?php  include('templates/header.php');?>
 	<section class="container grey-text">
 		<h4 class="center">Contact Us</h4>
 		<div class="card-action left-align">
 			<form class="white z-depth-2" action = "contactus.php" method = "POST">
 				<h5 class="green-text center-align"><?php echo $success;?></h5>
 				<label>Your Name:</label>
 				<input type="text" name="name" value = "<?php echo $name?>">
 				<div class="red-text"><?php echo $errors['name'];?></div>

 				<label>Your Email:</label>
 				<input type="text" name="email" value = "<?php echo $email?>">
 				<div class="red-text"><?php echo $errors['email'];?></div>

 				<label>Your Phone Number:</label>
 				<input type="text" name="phone" value = "<?php echo $phone?>">
 				<div class="red-text"><?php echo $errors['phone'];?></div>

 				<label>Subject:</label>
 				<input type="text" name="subject" value = "<?php echo $subject?>">
 				<div class="red-text"><?php echo $errors['subject'];?></div>

 				<label>Message:</label>
 				<textarea type = "text" name = "message" value = "<?php echo $message?>" placeholder="Type your Message Here...." tabindex="5"></textarea>
 				<div class="red-text"><?php echo $errors['message'];?></div>

 				<div class="center">
 					<input type="submit" name="submit" value = "submit" class = "btn brand z-depth-1">
 				</div>

 			</form>
 		</div>
 	</section>
	<?php  include('templates/footer.php');?>
 </html>
