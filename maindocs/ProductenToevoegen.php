<?php
include_once 'connect.php';
if(isset($_POST['submit']))
{    
     $name = $_POST['productnaam'];
     $image = $_POST['image'];
     $price = $_POST['price'];
     $sql = "INSERT INTO `producten` (`id`, `name`, `image`, `price`)
     VALUES ('$name','$image', '$price')";
     if (mysqli_query($connect, $sql)) {
        echo "producten toegevoegd";
     } else {
        echo "error: " . $sql . ":-" . mysqli_error($connect);
     }
     mysqli_close($connect);
}
?>