<?php
    function template_login() {
?>

<?php
    }

    function template_register() {
?>
    <form action="../actions/process_sign_up.php" method="post">
            
            <label for="username" id="user">username:</label>
            <input type="text" id="username" name="username">
        
         
        
            <label for="pass" id="password">password:</label>
            <input type="password" id="pass" name="password"
                   minlength="8" required>
        

        
            <label for="pass2" id="password2">repeat password:</label>
            <input type="password" id="pass2" name="repeat_password"
                    minlength="8" required>
        

        
            <label for="name" id="full_name">Full name:</label>
            <input type="text" id="name" name="name">
        

        
            <label for="email" id="e-mail">e-mail:</label>
            <input type="email" id="email" name="email">
        

            <div id="pic">
                <img src="../resources/pic1.png" alt="Profile Picture Icon"  style="width:250px;height:250px;">
                <label for="picture"> Upload a profile picture: </label>
                <input type="file" id="picture" name="profile_pic">
                
            </div>
            
        

        <div>
            <input type="submit" value="Sign in">
        </div>


    </form>
<?php
    }
?>