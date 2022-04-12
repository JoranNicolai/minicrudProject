<?php
// config
require_once "config.php";


// maak var's aan voor user's
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// als de 
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
    <link rel="stylesheet" href="/minicrudProject/css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <title>Restaurant - Registreren</title>

    <style>
    .registerbody {
        background-image: url(../pictures/registerimage.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: auto;
    }
    </style>

</head>

<body class="registerbody">

    <main>
        <div class="omheensignup">
            <div class="formsregister">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="formss">
                        <label>Naam</label>
                        <input type="text" name="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="forms-kleiner">
                        <label>Wachtwoord</label>
                        <input type="password" name="password"
                            class="forms-kleiner <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $password; ?>">
                        <span class="onjuiste-error"><?php echo $password_err; ?></span>
                    </div>
                    <div class="forms-kleiner">
                        <label>Wachtwoord opnieuw</label>
                        <input type="password" name="confirm_password"
                            class="forms-kleiner <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $confirm_password; ?>">
                        <span class="onjuiste-error"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="submitouter" <div class="submitinput">
                        <input type="submit" class="submitinput" value="Registreren" name="test1">
                    </div>

            </div>
            </form>
        </div>
        </div>

    </main>


</body>

</html>