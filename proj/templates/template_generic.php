<?php

    include_once('../includes/session.php');

    function template_header() {
?>

<!DOCTYPE html>
<html lang = "pt-PT">
    <head>
        <title>EasyRent FrontPage</title>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1><a href="../html/main.php">EasyRent</a></h1>
            <?php
            if (isset($_SESSION['username']))        
                template_user_section(); 
            ?>

        </header>

<?php } 

    function template_footer() {
?>
        <footer>
            <p>&copy; EasyRent, 2019</p>
            <p>Contact us</p>
        </footer>
    </body>
</html>

<?php
    }

    function template_user_section() {
?>
<div id = "header_user_section">
    <a href="profile.php"><img src="../resources/pic1.png" alt="Profile Picture Icon" style="width:40px;height:40px;"></a>
    <a href="profile.php"><?= $_SESSION['username']  ?></a>
    <form action="../actions/process_logout.php"><input type="submit" id="logout" value="Logout"></form>
</div>
<?php
    }
?>