<?php
include_once('template_place.php');
include_once('../database/functions.php');  

function template_place_reservations($place) {
    $reservations = get_place_reservations($place['id']);
?>
    <article class="place_reservations" style="border-bottom: 4px solid;  padding: 1em; margin-bottom: 0.5em;"> <!--border-radius: 0.5em;background-color: rgba(0.5,0.5,0.5,0.1);-->
        <?php template_place_small($place) ?>
        <div id="table_header">
            <div>User</div>
            <div>Check-In Date</div>
            <div>Check-Out Date</div>
            <div>Total Price(€)</div>
        </div>
        <?php
        for ($i = 0; $i < count($reservations); $i++) {
            $id = $reservations[$i]['place_id'];
        ?>
            <div id="reservations">
                <div><?= $reservations[$i]['tourist']?></div>
                <div><?= $reservations[$i]['checkin']; ?></div>
                <div><?= $reservations[$i]['checkout']; ?></div>
                <div><?= $reservations[$i]['total_price']; ?></div>
            </div>
        <?php
        }
        ?>
        </div>
        <?php if (count($reservations) == 0){?>
            <p class="info_message">No reservations</p>
        <?php } ?>
    </article>
<?php
}
?>