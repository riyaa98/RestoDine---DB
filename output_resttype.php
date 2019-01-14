<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
<section>
<!-- Title -->
		<div class = "page-header">
			<h2>Search by Restaurant </h2>
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
											<form action="rid_Restaurants_Details.php" method="get">
										<?php
										// SQL statement
										$sql = "SELECT * "
											. "FROM RESTAURANTS_DETAILS r ";

										// Prepared statement, stage 1: prepare
										$stmt = $mysqli->prepare($sql);

										// Prepared statement, stage 2: execute
										$stmt->execute();

										// Bind result variables
										$stmt->bind_result($RID, $Hours_of_Ops, $Name, $Pricing, $Website, $Contact_num, $Contact_email, $Menu, $Accessibility, $Parking_space, $Home_delivery_takeout, $Patio_seating);

										/*fetch values (dropdown)*/
										echo '<div class = "labeltext"';
										echo '<label for="RID">Pick Restaurant Type: </label>';
										echo '</div>';
										echo '<div class = "dropdown">';
										echo '<select name="RID">';
										echo '</div>';

										while ($stmt->fetch())

										{
										printf ('<option value="%s">%s</option>', $RID, $Name);
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
								<button type="submit" class="btn btn-primary btn-lg" value="Submit">Search</button>
								<br>
								<br>
						</div>
						<div class="link">
								<p>
									<a href="index.php">Return to Main Page</a>
								</p>
		</div>
	</div>
	</form>
</section>
</body>
