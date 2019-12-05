<?php

    include_once('../includes/include_database.php');

    function getAllPlaces() {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT * FROM Place');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getPlacesBySearch(){

    }

    function getUserPlaces($user_id){
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT * FROM Place WHERE owner = ?');
        $stmt->execute(array($user_id));
        return $stmt->fetchAll();
    }

    function insertPlace($user_id, $title, $price, $description, $address, $city, $country) {
        $db = Database::instance()->db();

        $location = getLocationId($city, $country);
        $location_id = $location['id'];

        $stmt = $db->prepare('INSERT INTO Place VALUES(NULL, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, $price, $description, $address, $location_id, $user_id));
    }

    function getLocation($location_id) {
        $db = Database::instance()->db();
        $location = $db->prepare('SELECT city, country FROM Location WHERE id = ?');
        $location->execute(array($location_id));
        return $location->fetch();    }

    function getLocationId($city, $country) {
        $db = Database::instance()->db();
        $location = $db->prepare('SELECT * FROM Location WHERE city = ? AND country = ?');
        $location->execute(array($city, $country));
        return $location->fetch();
    }




?>