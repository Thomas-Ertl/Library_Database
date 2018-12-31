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
if (!$loggedIn) {
    header("Location: loginForm.php");
    exit;
}
?>

<!DOCTYPE html>
<!--
CS2830 Final Project
-->
<link rel="stylesheet" type="text/css" media="screen" href="layout.css" />
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <title>Library</title>
    </head>
    <body id="about">
        <div id="header">
            <h1>Library</h1>
        </div>
        <div id="navigation">
            <ul>
                <li id="home"><a href="index.php">Search</a></li>
                <li id="login"><a href="myAccount.php">My Account</a></li>
                <li id="logout"><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <dl>
                        <dd>

                            <?php

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

                            $username = $_SESSION['loggedin'];
                            $query = "SELECT password FROM users
                    WHERE (username='$username');
	               ";

                            $result = $mysqli->query($query);

                            $results=$result->fetch_array();

                            $password =  $results['password'];

                            $username = $mysqli->real_escape_string($username);
                            $password = $mysqli->real_escape_string($password);

                            $studentID = "SELECT studentID FROM users
                                WHERE (username='$username' AND password ='$password')
	                       ";



                            $result = $mysqli->query($studentID);

                            $results=$result->fetch_object();

                            $id = $results->studentID;

                            $query = "SELECT * FROM student
                                WHERE (studentID='$id')
	                       ";


                            $result = $mysqli->query($query);

                            echo '<div>
					<table>
                        <dt>Account Info</dt>
						<tr>
							<th>Name</th>
							<th>Student ID</th>
							<th>Gender</th>
							<th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Phone</th>
						</tr>';
                            $results=$result->fetch_array();
                            echo '
			<tr>
				<td>'.$results["studentName"].'</td>
				<td>'.$results["studentID"].'</td>
                <td>'.$results["gender"].'</td>
                <td>'.$results["address"].'</td>

                <td>'.$results["city"].'</td>
                <td>'.$results["state"].'</td>
                <td>'.$results["phone"].'</td>
			</tr></table></div>
		';

                            $query = "SELECT * FROM issue
                                WHERE (student_id='$id')
	                       ";


                            $result = $mysqli->query($query);

                            echo '<div>
					<table>
                        <dt>Books in Possession</dt>
						<tr>
							<th>Book ID</th>
							<th>Date Issued</th>
							<th>Date Due</th>
						</tr>';
                            $results=$result->fetch_array();

                            echo '
			<tr>
				<td>'.$results["bookID"].'</td>
				<td>'.$results["issueDate"].'</td>
                <td>'.$results["lateDate"].'</td>

			</tr></table></div>
		';

                            ?>



                            <div>Return a book:
                                <form id="return" action="index.php" method="POST">
                                    <input type="text" id="return" placeholder="Enter Book ID to Return" name="return">
                                </form>
                            </div>
                        </dd>
                        <div id="display">
                            <dd>
                            </dd></div>

                        <dd class="last">Created by: <em>Thomas Ertl</em></dd>
                    </dl>
                </div>
            </div>

        </div>
    </body>
</html>



<script>
    $(document).ready(function(){

        function load_data(query)
        {
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#display').html(data);
                }
            });
        }

        $('#search').keyup(function(){
            var search = $(this).val();
            if(search == '')
            {
                $("#display").html("");
            }
            else
            {
                load_data(search);
            }
        });

    });

</script>


