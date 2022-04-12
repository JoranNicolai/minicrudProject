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
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <title>Restaurant - Reserveren</title>
</head>

<style>
.reserverenbody {
    background-image: url(../pictures/booking.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: auto;
}
</style>

<body class="reserverenbody">


    <?php
// Reservatie proces
if (isset($_POST["date"])) {
    require "reserveren2.php";
    if ($_RSV->save(
        $_POST["date"], $_POST["name"],
        $_POST["email"], $_POST["tel"], $_POST["notes"])) {
    } else { echo "<div class='err'>".$_RSV->error."</div>"; }
}
?>
    <div class="contactoutercontainer">
        <form class="formreserveren" id="resForm" method="post" target="_self">
            <label for="res_name">Naam</label>
            <input type="text" required name="name" value="" placeholder="Naam.." />
            <label for="res_email">Email</label>
            <input type="email" required name="email" value="" placeholder="Email.." />
            <label for="res_tel">Telefoon</label>
            <input type="text" required name="tel" value="" placeholder="Telefoon-nummer.." />
            <label for="res_notes">Personen</label>
            <input type="text" name="notes" value="" placeholder="Aantal personen.." />
            <?php
    $mindate = date("Y-m-d");
    ?>
            <label>Reserveringsdatum</label>
            <input type="date" required id="res_date" name="date" min="<?=$mindate?>">

            <div class="submitouter">
                <button type="submit">Verzenden</button>

            </div>
        </form>
    </div>

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