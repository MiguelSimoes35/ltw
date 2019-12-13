<?php 
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $checkin = $_POST['check-in'];
    $checkout = $_POST['check-out'];
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

            header('Location: ../pages/main.php');
        }
        else{
            // deal with bad reservation
            header('Location: ../pages/place.php?id='.$place_id);
        }
    }
?>