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
                            
                            
                             header("location: backend.php");
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
    <link rel="stylesheet" href="/minicrudProject/css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="/minicrudProject/pictures/image.jpg">
    <title>Restaurant - Inloggen / Aanmelden</title>
    <style>
        .loginbody {
            background-image: url(../pictures/loginimage.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: auto;

        }
    </style>
</head>

<body class="loginbody">

    <main>
        <div class="outsidelogin">

            <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="formss">
                    <label>Naam</label>
                    <input type="text" name="username" placeholder="Naam.."
                        class=" <?php echo (!empty($username_err)) ? 'Onjuist' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <span class="onjuiste-error"><?php echo $username_err; ?></span>
                </div>
                <div class="">
                    <label>Wachtwoord</label>
                    <input type="password" name="password" placeholder="Wachtwoord.."
                        class="forms-kleiner <?php echo (!empty($password_err)) ? 'Onjuist' : ''; ?>">
                    <span class="onjuiste-error"><?php echo $password_err; ?></span>
                </div>
                <div class="submitouter">
                    <button type="submit">Inloggen</button>
                </div>
        </div>
        </form>
        </div>
    </main>

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