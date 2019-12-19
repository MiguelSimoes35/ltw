<?php
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $place_id = $_GET['id'];
    $place_reviews = get_place_reviews($place_id);
?>
    <section id="see_all_reviews">
        <div id="see_button">
            <a href="#" onclick="hideReviews()">Hide Reviews 
            <i class="material-icons">arrow_drop_up</i>
            </a>
        </div>
        <div id="review-container">
            <ul>
            <?php
            if(count($place_reviews) > 0) {
                for($i = 0; $i < count($place_reviews); $i++) {
            ?>
                <li>
                    <div id=user><?=$place_reviews[$i]['tourist']?></div>
                    <div id="rate">Rated: <?=$place_reviews[$i]['rate']?></div>
                    <div id="comment"><?=$place_reviews[$i]['comment']?></div>
                </li>
                <?php
                }
                ?>
            </ul>
            <?php
            }
            else {
            ?>
                <h3> Still no reviews for this place :( </h3>
                <?php
            }
                ?>
        </div>
    </section>
