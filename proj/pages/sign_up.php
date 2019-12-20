<?php 
    include_once('../templates/template_generic.php');
    include_once('../templates/template_warning.php');
    include_once('../templates/template_authentication.php');
    
    if(isset($_SESSION['username'])){
        die(header('Location: main.php'));
    }

    template_header();
    template_warning();
    template_register();
    template_footer();
?>