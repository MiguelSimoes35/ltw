<?php
    include_once('../includes/session.php');
    include_once('../database/functions.php');
    include_once('../templates/template_review.php');

    $place_id = $_GET['id'];
    $place_reviews = get_place_reviews($place_id);
?>
    <section id="see_all_reviews">
        <div id="see_button">
            <a href="#see_all_reviews" onclick="hideReviews()">Hide Reviews 
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
                    <?=template_review($place_reviews[$i])?>
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
