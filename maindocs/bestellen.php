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
    <title>Restaurant - Bestellen</title>
</head>

<body>
<header>
    <div class="header">
        <img class="headerlogo" src="/pictures/miepsushi.jpg" alt="">
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
    <main>
        <div class="bestellenouter">

            <?php
        require_once("dbcontroller.php");
        session_start();
        $db_handle = new DBController();
        if(!empty($_GET["action"])) {
            switch($_GET["action"]) {
                case "add":
                    if(!empty($_POST["quantity"])) {
                        $productByCode = $db_handle->runQuery("SELECT * FROM producten WHERE code='" . $_GET["code"] . "'");
                        $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

                        if(!empty($_SESSION["winkelwagen_items"])) {
                            if(in_array($productByCode[0]["code"],array_keys($_SESSION["winkelwagen_items"]))) {
                                foreach($_SESSION["winkelwagen_items"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k) {
                                        if(empty($_SESSION["winkelwagen_items"][$k]["quantity"])) {
                                            $_SESSION["winkelwagen_items"][$k]["quantity"] = 0;
                                        }
                                        $_SESSION["winkelwagen_items"][$k]["quantity"] += $_POST["quantity"];
                                    }
                                }
                            } else {
                                $_SESSION["winkelwagen_items"] = array_merge($_SESSION["winkelwagen_items"],$itemArray);
                            }
                        } else {
                            $_SESSION["winkelwagen_items"] = $itemArray;
                        }
                    }
                    break;
                case "remove":
                    if(!empty($_SESSION["winkelwagen_items"])) {
                        foreach($_SESSION["winkelwagen_items"] as $k => $v) {
                            if($_GET["code"] == $k)
                                unset($_SESSION["winkelwagen_items"][$k]);
                            if(empty($_SESSION["winkelwagen_items"]))
                                unset($_SESSION["winkelwagen_items"]);
                        }
                    }
                    break;
                case "empty":
                    unset($_SESSION["winkelwagen_items"]);
                    break;
            }
        }
        ?>

            <div id="shopping-cart">
                <div class="buttonouter">
                    <a id="buttonLegen" href="bestellen.php?action=empty">Winkelwagen legen</a>
                    <a id="buttonBestellen" href="bestellingafgerond.php">Bestelling plaatsen</a>
                </div>
                <?php
            if(isset($_SESSION["winkelwagen_items"])){
                $total_quantity = 0;
                $total_price = 0;
                ?>
                <table class="producten-winkelwagen" cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th style="text-align:left;">Bestelling</th>
                            <th style="text-align:left;">Product Code</th>
                            <th style="text-align:right;" width="5%">Hoeveelheid</th>
                            <th style="text-align:right;" width="10%">Per stuk</th>
                            <th style="text-align:right;" width="10%">Prijs</th>
                            <th style="text-align:center;" width="5%">Verwijderen</th>
                        </tr>
                        <?php
                    foreach ($_SESSION["winkelwagen_items"] as $item){
                        $item_price = $item["quantity"]*$item["price"];
                        ?>
                        <tr>
                            <td><img src="<?php echo $item["image"]; ?>"
                                    class="cart-item-image" /><?php echo $item["name"]; ?></td>
                            <td><?php echo $item["code"]; ?></td>
                            <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align:right;"><?php echo "€ ".$item["price"]; ?></td>
                            <td style="text-align:right;"><?php echo "€ ". number_format($item_price,2); ?></td>
                            <td style="text-align:center;"><a
                                    href="bestellen.php?action=remove&code=<?php echo $item["code"]; ?>"
                                    class="buttonVerwijderen"><img src="/pictures/icon-delete.png"
                                        alt="Verwijderen" /></a></td>
                        </tr>
                        <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"]*$item["quantity"]);
                    }
                    ?>

                        <tr>
                            <td colspan="2" align="right">Totaal:</td>
                            <td align="right"><?php echo $total_quantity; ?></td>
                            <td align="right" colspan="2">
                                <strong><?php echo "€ ".number_format($total_price, 2); ?></strong>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <div class="no-records">Uw winkelwagen is leeg</div>
                <?php
            }
            ?>
            </div>

            <div id="product-grid">
                <?php
            $product_array = $db_handle->runQuery("SELECT * FROM producten ORDER BY id ASC");
            if (!empty($product_array)) {
                foreach($product_array as $key=>$value){
                    ?>
                <div class="product-item">
                    <form method="post"
                        action="bestellen.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                        <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
                        <div class="product-tile-footer">
                            <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                            <div class="product-price"><?php echo "€".$product_array[$key]["price"]; ?></div>
                            <div class="cart-action"><input type="text" class="product-quantity" name="quantity"
                                    value="1" size="2" /><input type="submit" value="Toevoegen" class="btnAddAction" />
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                }
            }
            ?>
            </div>

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