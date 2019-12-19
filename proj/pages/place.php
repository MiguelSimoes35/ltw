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
$place_reviews = get_place_reviews($place_id);
$numberReviews = count($place_reviews);

//aux function 
$places = get_places($_SESSION['username']);
for($i = 0; $i < count($places); $i++){
    if($place_id == $places[$i]['id']) {
        $ind = $i;
        break;
    }
}
?>

<section id="gallery">
<?php
for($i = 0; $i < get_number_photos($place_id); $i++) {
?>
        <div class="myLargeSlides fade">
            <div class="numbertext"> <?=$i + 1?> / <?=get_number_photos($place_id)?></div>
            <img src="../resources/places/<?=$place_id?>/<?=$i?>.jpg" style="max-width: 80%">
        </div>
<?php
}
?>
    <a class="prev" id="p" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" id="n" onclick="plusSlides(1)">&#10095;</a>
    <a class="slideShowBTN" id="close" onclick="closeGallery()"><i class="material-icons">clear</i></a>
</section>

<section id="content">
    <section id="place_section">
        <header class="title">
            <h1><?= $place['title'] ?></h1>
            <?php if($place['owner'] == $_SESSION['username']) { ?>
                <button id="edit_place"> <a href= "../pages/edit_place.php?code=<?=$ind?>"> Edit Place </a></button>
                <?php } ?>
        </header>

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
            <a id="openGallery" onclick="openGallery()"><i class="material-icons">photo_library</i></a>

            </div>
            <div class="place_info">
                <?php template_favorite($place_id) ?>
                <h2 class="location"><?= $place['city'] ?>, <?= $place['country'] ?>: <?= $place['address']?></h2>
                <h2 class="capacity">Capacity: <?= $place['capacity'] ?> <i class="material-icons">person</i> </h2>
                <h2 class="price">Price per day: <?= $place['price_day'] ?> €</h2>
                <h2>Rating:  
                    <?php 
                    if($numberReviews > 0) {
                        echo calculate_rating($place_id);
                    }
                    else {
                        echo "--";
                    }
                    ?>
                    <i class="material-icons" style="color: yellow;">star</i>
                </h2>
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

                <label for="checkin">Check-In <input type="date" name="checkin" id="checkin" required></label>
                
                <label for="checkout">Check-Out <input type="date" name="checkout" id="checkout" required></label>
                

                <!--</div>
                <!-<button id="make_reservation">Make a reservation!</button>-->
                <input type="submit" value="Make Reservation">

            </form>
        </section>
    </section>
    <section id="reviews">
        <h2>Reviews</h2>
        <h3>Add a Review</h3>
        <section id="add_reviews">
            <form action="../actions/process_add_review.php?place=<?=$place_id?>" method="post" enctype="multipart/form-data">
                <label for="rating" id="rating">Rating</label>
                <input type="number" id="rating" name="rating" required>

                <label for="comment" id="comment">Comment</label>
                <input type="textarea" rows="4" cols="50" id="comment" name="comment" required>

                <input type="submit" id="send_review" value="Send Review">
            </form>
        </section>
        <section id="see_all_reviews">
            <div id="see_button">
                <a href="#" onclick="loadReviews()">See all the reviews for this place 
                <i class="material-icons">arrow_drop_down</i>
                </a>
            </div>
            <div id="review-container" >
                <!-- reviews shows here -->
            </div>
        </section>
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
        let largeSlides = document.getElementsByClassName("myLargeSlides");

        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            largeSlides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
        largeSlides[slideIndex-1].style.display = "block";
    }

    function openGallery() {
        let gallery = document.getElementById("gallery");
        gallery.style.display = "inline";
    }

    function closeGallery() {
        let gallery = document.getElementById("gallery");
        gallery.style.display = "none";
    }

</script>


<?php
template_footer();
?>

<script type="text/javascript">
    function loadReviews() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("see_all_reviews").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "./see_reviews.php?id=<?=$place_id?>", true);
        xhttp.send();
    }
</script>

<script type="text/javascript">
    function hideReviews() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("see_all_reviews").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "./hide_reviews.php?id=<?=$place_id?>", true);
        xhttp.send();
    }
</script>
