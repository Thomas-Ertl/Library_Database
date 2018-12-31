

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
}
?>
<!DOCTYPE html>
<link href="layout.css" rel="stylesheet" type="text/css">
<html>
    <head>
        <title>Check Out</title>
    </head>
    <body>
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
            <dl>
                <dt>Check Out</dt>
                <?php

                $id = empty($_POST['checkOut']) ? '' : $_POST['checkOut'];

                //echo $id;

                require_once 'db/db.conf';

                // Connect to the database
                $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);



                // Check for errors
                if ($mysqli->connect_error) {
                    $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
                    require "index.php";
                    exit;
                }
                // $output = '';
                $username = $_SESSION['loggedin'];
                $query = "SELECT studentID FROM users
                    WHERE (username='$username');
	               ";

                $result = $mysqli->query($query);

                $results=$result->fetch_array();

                $studentid =  $results['studentID'];

                $query = "SELECT bookID FROM issue
                    WHERE (bookID='$id')
	               ";


                $result = $mysqli->query($query);
                $data=$result->fetch_array();
                if($data){
                    echo 'This book is already checked out';
                } else {
                    $issueID = rand(0,500);
                    $issuedate = date('Y-m-d');
                    $latedate = $issuedate;
                    $latedate = date('Y-m-d', strtotime('+1 months'));
                        $sql = "INSERT INTO issue (issueID, issueDate, lateDate, bookID, student_id)
                        VALUES ('$issueID', '$issuedate', '$latedate',$id,'$studentid')";
                    $mysqli->query($sql);
                    echo 'You have successfully checked out book '.$id.'';
                }
                ?>
            </dl>
        </div>


    </body>
</html>
