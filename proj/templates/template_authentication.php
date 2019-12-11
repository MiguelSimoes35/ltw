<?php
    include_once('../database/access_database.php');

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

        <footer><a href="../pages/sign_up.php">Not registered yet? Sign Up!</a></footer>
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

        <footer><a href="../pages/login.php">Have an account already?</a></footer>
    </section>
<?php
    }

    function template_edit_profile() {
        $userdata = getUserData($_SESSION['username']);
?>
        <section id="edit_profile" class="authentication">
            <header><h2>Edit Profile</h2></header>
            <form action="../actions/process_edit_profile.php" method="post">

                <label for="username" id="edit_username"> Username: <?php echo $_SESSION['username'] ?> </label>
                <br/>
                <label for="name" id="full_name">Full name</label>
                <input type="text" id="name" name="name" value="<?php echo $userdata['name'] ?>" required>
                
                <label for="email" id="e-mail">E-mail</label>
                <input type="email" id="email" name="email" value="<?php echo $userdata['email'] ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" minlength="8" required>
                
                <div id="photo">
                    <label for="picture"> Update your profile picture </label>
                    <img src="<?= get_user_photo($_SESSION['username']) ?>" alt="Profile Picture Icon"  style="width:250px;height:250px;">
                    <input type="file" id="picture" name="profile_pic">    
                </div>

                <input type="submit" value="Update">
            </form>
        </section>
        <section id="change_password" class="authentication">
        <header><h2>Change Password</h2></header>
            <form action="../actions/process_edit_profile.php" method="post">

                <label for="old_password">Old Password</label>
                <input type="password" id="old_password" name="old_password" minlength="8" required>
                
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" minlength="8" required>

                <label for="conf_new_password">Confirm Password</label>
                <input type="password" id="conf_new_password" name="conf_new_password" minlength="8" required>

                <input type="submit" value="Change Password">
            </form>
        </section>
<?php
    }
?>