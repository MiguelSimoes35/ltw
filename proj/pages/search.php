<?php
include_once('../includes/include_database.php');
include_once('../templates/template_generic.php');
include_once('../templates/template_search.php');
include_once('../templates/template_place.php');
include_once('../database/access_database.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username'])) {
    die(header('Location: login.php'));
}

$places = getPlacesBySearch($_GET['where_country'], $_GET['city'], $_GET['checkin'], $_GET['checkout'], $_GET['capacity'], $_GET['minimum_price'], $_GET['maximum_price']);

template_header();
?>

<section id="content">
    <?php
    template_search();
    foreach ($places as $place) {
        template_place($place);
    }
    ?>
</section>
<?php

template_footer();
?>