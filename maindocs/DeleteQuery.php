<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bestellentest";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = null;
    $sql = "DELETE FROM producten WHERE id='$id'";
    $conn->exec($sql);
    echo "verwijdert";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>