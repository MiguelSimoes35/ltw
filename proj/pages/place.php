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
$places = get_places($_SESSION['username']);
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
            <div class="place_photo">
                <!-- <img src="../resources/places/<?=$place_id?>/0.jpg" alt="Place photo" style="max-width:600px; max-height:400px;"> -->

                <?php
                    for($i = 0; $i < get_number_photos($place_id); $i++){
                ?>
                        <div class="mySlides fade">
                            <div class="numbertext"> <?=$i + 1?> / <?=get_number_photos($place_id)?></div>
                            <img src="../resources/places/<?=$place_id?>/<?=$i?>.jpg" style="max-width:600px;" >
                        </div>
                <?php
                    }
                ?>
            <a class="prev" id="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" id="next" onclick="plusSlides(1)">&#10095;</a>
            <a id="gallery" onclick="plusSlides(1)"><i class="material-icons">photo_library</i></a>

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

        <ul>
            <li><b>Title: </b><?= $place['title'] ?></li>
            <li><b>Prices/Day: </b><?= $place['price_day'] ?></li>
            <li><b>Description: </b><?= $place['description'] ?></li>
            <li><b>Address: </b><?= $place['address'] ?></li>
            <li><b>Capacity: </b><?= $place['capacity'] ?></li>
        </ul>
    </section>



    <section id="reviews">

    </section>
</section>


<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }


    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
    }

</script>


<?php
template_footer();
?>

