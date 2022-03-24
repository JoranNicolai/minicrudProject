<?php
// config
require_once "config.php";


// Definieer variabelen en initialiseer met lege waarden
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Voer een gebruikersnaam in.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "De gebruikersnaam mag alleen letters, cijfers en underscores bevatten.";
    } else{
        // select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Deze gebruikersnaam is al in gebruik.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later opnieuw.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Voer een wachtwoord in alstublieft.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Wachtwoord moet minimaal 6 tekens bevatten.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig het wachtwoord.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Wachtwoorden komen niet overeen!";
        }
    }
    

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            

            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later opnieuw.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/minicrud/css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrud/pictures/image.jpg">
    <title>Restaurant - Registreren</title>

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

<main class="registermain">
    <div class="transformfix">

    <div class="omheensignup">
        <div class="formsregister">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
                <label>Naam</label>
                <input type="text" name="username"
                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Wachtwoord</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Wachtwoord opnieuw</label>
                <input type="password" name="confirm_password"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="submitouter"
            <div class="submitinput">
                <input type="submit" class="submitinput" value="Registreren" name="test1">
            </div>

            </div>
        </form>
        </div>
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