<?php 
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    // username
    $user = $_SESSION['username'];

    // gets array of reservations
    $places = get_places($user);

?>
<div id="table_header">
    <div>Place</div> 
    <div>Capacity</div> 
    <div>Address</div> 
    <div>Price P/Day(€)</div>
</div>
<?php
    for($i = 0; $i < count($places); $i++){
        $id = $places[$i]['id'];
        ?>
        <a href="../pages/place.php?id=<?=$id?>">
            <div id="my_places">
                <div><?= $places[$i]['title']; ?></div>
                <div><?= $places[$i]['capacity']; ?></div> 
                <div><?= $places[$i]['address']; ?></div> 
                <div><?= $places[$i]['price_day']; ?></div>
            </div>
        </a>
        <?php
    }
?>
<a href="./add_place.php">
    <button id="add_place">Add Place!</button>
</a>
