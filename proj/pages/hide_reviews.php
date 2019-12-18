<?php

include_once('../includes/session.php');
include_once('../database/functions.php');

    $place_id = $_GET['id'];
?>
<section id="see_all_reviews">
    <div id="see_button">
        <a href="#" onclick="loadReviews()">See all the reviews for this place 
        <i class="material-icons">arrow_drop_down</i>
        </a>
    </div>
    <div id="review-container">

    </div>
</section>
