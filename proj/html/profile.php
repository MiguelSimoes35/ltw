<?php
    include_once('../templates/template_generic.php');

    template_header();
?>
<section id="content">
    <section id="profile">
        <div id="your_places">
            <b>Your Places</b>
        </div>

        <div id="reservations">
            <b>Reservations</b>
        </div>

        <div id="edit_profile">
            <img src="../resources/pic1.png" alt="Profile Picture Icon"  style="width:100px;height:100px;">
            <p><a href="#" class="text">Edit Profile</a></p>
        </div>

        <div id="message">
            <img src="../resources/pic2.png" alt="Message icon"  style="width:100px;height:100px;">
            <p><a href="#" class="text">Messages</a></p>
        </div>

        <div id="add_place">
            <!--<button type="button">Add a Place!</button>-->
            <a href="#" class="button">Add a Place!</a>
        </div>
    </section>
</section>
<?php
    template_footer();
?>