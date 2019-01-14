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
		<h1>Partner Restaurant Ratings </h1>
	</div>
		  <div class="mainwrapper">

			<?php
			// Enable error logging:
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function
			include ('./my_connect.php');
			$mysqli = get_mysqli_conn();
			?>

			<?php
      // SQL statement
			$sql = "SELECT c.RID, d.Name, AVG(r.rating) as Average_Rating FROM CONTAINS c NATURAL JOIN REVIEWS_AND_SUGGESTIONS r NATURAL JOIN RESTAURANTS_DETAILS d GROUP BY c.RID HAVING COUNT(*)>=1 ORDER BY c.RID ASC ";

			$result  = mysqli_query($mysqli, $sql);

			// Prepared statement, stage 1: prepare
			$stmt = $mysqli->prepare($sql);

			// Prepared statement, stage 2: execute
			$stmt->execute();

			//Bind result variables
			$stmt->bind_result($RID, $Name, $Average_Rating);

			/* fetch values (table) */
    			echo '<div class = "tables">';
    			echo "<table border ='1'><tr><th>Name</th><th>Average Rating</th></tr>";
			while ($stmt->fetch()){
  				echo "<tr> <td align = 'center'>" . $Name . "</td> <td align = 'center'>" . $Average_Rating . "</td> </tr>";
  			}
  				echo "</table>";
  				echo '</div>';

			/* close statement and connection*/
			$stmt->close();
			$mysqli->close();

			?>
			 <!--Link that takes you to different page -->
			<div class="link">
					<p>
						<a href="index.php">Return to Main Page</a>
					</p>
		</div>
	</div>
</body>
