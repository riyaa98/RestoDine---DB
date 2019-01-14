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

      <h1> Location </h1>
    </div>
        <div class = "mainwrapper">

<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

//Store RID
session_start();
$rid = $_SESSION['RID'];

// SQL statement
$sql = "SELECT r.Name, h.Address, l.City, h.postal_code, l.Province "
. "FROM ((HAS h NATURAL JOIN RESTAURANTS_DETAILS r) NATURAL JOIN LOCATION l) "
. "WHERE r.RID = $rid AND h.RID = r.RID ";


$result  = mysqli_query($mysqli, $sql);

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param('i', $rid);

// Prepared statement, stage 2: execute
$stmt->execute();

//Bind result variables
$stmt->bind_result($RID, $LID, $Address, $City, $Postal_Code, $Province);

/* fetch values (table) */
    echo '<div class = "tables">';
    echo"<table border='1'>";
    echo"<tr><td>Name</td><td>Address</td><td>City</td><td>Postal Code</td><td>Province</td><tr>";
    while($row=mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['Name']. "</td>";
    echo "<td>" . $row['Address']. "</td>";
    echo "<td>" . $row['City']. "</td>";
    echo "<td>" . $row['postal_code']. "</td>";
    echo "<td>" . $row['Province']. "</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo '</div>';

/* close statement and connection*/
$stmt->close();
$mysqli->close();
?>

 <!--Buttons that takes you to different pages -->
    <br>
    <button type="submit" class="btn btn-primary btn-lg" value="Go Back" onclick="history.back()">Go back</button>
    </br>
  </div>
</body>
