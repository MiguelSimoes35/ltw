<?php
include_once('../templates/template_generic.php');
include_once('../templates/template_favorite.php');
include_once('../database/functions.php');

if (!isset($_SESSION['username'])) {
    die(header('Location: login.php'));
}

template_header();

$place = get_place_data($_GET['id']);
$place_id = $_GET['id'];
$ind = 0;

//aux function 
$places = get_places($user);
for($i = 0; $i < count($places); $i++){
    if($place_id == $places[$i]['id']) {
        $ind = $i;
        break;
    }
}

?>

<section id="content">
    <section id="place_section">
        <h1><?= $place['title'] ?></h1>
        <?php if($place['owner'] == $_SESSION['username']) { ?>
            <button id="edit_place"> <a href= "../pages/edit_place.php?code=<?=$ind?>"> Edit Place </a></button>
        <?php } ?>
        <div class="place">
            <div id="place_photo">
                <img src="../resources/places/<?=$place_id?>/0.jpg" alt="Place photo" style="max-width:600px; max-height:400px;">
            </div>
            <div class="place_info">
                <?php template_favorite($place_id) ?>
                <h2 class="location"><?= $place['city'] ?>, <?= $place['country'] ?></h2>
                <h2 class="capacity">Capacity: <?= $place['capacity'] ?> <i class="material-icons">person</i> </h2>
                <h2 class="price">Price per day: <?= $place['price_day'] ?> €</h2>
                <h2>RATED 4.5<i class="material-icons">star</i></h2>
                <h3 class="owner">Posted by <?= $place['owner'] ?></h3>

            </div>
        </div>
        <div id="description">
            <h2><b>Description</b></h2>
            <p>
                <?= $place['description'] ?>
            </p>
        </div>
        <section id="reservation">
            <form action="../actions/process_reservation.php?id=<?= $place_id ?>" method="post">
                <!--<div id="reservation_info">-->
                <!-- calendar here -->

                <br>
                <label for="checkin">Check-In</label>
                <input type="date" name="checkin" id="checkin" required>
                <label for="checkout">Check-Out</label>
                <input type="date" name="checkout" id="checkout" required>

                <!--</div>
                <!-<button id="make_reservation">Make a reservation!</button>-->
                <input type="submit" value="Make Reservation">

            </form>
        </section>
        <!--<div id="place_reservation">
            
            <div id="place_photo">
                <img src="../resources/beachOpener.jpg" alt="Place photo"  style="max-width:50%;"> 
            </div>
        </div>

        <div id="data">-->
        <ul>
            <li><b>Title: </b><?= $place['title'] ?></li>
            <li><b>Prices/Day: </b><?= $place['price_day'] ?></li>
            <li><b>Description: </b><?= $place['description'] ?></li>
            <li><b>Address: </b><?= $place['address'] ?></li>
            <li><b>Capacity: </b><?= $place['capacity'] ?></li>
        </ul>
        <!--
            <div>

            </div>  
        </div>-->
    </section>



    <section id="reviews">

    </section>
</section>



<?php
template_footer();

?>