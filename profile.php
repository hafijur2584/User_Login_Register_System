<?php
include 'lib/user.php';
include 'inc/header.php';
session::checkSession();
?>

<?php
if (isset($_GET['id'])){
    $userId = (int)$_GET['id'];
}
$user = new user();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){

    $usrUpdate= $user->userUpdate($userId,$_POST);
}

?>


<div class="container">

    <div class="container-fluid">
        <div class="main_component">

            <div class="card-header">
                <h3>User Profile <span class="float-right"><a class="btn btn-primary" href="index.php">Back</a></span></h3>



            </div>

            <div class="card-body">

                <div class="register_form">

                    <?php
                    if (isset($usrUpdate)){
                        echo $usrUpdate;
                    }
                    ?>

                    <?php

                    $userData = $user->getUserById($userId);

                    if ($userData){

                 ?>
                    <form action="" method="POST">


                        <div class="form-group">
                            <label for="name"> Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $userData->name;?>"/>
                        </div>

                        <div class="form-group">
                            <label for="username"> User Name</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo $userData->username;?>"/>
                        </div>

                        <div class="form-group">
                            <label for="email"> User Email</label>
                            <input type="text" id="email" name="email" class="form-control" value="<?php echo $userData->email;?>"/>
                        </div>

                        <?php
                        $sessId = session::get('id');

                        if ($userId == $sessId){



                       ?>

                        <button type="submit" name="update" class="btn btn-success">Update</button>
                            <a class="btn btn-primary" href="changePass.php?id= <?php echo $userId; ?>">Change Password</a>

                        <?php } ?>
                    </form>

                    <?php } ?>
                </div>

            </div>

        </div>


    </div>



</div>




<?php include 'inc/footer.php'; ?>



