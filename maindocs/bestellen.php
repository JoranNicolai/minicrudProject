<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "bestelsysteem");

if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'			=>	$_GET["id"],
                'item_name'			=>	$_POST["hidden_name"],
                'item_price'		=>	$_POST["hidden_price"],
                'item_quantity'		=>	$_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
    }
    else
    {
        $item_array = array(
            'item_id'			=>	$_GET["id"],
            'item_name'			=>	$_POST["hidden_name"],
            'item_price'		=>	$_POST["hidden_price"],
            'item_quantity'		=>	$_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
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

<body>
<br />
<div class="container">
    <?php
    $query = "SELECT * FROM producten ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-4">
                <form method="post" action="bestellen.php?action=add&id=<?php echo $row["id"]; ?>">
                    <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;"
                         align="center">
                        <img src="../pictures/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

                        <h4 class="text-info"><?php echo $row["name"]; ?></h4>

                        <h4 class="text-danger">€ <?php echo $row["price"]; ?></h4>

                        <input type="text" name="quantity" value="1" class="form-control" />

                        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success"
                               value="Toevoegen" />

                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
    <div style="clear:both"></div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="bestellentr">
                <th width="40%">Product</th>
                <th width="10%">Aantal</th>
                <th width="20%">Prijs</th>
                <th width="5%">Acties</th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>$ <?php echo $values["item_price"]; ?></td>
                        <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        <td><a href="bestellen.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
                                    class="text-danger">Verwijderen</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <div class="bestellenbuttonouter">
                    <button class="bestellenbutton"><a class="bestellenhref" href="voltooid.php">Bestellen</a></button>

                </div>
                <tr>
                    <td colspan="3" align="right">Totaal</td>
                    <td align="right">€ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
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