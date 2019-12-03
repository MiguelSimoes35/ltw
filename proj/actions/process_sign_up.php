<?php
    include_once('../includes/include_database.php');

    // variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $r_password = $_POST['repeat_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // access database
    $db = Database::instance()->db();

    // insert the new user
    if($password == $r_password){
        $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?, ?)');
        $stmt->execute(array($username, $password, $name, $email));         // IMPORTANTE - mudar a forma de guardar a password para encriptada
        header('Location: ../html/main.php');
        exit;
    }
    header('Location: sign_up.php');
    


?>