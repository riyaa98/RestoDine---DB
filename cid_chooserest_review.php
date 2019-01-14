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
		<h1> Choose a Restaurant </h1>
	</div>
				<div class="mainwrapper">

<!-- specifies the next page -->
				<form action="rid_reviews.php" method="get">

<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

<?php
//Store CID
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
    echo '</select><br>';

/* close statement and connection*/
$stmt->close();
$mysqli->close();
?>
 <!--Button that takes you to different pages -->

  		<br>
  		<button type="submit" class="btn btn-primary btn-lg" value="Submit">Submit</button>
		</br>
		</div>
</body>
