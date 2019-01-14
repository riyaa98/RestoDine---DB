<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>


<body>
<!--Title -->
  <section class="maincontainer">
    <div class="container">
      <div class="page-header">
        <h1>Welcome to RestoDine!</h1>
        <h4><i>"We hope you are able to find all the information you need to select the best restaurant in town and enjoy a wonderful meal. Bon appetit! ;) "</i></h4><br>
      </div>

<!--Buttons that takes you to different pages -->

      <div class="mainwrapper">
        <div class="submit">
          <form action="output_resttype.php" method="get">
            <button style="margin:5px" type="submit" class="btn btn-primary btn-lg">Search by Restaurant Name </button>
          </form>
        </div>

        <div class="submit">
          <form action="output_genloctype.php" method="get">
            <button style="margin:5px" type="submit" class="btn btn-primary btn-lg">Search by Cities </button>
          </form>
        </div>

        <div class="submit">
          <form action="output_cuisinetype.php" method="get">
            <button style="margin:5px" type="submit" class="btn btn-primary btn-lg">Search by Cuisine Type </button>
          </form>
        </div>
		
		<div class="submit">
          <form action="partner_restaurants.php" method="get">
            <button style="margin:5px" type="submit" class="btn btn-primary btn-lg">View our Partner Ratings </button>
          </form>
        </div>

      </div>
    </div>
  </section>
</body>
