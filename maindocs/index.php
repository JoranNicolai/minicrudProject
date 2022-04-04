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
    <title>Restaurant - Home</title>
</head>

<body>
    <main>
        <div class="indexreserverencontainer">
            <div class="indexreserveren">
                <a class="reserverenAhref" href="reserveren.php">Reserveren</a>
            </div>
            <button class="pauzebutton" id="pauzebutton" onclick="Pauzeren()"><img class="pauzebuttonimg"  src="../pictures/pauzebutton.png" alt="pauze knop"></button>
        </div>
        <div class="indexcontainer">
            <img class="indexlogo" src="../pictures/indexlogo.png" alt="">
        </div>
        <video autoplay muted loop id="video">
            <source src=../pictures/sushi.mp4 type="video/mp4">
        </video>

        <div class="headercontent">
            <header>
                <div class="headerindex">
                    <div class="header-right">
                        <a class="active" href="index.php">Home</a>
                        <a href="reserveren.php">Reserveren</a>
                        <a href="bestellen.php">Bestellen</a>
                        <a href="overons.php">Over ons</a>
                        <a href="contact.php">Contact</a>
                        <a href="login.php">Inloggen / Aanmelden</a>
                    </div>
                </div>
            </header>
        </div>
    </main>



    <script src="scripts.js"></script>

    <script>
        var pauzebutton = document.getElementById("pauzebutton");
        var video = document.getElementById("video");

        function Pauzeren() {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        }
    </script>

</body>


</html>