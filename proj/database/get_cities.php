<?php
  include_once('../includes/include_database.php');
  $country = $_GET['country'];

  $db = Database::instance()->db();
  
  $stmt = $db->prepare("SELECT city FROM Location WHERE country = ?");
  $stmt->execute(array($country));
  $cities = $stmt->fetchAll();
  
  echo json_encode($cities);
?>