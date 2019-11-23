<?php 
setcookie("uname", $details['Email'], time()-3600);
header('location:login.php');
 ?>