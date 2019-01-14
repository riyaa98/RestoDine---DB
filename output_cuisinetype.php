<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
	<section>
			<div class = "page-header">
				<h2>Search by Cuisine Type </h2>
			</div>
			<div class="mainwrapper">

			<?php
			// Enable error logging:
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function
			include ('./my_connect.php');
			$mysqli = get_mysqli_conn();
			?>

			<!-- specifies the next page -->
			<div class = "submitbuttons">
				<form action="cid_Restaurants_Details.php" method="get">

			<?php
			// SQL statement
			$sql = "SELECT * "
				. "FROM CUISINE_TYPE c ";

			// Prepared statement, stage 1: prepare
			$stmt = $mysqli->prepare($sql);

			// Prepared statement, stage 2: execute
			$stmt->execute();

			// Bind result variables
			$stmt->bind_result($CID, $Cuisine_name);

			/* fetch values (dropdown) */
			echo '<div class = "labeltext"';
			echo '<label for="CID">Pick Cuisine Type: </label>';
			echo '</div>';
			echo '<div class = "dropdown">';
			echo '<select name="CID">';
			echo '</div>';

			while ($stmt->fetch())
			{
			printf ('<option value="%s">%s</option>', $CID, $Cuisine_name);
			}
			echo '</select><br>';

			/* close statement and connection*/
			$stmt->close();
			$mysqli->close();
			?>
		  </div>

		  <br>
  		<!-- the submit button -->
  		<div class="submit">
  				<button style="margin:5px" type="submit" class="btn btn-primary btn-lg">Submit </button>
  				<br>
  				</form>

  		<form action="all_cuisines_rest.php" method="get">
  		<button type="submit" class="btn btn-primary btn-lg" value="Can't decide?">Can't decide? </button>
  		</br>
  		</form>
  		</div>
  		<div class="link">
				<p>
				<a href="index.php">Return to Main Page</a>
				</p>
  		</div>
		</form>
	</section>
</body>
