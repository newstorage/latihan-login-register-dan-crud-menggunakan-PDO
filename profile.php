<?php

/**
 * Tutorial: PHP Login Registration system
 *
 * Page : Profile
 */
// Start Session
session_start();

// check user login
if (empty($_SESSION['user_id'])) {
    header("Location: index");
}

// Database connection
require __DIR__ . '/database/database.php';
$database = new Database();
$db = $database->getConnection();

include_once "layout_navbar.php";
$page_title = "Profile";
include_once "layout_header.php";

// Application controller ( with UserController class )

$app = new UserController();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

?>

<div class="panel panel-primary">
    <div class="panel-heading">Profile</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <table class='table table-hover table-bordered'>

                    <tr>
                        <td>Name</td>
                        <td><?php echo $user->name ?></td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td><?php echo $user->email ?></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><?php echo $user->username ?></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><?php echo $user->password ?></td>
                    </tr>
                    <tr>

                    </tr>
                </table>

        </div>
    </div>
</div>

<?php
include_once "layout_footer.php";
