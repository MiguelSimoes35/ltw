<?php 

    include_once('../includes/include_database.php');

    function available_username($username){

        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetch() ? false : true;

    }

    function insert_user($username, $password, $name, $email){

        echo "deu MERDA";

        $db = Database::instance()->db();

        echo "123";

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO User(username, password, name, email) VALUES(?, ?, ?, ?)');
        $stmt->execute(array($username, $hash_password, $name, $email));

        return true;

    }


    function valid_login($username, $password){

    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();

    return $user !== false && $password == $user['password']/*password_verify($password, $user['password']) <- adicionar quando houver hash e tal */;

    }

    function get_user_id($username){

    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT id FROM User WHERE username = ?');
    $stmt->execute(array($username));

    return $stmt->fetch()['id'];

    }

    function get_user_name($id){

    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT username FROM User WHERE id = ?');
    $stmt->execute(array($id));

    return $stmt->fetch()['username'];

    }

?>