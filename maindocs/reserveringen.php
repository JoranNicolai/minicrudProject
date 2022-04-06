<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/minicrudProject/css/backend.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <title>Backend - Reserveringen</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>

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
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

    <button><a class="h1reservering" href="backend.php">Terug naar backend - home</a></button>
    <h1>ALLE RESERVERINGEN</h1>

    <?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    
    echo "<table>"; 
    echo "<tr><td>" . htmlspecialchars($row['res_id']) . "</td><td>" . htmlspecialchars($row['res_name']) . "</td><td>" . htmlspecialchars($row['res_slot']) . "</td><td>" . htmlspecialchars($row['res_email']) . "</td><td>" . htmlspecialchars($row['res_date']) . "</td><td>" . htmlspecialchars($row['res_date']) . "</td><td>" . htmlspecialchars($row['res_tel']) . "</td></tr>";
    }

    echo "</table>";
} 
else {
  echo "geen reserveringen";
}
$conn->close();
?>






</body>

</html>