<?php

require_once 'loader/loader.php';
include("templates/header.php");
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


<div class="container mt-4 d-flex justify-content-center">
    <div class="col-7">
        <div class="card">

            <div class="card-header ">
                <h4 class="card-title">Login Form</h4>
            </div>

            <div class="card-body ">

                <form method="post" action="">

                    <label for="email">Email address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" required id="email" value="<?php echo escape(Input::get('email')); ?>">
                    </div>

                    <label for="password">Password</label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="form-check mt-3">
                        <label class="form-check-label" for="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <span class="form-check-sign"></span>
                            Remember me
                        </label>
                    </div>


            </div>

            <div class="card-footer ">
                <button type="submit" class="btn btn-fill btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>