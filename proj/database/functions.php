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

        return $user !== false && $password == password_verify($password, $user['password']);
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

    function get_user_full_name($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM User WHERE username = ?');
        $stmt->execute(array($id));

        return $stmt->fetch()['name'];
    }

    function update_password($username, $password) {
        $db = Database::instance()->db();

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare('UPDATE User SET password = ? WHERE username = ?');
        $stmt->execute(array($hash_password, $username));

        return true;
    }

    function update_name($username, $name) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE User SET name = ? WHERE username = ?');
        $stmt->execute(array($name, $username));

        return true;
    }

    function update_email($username, $email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE User SET email = ? WHERE username = ?');
        $stmt->execute(array($email, $username));

        return true;
    }

    function get_place_data($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Place, Location WHERE Place.id = ? AND Place.location_id = Location.id');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function valid_dates($checkin, $checkout, $place_id){

        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Reservation WHERE (place_id = ? AND checkin <= ? AND checkout >= ?)');
        $stmt->execute(array($place_id, $checkout, $checkin));
                
        $number = count($stmt->fetch()['id']);

        if($number == 0){
            return true;
        }
        else{
            return false;
        }
        return true;
    }

    function make_reservation($checkin, $checkout, $place_id, $user, $total_price){

        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Reservation(checkin, checkout, total_price, place_id, tourist) VALUES(?, ?, ?, ?, ?)');
        $stmt->execute(array($checkin, $checkout, $total_price, $place_id, $user));

        return true;
    }

    function calculate_total_price($checkin, $checkout, $place_id){

        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT price_day FROM Place WHERE id = ?');
        $stmt->execute(array($place_id));

        $price = $stmt->fetch()['price_day'];

        // calculates duration 
        $date1=date_create($checkin);
        $date2=date_create($checkout);
        $diff = date_diff($date1,$date2);
        $duration =  $diff->format("%a");

        $total_price = $duration * $price;

        return $total_price;
    }

    function get_reservations($user){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Reservation WHERE tourist = ?');
        $stmt->execute(array($user));

        return $stmt->fetchAll();
    }

    function get_place_name($place_id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Place WHERE id = ?');
        $stmt->execute(array($place_id));
        $name = $stmt->fetch()['title'];

        return $name;
    }

    function find_location_id($city, $country){

        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Location WHERE (city = ? AND country = ?)');
        $stmt->execute(array($city, $country));

        return $stmt->fetch()['id'];

    }

    function add_place($title, $description, $address, $price_day, $capacity, $location_id, $user){

        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Place(title, price_day, description, address, location_id, owner, capacity) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, $price_day, $description, $address, $location_id, $user, $capacity));

        return true;

    }

    function add_like($username, $place_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Like(id, username, place_id) VALUES(NULL, ?, ?)');
        $stmt->execute(array($username, $place_id));
    }

    function remove_like($username, $place_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('DELETE FROM Like WHERE username = ? AND place_id = ?');
        $stmt->execute(array($username, $place_id));
    }

    function get_places($user){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Place WHERE owner = ?');
        $stmt->execute(array($user));

        return $stmt->fetchAll();
    }
?>