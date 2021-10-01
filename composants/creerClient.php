<?php

function creerClient(){
    echo("\n");
    
    $header = ("Genre;" . "nom;" . "prenom;" . "date de naissance;" . "mail\n");
    $genre = readline ("Veuillez saisir votre genre (taper Homme ou Femme) : ");
    $nom = readline ("Entrez votre nom de famille : ");
    $prenom = readline ("Entrez votre prénom : ");
    $age = readline ("Entrez votre date de naissance (JJ/MM/AAAA) : ");
    $mail = readline ("Veuillez saisir votre e-mail : ");

    $f = fopen("bdd/client.csv", "a+");
    if (filesize("bdd/client.csv") > 0){
        fwrite($f, ($genre . ";" . $nom . ";" . $prenom . ";" . $age . ";" . $mail . "\n"));
    }
    else{
        fwrite($f, ($header));
        fwrite($f, ($genre . ";" . $nom . ";" . $prenom . ";" . $age . ";" . $mail . "\n"));
    }

    $suite = chr(rand(65,90)) . chr(rand(65,90));
    $suite .= rand(100000, 999999);
    echo ("Votre identifiant client est : " . $suite);
    echo "\n";

    fclose($f);
}

?>