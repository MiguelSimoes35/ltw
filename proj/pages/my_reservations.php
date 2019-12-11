<?php 

    include_once('../includes/session.php');

    include_once('../database/functions.php');

    // username
    $user =  $_SESSION['username'];
    echo $user;
    echo "<br>";
    echo "<br>";

    // gets array of reservations
    $reservations = get_reservations($user);

    // loops through place names
    //print_r($reservations['id']);

    // loops through users reservations
    for($i = 0; $i < count($reservations); $i++){
        
        $id = $reservations[$i]['place_id'];
    

        echo get_place_name($id);
        echo "          ";

        echo $reservations[$i]['checkin'];
        echo "          ";

        echo $reservations[$i]['checkout'];
        echo "          ";

        echo $reservations[$i]['total_price'];
        echo "";

        echo "<br>";
        
    }
    

    

    



?>