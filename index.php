<?php

require_once 'loader/loader.php';
include("templates/header.php");

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
    echo '<div class="container"><p class="mt-5 text-center">You need to <a href="login.php">login</a> or <a href="register.php">register.</a></p></div>';
}