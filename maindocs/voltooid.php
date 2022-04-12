<!doctype html>
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
    <title>Restaurant - Bestelling voltooid</title>
</head>

<body>
    // blockt om naar voltooid.php te gaan via url. persee button gebruiken
    <?php
session_start();
if (!isset($_GET['voltooid']) || empty($_SESSION["winkelwagen"])) {
    header('Location: bestellen.php');
}
?>
    // randint code die een order nummer maakt en echo't
    <?php
$randomnummer = rand(1000, 9999);
echo "Bedankt voor uw bestelling! Hier uw order nummer  #" . $randomnummer;



?>

    // foreach (zelfde code van bestellen die laat zien wat je hebt besteld en totaal bedrag laat zien.
    <?php
if(!empty($_SESSION["winkelwagen"]))
{
    $total = 0;
    foreach($_SESSION["winkelwagen"] as $keys => $values)
    {
        ?>
    <tr>
        <div>
            <td><?php echo $values["etenproduct_naam"]; ?></td>
        </div>
        <div>
            <td>$ <?php echo number_format($values["etenproduct_hoeveelheid"] * $values["etenproduct_prijs"], 2);?></td>
        </div>
    </tr>
    <?php
        $total = $total + ($values["etenproduct_hoeveelheid"] * $values["etenproduct_prijs"]);
    }
    ?>
    <tr>
        <td colspan="3" align="right">Totaal</td>
        <td align="right">€ <?php echo number_format($total, 2); ?></td>
        <td></td>
    </tr>
    <?php
}

// verwijdert de session en redirect naar index na 5 seconden.
session_destroy();

echo "Redirecting in 5 seconden.";
header("Refresh:5; url=index.php");
?>

</body>

</html>