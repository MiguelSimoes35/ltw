<?php

    include_once('../includes/include_database.php');

    function getUserData($username) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getAllPlaces() {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT * FROM Place');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getPlacesBySearch($country, $city, $checkin, $checkout, $capacity, $min_price, $max_price){
        $db = Database::instance()->db();
        $query = 'SELECT * FROM Place, Location WHERE Place.location_id = Location.id AND (NOT EXISTS (SELECT place_id AS id FROM Reservation WHERE (((checkin <= ? AND checkout > ?) OR (checkin < ? AND checkout >= ?) OR (? <= checkin AND ? > checkin) OR (? < checkout AND ? >= checkout)) AND Reservation.place_id=Place.id)))';
        $variables = array($checkin, $checkin, $checkout, $checkout, $checkin, $checkout, $checkin, $checkout);

        if ($country != null && $country != 'undefined') {
            $query = $query . 'AND country = ?';
            $variables[] = $country; 
        }

        if ($city != null && $city != 'undefined') {
            $query = $query . 'AND city = ?';
            $variables[] = $city;
        }

        if ($capacity != null && $capacity != 'undefined') {
            $query = $query . 'AND capacity >= ?';
            $variables[] = $capacity;
        }

        if ($min_price != null && $min_price != 'undefined') {
            $query = $query . 'AND price_day >= ?';
            $variables[] = $min_price;
        }

        if ($max_price != null && $max_price != 'undefined') {
            $query = $query . 'AND price_day <= ?';
            $variables[] = $max_price;
        }

        $stmt = $db->prepare($query);
        $stmt->execute($variables);

        return $stmt->fetchAll();
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
        return $location->fetch();    
    }

    function getLocationId($city, $country) {
        $db = Database::instance()->db();
        $location = $db->prepare('SELECT * FROM Location WHERE city = ? AND country = ?');
        $location->execute(array($city, $country));
        return $location->fetch();
    }

    function getAllCountries() {
        $db = Database::instance()->db();
        $countries = $db->prepare('SELECT DISTINCT country FROM Location');
        $countries->execute();
        return $countries->fetchAll();
    }




?>
