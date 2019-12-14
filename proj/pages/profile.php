<?php
    include_once('../templates/template_generic.php');
    include_once('../database/access_database.php');

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
                <img src="<?=$photo?>" alt="Profile Picture Icon"  style="width:150px;height:150px;"> 
            </div>
            <div id="profile_info">
                <p><b> <?= $_GET['user'] ?> </b></p>
                <p><b> No. of Properties: <?= getUserPlacesCount($_GET['user']) ?> </b></p>
                <p><b> No. of Reservations: <?= getUserReservationsCount($_GET['user']) ?> </b></p>
            </div>
            <?php if($_GET['user'] == $_SESSION['username']) { ?>
                <button id="edit_profile" > <a href= "../pages/edit_profile.php"> Edit Profile </a></button>
            <?php } ?>
        </div>

        <div id="data">
            <ul>
                <li><b><a href="#" onclick="loadDoc1()">My Reservations</a> </b></li>
                <li><b><a href="#" onclick="loadDoc2()">My Places</a></b></li>
                <li><b><a href="#" onclick="loadDoc3()">Favorite Places</a></b></li>
                <li><b>Messages</b></li>
                <li><b>Notifications</b></li>
            </ul>
            <div id="profile-content">
                <!-- Profile information will display here -->
            </div>  
        </div>
    </section>
</section>

<!-- Javascript -->
<script type="text/javascript">

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
    };
    xhttp.open("POST", "../templates/template_favorite_places.php", true);
    xhttp.send();

    }

</script>

<?php
    template_footer();
?>