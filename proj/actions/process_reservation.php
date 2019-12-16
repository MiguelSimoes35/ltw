<?php 
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $user = $_SESSION['username'];

    $place_id = $_GET['id'];

    if($checkin >= $checkout){
        // deal with bad reservation
        header('Location: ../pages/place.php?id='.$place_id);
    }
    else {
        if(valid_dates($checkin, $checkout, $place_id)){

            $total_price = calculate_total_price($checkin, $checkout, $place_id);
            make_reservation($checkin, $checkout, $place_id, $user, $total_price);

            // New Notification -> New Reservation
            header('Location: ../pages/main.php');
        }
        else{
            // deal with bad reservation
            header('Location: ../pages/place.php?id='.$place_id);
        }
    }
?>