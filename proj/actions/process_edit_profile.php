<?php
    
include_once('../database/functions.php');
include_once('../includes/session.php');
include_once('../database/access_database.php');

// variables
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$oldpassword = $_POST['old_password'];
$newpassword = $_POST['new_password'];
$rpassword = $_POST['conf_new_password'];

$userData = getUserData($_SESSION['username']);


if($oldpassword == password_verify($oldpassword, $userData['password'])) {
    if($newpassword != $oldpassword) {
        echo "Here!";
        if($newpassword == $rpassword) {
            update_password($_SESSION['username'], $newpassword);
            // create success message
            header('Location: ../pages/profile.php?user=' . $_SESSION['username']);
        }
        else {
            echo "Confirmation password different from new password :(";
            // create error message
            header('Location: ../pages/edit_profile.php');
        }
    }
}

if($password == password_verify($password, $userData['password'])){
    if($name != $userData['name']) {
        update_name($_SESSION['username'], $name);
    }
    if($email != $userData['email']) {
        update_email($_SESSION['username'], $name);
    }
    // if for the pic -> when update photo available
    // create success message
    header('Location: ../pages/profile.php?user=' . $_SESSION['username']);
}
else {
    // create error message
    header('Location: ../pages/edit_profile.php');
}
?>