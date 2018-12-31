<?php
require_once 'db/db.conf';

// Connect to the database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check for errors
if ($mysqli->connect_error) {
    $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    require "index.php";
    exit;
}
$output = '';
if(isset($_GET["query"]))
{
    $search = $mysqli->real_escape_string($_GET["query"]);
    $query = "SELECT * FROM books
            WHERE (`bookName` LIKE '%".$search."%') OR (`bookAuthor` LIKE '%".$search."%') OR (`ISBN` LIKE '%".$search."%')
	";

}
else
{
    $query = "
	SELECT * FROM books ORDER BY book_id";
}
$result = $mysqli->query($query);
if($result->num_rows > 0)
{
    $output .= '<div>
					<table>
                        <dt>Results</dt>
						<tr>
							<th>Title</th>
							<th>Author</th>
							<th>ISBN</th>
							<th>Edition</th>
                            <th>Book ID</th>
						</tr>';
    while($results=$result->fetch_array())
    {
        $output .= '
			<tr>
				<td class="book">'.$results["bookName"].'</td>
				<td>'.$results["bookAuthor"].'</td>
                <td>'.$results["ISBN"].'</td>
                <td>'.$results["bookEdition"].'</td>

                <td>'.$results["book_id"].'</td>
			</tr>
		';



    }
    echo $output;
}
else
{
    echo 'Data Not Found';
}
?>
