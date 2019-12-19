<?php 
    include_once('../includes/include_database.php');

    function available_username($username){
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetch() ? false : true;
    }

    function insert_user($username, $password, $name, $email){
        $db = Database::instance()->db();

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

    function get_place_reservations($place) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Reservation WHERE place_id = ?');
        $stmt->execute(array($place));

        return $stmt->fetchAll();
    }

    function get_user_reservations_place($user, $place) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Reservation WHERE place_id = ? AND tourist = ?');
        $stmt->execute(array($place, $user));

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

        return $db->lastInsertId();
    }

    function add_like($username, $place_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Like(like_id, username, place_id) VALUES(NULL, ?, ?)');
        $stmt->execute(array($username, $place_id));
    }

    function add_review($rating, $comment, $reservation_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Review(id, rate, comment, reservation) VALUES(NULL, ?, ?, ?)');
        $stmt->execute(array($rating, $comment, $reservation_id));
    }

    function remove_like($username, $place_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('DELETE FROM Like WHERE username = ? AND place_id = ?');
        $stmt->execute(array($username, $place_id));
    }

    function add_notification($type, $username, $helper) {
        $db = Database::instance()->db();
        $date = date("Y-m-d");

        switch ($type) {
            case 'New_Reservation':
                $stmt = $db->prepare('INSERT INTO Notification (id, type, description, seen, date, username, helper) VALUES(NULL, "New Reservation", "Description", "no", ?, ?, ?)');
                $stmt->execute(array($date, $username, $helper));
                break;
            case 'New_Review':
                $stmt = $db->prepare('INSERT INTO Notification (id, type, description, seen, date, username, helper) VALUES(NULL, "New Review", "Description", "no", ?, ?, ?)');
                $stmt->execute(array($date, $username, $helper));
                break;
            case 'New_Reply':
                $stmt = $db->prepare('INSERT INTO Notification (id, type, description, seen, date, username, helper) VALUES(NULL, "New Reply", "Description", "no", ?, ?, ?)');
                $stmt->execute(array($date, $username, $helper));
                break;
            case 'New_Place_Added':
                $stmt = $db->prepare('INSERT INTO Notification (id, type, description, seen, date, username, helper) VALUES(NULL, "New Place Added", "Description", "no", ?, ?, ?)');
                $stmt->execute(array($date, $username, $helper));
                break;
            default:
                break;
        }
    }

    function get_places($user){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Place WHERE owner = ?');
        $stmt->execute(array($user));

        return $stmt->fetchAll();
    }

    function update_place_title($id, $title) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Place SET title = ? WHERE id = ?');
        $stmt->execute(array($title, $id));

        return true;
    }

    function update_place_description($id, $description) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Place SET description = ? WHERE id = ?');
        $stmt->execute(array($description, $id));

        return true;
    }

    function update_place_price($id, $price) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Place SET price_day = ? WHERE id = ?');
        $stmt->execute(array($price, $id));

        return true;
    }

    function update_place_capacity($id, $capacity) {
        
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Place SET capacity = ? WHERE id = ?');
        $stmt->execute(array($capacity, $id));

        return true;
    }

    function get_place_reviews($place) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Review, Reservation WHERE Review.reservation = Reservation.id
                                                                AND Reservation.place_id = ?');
        $stmt->execute(array($place));

        return $stmt->fetchAll();
    }

    function get_user_place_reviews($user, $place) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Review, Reservation WHERE Review.reservation = Reservation.id
                                                                AND Reservation.place_id = ? AND tourist = ?');
        $stmt->execute(array($place, $user));

        return $stmt->fetchAll();
    }

    function calculate_rating($place) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT avg(Review.rate) as place_rate FROM Review, Reservation WHERE Review.reservation = Reservation.id
                                                                               AND Reservation.place_id = ?');
        $stmt->execute(array($place));

        return round($stmt->fetch()['place_rate'], 2);
    }

    function calculate_user_rating($user) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT avg(Review.rate) as user_rate FROM Place, Review, Reservation WHERE Review.reservation = Reservation.id
                                                                               AND Reservation.place_id = Place.id 
                                                                               AND Place.owner = ?');
        $stmt->execute(array($user));

        return round($stmt->fetch()['user_rate'], 2);
    }

    function new_notification($place_id, $user){
        $place = get_place_data($place_id);
        
        $title = $place['title'];

        $type = "New Reservation!";
        $description = "$user made a Reservation for your place $title";
        $seen = "no";
        $date = date("Y-m-d");
        $owner = $place['owner'];

        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Notification(type, description, seen, date, user) VALUES(?, ?, ?, ?, ?)');
        $stmt->execute(array($type, $description, $seen, $date, $owner));

        return true;
    }

    function change_notification_status($notification){
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Notification SET seen = ? WHERE id = ?');
        $stmt->execute(array("yes", $notification));

        return true;
    }

    function get_number_photos($place_id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Photo WHERE place = ?');
        $stmt->execute(array($place_id));

        return count($stmt->fetchAll());
    }
?>
