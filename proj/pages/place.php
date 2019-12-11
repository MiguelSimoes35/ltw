<?php
    include_once('../templates/template_generic.php');
    include_once('../database/functions.php');

    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }

    template_header();

    $place = get_place_data($_GET['id']);
    $place_id = $_GET['id'];
?> 

<section id="content">

    <section id="place_section">
        <div id="place_reservation">
            <div id="place_photo">
                <img src="../resources/beachOpener.jpg" alt="Place photo"  style="width:250px;height:150px;"> 
            </div>
            
            <form action="../actions/process_reservation.php?id=<?=$place_id?>" method="post">
                
                <div id="reservation_info">

                    <!-- calendar here -->
                    Please insert the date of check-in and check-out.
                    <br>
                    Check-In
                    <input type="date" name="check-in" id="check-in">
                    Check-Out
                    <input type="date" name="check-out" id="check-out"> 

                </div>
                <!--<button id="make_reservation">Make a reservation!</button>-->
                <input type="submit" value="Make Reservation">

            </form>

        </div>

        <div id="data">
            <ul>
                <li><b>Title: </b><?= $place['title'] ?></li>
                <li><b>Prices/Day: </b><?= $place['price_day'] ?></li>
                <li><b>Description: </b><?= $place['description'] ?></li>
                <li><b>Address: </b></li>
                <li><b>Capacity: </b><?= $place['capacity'] ?></li>
            </ul>
            <div>

            </div>  
        </div>
    </section>

</section>
</body>


<?php  
    template_footer();

?>