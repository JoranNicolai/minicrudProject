<?php
#$host = 'localhost';
#$db = 'bestelsysteem';
#$user = 'root';
#$pass = '';
#$charset = 'utf8mb4';
#$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
#opt = [
#PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
#PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
#PDO::ATTR_EMULATE_PREPARES => false,
#];

#try {
#$connect = new PDO($dsn, $user, $pass, $opt);
#} catch (PDOException $e) {
#echo $e->getMessage();
#die("fout");
#}
?>

<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "bestelsysteem";
    $connect=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$connect){
          die('Could not Connect MySql Server:' .mysql_error());
        }
?>