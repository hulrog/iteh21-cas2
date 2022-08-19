<?php

class Prijava{
    public $id;
    public $predmet;
    public $katedra;
    public $sala;
    public $datum;

    public function __construct($id=null, $predmet=null, $katedra=null,
                                $sala=null, $datum=null){
        $this->id = $id;
        $this->predmet = $predmet;
        $this->katedra = $katedra;
        $this->sala = $sala;
        $this->datum = $datum;

    }

    //kad god radimo nesto sto ima veze sa bazom, mora da se ukljuci ta veza
    public static function getAll(mysqli $conn){

        //kad radimo sql radimo sa dvostrukim da bismo prosledjivali promenljive
        //bez konkatizacije koja bi morala da se radi sa jednostrukim
        $query = "SELECT * FROM prijave";
        return $conn->query($query);
        //vraca sve redove iz tabele prijave

    }

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM prijave WHERE id=$id";
        //vrati sve prijave gde je taj prosledjen id
        $myArray = array();//pravljenje niza(prazan)
        $rezultat = $conn->query($query);

        //ako vrati bilo sta
        if($rezultat){
            while($red=$rezultat->fetch_array()){//prodji kroz to red po red
                //funkcija fetch_array uzima taj red i stavlja ga
                $myArray[] = $red; //na kraj napravljenog niza 
            }
        }

        return $myArray;//vrati taj napravljen niz
        //ovako se radi jer mozda i vrati vise redova, pa ih ovako vrati kao niz redova
    }

    //obrisi sve prijave gde je id trenutni (this) - nije staticka pa cemo ovako
    public function deleteById(mysqli $conn){

        $query = "DELETE FROM prijave WHERE id=$this->id";
        return $conn->query($query);//return bezveze da se vidi dal je uspesna

    }


    public static function add(Prijava $prijava, mysqli $conn){
        $query = "INSERT INTO prijave(predmet,katedra,sala,datum) 
        VALUES('$prijava->predmet', '$prijava->katedra', '$prijava->sala', '$prijava->datum')";
        
        return $conn->query($query);//return bezveze da se vidi dal je uspesna

    }

    public function update(mysqli $conn){
        $query = "UPDATE prijave 
        SET predmet = '$this->predmet',
        katedra = '$this->katedra', 
        sala = '$this->sala', 
        datum = '$this->datum'";

        return $conn->query($query);
    }


}

?>