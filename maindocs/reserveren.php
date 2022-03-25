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
    <title>Restaurant - Reserveren</title>
</head>

<body>
    <header>
        <div class="header">
            <img class="headerlogo" src="../pictures/miepsushi.jpg" alt="">
            <div class="header-right">
                <a class="active" href="index.php">Home</a>
                <a href="bestellen.php">Bestellen</a>
                <a href="reserveren.php">Reserveren</a>
                <a href="overons.php">Over ons</a>
                <a href="contact.php">Contact</a>
                <a href="login.php">Inloggen / Aanmelden</a>
            </div>
        </div>
    </header>

    <?php
// Reservatie proces
if (isset($_POST["date"])) {
    require "2-reserve.php";
    if ($_RSV->save(
        $_POST["date"], $_POST["name"],
        $_POST["email"], $_POST["tel"], $_POST["notes"])) {
    } else { echo "<div class='err'>".$_RSV->error."</div>"; }
}
?>
    <div class="contactoutercontainer">
        <form class="formreserveren" id="resForm" method="post" target="_self">
            <label for="res_name">Naam</label>
            <input type="text" required name="name" value="" />
            <label for="res_email">Email</label>
            <input type="email" required name="email" value="" />
            <label for="res_tel">Telefoon</label>
            <input type="text" required name="tel" value="" />
            <label for="res_notes">Personen</label>
            <input type="text" name="notes" value="" />
            <?php
    $mindate = date("Y-m-d");
    ?>
            <label>Reserveringsdatum</label>
            <input type="date" required id="res_date" name="date" min="<?=$mindate?>">

            <div class="submitouter">
                <button type="submit">Verzenden</button>

            </div>
        </form>
        <img class="contactbackimage" src="/minicrudProject/pictures/image9.jpg" alt="background eten">
        <div class="contactrightcontainer">
        </div>
    </div>

    <footer class="footer-distributed">
        <div class="footer-left">
            <p class="footer-links">
                <a href="index.php" class="link-1">Home</a>
                <a href="index.php">Menu</a>
                <a href="bestellen.php">Bestellen</a>
                <a href="overons.php">Over ons</a>
                <a href="contact.php">Contact</a>
            </p>
            <p class="footer-company-name">Restaurant PhP © 2022</p>
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