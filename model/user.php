<?php

//kljucna rec class
class User{

    public $id;
    public $username;
    public $password;

    //__consturct - funkcija koja definise konstruktor, incijalizuje obj.
    //postoje i destruktori, brise obj. (poziva se automatski, kad obj. nema vise referenci)
    
    //inace za f-je u php-u se ne navodi povratna vrednost (pretpostavlja void
    //ako nema return statement), i mora da pise kljucna rec function

    //default parametri: ako se ne prosledi nista onda uzima null
    public function __construct($id=null, $username=null, $password=null){

        $this->id= $id;
        $this->username = $username;
        $this->password = $password;

    }

    //mysqli je tip koji prestavlja konekciju za bazom podataka
    public static function logInUser($usr, mysqli $conn){

        //MySQL upit 
        //i inace: php dozvoljava koriscenje promenljivih unutar stringa
        //(vazi samo za dvostruke navodnike, jednostruki tumace string bukvalno)
        $query = "SELECT * FROM user WHERE username='$usr->username' AND password='$usr->password'";

        return $conn->query($query); //ako je ulogovan korisnik da vrati true
        //query($query) ce vratiti true ako $query, tj. SELECT upit, vrati bilo sta

    }

}

?>