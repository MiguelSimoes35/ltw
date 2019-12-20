<?php
    function template_warning() {
?>
    <div id="warning" style="background-color: red; text-align: center; transition: 1s linear">
        <p style="margin:0;">
        <?php
       if(isset($_SESSION['messages'])){
           echo $_SESSION['messages'];
        }?> 
        </p>
    </div>
<?php
        unset($_SESSION['messages']);
    }
?>