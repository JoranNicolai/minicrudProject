<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>voltooid</title>
</head>

<body>

<?php
session_start();
echo "Bedankt voor uw bestelling!";
?>

<?php
if(!empty($_SESSION["shopping_cart"]))
{
    $total = 0;
    foreach($_SESSION["shopping_cart"] as $keys => $values)
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
?>

</body>

</html>