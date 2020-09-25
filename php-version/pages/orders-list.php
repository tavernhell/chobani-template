<!-- REQUIRE STATEMENTS && CONNECTION TO THE DB -->
<?php 
  require('db-config.php');
  
  //connecting to DB
  try {
    //create a PDO connection with a timeout set to 10 seconds
    $conn = new PDO($dsn, $username, $password, array(PDO::ATTR_TIMEOUT => 10));
    //throws exception on bad queries
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $e) {
    //report error message (die prevents the page to be rendered)
    die($e->getMessage());
  }
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <title>Orders list</title>

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' 
        href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'
        integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' 
        crossorigin='anonymous'>
  <!-- Bootstrap JS-->
  <script defer src='https://code.jquery.com/jquery-3.5.1.slim.min.js'
          integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj'
          crossorigin='anonymous'></script>
  <script defer src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'
          integrity='sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN'
          crossorigin='anonymous'></script>
  <script defer src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'
          integrity='sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV'
          crossorigin='anonymous'></script>
</head>

<body class="bg-dark text-white">
  <div class="row">
    <div class="col-10 mx-auto">
      <table class="table table-dark table-striped table-hover">
      </table>
    </div>
  </div>
</body>
</html>