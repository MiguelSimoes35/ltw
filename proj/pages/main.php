<?php 
    include_once('../includes/include_database.php');
    include_once('../templates/template_generic.php');
    include_once('../templates/template_warning.php');
    include_once('../templates/template_search.php');
    include_once('../templates/template_place.php');
    include_once('../database/access_database.php');
    include_once('../includes/session.php');
    include_once('../templates/template_favorite.php');
    
    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }

    $places = getPopularPlaces();

    template_header();

 
?>
    
    <section id="user">
    </section>    
<?php

?>
<script>document.title = "Top Rated Places | EasyRent"</script>
<section id="content">
<?php
    template_search();
?>
    <h2>Most popular places</h2>
    <section id="popular_places" style="display: flex; justify-content: center; margin: 0 auto">
<?php
    foreach ($places as $place) {
        template_place_small($place);
    }
?>
    </section>
</section>
<?php
    template_footer();

?>
