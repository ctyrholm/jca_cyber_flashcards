<?php
session_start();
unset($_SESSION['whichtable']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Cyber Quiz</title>
</head>
<body style = "background-color: black; color: white;">

<div class = "container-fluid text-center">
<div class = "row">
<div class = "col-md-4">
</div>
  <div class = "col-md-4">
<h1>Linux and Cyber security</h1>
<br><br>
<form action = "index.php" method = "POST">
    <h3>Search Term</h3> <input type = "text" name = "searchterm" style = "width: 100%" class="form-control form-control-md text-center" placeholder = "Enter term">
    <br>
    <select class="btn btn-info" name = "table">
    <option value = "cyberterms">Cyber Terms</option>
    <option value = "linuxterms">Linux Terms</option>
  </select>
    <button class = "btn btn-primary" type = "submit" name = "search">Search Term</button>
</form>

<br><br>
<a href = "flip.php?whichtable=cyberterms" style = "color: #cc0463; text-decoration: none;">Cyber Flahscards</a> | 
<a href = "flip.php?whichtable=linuxterms" style = "color: #cc0463; text-decoration: none;">Linux Flahscards</a>
<br><br>
<hr>

<?php
////////////////search term php
    if(isset($_POST['search'])) {
    //echo $_POST['searchterm'];
//$stringlength = strlen($_POST['serchterm']);
//if($stringlength <1) {

//}
    
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

//dropdown
if($_POST['table'] == 'cyberterms') {

  $sql = "SELECT * FROM `cyberterms` WHERE `term` LIKE '%".$_POST['searchterm']."%'";
  $result = $conn->query($sql);
$whichone = 'Cyber';
} else {

    $sql = "SELECT * FROM `linuxterms` WHERE `term` LIKE '%".$_POST['searchterm']."%'";
    $result = $conn->query($sql);
    $whichone = 'Linux';
}

echo $whichone.' Search results: <br><br>';

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        ?>
          Term: <?=$row["term"]?>: <?=$row["definition"]?><br><br><hr>

        <?php
      }
    } else {
      echo "0 results";
      echo '<br><hr><br>';
    }
    $conn->close();
  }

?>
<hr>
</div>
</div>
</div>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>