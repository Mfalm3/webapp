<?php

require_once('../../loader/loader.php');

include("../../templates/header.php");
include("../../templates/navbar.php");
include("../../templates/sidebar.php");

$user =  new User();

if ($user->isLoggedIn()) {

    $path = APP_PATH;
    if (!$user->hasPermission('admin')) {
        die("You are not an administrator and are not allowed to view this page!");
    }
} else {
    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register.</a></p>';
}

?>


<?php
include("../../templates/footer.php");
?>