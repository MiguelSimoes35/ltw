<?php
    function template_header() {
?>

<!DOCTYPE html>
<html lang = "pt-PT">
    <head>
        <title>EasyRent FrontPage</title>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet">
        <!--<link href="../css/loginStyle.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">-->
    </head>
    <body>
        <header>
            <h1>
                <a href="main.php">EasyRent</a>
            </h1>
            <div id = "search">
                <input type="submit" value="Search Place">
            </div>
            <div id = "profile">
                <a href="profile.php">
                    <p>Username</p>
                    <img src="../resources/pic1.png" alt="Profile Picture Icon" style="width:50px;height:50px;">
                </a>
            </div>
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
?>