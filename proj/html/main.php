<?php 
    include_once('../includes/include_database.php');
    include_once('../templates/template_generic.php');

    template_header();
?>
<article>
            <p>Most popular places</p>
            <img src="../resources/beachOpener.jpg" alt="Beach">
            <img src="../resources/cityOpener.jpg" alt="City">
            <img src="../resources/villageOpener.jpg" alt="Village">
        </article>
        <article>
            <p>Best seasons</p>
            <img src="../resources/summerSeason.jpg" alt="Summer">
            <img src="../resources/winterSeason.jpg" alt="Winter">
            <img src="../resources/springSeason.jpg" alt="Spring">
        </article>
<?php
    template_footer();

?>
