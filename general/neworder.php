<?php
   include('config/db_connect.php');

   $length = $width = $quantity = $detail = $references = $success = "";
   $errors = array('length' => '', 'width' => '', 'quantity' => '', 'detail' => '', 'references' => '');
   
   if(isset($_POST['request'])) {
      $length = htmlspecialchars($_POST['length']);
      $width = htmlspecialchars($_POST['width']);
      $quantity = htmlspecialchars($_POST['quantity']);
      $detail = htmlspecialchars($_POST['detail']);
      $references = htmlspecialchars($_POST['references']);

      if($length =="0"){
         $errors['length'] = 'Please specify a length. <br />';
      }

      if($width =="0"){
         $errors['width'] = 'Please specify a width. <br />';
      }

      if($quantity =="0"){
         $errors['quantity'] = 'Please specify a quantity. <br />';
      }

      if(empty($detail)){
         $errors['detail'] = 'Please provide details about your order. <br />';
      }
      if (!array_filter($errors)){
         $length = mysqli_real_escape_string($conn, $_POST['length']);
         $width = mysqli_real_escape_string($conn, $_POST['width']);
         $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
         $detail = mysqli_real_escape_string($conn, $_POST['detail']);
         $cost = $length * $width * $quantity;

         $sql = "INSERT INTO order_table(Cost, Length, Width, Quantity) VALUES
         ('$cost', '$length', '$width', '$quantity')"; 

         if(mysqli_query($conn, $sql)){
            $success = "Your order request has been sent! A manager may contact you for further details.";
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

   <section class="container grey-text" style="padding-bottom:5rem;">
      <h4 class="center">Order Form</h4>
    <div class="card-action center-align"></div>
      <form class="white z-depth-2" action ="neworder.php" method="POST">
         <h6 class="green-text center-align"><?php echo $success;?></h5>
         <label>Length:</label>
         <select name = "length" value = "<?php echo $length?>" style="display: block;">
            <option value=0 selected>------</option>
            <?php for($i=1; $i<=24;$i++): ?>
               <option value = <?php echo $i; ?> ><?php echo $i.'"';?></option>
            <?php endfor; ?>
         </select>
         <div class="red-text"><?php echo $errors['length'];?></div>

         <label>Width:</label>
         <select name = "width" value = "<?php echo $width?>" style="display: block;">
            <option value="0" selected>------</option>
            <?php for($i=1; $i<=24;$i++): ?>
               <option value= <?php echo $i; ?> ><?php echo $i.'"';?></option>
            <?php endfor; ?>
         </select>
         <div class="red-text"><?php echo $errors['width'];?></div>

         <label>Quantity:</label>
         <select name = "quantity" value = "<?php echo $quantity?>" style="display: block;">
            <option value="0" selected>------</option>
            <?php for($i=1; $i<=5000;$i++): ?>
               <option value= <?php echo $i; ?> ><?php echo $i;?></option>
            <?php endfor; ?>
         </select>
         <div class="red-text"><?php echo $errors['quantity'];?></div>

         <label>Details:</label>
            <textarea type = "text" name = "detail" value = "<?php echo $detail?>"placeholder="Provide details about the design..." tabindex="5"></textarea>
            <div class="red-text"><?php echo $errors['detail'];?></div>

         <label>Attach references you may have:</label>
         <div class="attachment-row">
            <input type="file" class="input-field" name="references">
         </div>

         <div class="center">
            <input type="submit" name="request" value = "request" class= "btn brand z-depth-1">
         </div>
      </form>
   </section>

   <?php  include('templates/footer.php');?>

 </html>

