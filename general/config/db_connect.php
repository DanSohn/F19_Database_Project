<?php 
	//connect to database
	$conn = mysqli_connect('localhost','pnamkoong','1234','order tracker');

	//check connection
	if(!$conn){
		echo 'Connection error:'. mysqli_connect_error();
} ?>