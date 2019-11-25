<?php
   include('config/db_connect.php');

   $month = $year = $card_name = $card_cvv = $card_number = $success = "";
   //$errors = array('length' => '', 'width' => '', 'quantity' => '', 'detail' => '', 'references' => '');
   $errors = array('month' => '', 'year' => '', 'card_name' => '', 'card_cvv' => '', 'card_number' => '');
   
   if(isset($_POST['request'])) {

      $month = htmlspecialchars($_POST['month']);
      $year = htmlspecialchars($_POST['year']);
      $card_name = htmlspecialchars($_POST['card_name']);
      $card_cvv = htmlspecialchars($_POST['card_cvv']);
      $card_number = htmlspecialchars($_POST['card_number']);
      
      if($month =="0"){
         $errors['month'] = 'Please specify a month. <br />';
      }

      if($year =="0"){
         $errors['year'] = 'Please specify a year. <br />';
      }
      
      if(empty($card_name)){
         $errors['detail'] = 'Please enter your full name, as shown on your credit card. <br />';
      }
      if(empty($card_cvv)){
         $errors['detail'] = 'Please enter your cvv, as shown on the back of your credit card. <br />';
      }
      if(empty($card_number)){
         $errors['detail'] = 'Please provide your credit card number. <br />';
      }
      
      if (!array_filter($errors)){
         $month = mysqli_real_escape_string($conn, $_POST['month']);
         $year = mysqli_real_escape_string($conn, $_POST['year']);
         $card_name = mysqli_real_escape_string($conn, $_POST['card_name']);
         $card_cvv = mysqli_real_escape_string($conn, $_POST['card_cvv']);
         $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);

         $status = "Paid";
         //$status = mysqli_real_escape_string($status);
         
         $invoiceNumber = "100000";
         //$invoiceNumber = mysqli_real_escape_string($invoiceNumber);
         //$sql = "INSERT INTO order_table(Cost, Length, Width, Quantity) VALUES
         //('$cost', '$length', '$width', '$quantity')"; 
         // Convert the invoice to be paid
         $sql = "UPDATE invoice_table SET status = '$status' WHERE InvoiceNumber = '$invoiceNumber'";

         if(mysqli_query($conn, $sql)){
            $success = "Thank you for paying your invoice!";
            $length = $width = $quantity = $detail = $references = "";
         }else{
            echo 'query error: '.mysql_error($conn);
         }
      }
   }
?>

 <!DOCTYPE html>
 <html>

   <?php  include('templates/header.php');?>
   <?php  include('config/cookies.php');?>

   <section class="container grey-text">
      <h4 class="center">Settle Invoice</h4>
    <div class="card-action center-align"></div>
      <form class="white z-depth-2" action ="settle_invoice.php" method="POST">
         <h6 class="green-text center-align"><?php echo $success;?></h5>
         
         <label>Card Holder Name</label>
            <input type = "text" name = "card_name" value = "<?php echo $card_name?>" placeholder="John M. Doe">
            <div class="red-text"><?php echo $errors['card_name'];?></div>
            
        <label>Credit Card Number</label>
            <input type = "text" name = "card_number" value = "<?php echo $card_number?>" placeholder="1111-2222-3333-4444">
            <div class="red-text"><?php echo $errors['card_number'];?></div>
            
        <label>CVV</label>
            <input type = "text" name = "card_cvv" value = "<?php echo $card_cvv?>" placeholder="912">
            <div class="red-text"><?php echo $errors['card_cvv'];?></div>
            
        <label>Expiration Date</label>
         <select name = "month" value = "<?php echo $month?>" style="display: block;">
            <option value=0 selected>Month</option>
            <?php for($i=1; $i<=12;$i++): ?>
               <option value = <?php echo $i; ?> ><?php echo $i;?></option>
            <?php endfor; ?>
         </select>
         <div class="red-text"><?php echo $errors['month'];?></div>

         <select name = "year" value = "<?php echo $year?>" style="display: block;">
            <option value="0" selected>Year</option>
            <?php for($i=2019; $i<=2025;$i++): ?>
               <option value= <?php echo $i; ?> ><?php echo $i;?></option>
            <?php endfor; ?>
         </select>
         <div class="red-text"><?php echo $errors['year'];?></div>
         

            
         <div class="center">
            <input type="submit" name="request" value = "request" class= "btn brand z-depth-1">
         </div>
      </form>
   </section>

   <?php  include('templates/footer.php');?>

 </html>

