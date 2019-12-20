<?php
    include_once('../includes/session.php');
    include_once('../database/access_database.php');

    function template_header() {
?>

<!DOCTYPE html>
<html lang = "pt-PT">
    <head>
        <title>EasyRent FrontPage</title>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="../javascript/search.js" defer></script>
    </head>
    <body>
        <header>
            <h1><a href="../pages/main.php">EasyRent</a></h1>
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
        $thumbnail = get_user_thumbnail($_SESSION['username']);
?>
        <div id = "header_user_section">
            <a href="profile.php?user=<?=$_SESSION['username']?>">    
                <div style="display: block;">
                    <img src=<?=$thumbnail?> alt="Profile Picture Icon" style="width:40px;height:40px;">
                    <h5 style="margin: 0; padding: 0;"><?= $_SESSION['username']?></h5>
                </div>
            </a>
            <a href="profile.php?user=<?=$_SESSION['username']?>#Notifications">
                <i class="material-icons">notifications</i>
            </a>
            <form action="../actions/process_logout.php"><input type="submit" id="logout" value="Logout"></form>
        </div>
<?php
    }
?>
