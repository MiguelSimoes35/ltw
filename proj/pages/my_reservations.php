<?php 
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    // username
    $user = $_SESSION['username'];

    // gets array of reservations
    $reservations = get_reservations($user);

?>
<div id="table_header">
    <div>Place</div> 
    <div>Check-In Date</div> 
    <div>Check-Out Date</div> 
    <div>Price(€)</div>
</div>
<?php
    for($i = 0; $i < count($reservations); $i++){
        $id = $reservations[$i]['place_id'];
        ?>
        <div id="reservations">
            <div><?= get_place_name($id); ?></div>
            <div><?= $reservations[$i]['checkin']; ?></div> 
            <div><?= $reservations[$i]['checkout']; ?></div> 
            <div><?= $reservations[$i]['total_price']; ?></div>
        </div>
        <?php
    }
    ?>
</div>

<?php
    if (count($reservations) == 0) {
?>
    <!-- NO FAVORITE PLACES-->
    <p class="info_message">You have no reservations</p>

<?php
    }
?>
