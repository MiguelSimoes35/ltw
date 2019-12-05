<?php
    function template_login() {
?>
    <section id="login" class="authentication">
        <header><h2>Login</h2></header>
        <form action="../actions/process_login.php" method="post">
            <label for="username" id="user">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="pass" id="password">Password</label>
            <input type="password" id="pass" name="password" minlength="8" required>
            <input type="submit" value="Login">
        </form>

        <footer><a href="../html/sign_up.php">Not registered yet? Sign Up!</a></footer>
    </section>

<?php
    }

    function template_register() {
?>
    <section id="sign_up" class="authentication">
        <header><h2>Sign up</h2></header>
        <form action="../actions/process_sign_up.php" method="post">
                
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" minlength="8" required>
            
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
            
            <label for="name" id="full_name">Full name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email" id="e-mail">E-mail</label>
            <input type="email" id="email" name="email" required>
            
            <div id="photo">
                <label for="picture"> Upload a profile picture: </label>
                <img src="../resources/pic1.png" alt="Profile Picture Icon"  style="width:250px;height:250px;">
                <input type="file" id="picture" name="profile_pic">    
            </div>

            <input type="submit" value="Sign up">
        </form>

        <footer><a href="../html/login.php">Have an account already?</a></footer>
    </section>
<?php
    }
?>