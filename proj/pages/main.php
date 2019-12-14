<?php 
    include_once('../includes/include_database.php');
    include_once('../templates/template_generic.php');
    include_once('../templates/template_search.php');
    include_once('../templates/template_place.php');
    include_once('../database/access_database.php');
    include_once('../includes/session.php');
    include_once('../templates/template_favorite.php');
    
    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }

    $places = getAllPlaces();

    template_header();

 
?>
    
    <section id="user">
        Welcome, <?= $_SESSION['username']  ?> 
    </section>    
<?php

?>

<section id="content">
<?php
    template_search();

    //print_r($places);
    
    //template_place($places[0]);
    foreach ($places as $place) {
        template_place($place);
    }
?>
    <!--<section id="popular_places">
        <h2>Most popular places</h2>
        <article>
            <img src="../resources/beachOpener.jpg" alt="Beach">
        </article>
        <article>
            <img src="../resources/cityOpener.jpg" alt="City">
        </article>
        <article>
            <img src="../resources/villageOpener.jpg" alt="Village">
        </article>
    </section>
    <section id="best_seasons">
        <article>
            <p>Best seasons</p>
            <img src="../resources/summerSeason.jpg" alt="Summer">
            <img src="../resources/winterSeason.jpg" alt="Winter">
            <img src="../resources/springSeason.jpg" alt="Spring">
        </article>
    </section> -->

</section>
<?php
    template_footer();

?>
