<?php
include 'lib/user.php';
include 'inc/header.php';
session::checkSession();
?>

<?php
if (isset($_GET['id'])){
    $userId = (int)$_GET['id'];
    $sessId = session::get('id');

    if ($userId != $sessId){
        header("Location: index.php");
    }
}
$user = new user();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatePass'])){

    $updatePass= $user->passUpdate($userId,$_POST);
}

?>


<div class="container">

    <div class="container-fluid">
        <div class="main_component">

            <div class="card-header">
                <h3>Change Password <span class="float-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userId; ?>">Back</a></span></h3>



            </div>

            <div class="card-body">

                <div class="register_form">
                    <?php
                    if (isset($updatePass)){
                        echo $updatePass;
                    }
                    ?>

                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="old_pass"> Old Password</label>
                            <input type="password" id="old_pass" name="old_pass" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="new_pass"> New Password</label>
                            <input type="password" id="new_pass" name="new_pass" class="form-control"/>
                        </div>

                        <button type="submit" name="updatePass" class="btn btn-success">Update</button>
                    </form>
                </div>

            </div>

        </div>


    </div>



</div>




<?php include 'inc/footer.php'; ?>



