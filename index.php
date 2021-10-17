<?php

    //kao include u C
    //skripte se stakuju jedna na drugu, prvo dbBroker koji kreira konekciju,
    //pa user, kome se prosledjuje ta konekcija, i odakle je funkcija za prijavu
    require "dbBroker.php";
    require "model/user.php";

    session_start();
    //jer forma salje post zahtev u kom je upisan username i password
    //post obuhvata sva input polja i hvata njihove nazive (name)
    if(isset($_POST['username']) && isset($_POST['password'])){ 
        
        $uname = $_POST['username'];
        $upass = $_POST['password'];


        $korisnik = new User(null, $uname, $upass);

        //$odg = $korisnik->logInUser($uname, $upass, $conn);
        $odg = User::logInUser($korisnik, $conn); //poziv nad klasom jer ja klasicna

        //ako nam onaj SELECT upit vrati tacno jedan red,
        //to znaci da postoji taj jedinstven korisnik, te mu je dozvoljeno da se prijavi
        if($odg->num_rows==1){
            echo 
            `<script>
            console.log("Uspešno ste se prijavili.");
            </script>`; 
            // ` - backtick - sluzi za pisanje stringa u vise linija
            //na tastaturi se nalazi ispod escape-a

            //postavlja sesiju (mada u nasem slucaju id ne postoji, ali nema veze)
            $_SESSION['user_id']=$korisnik->id;

            header('Location: home.php');//prelazi na home stranicu (home.php)
            exit();//izlazi iz login stranice (index.php)
        }else{
            echo 
            `<script>
            console.log("Niste se prijavili.");
            </script>`; 
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>FON: Zakazivanje kolokvijuma</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control"  required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>
</body>
</html>