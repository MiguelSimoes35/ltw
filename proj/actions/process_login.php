<?php
  include_once('../includes/session.php');
  include_once('../database/functions.php');

  $username = $_POST['username'];
  $password = $_POST['password'];


  if (valid_login($username, $password)) {
    if(preg_match('/^[A-Z\d]+$/i', $username)){
      $_SESSION['username'] = $username;
      header('Location: ../pages/main.php');
    }
    else{
      header('Location: ../pages/login.php');
    }
  } 
  else {
    echo ":(";
    //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    header('Location: ../pages/login.php');
  }
?>