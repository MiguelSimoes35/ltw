<?php
    
include_once('../database/functions.php');
include_once('../includes/session.php');
include_once('../database/access_database.php');

// variables
$password2 = $_POST['password'];
$name2 = $_POST['name'];
$email2 = $_POST['email'];

if($password != $r_password){
    // create error message
    header('Location: ../pages/edit_profile.php');
}
?>