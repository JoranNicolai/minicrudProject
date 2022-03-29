<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/minicrudProject/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Restaurant - Contact</title>
</head>

<style>
    .contactbody {
        background-image: url(../pictures/registerimage.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: auto;
    }
</style>

<body class="contactbody">
    <main>
        <div class="outercontactcontainer">
            <div class="contactcontainer">
                <div class="containerforms">
                    <form class="contactforms" action="verzonden.php" method="post">
                        <input type="text" id="voornaam" name="voor_naam" placeholder="Voornaam..">
                        <input type="text" id="achternaam" name="achter_naam" placeholder="Achternaam..">
                        <input type="text" id="email" name="email" placeholder="Email..">
                        <textarea id="subject" name="onderwerp" placeholder="Laat ons iets weten"
                            style="height:70px; width: 100%; resize: none;"></textarea>
                        <input class="submitinput" type="submit" name="submit" value="Verzenden">

                    </form>
                </div>
            </div>
            <div class="contactcontainer">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2464.8687672753904!2d5.863308115980852!3d51.845092393776675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c70844de874645%3A0x7fd154455deb5f82!2sArsenaal%201824!5e0!3m2!1snl!2snl!4v1647973931114!5m2!1snl!2snl"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </main>

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

</body>

</html>