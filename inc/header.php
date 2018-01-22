<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/session.php';
session::init();

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Hello, world!</title>
</head>


<?php

if (isset($_GET['action']) && $_GET['action']=="logout"){
    session::destroy();
}

?>
<body>

<div class="header_div">

    <div class="container">
        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <?php
                        $id = session::get("id");
                        $userLogin = session::get("login");
                        if ($userLogin == true) {

                        ?>

                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?action=logout">Logout</a>
                        </li>

                            <?php
                        }else{


                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>

                            <?php
                        }

                        ?>

                    </ul>

                </div>
            </nav>

        </div>

    </div>

</div>