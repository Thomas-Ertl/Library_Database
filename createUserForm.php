<?php
    if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURLp");
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
        <title>Register</title>
    </head>
    <body>
        <div id="header">
            <h1>Library</h1>
        </div>
        <div id="navigation">
            <ul>
                <li id="home"><a href="loginForm.php">Already a user?</a></li>
            </ul>
        </div>

        <div id="wrapper">
            <dl>
                <dt>Create a new account</dt>
                <form id="form" name="createUserForm" action="createUser.php" method="POST" >

                    <input type="hidden" name="action" value="do_create">

                    <div class="stack">
                        <label for="firstName">First name:</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>

                    <div class="stack">
                        <label for="lastName">Last name:</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>

                    <div class="stack">
                        <label for="gender">Gender:</label>
                        <input type="radio" name="gender" value="male" required> Male<br>
                        <input type="radio" name="gender" value="female"> Female<br>
                    </div>

                    <div class="stack">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="stack">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>

                    <div class="stack">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" maxlength="2" required>
                    </div>

                    <div class="stack">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" maxlength="10" required>
                    </div>

                    <div class="stack">
                        <label for="username">Username:</label>
                        <input type="username" id="username" name="username" required>
                    </div>

                    <div class="stack">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="stack">
                        <label for="confirmPass">Confirm Password:</label>
                        <input type="password" id="confirmPass" name="confirmPass" required>
                    </div>





                    <div class="stack">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </dl>
        </div>

    </body>
</html>
