<?php
    include_once('../templates/template_generic.php');

    template_header();
?>
<h2>
    <p> LOGIN </p>
</h2>
<div>
    <form action="../actions/process_sign_up.php" method="post">
        <label for="username" id="user">Username</label>
        <input type="text" id="username" name="username">
        <label for="pass" id="password">Password</label>
        <input type="password" id="pass" name="password" minlength="8" required>
        <input type="submit" value="Sign in">
    </form>
</div>
<?php
    template_footer();
?>