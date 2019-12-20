<?php
    
include_once('../database/functions.php');
include_once('../includes/session.php');
include_once('../database/access_database.php');
include_once('../actions/process_upload_files.php');


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
        if($newpassword == $rpassword) {
            update_password($_SESSION['username'], $newpassword);
            // create success message
            header('Location: ../pages/profile.php?user=' . $_SESSION['username']);
        }
        else {
            $_SESSION['messages'] = 'Passwords do not match';
            header('Location: ../pages/edit_profile.php');
        }
    }
    else {
        $_SESSION['messages'] = 'New password is the same as the current one';
        header('Location: ../pages/edit_profile.php');
    }
}

if(preg_match('/^[a-zA-Z\s]+$/', $name)){
    if($password == password_verify($password, $userData['password'])){
        if($name != $userData['name']) {
            update_name($_SESSION['username'], $name);
        }
        if($email != $userData['email']) {
            update_email($_SESSION['username'], $name);
        }
        // if for the pic -> when update photo available
        update_profile_photo();
        // create success message
        header('Location: ../pages/profile.php?user=' . $_SESSION['username']);
    }
    else {
        $_SESSION['messages'] = 'Incorrect Password';
        header('Location: ../pages/edit_profile.php');
    }
}
else{
    $_SESSION['messages'] = 'Inserted data is invalid';
    header('Location: ../pages/edit_profile.php');
}



?>