<?php
include 'inc/header.php';
include 'lib/user.php';
session::checkLogin();
?>
<?php

$user = new user();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

    $usrLogin = $user->userLogin($_POST);
}
?>

<div class="container">

    <div class="container-fluid">
        <div class="main_component">

            <div class="card-header">
                <h3>User Login <span class="float-right"><strong>Wellcome!</strong></span></h3>



            </div>

            <div class="card-body">

                <div class="register_form">
                    <?php
                    if (isset($usrLogin)){
                        echo $usrLogin;
                    }
                    ?>

                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="email"> Email Address</label>
                            <input type="text" id="email" name="email" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" id="password" name="password" class="form-control"/>
                        </div>

                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </form>
                </div>

            </div>

        </div>


    </div>



</div>




<?php include 'inc/footer.php'; ?>



