<?php
require_once "connect.php";
?>

<!DOCTYPE html>
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
    <title>Restaurant - Producten Toevoegen</title>
</head>

<body>
    <form action="ProductenToevoegen.php" method="post">
        <div>
            <label>Product Naam</label>
            <input type="text" name="productnaam" class="formsproducten">
        </div>
        <div>
            <label>Product Foto</label>
            <input type="file" name="image">
        </div>
        <div>
            <label>Prijs</label>
            <input type="text" name="price" class="formsproducten">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>

    <button class="buttonproductentoevoegen">Terug</button>
</body>

</html>