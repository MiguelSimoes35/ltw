<?php
    include_once('../includes/include_database.php');
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $username = $_SESSION['username'];

    $db = Database::instance()->db();
  
    $stmt = $db->prepare('SELECT place_id FROM Like WHERE username = ?');
    $stmt->execute(array($username));    
    $places = $stmt->fetchAll();
    
    echo json_encode($places);
?>