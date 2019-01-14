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
	<h1>Add a Review!</h1>
</div>
	<div class = "mainwrapper">
	<!-- INSERT form if needed -->
		<form action="insertReview.php" method="get">

	<?php
	//Store RID
	$rid = $_GET['RID'];
	?>

<br>
<!--User input -->
  	 <div class = "labeltext">
  	   User name: <input type="text" name="user_name"><br>
       Rating: <input type="number" name="rating" min="1" max="5"><br>
  	   Comments: <input type="text" name="comments"><br>
	   </div>
	<!--To pass the variable to the next page -->
    	<input type="hidden" name="RID" value="<?php echo $rid;?>">

    	<!--Button that takes you to different pages -->
    	<button type="submit" class="btn btn-primary btn-lg" value="Add Review">Add Review</button>
	   </form>
   </div>
</body>
