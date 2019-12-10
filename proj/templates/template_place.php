<?php
    function template_place($place){
        $location = getLocation($place['location_id']);
?>  
    <a href="../html/place.php?id=<?=$place['id']?>">
        <article class="place">
            <div class="place_photo">
                <img src="../resources/beachOpener.jpg" alt="Beach" style="max-width:100%;">
            </div>
            <div class="place_info">
                <h2 class="title"><?=$place['title']?></h3>
                <h3 class="location"><?=$location['city']?>, <?=$location['country']?></h3>
                <h3 class="capacity"><?=$place['capacity']?> <i class="material-icons">person</i> </h3>
                <h2 class="price"><?=$place['price_day']?> € / day</h3>
                <h4 class="owner">Posted by <?=$place['owner']?></h4>
            </div>
        </article>
    </a>
<?php
    }
?>