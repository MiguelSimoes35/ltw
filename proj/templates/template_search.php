<?php 
    function template_search() {
?>
    <section id = "search">
        
        <form action="../" method="post">
            <input type="text" id="where" value="Where?">
            <div id="date">
                <label for="checkin">Check-In</label>
                <input type="date" id="checkin">
                <label for="checkout">Check-Out</label>
                <input type="date" id="checkout"> 
            </div>
        
            <div id="capacity">
                <label for="min_capacity">Capacity</label>
                <select name="min_capacity" id="min_capatity">
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
                <input type="number" id="min" name="min" value="50" step="1">
                <label for="max">Max</label>
                <input type="number" id="max" name="max" value="100" step="1">
            </div>

            <input type="submit" id="submit_search" value="Search Place">
        </form>
    </section>
<?php        
    }
?>