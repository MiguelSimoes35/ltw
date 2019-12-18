<?php
    
include_once('../database/functions.php');
include_once('../includes/session.php');
include_once('../database/access_database.php');
include_once('../actions/process_upload_files.php');


// variables
$title = $_POST['title'];
$description = $_POST['description'];
$price_day = $_POST['price_day'];
$capacity = $_POST['capacity'];
$password = $_POST['password'];
$code = $_GET['code'];

$userData = getUserData($_SESSION['username']);
$place = get_places($_SESSION['username'])[$code];


if($password == password_verify($password, $userData['password'])){
    if($title != $place['title']) {
        update_place_title($place['id'], $title);
    }
    if($description != $place['description']) {
        update_place_description($place['id'], $description);
    }
    if($price_day != $place['price_day']) {
        update_place_price($place['id'], $price_day);
    }
    if($capacity != $place['capacity']) {
        update_place_capacity($place['id'], $capacity);
    }
    header('Location: ../pages/place.php?id='.$place['id']);
}
else {
    // create error message
    header('Location: ../pages/edit_place.php?code='.$code);
}

?>