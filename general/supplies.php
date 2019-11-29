<?php

$user='';
include('config/db_connect.php');
include('config/cookies.php');
?>

<!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>

<div class = "container">
    <h4 class="center grey-text">Supplier Search</h4>
    <div class="row justify-content-center brown lighten-3 z-depth-2" style ="width:1040px;">
        <form class="white z-depth-2" action ="supplies.php" method="POST">
            <input type="hidden" name = "orderNumber" value = $status['OrderNumber']>
            <div class="form-group">
                <label class="col-lg-2 control-label">Size:</label>
                <div class="col-lg-4">
                    <select name = "size" class="form-control" style="display: block;">
                        <option value="0" selected>Select</option>
                        <option value="6">6"</option>
                        <option value = "12">12"</option>
                        <option value="24">24"</option>
                        <option value="48">48"</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Color:</label>
                <div class="col-lg-4">
                    <select name = "color" class="form-control" style="display: block;">
                        <option value="0" selected>Select</option>
                        <option value="White">White</option>
                        <option value ="Black">Black</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Orange">Orange</option>
                        <option value ="Red">Red</option>
                        <option value="Pink">Pink</option>
                        <option value="Purple">Purple</option>
                        <option value="Blue">Blue</option>
                        <option value ="Green">Green</option>
                        <option value="Brown">Brown</option>
                        <option value="Gray">Gray</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Durability:</label>
                <div class="col-lg-4">
                    <select name = "durability" class="form-control" style="display: block;">
                        <option value="0" selected>Select</option>
                        <option value="5">5 years</option>
                        <option value ="10">10 years</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Brand:</label>
                <div class="col-lg-4">
                    <select name = "brand" class="form-control" style="display: block;">
                        <option value="0" selected>Select</option>
                        <option value="3M">3M</option>
                        <option value ="Avery">Avery</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Search:</label>
                <div class="col-lg-4">
                    <input type="submit" name = "search" class= "btn brand z-depth-1">
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center brown lighten-5 z-depth-2" style ="width:1040px;">
        <table class ="table">
            <thread>
                <tr>
                    <th class = "center">Supplier Name</th>
                    <th class = "center">Location</th>
                </tr>
            </thread>
        <tbody>
        <?php
        if(isset($_POST['search'])){
            $size = $_POST['size'];
            $color = $_POST['color'];
            $durability = $_POST['durability'];
            $brand = $_POST['brand'];

            if($size != "" || $color != "" || $durability != "" || $brand != ""){
                $query = "SELECT name, location FROM supplier_table, supply_table WHERE name = SupplierName AND
                            size = '$size' OR color = '$color' OR durability = '$durability' OR brand = '$brand' GROUP BY name";

                $data = mysqli_query($conn, $query) or die('error');
                if(mysqli_num_rows($data) > 0){
                    foreach($data as $row){
                        $supplier = $row['name'];
                        $location = $row['location'];
                    ?>
                    <tr>
                        <td class="center"><?php echo $supplier; ?></td>
                        <td class = "center"><?php echo $location; ?></td>
                    </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td>Records Not Found!</td>
                    </tr>
                    <?php
                }

            }
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
</div>

<?php  include('templates/footer.php');?>

</html>


