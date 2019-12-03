<?php 
    function template_search() {
?>
    <section id = "search">
        <input type="text" value="Where?">
        <label> From: <input type="date"> </label>
        <label> To: <input type="date"> </label>
        <label>Capacity
            <div id="capacity">
                <label for="min_capacity">Min</label>
                <select name="min_capacity" id="min_capatity">
                    <option value="">Min</option>
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
                <label for="max_capacity">Max</label>
                <select name="max_capacity" id="max_capatity">
                    <option value="">Max</option>
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
        </label>
        <label>Price range
            <div id="price_range">
                <label for="min">Min</label>
                <input type="number" id="min" name="min" value="50" step="1">
                <label for="max">Max</label>
                <input type="number" id="max" name="max" value="100" step="1">
            </div>
        </label>
        <input type="submit" id="submit_search" value="Search Place">
    </section>
<?php        
    }
?>