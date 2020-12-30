<?php

require_once 'loader/loader.php';

if (Input::exists()) {

    $validate = new Validate();
    $validate->check($_POST, array(
        'email' => array('required' => true),
        'password' => array('required' => true)
    ));

    if ($validate->passed()) {
        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('email'), Input::get('password'), $remember);

        if ($login) {
            header('Location: index.php');
        } else {
            echo '<p>Incorrect username or password</p>';
        }
    } else {
        foreach ($validate->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for='email'>Email</label>
        <input type="text" name="email" id="email">
    </div>

    <div class="field">
        <label for='password'>Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">Remember me
        </label>
    </div>

    <input type="submit" value="Login">
</form>