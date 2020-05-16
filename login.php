<?php
/*
 * Tutorial: PHP Login Registration system
 *
 * Page index.php
 * */
// Start Session
session_start();

// Application controller ( with UserController class )
require __DIR__ . '/controller/UserController.php';
$app = new UserController();

$login_error_message = '';
$register_error_message = '';
$page_title = "Sign In.";
include_once "layout_header.php";

// check Login request
if (!empty($_POST['btnLogin'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        if ($user_id > 0) {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: product/read_template"); // Redirect user to the product/read_template.php
        } else {
            $login_error_message = 'Invalid login details!';
        }
    }
}

?>

<div class="col-md-5">
    <div class="panel panel-primary">
        <div class="panel-heading">Please Sign In here.</div>
        <div class="panel-body">


            <?php
            if ($login_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
            ?>
            <form action="login" method="post">
                <div class="form-group">
                    <label for="">Username/Email</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Email/Username" />
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" />
                </div>
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login" />
                    <a href="register" style="float:right;" class="btn btn-success">Sign Up</a>
                    <hr />
                </div>
            </form>
        </div>
    </div>

</div>

<?php
include_once "layout_footer.php";
