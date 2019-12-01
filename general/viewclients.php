<?php

    $user = '';
    include('config/db_connect.php');
    include('config/cookies.php');
    $sql = '';
    $sin = $user['SIN'];
    $sql = 'SELECT * FROM person_table WHERE PersonType="Client" ORDER BY LName DESC';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);


 ?>

 <!DOCTYPE html>
<html>

<?php  include('templates/header.php');?>
<?php  include('config/cookies.php');?>

<h4 class="center grey-text">List of Clients</h4>
<div class="row justify-content-center pink lighten-3 z-depth-2" style ="width:1040px;">
    <table class = "table">
        <thread>
            <tr>
                <th class = "center">Client's  First Name</th>
                <th class = "center">Client's  Last Name</th>
                <th class = "center">Phone Number</th>
                <th colspan = '2' class ="center">Action</th>
            </tr>
        </thread>
        <?php foreach ($clients as $client):?>
                <tr>
                    <td class = "center"><?php echo htmlspecialchars($client['FName']); ?></td>
                    <td class = "center"><?php echo htmlspecialchars($client['LName']); ?></td>
                    <td class = "center"><?php echo htmlspecialchars($client['PhoneNumber']); ?></td>
                    <td class = "center">
                        <a href="clientstatus.php?PhoneNumber=<?php echo $client['PhoneNumber']?>" class = "btn btn-info">Details</a>
                    </td>
                </tr>
        <?php endforeach; ?>
    </table>
</div>


</div>

<?php  include('templates/footer.php');?>

</html>
