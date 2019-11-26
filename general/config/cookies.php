<?php
include('config/db_connect.php');
 if(!isset($_COOKIE['uname'])){
 	header("location:login.php");
 }
 else{
     $email = mysqli_real_escape_string($conn, $_COOKIE['uname']);
     $sql = "SELECT * FROM person_table WHERE Email = '$email'";
     $result = mysqli_query($conn, $sql);
     $user = mysqli_fetch_array($result);
 }
 ?>