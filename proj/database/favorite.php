<?php
    include_once('../includes/include_database.php');
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $place = $_GET['place_id'];
    $username = $_SESSION['username'];

    $db = Database::instance()->db();
  
    $stmt = $db->prepare('SELECT * FROM Like WHERE username = ? AND place_id = ?');
    $stmt->execute(array($username, $place));
    
    if($stmt->fetch() == false){
        add_like($username, $place);
        $like = array($place, 'red');
    }
    else {
        remove_like($username, $place);
        $like = array($place, "#bbbbbb");
    }
    
    echo json_encode($like);
?>
