<?php
    include_once('../includes/include_database.php');
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    $username = $_SESSION['username'];
    $id = $_GET['id'];

    $db = Database::instance()->db();  
    $stmt = $db->prepare('DELETE FROM Notification WHERE id = ?');
    $stmt->execute(array($id));  
    
    echo json_encode(array("id" => $id));
?>