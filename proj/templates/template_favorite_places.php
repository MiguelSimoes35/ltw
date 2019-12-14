<?php 
    include_once('../includes/session.php');
    include_once('../database/access_database.php');
    include_once('../templates/template_place.php');

    // username
    $user = $_SESSION['username'];

    // gets array of reservations
    $favorite_places = getFavoritePlaces($user);

?>
<div id="favorite_places">
    <?php 
        foreach ($favorite_places as  $place) {
            template_place_small($place);
        }
    ?>

</div>
    