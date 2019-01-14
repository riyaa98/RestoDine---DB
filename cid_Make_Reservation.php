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
		<h1>Make a Reservation </h1>
	</div>
		<div class="mainwrapper">
<form action="Insert_Reservation.php" method="get">
<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

<?php
//Store RID, LID, CID
$rid = $_GET['RID'];
$lid = $_GET['LID'];
$cid = $_GET['CID'];

// SQL statement
$sql = "SELECT r.RID, r.Name "
	. "FROM (RESTAURANTS_DETAILS r NATURAL JOIN SERVES s) "
	. "WHERE s.CID = $cid ";

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: execute
$stmt->execute();

// Bind result variables
$stmt->bind_result($RID, $Name);

/*fetch values (dropdown)*/
    echo '<div class = "labeltext"';
    echo '<label for="RID">Pick Restaurant: </label>';
    echo '</div>';
    echo '<div class = "dropdown">';
    echo '<select name="RID">';
    echo '</div>';

while ($stmt->fetch())
  {
  printf ('<option value="%s">%s</option>', $RID, $Name);
  }

$chooseRID = $RID;
echo '</select><br>';


// SQL statement
$sql2 = "SELECT l.LID, l.City "
		. "FROM (((SERVES s NATURAL JOIN RESTAURANTS_DETAILS r) NATURAL JOIN HAS h) NATURAL JOIN LOCATION l) "
		. "WHERE s.CID = $cid";

// Prepared statement, stage 1: prepare
$stmt2 = $mysqli->prepare($sql2);

// Prepared statement, stage 2: execute
$stmt2->execute();

// Bind result variables
$stmt2->bind_result($LID, $City);

/* fetch values */
    echo '<div class = "labeltext"';
    echo '<label for="LID">Pick City: </label>';
    echo '</div>';
    echo '<div class = "dropdown">';
    echo '<select name="LID">';
    echo '</div>';

while ($stmt2->fetch())

    {
    printf ('<option value="%s">%s</option>', $LID, $City);
    }
    echo '</select><br>';

/* close statement and connection*/
$stmt2->close();
$mysqli->close();
?>
				<!--User input -->

				Name: <input type="text" name="user_name"><br>
				Party Size: <input type="number" name="party_size" min="1" max="20"><br>
				Date: <input type="date" name="date"><br>
				Time: <input type="time" name="time"><br>


				<!--To pass the variable to the next page -->
				<input type="hidden" name="CID" value="<?php echo $cid;?>">
				<button type="submit" class="btn btn-primary btn-lg" value="Make Reservation">Make Reservation</button>
				</form>

				<!--Button that takes you to different pages -->
				<button type="submit" class="btn btn-primary btn-lg" value="Go Back" onclick="history.back()">Go Back</button>
			</br>
</div>
</body>
