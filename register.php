<?php
include 'inc/header.php';
include 'lib/user.php';
?>

<?php

$user = new user();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'])){

    $usrRegi = $user->userRegistration($_POST);
}
?>


<div class="container">

    <div class="container-fluid">
        <div class="main_component">

            <div class="card-header">
                <h3>User Registration <span class="float-right"><strong>Wellcome!</strong></span></h3>



            </div>

            <div class="card-body">

                <div class="register_form">

                    <?php
                    if (isset($usrRegi)){
                        echo $usrRegi;
                    }
                    ?>

                    <form action="" method="POST">


                        <div class="form-group">
                            <label for="name"> Your Name</label>
                            <input type="text" id="name" name="name" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="username"> UserName</label>
                            <input type="text" id="username" name="username" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="email"> Email Address</label>
                            <input type="text" id="email" name="email" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" id="password" name="password" class="form-control"/>
                        </div>

                        <button type="submit" name="registration" class="btn btn-success">Submit</button>
                    </form>
                </div>

            </div>

        </div>


    </div>



</div>




<?php include 'inc/footer.php'; ?>



