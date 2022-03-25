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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, created_at FROM users";
$result = $conn->query($sql);
?>

    <button><a class="h1reservering" href="backend.php">Terug naar backend - home</a></button>
    <h1>ALLE ACCOUNTS</h1>

    <?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    
    echo "<table>"; 
    echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['username']) . "</td><td>" . htmlspecialchars($row['created_at']) . "</td></tr>";
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