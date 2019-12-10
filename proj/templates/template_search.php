<?php 
    function template_search() {

        $countries = getAllCountries();
?>
    <section id = "search">
        
        <form action="../html/search.php" method="get">
            <!--<input type="text" id="where" name="where" placeholder="Where?" required>-->
            <select name="where_country" id="country" value="">
                <option value="undefined"></option>

                <?php foreach ($countries as $country) {
                    ?>
                    <option value=<?=$country['country']?>><?=$country['country']?></option>
                    <?php
                } 
                ?>
            </select>
            <select name="city" id="city" value="">
                <option value="undefined"></option>
            </select>
            <div id="date">
                <label for="checkin">Check-In</label>
                <input type="date" name="checkin" id="checkin" required>
                <label for="checkout">Check-Out</label>
                <input type="date" name="checkout" id="checkout" required> 
            </div>
        
            <div id="capacity">
                <label for="capacity">Capacity</label>
                <select name="capacity" id="capacity" placeholder="Capacity">
                    <option value="undefined"></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10+</option>
                </select>           
            </div>
            
            <div id="price_range">
                <label for="min">Min</label>
                <input type="number" id="min" name="minimum_price" placeholder="Minimum price" step="1"> <!-- Only max maybe -->
                <label for="max">Max</label>
                <input type="number" id="max" name="maximum_price" placeholder="Maximum price" step="1">
            </div>

            <input type="submit" id="submit_search" value="Search Place">
        </form>
    </section>
<?php        
    }
?>