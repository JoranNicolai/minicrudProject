<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Backend</title>
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <link rel="stylesheet" href="/minicrudProject/css/backend.css">
    <style>
    body {
        font: 14px sans-serif;
        text-align: center;
    }
    </style>
</head>

<body>



    <h1>Ingelogd als: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    <p>
        <button><a class="headertext" href="logout.php">Uitloggen</a></button>
    </p>

    <div class="bigcontainer">
        <div class="middlecontainer">
            <h1 class="h1reservering">Producten Toevoegen</h1>
            <div class="buttonmid"><button><a class="h1reservering" href="producten.php">Producten</a></button></div>

        </div>
        <div class="middlecontainer">
            <h1 class="h1reservering">Reserveringen bekijken</h1>
            <div class="buttonmid"><button><a class="h1reservering" href="reserveringen.php">Reserveringen</a></button>
            </div>
        </div>
        <div class="middlecontainer">
            <h1 class="h1reservering">Accounts bekijken</h1>
            <div class="buttonmid"><button><a class="h1reservering" href="accounts.php">Accounts</a></button></div>
        </div>
    </div>
</body>

</html>