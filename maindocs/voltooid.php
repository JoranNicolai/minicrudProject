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

    <?php
include_once('../maindocs/dbcontroller.php');
session_start();
$randomnummer = rand(1000, 9999);
echo "Bedankt voor uw bestelling! Hier uw order nummer  #" . $randomnummer;



?>

    <?php
if(!empty($_SESSION["winkelwagen"]))
{
    $total = 0;
    foreach($_SESSION["winkelwagen"] as $keys => $values)
    {
        ?>
    <tr>
        <div>
            <td><?php echo $values["item_name"]; ?></td>
        </div>
        <div>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
        </div>
    </tr>
    <?php
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
    ?>
    <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">$ <?php echo number_format($total, 2); ?></td>
        <td></td>
    </tr>
    <?php
}
session_destroy();
echo "Redirecting in 5 seconden.";
header("Refresh:5; url=index.php");
?>

</body>

</html>