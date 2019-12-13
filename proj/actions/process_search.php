<?php 
    include_once('../includes/include_database.php');
    include_once('../database/access_database.php');

    $city = $_POST['city'];
    $country = $_POST['country'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $max_price = $_POST['max_price'];
    $capacity = $_POST['capacity'];

    if ($city === null && $country === null && $check_in === null && $check_out === null && $max_price === null && $capacity === null){
        getAllPlaces($db);
    }
?>