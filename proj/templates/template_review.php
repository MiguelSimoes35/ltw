<?php

    function template_review($review) { 
    ?>
    <h3 id=user><?=$review['tourist']?> rated with <?=$review['rate']?><i class="material-icons" style="color: orange;">star</i></h3>
    <?php
        if ($review['comment'] != "" && $review['comment'] != null) {?>
            <div id="comment"><p><?=$review['comment']?></p></div>
    <?php }
    }
?>