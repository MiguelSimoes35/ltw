<?php 
    include_once('../includes/session.php');
    include_once('../database/access_database.php');
    include_once('../templates/template_notification.php');

    // username
    $user = $_SESSION['username'];

    // gets array of reservations
    $notifications = getNotifications($user);
?>
<div id="notifications">
    <?php 
        foreach ($notifications as  $notification) {
            template_notification($notification);
        }

        if (count($notifications) == 0) {
?>
    <!-- NO NOTIFICATIONS-->
    <p class="info_message">You have no notifications</p>
<?php
        }
?>

</div>
