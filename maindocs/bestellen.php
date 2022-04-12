<!--Array-->
<?php
session_start();

//Connectie met database
$connect = mysqli_connect("localhost", "root", "", "bestelsysteem");

// of toevoegenwinkelwagen is ingedrukt
if (isset($_POST["toevoegenwinkelwagen"])) {

// session winkelwagen returnen in een arraycolumn
    if (isset($_SESSION["winkelwagen"])) {
        $id_vanitemarray = array_column($_SESSION["winkelwagen"], "etenproduct_id");
        
// tel alles van array producten_array op
        if (!in_array($_GET["id"], $id_vanitemarray)) {
            $count = count($_SESSION["winkelwagen"]);
            $producten_array = array(
                'etenproduct_id' => $_GET["id"],
                'etenproduct_naam' => $_POST["hidden_name"],
                'etenproduct_prijs' => $_POST["hidden_price"],
                'etenproduct_hoeveelheid' => $_POST["quantity"]
            );
            $_SESSION["winkelwagen"][$count] = $producten_array;
        }
    }
// winkelwagen op 0 niks erin
    else {
        $producten_array = array(
            'etenproduct_id' => $_GET["id"],
            'etenproduct_naam' => $_POST["hidden_name"],
            'etenproduct_prijs' => $_POST["hidden_price"],
            'etenproduct_hoeveelheid' => $_POST["quantity"]
        );
        $_SESSION["winkelwagen"][0] = $producten_array;
    }
}
// verwijdert uiteindelijke de variables in winkelwagen
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["winkelwagen"] as $keys => $values) {
            if ($values["etenproduct_id"] == $_GET["id"]) {
                unset($_SESSION["winkelwagen"][$keys]);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/minicrudProject/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrudProject/pictures/image.png">
    <title>Restaurant - Bestellen</title>
</head>

<style>
.bestellenbody {
    background-image: url(../pictures/bestellenbackground.jpg);
    background-position: center;
    background-repeat: repeat-y;
    background-size: cover;
    height: auto;
}
</style>

<body class="bestellenbody">
    <br />
    <div class="">

        <!--Sql query en numrows-->

        <?php
    $query = "SELECT * FROM producten ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>

        <!--Formsss-->
        <div class="containerbestellenouter">
            <form class="formbestellen" method="post" action="bestellen.php?action=add&id=<?php echo $row["id"]; ?>">
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;"
                    align=center>
                    <img src="../pictures/<?php echo $row["image"]; ?>" class="plaatjeresponsive" /><br />
                    <h4 class="text-info"><?php echo $row["name"]; ?></h4>
                    <h4 class="text-danger">€ <?php echo $row["price"]; ?></h4>
                    <input type="text" name="quantity" value="1" class="form-control" />
                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                    <input type="submit" name="toevoegenwinkelwagen" style="margin-top:5px;" class=""
                        value="Toevoegen" />
                </div>
            </form>
        </div>


        <?php
        }
    }
    ?>

        <!--Tabletje-->
        <div style="clear:both"></div>
        <br />
        <div class="">
            <table class="">
                <tr class="bestellentr">
                    <th width="40%"></th>
                    <th width="10%"></th>
                    <th width="20%"></th>
                    <th width="5%"></th>
                </tr>
                <?php
            if (!empty($_SESSION["winkelwagen"])) {
                $total = 0;
                foreach ($_SESSION["winkelwagen"] as $keys => $values) {
                    ?>
                <tr class="bestellentr">
                    <td><?php echo $values["etenproduct_naam"]; ?></td>
                    <td><?php echo $values["etenproduct_hoeveelheid"]; ?></td>
                    <td>€ <?php echo $values["etenproduct_prijs"]; ?></td>
                    <td>€
                        <?php echo number_format($values["etenproduct_hoeveelheid"] * $values["etenproduct_prijs"], 2); ?>
                    </td>
                    <td><a class="verwijderen"
                            href="bestellen.php?action=delete&id=<?php echo $values["etenproduct_id"]; ?>"><span
                                class="text-danger">Verwijderen</span></a></ < /td>
                </tr>
                <?php
                    $total = $total + ($values["etenproduct_hoeveelheid"] * $values["etenproduct_prijs"]);
                }
                ?>
                <div class="bestellenbuttonouter">
                    <a class="bestellenhref" href="voltooid.php?voltooid=1">
                        <button name="verzendenvoltooid" class="bestellenbutton">Bestellen</button>
                    </a>
                </div>
                <tr class="bestellentr">
                    <td colspan="3" align="right">Totaal</td>
                    <td align="right">€ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
                W


            </table>
        </div>
    </div>
    <br />

    <div class="headercontent2">
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