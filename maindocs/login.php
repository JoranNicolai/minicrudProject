<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: login.php");
    exit;
}
 

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Voer uw gebruikersnaam in.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Voer uw wachtwoord in.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = $username;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            
                            header("location: welcome.php");
                        } else{
                            
                            $login_err = "Ongeldige gebruikersnaam of wachtwoord.";
                        }
                    }
                } else{
                    
                    $login_err = "Ongeldige gebruikersnaam of wachtwoord.";
                }
            } else{
                echo "
                Oeps! Er is iets fout gegaan. Probeer het later opnieuw.";
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
    <title>Restaurant - Inloggen / Aanmelden</title>
    <style>

    </style>
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

    <main class="loginmain">
    <div class="outsidelogin">

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <div class="signupouter">
            <p class="signuptext">Heb je geen account? <a class="signuptext2" href="register.php">Maak een account</a>.</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Naam</label>
                <input type="text" name="username"
                    class=" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="">
                <label>Wachtwoord</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="submitouter">
                <button type="submit">Inloggen</button>
            </div>
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