<?php

$host = "localhost";
$db = "kolokvijumi";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

//connect_errno vraca poseldnji error code (true ako postoji bilo koja greska)
//tad da izadje i da ispise poruku gde pise i koja je greska
if($conn->connect_errno){

    exit("Neuspesna konekcija: gr.". $conn->connect_error." err kod>".$conn->connect->err);

}

?>