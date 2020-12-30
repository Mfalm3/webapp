<?php

require_once 'loader/loader.php';

if(Session::exists('home')) {
    echo '<p>' . Session::get('home'). '</p>';
}

$user = new User(); //Current

if($user->isLoggedIn()) {

    if($user->hasPermission('admin')) {
        header('Location: dashboards/admin/dashboard.php');
    }else{
        header('Location: dashboards/client/dashboard.php');
    }

} else {
    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register.</a></p>';
}