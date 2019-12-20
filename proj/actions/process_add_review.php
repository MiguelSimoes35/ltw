<?php
    include_once('../database/functions.php');
    include_once('../includes/session.php');

    // variables
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $place_id = $_GET['place'];

    $username = $_SESSION['username'];

    $date = date('Y-m-d');

    $reservations = get_user_reservations_place($_SESSION['username'], $place_id);
    $number_reviews = count(get_user_place_reviews($_SESSION['username'], $place_id));

    if($number_reviews == 0) {
        if(count($reservations) > 0) {
            $aux = 0;
            for($i = count($reservations)-1; $i >= 0; $i--)  {
                if($reservations[$i]['checkout'] < $date) {
                    if(preg_match('/^[a-zA-Z\s]+$/', $comment)){
                        add_review($rating, $comment, $reservations[$i]['id']);
                        add_notification("New_Review", $username, $place_id);
                        $aux = 0;
                        header('Location: ../pages/main.php');
                        break;
                    }
                    else {
                        header('Location: ../pages/place.php?id='. $place_id);
                    }
                    
                }
                else {
                    $aux = 1;
                }
            }
            if($aux == 1) {
                $_SESSION['messages'] = 'You have to wait for the final of your reservation to add a review';
                header('Location: ../pages/place.php?id='. $place_id);
            }
        }
        else {
            $_SESSION['messages'] = 'Only previous visitors can submit a review';
            header('Location: ../pages/place.php?id='. $place_id);
        }
    }
    else {
        $_SESSION['messages'] = 'You have already submited a review for this property';
        header('Location: ../pages/place.php?id='. $place_id);
    }
?>