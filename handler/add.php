<?php

//izadji iz handler foldera i idi dovedi dbBroker
require "../dbBroker.php";
require "../model/prijava.php";

//potrebno je da su setovana sva polja
if(isset($_POST['predmet']) && isset($_POST['katedra']) && 
isset($_POST['sala']) && isset($_POST['datum'])){
    //za id null jer radi autoincrement
    $prijava = new Prijava(null, $_POST['predmet'], $_POST['katedra'], 
    $_POST['sala'], $_POST['datum']);   
    $status = Prijava::add($prijava, $conn); //$conn vec postoji u dbBrokeru

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo 'Failed';
    }
}

//nepovazan je sa home phpom! to cemo izvrsiti preko javascripta - AJAX
//AJAX asinhroni javascript i XML
//sluzi da se refreshuje neki prikaz a da se ne refreshuje cela stranica - poggers 

?>