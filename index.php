<?php
include 'lib/user.php';
include 'inc/header.php';
session::checkSession();

?>

<?php
$loginMsg = session::get("loginMsg");
if (isset($loginMsg)){
    echo $loginMsg;
}
session::set("loginMsg",NULL);
?>

    <div class="container">

        <div class="container-fluid">
            <div class="main_component">

                <div class="card-header">
                    <h3>User List <span class="float-right"><strong>Wellcome!</strong>

                            <?php
                            $username = session::get("username");
                            if (isset($username)){
                                echo $username;
                            }
                            ?>

                        </span></h3>

                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <tr>
                            <th width="20%">Serial</th>
                            <th width="20%">Name</th>
                            <th width="20%">User Name</th>
                            <th width="20%">Email Address</th>
                            <th width="20%">Action</th>
                        </tr>

                        <?php
                        $user = new user();
                        $userData = $user->getUserData();
                        if ($userData){
                        $i = 0;
                        foreach ($userData as $sData){
                        $i++;
                        ?>

                        <tr>

                            <td><?php echo $i; ?></td>
                            <td><?php echo $sData['name'];?></td>
                            <td><?php echo $sData['username'];?></td>
                            <td><?php echo $sData['email'];?></td>
                            <td>
                                <a class="btn btn-primary" href="profile.php?id=<?php echo $sData['id']; ?>">View</a>

                            </td>
                        </tr>

                        <?php }}else{ ?>

                            <tr><td colspan="5"><h3>No User Data Found.....</h3></td></tr>
                        <?php } ?>



                    </table>

                </div>

            </div>


        </div>



    </div>




<?php include 'inc/footer.php'; ?>



