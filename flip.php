<?php
session_start();
if(!isset($_SESSION['whichtable'])) {
if($_GET['whichtable'] == 'cyberterms') {
    $_SESSION['whichtable'] = 'cyberterms';
    $_SESSION['topic'] = 'Cyber Security';
} else {
  $_SESSION['whichtable'] = 'linuxterms';
  $_SESSION['topic'] = 'Linux';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">


    <style>
        /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-card {
  background-color: black;
  width: 400px;
  height: 300px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #cc0463;
  color: white;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}
</style>
</head>
<body style = "background-color: black; color: white;">
  <div class = "container-fluid text-center">
    <br>
    <h1><?=$_SESSION['topic']?> Flashcards</h1>
    <br><br>
    <?php

$servername = "localhost";
$username = "ctyrholm";
$password = "I2N1qlfUtljZ9ZUH";
$dbname = "ctyrholm";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

      //pulls random row from table when reloaded
      $sql = "SELECT * FROM `linuxterms` ORDER BY RAND() LIMIT 1";

    if($_SESSION['whichtable'] == 'cyberterms') {

      //pulls random row from table when reloaded
      $sql = "SELECT * FROM `cyberterms` ORDER BY RAND() LIMIT 1";
    } else {
      $sql = "SELECT * FROM `linuxterms` ORDER BY RAND() LIMIT 1";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        ?>
          <div class=" container flip-card text-center">
              <div class="flip-card-inner">

                  <div class="flip-card-front p-3">
                      <h1><?=$row['term']?></h1>
                  </div>

                  <div class="flip-card-back p-3">
                      <h1><?=$row['term']?></h1>
                      <p><?=$row['definition']?></p>

                </div>
              </div>
          </div>

        <?php
      }
    } else {
      echo "0 results";
    }

    $conn->close();

    ?>
    </div>
    <br><br>
    <div class = "container text-center" >
    <form action = "flip.php">
        <button class = "btn btn-primary" type = "submit" name = "showterm">Next</button><br><br>
    </form>
    <br>
    <a href = "http://jca.ctyrholm.opalstacked.com/projects/cyber/" style = "color: #cc0463; text-decoration: none;">Search Terms</a>
  </div>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
