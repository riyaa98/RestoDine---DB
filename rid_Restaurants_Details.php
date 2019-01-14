<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<!-- Title -->
<body>
	<div class = "page-header">
		<h1> Restaurant Details </h1>
	</div>

<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

//Store RID from drop down
$rid = $_GET['RID'];

// SQL statement
$sql = "SELECT *"
. "FROM ((RESTAURANTS_DETAILS r NATURAL JOIN IS_OF i) NATURAL JOIN RESTAURANT_TYPE t) "
. "WHERE r.RID = $rid ";

$result  = mysqli_query($mysqli, $sql);

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param('i', $rid);

// Prepared statement, stage 2: execute
$stmt->execute();

//Bind result variables
$stmt->bind_result($RID, $Hours_of_Ops, $Name, $Pricing, $Website, $Contact_num, $Contact_email, $Menu, $Type, $Accessibility, $Parking_space, $Home_delivery_takeout, $Patio_seating);

/* fetch values (table) */
    echo '<div class = "tables">';
		echo "<table border='1'>";
		echo"<tr><td>Name</td><td>Hours of Operation</td><td>Pricing</td><td>Website</td><td>Contact Number</td><td>Contact Email</td><td>Menu</td><td>Restaurant Type</td><td>Accessibility</td><td>Parking Space</td><td>Home Delivery/Takeout</td><td>Patio Seating</td><tr>";
		while($row=mysqli_fetch_array($result)){
    		echo "<tr>";

    		echo "<td>" . $row['Name']. "</td>";
    		echo "<td>" . $row['Hours_of_Ops']. "</td>";
    		echo "<td>" . $row['Pricing']. "</td>";
    		echo "<td>" . $row['Website']. "</td>";
    		echo "<td>" . $row['Contact_num']. "</td>";
    		echo "<td>" . $row['Contact_email']. "</td>";
    		echo "<td>" . $row['Menu']. "</td>";
    		echo "<td>" . $row['Type_name']. "</td>";
    		echo "<td>" . $row['Accessibility']. "</td>";
    		echo "<td>" . $row['Parking_space']. "</td>";
    		echo "<td>" . $row['Home_delivery_takeout']. "</td>";
    		echo "<td>" . $row['Patio_seating']. "</td>";
    		echo "</tr>";
		}
    		echo "</table>";
        echo '</div>';

session_start();
$_SESSION['RID'] = $rid;

/* close statement and connection*/
$stmt->close();
$mysqli->close();
?>

<br>
	<div class = "mainwrapper">

	<!--Buttons that takes you to different pages -->
			<form action="rid_Make_Reservation.php" method="get">
			<input type="hidden" name="RID" value="<?php echo $rid;?>">
			<button type="submit" class="btn btn-primary btn-lg" value="Make a Reservation">Make a Reservation</button>
			</br>
			</form>

			<form action="rid_reviews.php" method="get">
			<input type="hidden" name="RID" value="<?php echo $rid;?>">
			<button type="submit" class="btn btn-primary btn-lg" value="Reviews & Suggestions">Reviews & Suggestions</button>
			</br>
			</form>

			<form action="rid_restloc.php" method="get">
			<button type="submit" class="btn btn-primary btn-lg" value="Location">Location</button>
			</br>
			</form>



<div class="link">
				<p>
				<a href="output_resttype.php">Return to list</a>
				</p>
</div>
</div>
</body>
