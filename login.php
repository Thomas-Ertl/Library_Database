
<?php

// HTTPS redirect
if ($_SERVER['HTTPS'] !== 'on') {
    $redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirectURL");
    exit;
}

if(!session_start()) {
    header("Location: error.php");
    exit;
}

// Check to see if the user has already logged in
$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

// Protected contents if they are already logged in
if ($loggedIn) {
    header("Location: page1.php");
    exit;
}

$action = empty($_POST['action']) ? '' : $_POST['action'];

if ($action == 'do_login') {
    handle_login();
} else {
    login_form();
}

function handle_login() {
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];

    require_once 'db/db.conf';

    // Connect to the database
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check for errors
    if ($mysqli->connect_error) {
        $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
        require "index.php";
        exit;
    }

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);

    $query = "SELECT username FROM users WHERE username = '$username' AND password = '$password'";

    $result = $mysqli->query($query);


    if($result){
        $match = $result->num_rows;

        $result ->close();
        $mysqli->close();

        if($match==1){
            $_SESSION['loggedin'] = $username;

            header("Location: index.php");
            exit;
        } else {
            $error = "Incorrect username or password";
            require "index.php";
            exit;
        }
    } else {
        $error = 'Something went wrong! Jon should really study this more';
        require "index.php";
        exit;
    }
}

function login_form() {
    $username = "";
    $error = "";
    require "index.php";
    exit;
}

?>
