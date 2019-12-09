<?php
    include_once('../templates/template_generic.php');
    include_once('../database/access_database.php');
    include_once('../database/functions.php');

    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }

    $user = getUserData($_GET['user']);
    $photo = get_user_photo($_GET['user']);
    
    template_header();
?>
<section id="content">
    <section id="profile_section">
        <div id="profile">
            <div id="profile_photo">
                <img src="<?= $photo ?>" alt="Profile Picture Icon"  style="width:150px;height:150px;"> 
            </div>
            <div id="profile_info">
                <p><b> <?= $_GET['user'] ?> </b></p>
                <p><b> No. of Properties: <?= getUserPlacesCount($_GET['user']) ?> </b></p>
                <p><b> No. of Reservations: <?= getUserReservationsCount($_GET['user']) ?> </b></p>
            </div>
            <?= edit_profile_button() ?>
        </div>

        <div id="data">
            <ul>
                <li><b>My Reservations </b></li>
                <li><b>My Places</b></li>
                <li><b>Favorite Places</b></li>
                <li><b>Messages</b></li>
                <li><b>Notifications</b></li>
            </ul>
            <div>

            </div>  
        </div>
    </section>
</section>
<?php
    template_footer();
?>