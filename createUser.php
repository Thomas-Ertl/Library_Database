<?php
    if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	}

	if(!session_start()) {
		header("Location: error.php");
		exit;
	}

	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

	if ($loggedIn) {
		header("Location: page1.php");
		exit;
	}

	$action = empty($_POST['action']) ? '' : $_POST['action'];

	if ($action == 'do_create') {
		create_user();
	} else {
		login_form();
	}

	function create_user() {
		$firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
        $lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
        $username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
        $confirmPass = empty($_POST['confirmPass']) ? '' : $_POST['confirmPass'];
        $userType = empty($_POST['userType']) ? '' : $_POST['userType'];
        $gender = empty($_POST['gender']) ? '' : $_POST['gender'];
        $address = empty($_POST['address']) ? '' : $_POST['address'];
        $city = empty($_POST['city']) ? '' : $_POST['city'];
        $state = empty($_POST['state']) ? '' : $_POST['state'];
        $phone = empty($_POST['phone']) ? '' : $_POST['phone'];
        $studentName = $firstName.' '.$lastName;


        if(strcmp($password,$confirmPass)==0){

            require_once 'db/db.conf';

            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            if ($mysqli->connect_error) {
                $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
                require "index.php";
                exit;
            }

            $username = $mysqli->real_escape_string($username);
            $password = $mysqli->real_escape_string($password);

            $studentid = rand(0,500);


             $query = "INSERT INTO student VALUES ('$studentid','$studentName','$gender','$address','$city','$state','$phone')";

            $mysqliResult = $mysqli->query($query);


            $query = "INSERT INTO users VALUES ('$username','$password','$firstName','$lastName','$studentid')";

            if ($mysqliResult = $mysqli->query($query)===TRUE) {
                $mysqli->close();

                $error="New User Created Successfully!";

                require "index.php";
                exit;
            } else {
                $error = "Insert error: ".$query."<br>".$mysqli->error;
                require "createUserForm.php";
                exit;
            }
        }
        else {
          $error = 'Error: Passwords do not match!';
          require "createUserForm.php";
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
