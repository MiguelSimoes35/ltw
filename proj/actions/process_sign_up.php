<?php
    
    include_once('../database/functions.php');
    include_once('../includes/session.php');
    include_once('../actions/process_upload_files.php');

    // variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $r_password = $_POST['confirm_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if($password != $r_password){
        // create error message
        header('Location: ../pages/sign_up.php');
    }
    

    if(!available_username($username)){
        // create error message
        header('Location: ../pages/sign_up.php');
    }
    

    if(insert_user($username, $password, $name, $email)) {
        mkdir("../resources/users/$username");
        $_SESSION['username'] = $username;
        set_profile_photo();
        header('Location: ../pages/main.php'); 
    }
    else {
        header('Location: ../pages/sign_up.php');
    }

?>