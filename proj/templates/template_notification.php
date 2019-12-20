<?php 

    include_once('../database/functions.php');
    
    function template_notification($notification) {
        if ($notification['seen'] == 'yes')
            $class = "seen";
        else if ($notification['seen'] == 'no') $class = "unseen";
?>

<article id="<?=$notification['id']?>" class="notification">
    <div class="<?=$class?>">
        <h3><b><?=$notification['type']?></b></h3>
        <h4><?=$notification['date']?> - <?=$notification['description']?></h4>
        <i id="<?=$notification['id']?>" class="material-icons">close</i>
    </div>
</article>
    
<?php

change_notification_status($notification['id']);
}

?>