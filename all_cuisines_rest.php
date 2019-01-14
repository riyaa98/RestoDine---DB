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
		<h1>Can't Choose only one? These have everything you want! </h1>
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
<form action="output_resttype.php" method="get">
<?php

// SQL statement
$sql = "SELECT r.Name FROM RESTAURANTS_DETAILS r WHERE NOT EXISTS (SELECT c.CID FROM CUISINE_TYPE c WHERE NOT EXISTS (SELECT s.CID FROM SERVES s WHERE s.CID = c.CID AND s.RID = r.RID)) ";
$result  = mysqli_query($mysqli, $sql);

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: execute
$stmt->execute();

//Bind result variables
$stmt->bind_result($Name);

/* fetch values (table) */
    echo '<div class = "tables">';
    echo "<table border ='1'><tr><th>Name</th></tr>";
    while ($stmt->fetch()){
    	echo "<tr> <td align = 'center'>" . $Name . "</td> </tr>";
    }
    echo "</table>";
    echo '</div>';

/* close statement and connection*/
$stmt->close();
$mysqli->close();
?>
<br>
<!--Button that takes you to different pages -->
		<button type="submit" class="btn btn-primary btn-lg" value="Search by Restaurant Name">Search by Restaurant Name</button>
		</br>
		</form>

	</div>
</body>
