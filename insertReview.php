<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
<!-- Title -->
  <div class = "page-header">
    <h1>Adding a Review...</h1>
  </div>

    <div class = "mainwrapper";
	<?php
	// Enable error logging:
	error_reporting(E_ALL ^ E_NOTICE);
	// mysqli connection via user-defined function
	include ('./my_connect.php');

	//Store RID
	$rid = $_GET['RID'];

	$mysqli_1 = get_mysqli_conn();
	$mysqli_2 = get_mysqli_conn();
	$mysqli_3 = get_mysqli_conn();
	$mysqli_4 = get_mysqli_conn();

?>

<?php
	// SQL statement
	$sql = "SELECT MAX(R.User_id) FROM REVIEWS_AND_SUGGESTIONS R";
	
	// Prepared statement, stage 1: prepare
	$stmt = $mysqli_1->prepare($sql);

	// Prepared statement, stage 2: execute
	$stmt->execute();

	// Bind result variables
	$stmt->bind_result($maxRow);

	while($stmt->fetch()){

// SQL statement
		$sql2 = "INSERT INTO REVIEWS_AND_SUGGESTIONS (User_id, user_name, rating, comments) "
					.	"VALUES (?, ?, ?,?)";

		// Prepared statement, stage 1: prepare
		$stmt2 = $mysqli_2->prepare($sql2);


		// (2) Handle GET parameters; username is the name of the textbox

		$user_name = $_GET['user_name'];
		$rating = $_GET['rating'];
		$comments = $_GET['comments'];
		$maxRow = $maxRow+1;

		// (3) "i" for integer, "d" for double, "s" for string, "b" for blob
		$stmt2->bind_param("isis", $maxRow, $user_name, $rating, $comments);

		// SQL statement to add into another table
		$sql4 = "INSERT INTO CONTAINS (User_id, RID) VALUES (?,?)";

		// Prepared statement, stage 1: prepare
		$stmt4 = $mysqli_4->prepare($sql4);

		// (3) "i" for integer, "d" for double, "s" for string, "b" for blob
		$stmt4->bind_param("ii", $maxRow, $rid);

	}
	//If successful in adding a review
	if ($stmt2->execute())
	{
	echo '<h1>Success!</h1>';
	echo '<p>Thanks ' . $user_name . '! We added your Review to the Reviews page ' . '.</p>';
	}
	else
	{
	echo '<h1>Error in inserting</h1>';
	echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}
	$stmt4->execute();

/* close statement and connection*/
	$stmt2->close();
	$mysqli_2->close();
	$stmt4->close();
	$mysqli_4->close();
	$stmt->close();
	$mysqli->close();

?>

<!--Buttons that takes you to different pages -->	
	<form>action="index.php" method="get">
	<button type="submit" class="btn btn-primary btn-lg" value="Main Page">Main Page</button>
</form>

</div>
</body>
