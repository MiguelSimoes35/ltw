<?php

include_once('../includes/session.php');
include_once('../database/functions.php');
include_once('../actions/process_upload_files.php');

$title = $_POST['title'];
$description = $_POST['description'];
$address = $_POST['address'];
$price_day = $_POST['price_day'];
$capacity = $_POST['capacity'];
$country = $_POST['country'];
$city = $_POST['city'];

$location_id = find_location_id($city, $country);
$user = $_SESSION['username'];

$place_id = add_place($title, $description, $address, $price_day, $capacity, $location_id, $user);
mkdir("../resources/places/$place_id");
set_place_photos($place_id);


header('Location: ../pages/main.php');

?>