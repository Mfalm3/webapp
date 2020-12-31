<?php

require_once 'loader/loader.php';

$user = new User();
$user->logout();

header('Location: index.php');
