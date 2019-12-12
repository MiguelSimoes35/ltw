<?php

    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $title = $_POST['title'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $price_day = $_POST['price_day'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    echo $title;
    echo "<br>";

    echo $description;
    echo "<br>";

    echo $address;
    echo "<br>";

    echo $price_day;
    echo "<br>";

    echo $capacity;
    echo "<br>";

    echo $country;
    echo "<br>";

    echo $city;
    echo "<br>";
    
    


?>