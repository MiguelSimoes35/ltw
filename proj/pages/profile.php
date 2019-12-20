<?php
include_once('../templates/template_generic.php');
include_once('../templates/template_warning.php');
include_once('../database/access_database.php');
include_once('../database/functions.php');

if (!isset($_SESSION['username'])) {
    die(header('Location: login.php'));
}

if ($_GET['user'] != $_SESSION['username']) {
    die(header('Location: login.php'));
}

$user = getUserData($_GET['user']);
$photo = get_user_photo($_GET['user']);

template_header();
template_warning();
?>
<script>
    document.title = "Profile | EasyRent"
</script>
<section id="content">
    <section id="profile_section">
        <div id="profile">
            <div id="profile_photo">
                <img src="<?= $photo ?>" alt="Profile Picture Icon" style="width:150px;height:150px;">
                <h3><?= $_GET['user'] ?></h3>
            </div>
            <div id="profile_info">
                <h3><b><?= $user['name'] ?></b></h3>
                <p><b> No. of Properties: </b><?= getUserPlacesCount($_GET['user']) ?></p>
                <p><b> No. of Reservations: </b><?= getUserReservationsCount($_GET['user']) ?></p>
                <h3><b> Rating: </b><?= calculate_user_rating($_GET['user']) ?> <i class="material-icons" style="color: orange; font-size:20px;">star</i></h3>
            </div>
            <?php if ($_GET['user'] == $_SESSION['username']) { ?>
                <a class="button_link" href="../pages/edit_profile.php"><button id="edit_profile">  Edit Profile </button></a>
            <?php } ?>
        </div>
        <?php if ($_GET['user'] == $_SESSION['username']) { ?>
        <div id="data">
            <ul>
                <li><b><a href="#Reservations" onclick="loadDoc1()">My Reservations</a> </b></li>
                <li><b><a href="#Places" onclick="loadDoc2()">My Places</a></b></li>
                <li><b><a href="#FavoritePlaces" onclick="loadDoc3()">Favorite Places</a></b></li>
                <li><b><a href="#Notifications" onclick="loadDoc4()">Notifications</a></b></li>
            </ul>
            <div id="profile-content">
                <!-- Profile information will display here -->
            </div>
        </div>
        <?php } else { 
            $places = get_places($_GET['user'])?>
            <div id="data">
            <ul>
                <li><b>Places</b></li>
            </ul>
            <div id="profile-content">
                <?php foreach ($places as  $place) {
                        template_place_small($place);
                }?>
            </div>
        </div>

        <?php } ?>
    </section>
</section>

<!-- Javascript -->
<script type="text/javascript">
    let hash = window.location.hash.substr(1);

    load(hash);

    window.addEventListener("hashchange", function() {
        let newhash = window.location.hash.substr(1);
        load(newhash);
    });

    function load(hash) {
        if (hash == "Places")
            loadDoc2();
        else if (hash == "FavoritePlaces")
            loadDoc3();
        else if (hash == "Notifications")
            loadDoc4();
        else loadDoc1();
    }

    function loadDoc1() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("profile-content").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "./my_reservations.php", true);
        xhttp.send();
    }

    function loadDoc2() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("profile-content").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "./my_places.php", true);
        xhttp.send();
    }

    function loadDoc3() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("profile-content").innerHTML = this.responseText;
            }

            let request = new XMLHttpRequest();
            request.addEventListener("load", colorFavorites);
            request.open("get", "../database/get_favorites.php", true);
            request.send();

            let elements = document.getElementsByClassName('favorite');

            if (elements.length != 0)
                for (let it = 0; it < elements.length; it++)
                    elements[it].addEventListener('click', favoritePressed);
        };
        xhttp.open("POST", "../templates/template_favorite_places.php", true);
        xhttp.send();
    }

    function loadDoc4() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("profile-content").innerHTML = this.responseText;
            }

            elements = document.getElementsByClassName('notification');

            console.log(elements);

            for (let it = 0; it < elements.length; it++) {
                console.log(elements[it]);
                elements[it].addEventListener('click', deleteNotificationPressed);
            }
        };
        xhttp.open("POST", "../templates/template_notifications.php", true);
        xhttp.send();
    }
</script>

<?php
template_footer();
?>