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

    .bigcontainer {
        background-image: url(../pictures/background.jpg);
    }


    </style>
</head>

<body>

<main class="mainbackend">
    <div class="headerbackend">
        <h1 class="echovar">Ingelogd als: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
        <p>
            <button><a class="h1reservering" href="logout.php">Uitloggen</a></button>
        </p>
        <div class="signupouter">
            <a class="signuptext2" href="register.php">Account aanmaken</a>.</p>
        </div>
    </div>

    <div class="bigcontainer">

        <div class="middlecontainer">
            <div class="buttonmid"><button><a class="h1reservering" href="producten.php">Producten Toevoegen</a></button></div>

        </div>
        <div class="middlecontainer">
            <div class="buttonmid"><button><a class="h1reservering" href="reserveringen.php">Reserveringen</a></button>
            </div>
        </div>
        <div class="middlecontainer">
            <div class="buttonmid"><button><a class="h1reservering" href="accounts.php">Accounts</a></button></div>
        </div>
    </div>

</main>
</body>

</html>