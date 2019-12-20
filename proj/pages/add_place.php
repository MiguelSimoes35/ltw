<?php
    include_once('../templates/template_generic.php');
    include_once('../templates/template_warning.php');
    include_once('../templates/template_authentication.php');
    include_once('../templates/template_place.php');


    template_header();
    template_warning();
    template_add_place();
    template_footer();
?>