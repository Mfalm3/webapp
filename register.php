<?php

require_once 'loader/loader.php';
include("templates/header.php");

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
            'name' => 'email',
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
                'email' => Input::get('email'),
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

<div class="container mt-4 d-flex justify-content-center">
    <div class="col-7">
        <div class="card">

            <div class="card-header ">
                <h4 class="card-title">Registration Form</h4>
            </div>

            <div class="card-body ">

                <form method="post" action="">
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" required value="<?php echo escape(Input::get('name')); ?>" id="name">
                    </div>

                    <label for="email">Email address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" required id="email" value="<?php echo escape(Input::get('email')); ?>">
                    </div>

                    <label for="password">Password</label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <label for="password_again">Password Confirmation</label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_again" id="password_again">
                    </div>

            </div>

            <div class="card-footer ">
                <button type="submit" class="btn btn-fill btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>