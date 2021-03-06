<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/minicrud/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrud/pictures/image.jpg">
    <title>Restaurant - Inloggen / Aanmelden</title>
</head>

<body>

<header>
        <div class="header">
            <div class="header-right">
                <a class="active" href="index.php">Home</a>
                <a href="menu.php">Menu</a>
                <a href="bestellen.php">Bestellen</a>
                <a href="reserveren.php">Reserveren</a>
                <a href="overons.php">Over ons</a>
                <a href="contact.php">Contact</a>
                <a href="login.php">Inloggen / Aanmelden</a>
            </div>
        </div>
    </header>
    <main>
        <div class="outsidelogin">
            <form action="login.php" method="post">


                <?php if (isset($_GET['error'])) { ?>

                <p class="error"><?php echo $_GET['error']; ?></p>

                <?php } ?>

                <input type="text" name="uname" placeholder="Naam"><br>

                <input type="password" name="password" placeholder="Wachtwoord"><br>
                <div class="buttonbox">
                <button type="submit">Inloggen / Aanmelden</button>
                </div>

            </form>
        </div>
    </main>

    <footer class="footer-distributed">
        <div class="footer-left">
            <p class="footer-links">
                <a href="index.php" class="link-1">Home</a>
                <a href="index.php">Menu</a>
                <a href="bestellen.php">Bestellen</a>
                <a href="overons.php">Over ons</a>
                <a href="contact.php">Contact</a>
            </p>
            <p class="footer-company-name">Restaurant PhP ?? 2022</p>
        </div>
        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Heyendaalseweg 98</span> Nijmegen</p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p>+31 682713669</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@company.com">1194390@student.roc-nijmegen.nl</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>Over ons</span>
                Dagelijks geopend vanaf 11.00 uur
            </p>
        </div>
    </footer>

</body>

</html>