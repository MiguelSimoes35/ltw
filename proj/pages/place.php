<?php
    include_once('../templates/template_generic.php');
    include_once('../database/functions.php');

    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }

    template_header();

    $place = get_place_data($_GET['id']);
    $place_id = $_GET['id'];
?> 

<section id="content">

    <section id="place_section">
        <h1><?=$place['title']?></h1>
        <h3 class="owner">Posted by <?=$place['owner']?></h3> 
        <div class="place">
            <div id="place_photo">
                <img src="../resources/beachOpener.jpg" alt="Place photo"  style="max-width:600px; max-height:400px;">
            </div>
            <div class="place_info">
                <h2><i class="material-icons">favorite_border</i> Like button  going there --------------------------------------> *</h2>
                <h2 class="price">Price per day: <?=$place['price_day']?> €</h2>
                <h3 class="capacity">Capacity: <?=$place['capacity']?> <i class="material-icons">person</i> </h3>
                <h3 class="location"><?=$place['city']?>, <?=$place['country']?></h3>
                <h2>RATED 4.5<i class="material-icons">star</i></h2>
            </div>
        </div>
        <h3><b>Description: </b></h3><p>
            <?= $place['description'] ?>
        </p>
        <!--<div id="place_reservation">
            
            <div id="place_photo">
                <img src="../resources/beachOpener.jpg" alt="Place photo"  style="max-width:50%;"> 
            </div>
        </div>

        <div id="data">-->
            <ul>
                <li><b>Title: </b><?=$place['title'] ?></li>
                <li><b>Prices/Day: </b><?= $place['price_day'] ?></li>
                <li><b>Description: </b><?= $place['description'] ?></li>
                <li><b>Address: </b></li>
                <li><b>Capacity: </b><?= $place['capacity'] ?></li>
            </ul><!--
            <div>

            </div>  
        </div>-->
    </section>

    <section id="reservation">
            <form action="../actions/process_reservation.php?id=<?=$place_id?>" method="post">
                <!--<div id="reservation_info">-->
                    <!-- calendar here -->
                    Please insert the date of check-in and check-out.
                    <br>
                    <label for="check-in">Check-In</label> 
                    <input type="date" name="check-in" id="check-in" required>
                    <label for="check-out">Check-Out</label> 
                    <input type="date" name="check-out" id="check-out" required>

                <!--</div>
                <!-<button id="make_reservation">Make a reservation!</button>-->
                <input type="submit" value="Make Reservation">

            </form>
    </section>

    <section id="reviews">

    </section>
</section>



<?php  
    template_footer();

?>