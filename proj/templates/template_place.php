<?php
    include_once('../templates/template_favorite.php');
    include_once('../database/functions.php');
    include_once('../database/access_database.php');

    function template_place($place_id){
        $place = getPlaceData($place_id);
        $location = getLocation($place['location_id']);
?>  
        <article class="place">
        <?php template_favorite($place['id']);?>
            <a href="../pages/place.php?id=<?=$place['id']?>">
                <div class="place">
                    <div class="place_photo">
                        <img src="../resources/places/<?=$place['id'] ?>/0.jpg" alt="Beach" style="max-width:600px;">
                    </div>
                    <div class="place_info">
                        <h2 class="title"><?=$place['title']?></h3>
                        <h3 class="location"><?=$location['city']?>, <?=$location['country']?></h3>
                        <h3 class="capacity"><?=$place['capacity']?> <i class="material-icons">person</i> </h3>
                        <h2 class="price"><?=$place['price_day']?> € / day</h3>
                        <h4 class="owner">Posted by <?=$place['owner']?></h4>
                    </div>
                </div>
            </a>
        </article>
<?php
    }

    function template_place_small($place_id) {
        $place = getPlaceData($place_id);
        $location = getLocation($place['location_id']);
?>
    <article class="place_small">
    <a href="../pages/place.php?id=<?=$place['id']?>"><div>
        <img src="../resources/places/<?=$place['id']?>/0.jpg" alt="">
        <div style="background-color: white; width: 350px; height: 80px; opacity: 0.75; position: absolute; bottom: 5px; color: white"><h5>.</h5></div>
        <div style="width: 350px; height: 80px; position: absolute; bottom: 0px; display: grid; grid-template-columns: auto auto auto; grid-template-rows: auto auto; justify-items: center">
            <h2 style="grid-column: 1/4; grid-row: 1/2; margin: 0; padding: 0.2em; justify-self: start;"><?=$place['title']?></h2>
            <h3 style="grid-column: 3/4; grid-row: 2/3; margin: 0; padding: 0.2em; "><?=$place['price_day']?> € / day</h3>
            <h3 style="grid-column: 1/2; grid-row: 2/3; margin: 0; padding: 0.2em;"><?=$location['city']?>, <?=$location['country']?></h3>
            <h3 style="grid-column: 2/3; grid-row: 2/3; margin: 0; padding: 0.2em;"><?=$place['capacity']?> <i class="material-icons">person</i> </h3>
        </div>
        </div>
    </a>
<?php template_favorite($place['id']);?>
   </article>
<?php
    }

    function template_add_place(){    
        ?>
            <script>document.title = "Add Place | EasyRent"</script>
            <section id="add-a-place" class="authentication">
                <header><h2>Add a Place</h2></header>
                <form action="../actions/process_add_place.php" method="post" enctype="multipart/form-data">     
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
                        <!--<img src="../resources/summerSeason.jpg" alt="Defualt Place image"  style="width:450px;height:250px;">-->
                        <input type="file" name="place_pic[]" multiple="">    
                    </div>
    
                    <input type="submit" value="Add place!">
                </form>
            </section>
        <?php    
    }

    function template_edit_place() {
        $ind = $_GET['code'];
        $place = get_places($_SESSION['username'])[$ind];
?>
        <script>document.title = "Edit Place | EasyRent"</script>
        <section id="edit_place" class="authentication">
            <header><h2>Edit Place</h2></header>
            <form action="../actions/process_edit_place.php?code=<?=$ind?>" method="post" enctype="multipart/form-data">
                <label for="title" id="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $place['title'] ?>" required>

                <label for="description" id="description">Description</label>
                <input type="textarea" rows="4" cols="50" id="description" name="description" value="<?php echo $place['description'] ?>" required>
                    
                <label for="price_day" id="price_day">Price p/ Day (in €)</label>
                <input type="number" id="price_day" name="price_day" value="<?php echo $place['price_day'] ?>" required>
    
                <label for="capacity">Capacity</label>
                <input type="number" id="capacity" name="capacity" value="<?php echo $place['capacity'] ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" minlength="8" required>
                    
                <div id="photo">
                    <label for="picture"> Change the picture of your Place </label>
                    <input type="file" name="place_pic[]" multiple="">    
                </div>

                <input type="submit" value="Update Profile">
            </form>
        </section>
<?php
    }
?>