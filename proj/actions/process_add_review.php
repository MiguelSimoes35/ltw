<?php
    include_once('../database/functions.php');
    include_once('../includes/session.php');

    // variables
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $place_id = $_GET['place'];

    $date = date('Y-m-d');

    $reservations = get_user_reservations_place($_SESSION['username'], $place_id);
    $number_reviews = count(get_user_place_reviews($_SESSION['username'], $place_id));

    if($number_reviews == 0) {
        if(count($reservations) > 0) {
            $aux = 0;
            for($i = count($reservations)-1; $i >= 0; $i--)  {
                if($reservations[$i]['checkout'] < $date) {
                    add_review($rating, $comment, $reservations[$i]['id']);
                    $aux = 0;
                    header('Location: ../pages/main.php');
                    break;
                }
                else {
                    $aux = 1;
                }
            }
            if($aux == 1) {
                //error message -> you have to wait for the final of your reservation to add a review
                header('Location: ../pages/place.php?id='. $place_id);
            }
        }
        else {
            //error message -> no reservations for this place
            header('Location: ../pages/place.php?id='. $place_id);
        }
    }
    else {
        //error message -> you already gave a review for this place
        header('Location: ../pages/place.php?id='. $place_id);
    }
?>