<?php 

    include_once('../includes/session.php');
    include_once('../database/functions.php');

    // username
    $user =  $_SESSION['username'];

    // gets array of reservations
    $reservations = get_reservations($user);

?>

<link href="../css/style.css" rel="stylesheet">

<h2>Reservations</h2>

<table>
    <tr>
        <th>Place</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Total Price</th>
    </tr>
    
    <?php 

        for($i = 0; $i < count($reservations); $i++){ 
            
            $id = $reservations[$i]['place_id']; ?>
            <tr>
                <td><?php echo get_place_name($id);  ?></th>
                <td><?php echo $reservations[$i]['checkin'];  ?></th>
                <td><?php echo $reservations[$i]['checkout'];  ?></th>
                <td><?php echo $reservations[$i]['total_price'];  ?></th>
            </tr>
        <?php } ?>
    
</table>

