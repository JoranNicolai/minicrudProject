<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/minicrudProject/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrudProject/pictures/image.png">
    <title>Restaurant - Producten</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=bestelsysteem", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<form action="insert.php" method="post">
    <div class="buitenproductenform">
        <label>Product ID</label>
        <input type="text" name="id" class="binnenproductenform">
    </div>
    <div class="buitenproductenform">
        <label>Product Naam</label>
        <input type="text" name="name" class="binnenproductenform">
    </div>
    <div class="buitenproductenform">
        <label>Product Image</label>
        <input type="text" name="image" class="binnenproductenform">
    </div>
    <div class="buitenproductenform">
        <label>Product Prijs</label>
        <input type="text" name="price" class="binnenproductenform">
    </div>
    <input type="submit" class="" name="submit" value="Verzenden">
</form>

<a href="backend.php">Terug</a>



</body>
</html>