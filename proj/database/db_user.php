<?php
  include_once('../includes/include_database.php');
  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($username, $password) { 
    $db = Database::instance()->db(); 
    $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    //return $user !== false && password_verify($password, $user['password']);
    if($password == $user['password'] && $user !== false){
        return true;
    }
    else{
        return false;
    }
  }

  /*
  function insertUser($username, $password) {
    $db = Database::instance()->db();
    $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO User VALUES(?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options)));
  }
  */
?>