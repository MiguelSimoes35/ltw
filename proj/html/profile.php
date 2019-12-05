<?php
    include_once('../templates/template_generic.php');

    template_header();
?>
<section id="content">
    <section id="profile_section">
        <div id="profile">
            <div id="profile_photo">
                <img src="../resources/pic1.png" alt="Profile Picture Icon"  style="width:150px;height:150px;"> 
            </div>
            <div id="profile_info"></div>
            <button id="edit_profile">Edit Profile</button>
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