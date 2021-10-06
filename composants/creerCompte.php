<?php

function creerCompte(){
    $header = ["numero_compte" , "code_agence" , "id_client", "solde", "decouvert_autorise", "type_compte"];
    $numCompte = "";
    $client = null;
    $compteur = 0;
    $listeTypeCompte = [];

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
                        $listeTypeCompte[] = $data[5];
                    }
                }
            }
        }
        else{
            echo("Client non trouvé\n");
        }
        
    }

    if($compteur > 2){
        echo("Vous avez atteint le nombre maximum de comptes autorisés.");
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
        
        $solde = 0;
        $decouvert = chr(rand(78,79));
        if($decouvert == "O"){
            $solde = rand(-200, 1500);
        }
        else{
            $solde = rand(0, 1500);
        }

        $comptePossible = ["Livret A", "PEL", "Courant"];
        if($listeTypeCompte !== []){
            $comptePossible = array_diff($comptePossible, $listeTypeCompte);
        }

        $ch = "(Disponible : ";
        foreach($comptePossible as $type){
            $ch .= $type . " - ";
        }
        $ch .= ")";

        $typeCompte = readline ("Quel type de compte voulez vous ? " . $ch . " : ");
        while((!in_array($typeCompte, $comptePossible))){
            echo("Le type de compte voulu est incorrect ou existe déjà.\n");
            $typeCompte = readline ("Quel type de compte voulez vous ? " . $ch . " : ");
        }

        $f = fopen("./bdd/compte.csv", "a+");
        if (filesize("./bdd/compte.csv") > 0){
            $tab = [$numCompte, $agence, $client, $solde, $decouvert, $typeCompte];
            fputcsv($f, $tab, ";");
        }
        else{
            fputcsv($f, $header, ";");
            $tab = [$numCompte, $agence, $client, $solde, $decouvert, $typeCompte];
            fputcsv($f, $tab, ";");
        }
        echo("Votre nouveau numéro de compte bancaire est : " . $numCompte . "\n");
        fclose($f);
    }
}
    
?>