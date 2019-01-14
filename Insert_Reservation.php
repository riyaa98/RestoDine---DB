<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<!-- Title -->
<body>
  <section>
      <div class = "mainwrapper">

<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

  <form action="index.php" method="get">
<?php

//Store RID and LID from previous page
$rid = $_GET['RID'];
$lid = $_GET['LID'];
// SQL statement
$sql = "INSERT INTO RESERVE (RID, LID, Name, Party_size, Date, Time)"
. "VALUES (?, ?, ?, ?, ?, ?)";

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// (2) Handle GET parameters; username is the name of the textbox
$rid = $_GET['RID'];
$lid = $_GET['LID'];
$username = $_GET['user_name'];
$party_size = $_GET['party_size'];
$date = $_GET['date'];
$time = $_GET['time'];

// (3) "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param('iisiss', $rid, $lid, $username, $party_size, $date, $time);


// Prepared statement, stage 2: execute
$stmt->execute();

    echo '<h1>Success!</h1>';
    echo '<p>Thanks ' . $username . '! We added your reservation to our system ' . '.</p>';

/* close statement and connection*/
$stmt->close();
$mysqli->close();
?>

 <!--Buttons that takes you to different pages -->
      <div class = "submit">
      <br>
      <button type="submit" class="btn btn-primary btn-lg" value="Go back to Main Page">Go back to Main Page</button>
      </div>
      </form>
    </div>

</body>
