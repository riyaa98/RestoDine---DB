<head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
		<!-- Title -->
		<section>
				<div class = "page-header">
					<h1>Search by Cities </h1>
				</div>
				      <div class = "mainwrapper">

				            <div class = "submitbuttons">


				<?php
					// Enable error logging:
					error_reporting(E_ALL ^ E_NOTICE);
					// mysqli connection via user-defined function
					include ('./my_connect.php');
					$mysqli = get_mysqli_conn();
				?>

				<!-- INSERT form if needed -->
				<div class = "submitbuttons">
				<form action="lid_Restaurants_Details.php" method="get">

					<?php
						// SQL statement
							$sql = "SELECT l.LID, l.City, l.Province "
								. "FROM LOCATION l ";


						// Prepared statement, stage 1: prepare
						$stmt = $mysqli->prepare($sql);

						// Prepared statement, stage 2: execute
						$stmt->execute();

						// Bind result variables
						$stmt->bind_result($LID, $City, $Province);

						/* fetch values (dropdown) */

						echo '<div class = "labeltext"';
						echo '<label for="LID">Pick City: </label>';
						echo '</div>';
						echo '<div class = "dropdown">';
						echo '<select name="LID">';
						echo '</div>';

						while ($stmt->fetch())
						{
						printf ('<option value="%s">%s</option>', $LID, $City);
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
						<button style="margin:5px" type="submit" class="btn btn-primary btn-lg" value="submit">Submit </button>
						<br>
						<br>
				</div>
				<div class = "link">
				<p>
				<a href="index.php">Return to Main Page</a>
				</p>
			</div>
		</form>
	</section>
</body>
