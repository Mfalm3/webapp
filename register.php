<?php

require_once 'loader/loader.php';

if (Input::exists()) {
    $validate = new Validate();
    $validate->check($_POST, array(
        'name' => array(
            'name' => 'Name',
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        'email' => array(
            'name' => 'Username',
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'name' => 'Password',
            'required' => true,
            'min' => 6
        ),
        'password_again' => array(
            'required' => true,
            'matches' => 'password'
        ),
    ));

    if ($validate->passed()) {
        $user = new User();

        try {
            $user->create(array(
                'name' => Input::get('name'),
                'email' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'isAdmin' => 0
            ));

            header('Location: index.php');
        } catch (Exception $e) {
            echo $e->getTraceAsString(), '<br>';
        }
    } else {
        foreach ($validate->errors() as $error) {
            echo $error . "<br>";
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" required value="<?php echo escape(Input::get('name')); ?>" id="name">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" required id="email" value="<?php echo escape(Input::get('username')); ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="password_again">Password Confirmation</label>
        <input type="password" name="password_again" id="password_again" value="">
    </div>

    <input type="submit" value="Register">
</form>