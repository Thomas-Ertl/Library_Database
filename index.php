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

$id = empty($_POST['return']) ? '' : $_POST['return'];

require_once 'db/db.conf';

// Connect to the database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check for errors
if ($mysqli->connect_error) {
    $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    require "index.php";
    exit;
}

$query = "DELETE FROM issue WHERE bookID = '$id'";



$result = $mysqli->query($query);

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
                        <dt>Search for a book</dt>
                        <dd>
                            <input type="text" id="search" placeholder="Search..." name="query">

                            <form id="checkOut" action="checkOut.php" method="POST">
                                <input type="text" id="checkOut" placeholder="Enter Book ID to Checkout" name="checkOut">
                            </form>
                        </dd>
                        <div id="display">
                            <dd>
                            </dd></div>

                        <dd class="last">Created by: <em>Thomas Ertl</em>


                        </dd>
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
                method:"get",
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


