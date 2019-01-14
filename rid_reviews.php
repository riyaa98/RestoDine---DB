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
		<h1>Reviews and Suggestions</h1>
	</div>


	<?php
		// Enable error logging:
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function
		include ('./my_connect.php');
		$mysqli = get_mysqli_conn();

//Store RID
$rid = $_GET['RID'];


		// SQL statement
		$sql = "SELECT r.user_name, r.rating, r.comments "
				. "FROM ((CONTAINS c NATURAL JOIN RESTAURANTS_DETAILS d) NATURAL JOIN REVIEWS_AND_SUGGESTIONS r)"
				. "WHERE d.RID = $rid AND c.RID = d.RID ";


				// Prepared statement, stage 1: prepare
		$stmt = $mysqli->prepare($sql);

		// Prepared statement, stage 2: execute
		$stmt->execute();

		// Bind result variables
		$stmt->bind_result($user_name, $rating, $comments);

		/* fetch values (table) */
    		echo '<div class = "tables">';
    		echo "<table border ='1'><tr><th>Username</th><th>Ratings</th><th>Comments</th></tr>";

				while ($stmt->fetch()){
					echo "<tr> <td align = 'center'>" . $user_name . "</td> <td align = 'center'>" . $rating . "</td> <td> $comments </td> </tr>";
				}

  			 echo "</table>";
  			 echo '</div>';

		/* close statement and connection*/
		$stmt->close();
		$mysqli->close();
	?>

	<br>
	<div class = "mainwrapper">

 <!--Buttons that takes you to different pages -->
	<form action="rid_addReview.php" method="get">
  	<input type="hidden" name="RID" value="<?php echo $rid;?>">
  	<button type="submit" class="btn btn-primary btn-lg" value="Would you like to leave us a review?">Would you like to leave us a review?</button>
  		</br>
  		</form>

		<button type="submit" class="btn btn-primary btn-lg" value="Go Back" onclick="history.back()">Go back</button>
  </div>
</body>
