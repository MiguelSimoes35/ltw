<?php
    include_once('../templates/template_generic.php');

    if(!isset($_SESSION['username'])){
        die(header('Location: login.php'));
    }
    
    template_header();
    
    template_footer();

?>