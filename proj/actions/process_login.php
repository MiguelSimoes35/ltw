<?php
  include_once('../includes/session.php');
  include_once('../database/functions.php');

  $username = $_POST['username'];
  $password = $_POST['password'];


  if (valid_login($username, $password)) {
    echo "super";
    //$_SESSION['username'] = $username;
    //echo "success!";
    //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    $_SESSION['username'] = $username;
    header('Location: ../html/main.php');
    //header('Location: ../pages/list.php');
  } 
  else {
    echo ":(";
    //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    //header('Location: ../pages/login.php');
    header("Location: ../html/login.php");
  }
?>