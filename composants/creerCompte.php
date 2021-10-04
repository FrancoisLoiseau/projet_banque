<?php

function creerCompte(){

    $header = ["Numero_de_compte" , "Code_agence" , "Identifiant_client"];
    $numCompte = "";
    $numCompteBancaire = "";
    $client = null;
    $compteur = 0;

    while($client == null){
        $recherche = readline("Entrez votre numéro de client : ");
        if(($fClient = fopen("./bdd/client.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($fClient, 1000, ";")) !== FALSE) {
                if($data[0] == $recherche) {
                    $client = ($data[0]);
                }
            }
        }
        if ($client){
            if (($fCompte = fopen("./bdd/compte.csv", "r")) !== FALSE){
                while (($data = fgetcsv($fCompte, 1000, ";")) !== FALSE){
                    if($data[2] == $recherche){
                    $compteur++;
                    }
                }
            }
        }
        else{
            echo("Client non trouvé\n");
        }
        
    }

    if($compteur > 2){
        echo("Vous avez atteint le nombre maximum de comptes autorisé.");
    }
    else{
        $agence = "";
        $trouve = false;
        while(!$trouve){
            $idAgence = readline ("Veuillez saisir votre numéro d'agence (doit contenir 3 chiffres) : ");
            if(($fichier = fopen("./bdd/agence.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                    if($data[0] == $idAgence){
                        $agence = ($data[0]);
                        $trouve = true;
                        break;
                    }
                }
            }
        }
        for($i=0; $i<11; $i++){
            $numCompte .= rand(0,9);
        }
        
        $f = fopen("./bdd/compte.csv", "a+");
        if (filesize("./bdd/compte.csv") > 0){
            $tab = [$numCompte, $agence, $client];
            fputcsv($f, $tab, ";");
        }
        else{
            fputcsv($f, $header, ";");
            $tab = [$numCompte, $agence, $client];
            fputcsv($f, $tab, ";");
        }
        echo("Votre nouveau numéro de compte bancaire est : $numCompte");
        fclose($f);
    }
}

?>