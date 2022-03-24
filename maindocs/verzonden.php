<?php
if(isset($_POST['submit'])){
    $to = "mirzaselimovic2005@gmail.com";
    $from = $_POST['email'];
    $first_name = $_POST['voor_naam'];
    $last_name = $_POST['achter_naam'];
    $bericht = $_POST['onderwerp'];
    $subject = "forms onderwerp";
    $subject2 = "forms onderwerp 2";
    $message = $first_name . " " . $last_name . " schreef:" . "\n\n" . $_POST['onderwerp'];
    $message2 = "copy van het bericht: " . $first_name . "\n\n" . $_POST['onderwerp'];
    $headers = "Van:" . $from;
    $headers2 = "Van:" . $to;
    //mail($to,$subject,$message,$headers); Mail Server voor nodig
    //mail($from,$subject2,$message2,$headers2); Mail Server voor nodig
}
?>

<?php
    $bericht = $_POST['onderwerp'];
    $first_name = $_POST['voor_naam'];
echo  "Bedankt voor je mailtje " . $first_name . "!";
echo "Hier uw mailtje opnieuw:" . $bericht;

?>


