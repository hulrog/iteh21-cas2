$('#dodajForm').submit(function(){ //jquery kod - u home.php je ukljucen jq - ako se desio submit...
    event.preventDefault(); //sprecava refresh stranice
    console.log("Dodaj je pokrenut.") //provera da li se desava, u konzoli

    const $form = $(this); //forma kojoj se pristupa $(this) objekat nad kojim je poslat dogadjaj (submit)
    const $inputs = $form.find('input, select, button, textarea'); //sta da pokupi od forme
    const serijalizacija = $form.serialize();//serijalizuje te podatke
    console.log(serijalizacija);//ispusuje ih
    
    //ajax je funkcija koja
    //prihvata JSON objekat -> $_POST u add.php ocekuje predmet, katedru, salu, datum
    request = $.ajax({
        url:'handler/add.php',
        type: 'post',
        data: serijalizacija
    });
    
    //jqXHR - jqery xml http request
    request.done(function(response, textStatus, jqXHR){
        if(response==="Success") //ovamo u add.php smo napisali da echo Success
        {
            alert("Kolokvijum je zakazan");
            console.log("Uspesno zakazivanje");
            location.reload(true);
        }else{
            console.log("Kolokvijum nije zakazan " + response);
        }
        console.log(response);
    })

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila: '+ textStatus, errorThrown)
    });


})