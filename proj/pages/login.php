<?php
    include_once('../templates/template_generic.php');
    include_once('../templates/template_authentication.php');
    
    if(isset($_SESSION['username'])){
        die(header('Location: main.php'));
    }
    
    template_header();
    template_login();
    template_footer();
?>