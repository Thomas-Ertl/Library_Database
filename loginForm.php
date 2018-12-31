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
		header("Location: index.php");
		exit;
	}
?>
<!DOCTYPE html>
<link href="layout.css" rel="stylesheet" type="text/css">
<html>
    <head>
        <title>New User</title>
    </head>
    <body>
        <div id="header">
            <h1>Library</h1>
        </div>
        <div id="navigation">
            <ul>
                <li id="home"><a href="index.php">Log in to continue</a></li>
            </ul>
        </div>

        <div id="wrapper">
            <dl>
                <dt>Sign in</dt>
                <form id="form" action="login.php" method="POST">
                    <p></p>
                    <input type="hidden" name="action" value="do_login">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <div>
                        <input id="submitButton" type="submit" value="Submit">
                        <a href="createUserForm.php">Not a user?</a>
                    </div>
                </form>
            </dl>
        </div>


    </body>
</html>
