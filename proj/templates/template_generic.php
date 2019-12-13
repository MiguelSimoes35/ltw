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
            <a href="profile.php?user=<?=$_SESSION['username']?>"><img src=<?=$thumbnail?> alt="Profile Picture Icon" style="width:40px;height:40px;"></a>
            <a href="profile.php?user=<?=$_SESSION['username']?>"><?= $_SESSION['username']?></a>
            <form action="../actions/process_logout.php"><input type="submit" id="logout" value="Logout"></form>
        </div>
<?php
    }

    function template_add_place(){    
        ?>
            <section id="add-a-place" class="authentication">
                <header><h2>Add a Place</h2></header>
                <form action="../actions/process_add_place.php" method="post">     
                    <label for="title" id="title">Title</label>
                    <input type="text" id="title" name="title" required>
                    
                    <label for="description" id="description">Description</label>
                    <input type="textarea" rows="4" cols="50" id="description" name="description" required>
    
                    <?php
                    // gets all countries
                    $countries = getAllCountries(); 
                    ?>
    
                    <label for="country">Country</label>
                    <select name="country" id="country" value="">
                    <option value="undefined"></option>
    
                    <?php foreach ($countries as $country) {
                        ?>
                        <option value=<?=$country['country']?>><?=$country['country']?></option>
                        <?php
                    } 
                    ?>
                    </select>
                    <br>
    
                    <label for="city">City</label>
                    <select name="city" id="city" value="">
                        <option value="undefined"></option>
                    </select>
                    <br>
    
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
    
                    <label for="price_day">Price p/ Day (in €) </label>
                    <input type="number" id="price_day" name="price_day" required>
    
                    <label for="capacity">How many people can be at your Place? </label>
                    <input type="number" id="capacity" name="capacity" required>
                    
                    <div id="photo">
                        <label for="picture"> Upload a picture of your Place </label>
                        <img src="../resources/summerSeason.jpg" alt="Defualt Place image"  style="width:450px;height:250px;">
                        <input type="file" id="place-picture" name="place_pic">    
                    </div>
    
                    <input type="submit" value="Add place!">
                </form>
            </section>
        <?php    
    }
?>
