<?php 
    include_once('../includes/include_database.php');
    include_once('../templates/template_generic.php');
    include_once('../templates/template_search.php');

    template_header();
?>
<section id="content">
<?php
    template_search();
?>
    <section id="popular_places">
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
    </section>

</section>
<?php
    template_footer();

?>
